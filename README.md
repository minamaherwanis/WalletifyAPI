<div align="center">

# 💳 Walletify API

**A secure, scalable digital wallet backend built with Laravel 11**

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8+-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)](https://mysql.com)
[![Sanctum](https://img.shields.io/badge/Sanctum-Auth-FF2D20?style=flat)](https://laravel.com/docs/sanctum)
[![Live Demo](https://img.shields.io/badge/Live%20Demo-Online-22c55e?style=flat&logo=rocket&logoColor=white)](https://walletify-api.infinityfreeapp.com/)

**[🚀 Live Demo →](https://walletify-api.infinityfreeapp.com/)**

</div>

---

## 📌 Overview

Walletify API is a fintech-style RESTful backend that provides complete wallet infrastructure — authentication, balance management, money transfers, deposits, transaction history, and payment gateway integration — built with clean code principles and modern Laravel architecture.

<img width="1920" height="1080" alt="Walletify API Preview" src="https://github.com/user-attachments/assets/bf344676-4296-4677-8a98-4808a3d8b616" />

---

## ✨ Features

| Module | Capabilities |
|---|---|
| 🔐 **Auth** | Register, Login, Logout, Email Verification, Password Reset |
| 💰 **Wallet** | Auto-create wallet, Deposit, Transfer, Balance tracking |
| 📜 **Transactions** | Full history, Validation, Real-time balance updates |
| 💳 **Payments** | Paymob integration, Secure callbacks, Payment verification |
| 📧 **Notifications** | Transfer & deposit emails, Queue-ready, Blade templates |

---

## 🛠 Tech Stack

- **Framework:** Laravel 11
- **Language:** PHP 8+
- **Database:** MySQL
- **Auth:** Laravel Sanctum
- **Payments:** Paymob API
- **Architecture:** RESTful, Service-based, API Resources

---

## 🚀 Installation

```bash
git clone https://github.com/minamaherwanis/WalletifyAPI
cd walletify-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## ⚙️ Environment Variables

```env
APP_NAME=Walletify
APP_URL=http://127.0.0.1:8000

DB_DATABASE=walletify
DB_USERNAME=root
DB_PASSWORD=

PAYMOB_API_KEY=
PAYMOB_INTEGRATION_ID=
PAYMOB_IFRAME_ID=
```

---

## 📡 API Endpoints

<details>
<summary><strong>Auth</strong></summary>

| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/register` | Register new user |
| POST | `/api/login` | Login & get token |

</details>

<details>
<summary><strong>Wallet</strong></summary>

| Method | Endpoint | Description |
|---|---|---|
| GET | `/wallet/balance` | Wallet details & balance |
| POST | `/wallet/deposit` | Deposit funds |
| POST | `/wallet/transfer` | Transfer to another user |
| GET | `/wallet/logs` | Transaction history |

</details>

---

## 📦 Example Response

```json
{
  "status": true,
  "message": "Transfer completed successfully",
  "data": {
    "amount": 500,
    "sender_balance": 1500,
    "receiver_balance": 2500
  }
}
```

---

## 👤 Author

**Mina Maher** — Laravel Backend Developer

[![GitHub](https://img.shields.io/badge/GitHub-minamaherwanis-181717?style=flat&logo=github)](https://github.com/minamaherwanis)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-minamaherwanis-0A66C2?style=flat&logo=linkedin)](https://www.linkedin.com/in/mina-maher-b91369199)
