<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Str;

class WalletController extends Controller
{
    public function getBalance(Request $request)
    {
        $user = $request->user();

        $wallet = $user->wallet;

        if (! $wallet) {
            return response()->json([
                'message' => 'Wallet not found',
            ], 404);
        }

        return response()->json([
            'balance' => $wallet->balance,
            'currency' => $wallet->currency,
        ]);
    }

    public function deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:1'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $user = $request->user();

        $wallet = $user->wallet;
        if (! $wallet) {
            return response()->json([
                'message' => 'Wallet not found',
            ], 404);
        }
        $amount = $request->amount;

        $transactionId = (string) Str::uuid();

        Transactions::create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => $amount,
            'status' => 'pending',
            'reference_id' => $transactionId,
        ]);
        $authResponse = Http::post(
            'https://accept.paymob.com/api/auth/tokens',
            [
                'api_key' => config('services.paymob.api_key'),
            ]
        );

        $token = $authResponse['token'];

        $orderResponse = Http::post(
            'https://accept.paymob.com/api/ecommerce/orders',
            [
                'auth_token' => $token,
                'delivery_needed' => false,
                'amount_cents' => $amount * 100,
                'currency' => 'EGP',
                'merchant_order_id' => $transactionId,
                'items' => [],
            ]
        );

        $orderId = $orderResponse['id'];

        $paymentKeyResponse = Http::post(
            'https://accept.paymob.com/api/acceptance/payment_keys',
            [
                'auth_token' => $token,
                'amount_cents' => $amount * 100,
                'expiration' => 3600,
                'order_id' => $orderId,
                'currency' => 'EGP',

                'billing_data' => [
                    'apartment' => 'NA',
                    'email' => $user->email,
                    'floor' => 'NA',
                    'first_name' => $user->name,
                    'street' => 'NA',
                    'building' => 'NA',
                    'phone_number' => '01000000000',
                    'shipping_method' => 'NA',
                    'postal_code' => 'NA',
                    'city' => 'Cairo',
                    'country' => 'EG',
                    'last_name' => 'NA',
                    'state' => 'Cairo',
                ],

                'integration_id' => config('services.paymob.integration_id'),
            ]
        );
        $paymentToken = $paymentKeyResponse['token'];
        $paymentUrl =
          'https://accept.paymob.com/api/acceptance/iframes/'
          .config('services.paymob.iframe_id')
          .'?payment_token='
          .$paymentToken;

        return response()->json([
            'payment_url' => $paymentUrl,
        ]);
    }

    public function webhook(Request $request)
    {
        $data = $request->all();

        $transactionId = $data['obj']['order']['merchant_order_id'] ?? null;

        if (! $transactionId) {
            return response()->json(['message' => 'invalid data'], 400);
        }

        $transaction = Transactions::where('reference_id', $transactionId)->first();

        if (! $transaction) {
            return response()->json(['message' => 'transaction not found'], 404);
        }

        if (($data['obj']['success'] ?? false) == true) {

            if ($transaction->status == 'pending') {

                $amount = $data['obj']['amount_cents'] / 100;

                $transaction->update([
                    'status' => 'success',
                ]);

                $transaction->user->wallet->increment('balance', $amount);
            }
        } else {
            if ($transaction->status == 'pending') {
                $transaction->update([
                    'status' => 'failed',
                ]);
            }
        }

        return response()->json([
            'message' => 'webhook received',
        ]);
    }

    public function response(Request $request)
    {
        $success = $request->query('success');

        if ($success == 'true' || $success == 1) {
            return view('payment.success');
        }

        return view('payment.failed');
    }

    public function logs(Request $request)
    {
        $user = $request->user();

        $transactions = $user->transactions()->latest()->get();

        return response()->json([
            'transactions' => $transactions,
        ]);
    }


}
