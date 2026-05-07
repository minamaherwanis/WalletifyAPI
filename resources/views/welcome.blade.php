<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        window.APP_URL = "{{ env('APP_URL') }}";
    </script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Walletify â€” API Documentation</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/18.2.0/umd/react.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/18.2.0/umd/react-dom.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.23.2/babel.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=JetBrains+Mono:wght@300;400;500;600&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Syne', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        neon: '#3B82F6',
                        neonDark: '#1D4ED8',
                        neonGlow: '#60A5FA',
                        surface: 'rgba(10,14,26,0.95)',
                        glass: 'rgba(15,22,40,0.6)',
                        glassLight: 'rgba(59,130,246,0.08)',
                        border: 'rgba(59,130,246,0.18)',
                        borderHover: 'rgba(59,130,246,0.45)',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4,0,0.6,1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'shimmer': 'shimmer 2.5s linear infinite',
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%,100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-8px)'
                            },
                        },
                        shimmer: {
                            '0%': {
                                backgroundPosition: '-200% 0'
                            },
                            '100%': {
                                backgroundPosition: '200% 0'
                            },
                        },
                        glowPulse: {
                            '0%,100%': {
                                boxShadow: '0 0 20px rgba(59,130,246,0.3)'
                            },
                            '50%': {
                                boxShadow: '0 0 40px rgba(59,130,246,0.6), 0 0 80px rgba(59,130,246,0.2)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #050810;
            color: #e2e8f0;
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #080d1a;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.4);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.7);
        }

        .bg-grid {
            background-image:
                linear-gradient(rgba(59, 130, 246, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
        }

        .glass-panel {
            background: rgba(10, 16, 32, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(59, 130, 246, 0.15);
        }

        .glass-panel:hover {
            border-color: rgba(59, 130, 246, 0.35);
        }

        .endpoint-card {
            background: rgba(8, 13, 26, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(59, 130, 246, 0.12);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .endpoint-card:hover {
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.08), inset 0 0 30px rgba(59, 130, 246, 0.03);
            transform: translateY(-1px);
        }

        .endpoint-card.active {
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 40px rgba(59, 130, 246, 0.12);
            background: rgba(10, 18, 38, 0.9);
        }

        .method-badge {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 3px 10px;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .method-post {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .method-get {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .method-put {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .method-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .method-patch {
            background: rgba(139, 92, 246, 0.15);
            color: #a78bfa;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .code-block {
            background: rgba(4, 8, 18, 0.95);
            border: 1px solid rgba(59, 130, 246, 0.12);
            border-radius: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            line-height: 1.7;
            position: relative;
            overflow: hidden;
        }

        .code-block::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.5), transparent);
        }

        .neon-btn {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(29, 78, 216, 0.3));
            border: 1px solid rgba(59, 130, 246, 0.4);
            color: #93c5fd;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            padding: 8px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .neon-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(29, 78, 216, 0.4));
            opacity: 0;
            transition: opacity 0.25s;
        }

        .neon-btn:hover::before {
            opacity: 1;
        }

        .neon-btn:hover {
            border-color: rgba(59, 130, 246, 0.7);
            color: #bfdbfe;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.25);
            transform: translateY(-1px);
        }

        .neon-btn:active {
            transform: translateY(0);
        }

        .neon-btn-solid {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: 1px solid rgba(96, 165, 250, 0.4);
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .neon-btn-solid:hover {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.4);
            transform: translateY(-1px);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.82rem;
            color: #94a3b8;
            font-family: 'DM Sans', sans-serif;
        }

        .sidebar-link:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #93c5fd;
        }

        .sidebar-link.active {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border-left: 2px solid #3b82f6;
        }

        .try-input {
            background: rgba(4, 8, 18, 0.9);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 8px;
            color: #e2e8f0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            padding: 10px 14px;
            width: 100%;
            transition: border-color 0.2s;
            outline: none;
        }

        .try-input:focus {
            border-color: rgba(59, 130, 246, 0.55);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .try-input::placeholder {
            color: #475569;
        }

        .response-panel {
            background: rgba(2, 5, 12, 0.95);
            border: 1px solid rgba(59, 130, 246, 0.15);
            border-radius: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            padding: 16px;
            max-height: 300px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-break: break-all;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-200 {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .status-4xx {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .status-loading {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .param-row {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr;
            gap: 12px;
            align-items: start;
            padding: 10px 0;
            border-bottom: 1px solid rgba(59, 130, 246, 0.07);
        }

        .param-row:last-child {
            border-bottom: none;
        }

        .tag-required {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.25);
            font-size: 0.65rem;
            padding: 1px 7px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
        }

        .tag-optional {
            background: rgba(148, 163, 184, 0.1);
            color: #94a3b8;
            border: 1px solid rgba(148, 163, 184, 0.2);
            font-size: 0.65rem;
            padding: 1px 7px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
        }

        .header-bar {
            background: rgba(5, 8, 18, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.15);
        }

        .section-heading {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #e2e8f0, #93c5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .copy-btn {
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #64748b;
            padding: 4px 10px;
            border-radius: 5px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .copy-btn:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
            border-color: rgba(59, 130, 246, 0.4);
        }

        .tab-btn {
            padding: 6px 16px;
            border-radius: 7px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            cursor: pointer;
            transition: all 0.2s;
            color: #64748b;
            border: 1px solid transparent;
        }

        .tab-btn.active {
            background: rgba(59, 130, 246, 0.15);
            color: #93c5fd;
            border-color: rgba(59, 130, 246, 0.3);
        }

        .tab-btn:hover:not(.active) {
            color: #94a3b8;
            background: rgba(255, 255, 255, 0.04);
        }

        .sidebar-section-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #334155;
            padding: 4px 12px;
            margin-top: 20px;
            margin-bottom: 4px;
        }

        .floating-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #3b82f6;
            box-shadow: 0 0 10px #3b82f6;
            animation: pulse 2s infinite;
        }

        .json-key {
            color: #93c5fd;
        }

        .json-string {
            color: #86efac;
        }

        .json-number {
            color: #fbbf24;
        }

        .json-bool {
            color: #f472b6;
        }

        .json-null {
            color: #94a3b8;
        }

        .json-bracket {
            color: #64748b;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.4s ease both;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-right {
            animation: slideInRight 0.35s ease both;
        }

        .loading-dots::after {
            content: '...';
            animation: loadingDots 1.2s steps(4, end) infinite;
        }

        @keyframes loadingDots {

            0%,
            20% {
                content: '.';
            }

            40% {
                content: '..';
            }

            60%,
            100% {
                content: '...';
            }
        }

        textarea.try-input {
            resize: vertical;
            min-height: 80px;
        }
    </style>
</head>

<body class="bg-grid">

    <!-- Ambient orbs -->
    <div class="orb"
        style="width:600px;height:600px;top:-200px;right:-100px;background:radial-gradient(circle,rgba(37,99,235,0.12) 0%,transparent 70%);">
    </div>
    <div class="orb"
        style="width:500px;height:500px;bottom:10%;left:-150px;background:radial-gradient(circle,rgba(29,78,216,0.08) 0%,transparent 70%);">
    </div>
    <div class="orb"
        style="width:300px;height:300px;top:50%;left:40%;background:radial-gradient(circle,rgba(59,130,246,0.05) 0%,transparent 70%);">
    </div>

    <div id="root"></div>

    <script type="text/babel">
@verbatim
const { useState, useRef, useEffect, useCallback } = React;

const API_BASE = window.APP_URL + "/api";
const endpoints = [{
  id: "auth-login",
  group: "Authentication",
  name: "Login User",
  method: "POST",
  path: "/login",
  description: "Authenticate user and return access token.",
  auth: false,
  body: JSON.stringify({
    email: "minamaherwanis@gmail.com",
    password: "12345678"
  }, null, 2),
  response200: JSON.stringify({
    status: true,
    message: "Login successful",
    token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
  }, null, 2),
  response401: JSON.stringify({
    status: false,
    message: "Invalid credentials"
  }, null, 2)
},{
  id: "auth-register",
  group: "Authentication",
  name: "Register User",
  method: "POST",
  path: "/register",
  description: "Create a new user account and return access token.",
  auth: false,
  body: JSON.stringify({
    name: "Mina Maher",
    username: "minamaherwanis",
    email: "minamaherwanis@gmail.com",
    password: "Youpassword",
    password_confirmation: "12345678"
  }, null, 2),
  response200: JSON.stringify({
    status: true,
    message: "User registered successfully",
    token: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
  }, null, 2),
  response422: JSON.stringify({
    status: false,
    message: "Validation error",
    errors: {
      email: ["The email has already been taken."]
    }
  }, null, 2)
},{
  id: "wallet-balance",
  group: "Wallet",
  name: "Get Wallet Balance",
  method: "GET",
  path: "/wallet/balance",
  description: "Retrieve the authenticated user's wallet balance.",
  auth: true,
  headers: {
    Authorization: "Bearer {token}"
  },
  response200: JSON.stringify({
    status: true,
    message: "Balance retrieved successfully",
    data: {
      balance: 1500.75,
      currency: "EGP"
    }
  }, null, 2),
  response401: JSON.stringify({
    status: false,
    message: "Unauthenticated"
  }, null, 2)
},{
  id: "wallet-deposit",
  group: "Wallet",
  name: "Deposit Funds",
  method: "POST",
  path: "/wallet/deposit",
  description: "Create a deposit transaction and generate a Paymob payment URL for the user.",
  auth: true,
  headers: {
    Authorization: "Bearer {token}"
  },
  body: JSON.stringify({
    amount: "800"
  }, null, 2),

  response200: JSON.stringify({
    payment_url: "https://accept.paymob.com/api/acceptance/iframes/1040699?payment_token=..."
  }, null, 2),

  response422: JSON.stringify({
    status: false,
    message: "Validation error",
    errors: {
      amount: ["The amount field is required."]
    }
  }, null, 2),

  response401: JSON.stringify({
    status: false,
    message: "Unauthenticated"
  }, null, 2)
},{
  id: "wallet-logs",
  group: "Wallet",
  name: "Get Wallet Logs",
  method: "GET",
  path: "/wallet/logs",
  description: "Retrieve all wallet transactions (deposits, withdrawals, transfers) for the authenticated user.",
  auth: true,
  headers: {
    Authorization: "Bearer {token}"
  },

  queryParams: [
    {
      name: "type",
      type: "string",
      required: false,
      desc: "Filter by transaction type (deposit | withdraw | transfer)"
    },
    {
      name: "status",
      type: "string",
      required: false,
      desc: "Filter by status (pending | completed | failed)"
    },
    {
      name: "page",
      type: "number",
      required: false,
      desc: "Pagination page number"
    }
  ],

  response200: JSON.stringify({
    status: true,
    message: "Wallet logs retrieved successfully",
    data: [
      {
        id: 1,
        type: "deposit",
        amount: 800,
        status: "completed",
        reference: "DEP-10482",
        created_at: "2026-05-07T12:00:00Z"
      }
    ],
    pagination: {
      current_page: 1,
      last_page: 5,
      per_page: 10,
      total: 42
    }
  }, null, 2),

  response401: JSON.stringify({
    status: false,
    message: "Unauthenticated"
  }, null, 2)
},{
  id: "wallet-transfer",
  group: "Wallet",
  name: "Transfer Money",
  method: "POST",
  path: "/wallet/transfer",
  description: "Transfer money from the authenticated user to another user using username.",
  auth: true,

  headers: {
    Authorization: "Bearer {token}"
  },

  body: JSON.stringify({
    username: "minamaherwanis",
    amount: "1"
  }, null, 2),

  response200: JSON.stringify({
    status: true,
    message: "Transfer completed successfully",
    data: {
      from_user: "mina",
      to_user: "abanobnabeh",
      amount: 1,
      fee: 0,
      transaction_id: "TRF-10021",
      balance_after: 1499.75
    }
  }, null, 2),

  response422: JSON.stringify({
    status: false,
    message: "Validation error",
    errors: {
      username: ["The selected username is invalid."],
      amount: ["The amount must be at least 1."]
    }
  }, null, 2),

  response401: JSON.stringify({
    status: false,
    message: "Unauthenticated"
  }, null, 2),

  response400: JSON.stringify({
    status: false,
    message: "Insufficient balance"
  }, null, 2)
}];

const groups = [...new Set(endpoints.map(e => e.group))];

// â”€â”€â”€ HELPERS â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function syntaxHighlight(json) {
  return json
    .replace(/(".*?")\s*:/g, '<span class="json-key">$1</span>:')
    .replace(/:\s*(".*?")/g, ': <span class="json-string">$1</span>')
    .replace(/:\s*(\d+\.?\d*)/g, ': <span class="json-number">$1</span>')
    .replace(/:\s*(true|false)/g, ': <span class="json-bool">$1</span>')
    .replace(/:\s*(null)/g, ': <span class="json-null">$1</span>')
    .replace(/([{}\[\]])/g, '<span class="json-bracket">$1</span>');
}

function MethodBadge({ method }) {
  const cls = `method-badge method-${method.toLowerCase()}`;
  return <span className={cls}>{method}</span>;
}

function CopyButton({ text }) {
  const [copied, setCopied] = useState(false);
  const copy = () => {
    navigator.clipboard?.writeText(text).catch(() => {});
    setCopied(true);
    setTimeout(() => setCopied(false), 1800);
  };
  return (
    <button className="copy-btn" onClick={copy}>
      {copied ? 'âœ“ copied' : 'copy'}
    </button>
  );
}

// â”€â”€â”€ TRY IT PANEL â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function TryItPanel({ endpoint }) {
  const [token, setToken] = useState('');
  const [body, setBody] = useState(endpoint.body || '');
  const [loading, setLoading] = useState(false);
  const [result, setResult] = useState(null);
  const [statusCode, setStatusCode] = useState(null);
const [formData, setFormData] = useState({
  amount: ""
});
  useEffect(() => {
    setBody(endpoint.body || '');
    setResult(null);
    setStatusCode(null);
  }, [endpoint.id]);

  const sendRequest = async () => {
    setLoading(true);
    setResult(null);
    setStatusCode(null);

    try {
      let parsedBody = null;

      if (body && body.trim().length > 0) {
        parsedBody = JSON.parse(body);
      }

      const res = await fetch(`${API_BASE}${endpoint.path}`, {
        method: endpoint.method,
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          ...(token ? { Authorization: `Bearer ${token}` } : {})
        },
        body: endpoint.method !== "GET" ? JSON.stringify(parsedBody) : null
      });

      const data = await res.json();

      setStatusCode(res.status);
      setResult(JSON.stringify(data, null, 2));

    } catch (err) {
      setStatusCode(500);
      setResult(JSON.stringify({
        status: false,
        message: "Client error or invalid JSON",
        error: err.message
      }, null, 2));
    }

    setLoading(false);
  };

  const statusCls =
    statusCode
      ? statusCode < 300
        ? "status-200"
        : "status-4xx"
      : "status-loading";

  return (
    <div className="mt-4 rounded-xl overflow-hidden"
      style={{ background: 'rgba(4,8,18,0.6)', border: '1px solid rgba(59,130,246,0.15)' }}>

      <div className="flex items-center gap-3 px-4 py-3"
        style={{ borderBottom: '1px solid rgba(59,130,246,0.1)', background: 'rgba(59,130,246,0.05)' }}>

        <span style={{ fontFamily: 'Syne', fontSize: '0.8rem', fontWeight: 700, color: '#93c5fd' }}>
          Try It Live
        </span>

        <span style={{ fontFamily: 'JetBrains Mono', fontSize: '0.7rem', color: '#475569', marginLeft: 'auto' }}>
          {API_BASE}{endpoint.path}
        </span>
      </div>

      <div className="p-4 space-y-3">

        {endpoint.auth && (
          <input
            className="try-input"
            placeholder="Bearer Token"
            value={token}
            onChange={e => setToken(e.target.value)}
          />
        )}

        {endpoint.body !== null && (
          <textarea
            className="try-input"
            value={body}
            onChange={e => setBody(e.target.value)}
            rows={6}
          />
        )}

        <button className="neon-btn-solid" onClick={sendRequest} disabled={loading}>
          {loading ? "Sending..." : `Send ${endpoint.method}`}
        </button>

        {statusCode && (
          <div className={`status-badge ${statusCls}`}>
            {statusCode}
          </div>
        )}

       {result && (
  <div className="response-panel">

    {JSON.parse(result)?.payment_url ? (
      <div className="flex flex-col gap-3">

        <div style={{ color: "#94a3b8" }}>
          Payment link generated successfully
        </div>

        <a
          href={JSON.parse(result).payment_url}
          target="_blank"
          rel="noopener noreferrer"
          className="neon-btn-solid"
          style={{
            textDecoration: "none",
            width: "fit-content"
          }}
        >
          Pay Now
        </a>

      </div>
    ) : (
      result
    )}

  </div>
)}
      </div>
    </div>
  );
}
// â”€â”€â”€ ENDPOINT DETAIL â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function EndpointDetail({ endpoint }) {
  const [tab, setTab] = useState('params');
  const [tryOpen, setTryOpen] = useState(false);
  const allParams = [...(endpoint.params || []), ...(endpoint.queryParams || [])];

  return (
    <div className="endpoint-card rounded-2xl p-6 active fade-in-up" id={endpoint.id}>

      {/* Header */}
      <div className="flex flex-wrap items-start gap-3 mb-5">
        <MethodBadge method={endpoint.method} />
        <code style={{ fontFamily: 'JetBrains Mono', fontSize: '0.88rem', color: '#e2e8f0', background: 'rgba(59,130,246,0.08)', padding: '3px 12px', borderRadius: 6, border: '1px solid rgba(59,130,246,0.15)', flex: 1, minWidth: 200 }}>
          {endpoint.path}
        </code>
        {endpoint.auth && (
          <span style={{ display: 'flex', alignItems: 'center', gap: 5, fontFamily: 'JetBrains Mono', fontSize: '0.68rem', color: '#fbbf24', background: 'rgba(245,158,11,0.1)', border: '1px solid rgba(245,158,11,0.2)', padding: '3px 10px', borderRadius: 6 }}>
            Auth Required
          </span>
        )}
      </div>

      <h3 style={{ fontFamily: 'Syne', fontWeight: 700, fontSize: '1.15rem', color: '#e2e8f0', marginBottom: 6 }}>{endpoint.name}</h3>
      <p style={{ color: '#64748b', fontSize: '0.875rem', lineHeight: 1.6, marginBottom: 20 }}>{endpoint.description}</p>

      {/* Tabs */}
      <div className="flex gap-2 flex-wrap mb-5" style={{ borderBottom: '1px solid rgba(59,130,246,0.1)', paddingBottom: 12 }}>
        {allParams.length > 0 && <button className={`tab-btn ${tab === 'params' ? 'active' : ''}`} onClick={() => setTab('params')}>Parameters</button>}
        {endpoint.body && <button className={`tab-btn ${tab === 'body' ? 'active' : ''}`} onClick={() => setTab('body')}>Request Body</button>}
        <button className={`tab-btn ${tab === 'response' ? 'active' : ''}`} onClick={() => setTab('response')}>Response</button>
      </div>

      {/* Tab content */}
      {tab === 'params' && allParams.length > 0 && (
        <div className="fade-in-up">
          <div style={{ fontFamily: 'JetBrains Mono', fontSize: '0.65rem', color: '#334155', letterSpacing: '0.1em', textTransform: 'uppercase', display: 'grid', gridTemplateColumns: '1fr 1fr 2fr', gap: 12, padding: '6px 0', marginBottom: 4 }}>
            <span>Name</span><span>Type</span><span>Description</span>
          </div>
          {allParams.map(p => (
            <div key={p.name} className="param-row">
              <div className="flex items-center gap-2 flex-wrap">
                <code style={{ fontFamily: 'JetBrains Mono', fontSize: '0.78rem', color: '#93c5fd' }}>{p.name}</code>
                {p.required ? <span className="tag-required">required</span> : <span className="tag-optional">optional</span>}
              </div>
              <code style={{ fontFamily: 'JetBrains Mono', fontSize: '0.75rem', color: '#fbbf24' }}>{p.type}</code>
              <span style={{ fontSize: '0.8rem', color: '#64748b', lineHeight: 1.5 }}>{p.desc}</span>
            </div>
          ))}
        </div>
      )}

      {tab === 'body' && endpoint.body && (
        <div className="fade-in-up">
          <div className="code-block p-4">
            <div className="flex justify-between items-center mb-3">
              <span style={{ fontFamily: 'JetBrains Mono', fontSize: '0.65rem', color: '#475569', letterSpacing: '0.1em' }}>JSON BODY</span>
              <CopyButton text={endpoint.body} />
            </div>
            <div dangerouslySetInnerHTML={{ __html: syntaxHighlight(endpoint.body) }} />
          </div>
        </div>
      )}

      {tab === 'response' && (
        <div className="fade-in-up space-y-4">
          {endpoint.response200 && (
            <div>
              <div className="flex items-center gap-2 mb-2">
                <span className="status-badge status-200"><span style={{ width: 5, height: 5, borderRadius: '50%', background: 'currentColor', display: 'inline-block' }}></span>200 OK</span>
                <span style={{ fontFamily: 'JetBrains Mono', fontSize: '0.7rem', color: '#475569' }}>Success</span>
              </div>
              <div className="code-block p-4">
                <div className="flex justify-between items-center mb-3">
                  <span style={{ fontFamily: 'JetBrains Mono', fontSize: '0.65rem', color: '#475569', letterSpacing: '0.1em' }}>RESPONSE BODY</span>
                  <CopyButton text={endpoint.response200} />
                </div>
                <div dangerouslySetInnerHTML={{ __html: syntaxHighlight(endpoint.response200) }} />
              </div>
            </div>
          )}
          {(endpoint.response422 || endpoint.response401 || endpoint.response404) && (
            <div>
              <div className="flex items-center gap-2 mb-2">
                <span className="status-badge status-4xx"><span style={{ width: 5, height: 5, borderRadius: '50%', background: 'currentColor', display: 'inline-block' }}></span>{endpoint.response422 ? '422' : endpoint.response401 ? '401' : '404'}</span>
                <span style={{ fontFamily: 'JetBrains Mono', fontSize: '0.7rem', color: '#475569' }}>Error</span>
              </div>
              <div className="code-block p-4">
                <div dangerouslySetInnerHTML={{ __html: syntaxHighlight(endpoint.response422 || endpoint.response401 || endpoint.response404) }} />
              </div>
            </div>
          )}
        </div>
      )}

      {/* Try it */}
      <div className="mt-5 pt-4" style={{ borderTop: '1px solid rgba(59,130,246,0.08)' }}>
        <button className="neon-btn" onClick={() => setTryOpen(o => !o)}>
          {tryOpen ? 'Hide Panel' : 'Try it live'}
        </button>
        {tryOpen && <TryItPanel endpoint={endpoint} />}
      </div>
    </div>
  );
}

// â”€â”€â”€ SIDEBAR â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function Sidebar({ activeId, onSelect, mobileOpen, onClose }) {
  return (
    <>
      {mobileOpen && (
        <div
          className="fixed inset-0 z-30"
          style={{ background: 'rgba(0,0,0,0.6)', backdropFilter: 'blur(4px)' }}
          onClick={onClose}
        />
      )}
      <aside
        className={`fixed top-0 left-0 h-full z-40 flex flex-col transition-transform duration-300 ${mobileOpen ? 'translate-x-0' : '-translate-x-full'} lg:translate-x-0 lg:static lg:h-auto lg:flex`}
        style={{ width: 256, minWidth: 256, background: 'rgba(5,8,18,0.97)', borderRight: '1px solid rgba(59,130,246,0.1)', overflowY: 'auto', paddingBottom: 40 }}
      >
        {/* Logo */}
        <div className="p-5 sticky top-0" style={{ background: 'rgba(5,8,18,0.97)', borderBottom: '1px solid rgba(59,130,246,0.1)', zIndex: 1 }}>
          <div className="flex items-center gap-3">
            <div style={{ width: 34, height: 34, borderRadius: 10, background: 'linear-gradient(135deg,#2563eb,#1d4ed8)', display: 'flex', alignItems: 'center', justifyContent: 'center', boxShadow: '0 0 20px rgba(59,130,246,0.4)', fontSize: '1rem' }}>
              W
            </div>
            <div>
              <div style={{ fontFamily: 'Syne', fontWeight: 800, fontSize: '1rem', color: '#e2e8f0' }}>Walletify</div>
              <div style={{ fontFamily: 'JetBrains Mono', fontSize: '0.62rem', color: '#334155' }}>API v1.0</div>
            </div>
          </div>
        </div>

        <nav className="flex-1 p-3 pt-2">
          <div className="sidebar-section-title">Overview</div>
          {[{ id: 'overview', label: 'Introduction' }, { id: 'auth-guide', label: 'Authentication' }].map(item => (
            <div key={item.id}
              className={`sidebar-link ${activeId === item.id ? 'active' : ''}`}
              onClick={() => { onSelect(item.id); document.getElementById(item.id)?.scrollIntoView({ behavior: 'smooth', block: 'start' }); onClose(); }}
            >{item.label}</div>
          ))}

          {groups.map(group => (
            <div key={group}>
              <div className="sidebar-section-title">{group}</div>
              {endpoints.filter(e => e.group === group).map(ep => (
                <div key={ep.id}
                  className={`sidebar-link ${activeId === ep.id ? 'active' : ''}`}
                  onClick={() => { onSelect(ep.id); document.getElementById(ep.id)?.scrollIntoView({ behavior: 'smooth', block: 'start' }); onClose(); }}
                >
                  <span className={`method-badge method-${ep.method.toLowerCase()}`} style={{ fontSize: '0.6rem', padding: '2px 7px', flexShrink: 0 }}>{ep.method}</span>
                  <span style={{ overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>{ep.name}</span>
                </div>
              ))}
            </div>
          ))}
        </nav>

        <div className="p-4 mx-3 mb-3 rounded-xl" style={{ background: 'rgba(59,130,246,0.05)', border: '1px solid rgba(59,130,246,0.12)' }}>
          <div style={{ fontFamily: 'JetBrains Mono', fontSize: '0.65rem', color: '#334155', marginBottom: 4 }}>BASE URL</div>
          <code style={{ fontFamily: 'JetBrains Mono', fontSize: '0.7rem', color: '#60a5fa', wordBreak: 'break-all' }}>{API_BASE}</code>
        </div>
      </aside>
    </>
  );
}

// â”€â”€â”€ OVERVIEW SECTION â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function OverviewSection() {
  return (
    <div className="space-y-6 fade-in-up" id="overview">
      <div>
        <div style={{ fontFamily: 'JetBrains Mono', fontSize: '0.7rem', color: '#3b82f6', letterSpacing: '0.15em', textTransform: 'uppercase', marginBottom: 8 }}>Getting Started</div>
        <h2 className="section-heading" style={{ fontSize: '2rem', marginBottom: 12 }}>Walletify API</h2>
        <p style={{ color: '#64748b', fontSize: '0.9rem', lineHeight: 1.8, maxWidth: 680 }}>
          The Walletify REST API lets you build powerful wallet-powered applications â€” from peer-to-peer payments and deposits to full transaction ledgers. All responses use JSON and follow predictable RESTful conventions.
        </p>
      </div>

      <div className="grid gap-4" style={{ gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))' }}>
        {[
          { icon: '', label: 'REST API', desc: 'Standard HTTP methods with JSON responses' },
          { icon: '', label: 'JWT Auth', desc: 'Stateless Bearer token authentication' },

          { icon: '', label: 'v1 Stable', desc: 'Production-ready, backwards-compatible' },
        ].map(f => (
          <div key={f.label} className="glass-panel rounded-xl p-4" style={{ transition: 'all 0.3s' }}>
            <div style={{ fontSize: '1.4rem', marginBottom: 8 }}>{f.icon}</div>
            <div style={{ fontFamily: 'Syne', fontWeight: 700, fontSize: '0.9rem', color: '#e2e8f0', marginBottom: 4 }}>{f.label}</div>
            <div style={{ fontSize: '0.78rem', color: '#475569', lineHeight: 1.5 }}>{f.desc}</div>
          </div>
        ))}
      </div>

      {/* Auth guide */}
      <div id="auth-guide" className="glass-panel rounded-xl p-5">
        <h3 style={{ fontFamily: 'Syne', fontWeight: 700, fontSize: '1rem', color: '#93c5fd', marginBottom: 12 }}>Authentication</h3>
        <p style={{ color: '#64748b', fontSize: '0.85rem', lineHeight: 1.7, marginBottom: 16 }}>
          Obtain a Bearer token via <code style={{ color: '#60a5fa', fontFamily: 'JetBrains Mono' }}>/api/login</code> or <code style={{ color: '#60a5fa', fontFamily: 'JetBrains Mono' }}>/api/register</code>, then include it in every protected request:
        </p>
        <div className="code-block p-4">
          <div style={{ color: '#475569', fontFamily: 'JetBrains Mono', fontSize: '0.75rem', marginBottom: 6 }}>// HTTP Header</div>
          <div>
            <span className="json-key">Authorization</span><span className="json-bracket">:</span> <span className="json-string">Bearer eyJ0eXAiOiJKV1Qi...</span>
          </div>
          <div style={{ marginTop: 8 }}>
            <span className="json-key">Content-Type</span><span className="json-bracket">:</span> <span className="json-string">application/json</span>
          </div>
          <div>
            <span className="json-key">Accept</span><span className="json-bracket">:</span> <span className="json-string">application/json</span>
          </div>
        </div>
      </div>

      {/* Error guide */}
    </div>
  );
}

// â”€â”€â”€ MAIN APP â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€
function App() {
  const [activeId, setActiveId] = useState('overview');
  const [mobileOpen, setMobileOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState('');

  const filtered = searchQuery
    ? endpoints.filter(e =>
        e.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
        e.path.toLowerCase().includes(searchQuery.toLowerCase()) ||
        e.method.toLowerCase().includes(searchQuery.toLowerCase())
      )
    : null;

  return (
    <div style={{ minHeight: '100vh', display: 'flex', flexDirection: 'column', position: 'relative', zIndex: 1 }}>
      {/* Header */}
      <header className="header-bar sticky top-0 z-50 flex items-center gap-4 px-4 lg:px-6" style={{ height: 60 }}>
        <button
          className="lg:hidden neon-btn"
          style={{ padding: '6px 12px' }}
          onClick={() => setMobileOpen(true)}
        >Menu</button>

        <div style={{ fontFamily: 'Syne', fontWeight: 800, fontSize: '1rem', color: '#e2e8f0', display: 'flex', alignItems: 'center', gap: 8 }}>
          <span style={{ color: '#3b82f6' }}>W</span> Walletify
          <span style={{ fontFamily: 'JetBrains Mono', fontSize: '0.65rem', color: '#334155', background: 'rgba(59,130,246,0.1)', border: '1px solid rgba(59,130,246,0.2)', padding: '2px 8px', borderRadius: 5 }}>API v1</span>
        </div>

       

        <div className="ml-auto flex items-center gap-3">
         <div class="flex items-center gap-2 lg:gap-2.5">
            <a href="https://discord.com/users/1313883982982549590" target="_blank" rel="noopener" aria-label="Discord"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.317 4.369a19.791 19.791 0 00-4.885-1.515.07.07 0 00-.074.037 13.66 13.66 0 00-.59 1.204 18.827 18.827 0 00-5.778 0 12.81 12.81 0 00-.603-1.204.069.069 0 00-.074-.037 19.736 19.736 0 00-4.886 1.515.062.062 0 00-.028.023C2.83 9.04 2.27 13.573 2.54 18.057a.082.082 0 00.031.056 19.9 19.9 0 006.041 3.07.07.07 0 00.077-.027 13.914 13.914 0 001.212-1.86.07.07 0 00-.034-.097 11.133 11.133 0 01-1.588-.762.07.07 0 01-.006-.118c.106-.08.212-.163.311-.248a.07.07 0 01.073-.01c3.327 1.519 6.927 1.519 10.218 0a.07.07 0 01.075.01c.099.085.205.168.311.248a.07.07 0 01-.006.118 11.174 11.174 0 01-1.588.762.07.07 0 00-.034.097 13.877 13.877 0 001.212 1.86.07.07 0 00.077.027 19.869 19.869 0 006.04-3.07.082.082 0 00.032-.056c.533-5.177-.838-9.67-2.673-13.665a.061.061 0 00-.028-.023zm-11.42 9.707c-1.183 0-2.156-1.085-2.156-2.419 0-1.333.955-2.418 2.156-2.418 1.21 0 2.18 1.098 2.155 2.418 0 1.334-.955 2.419-2.155 2.419zm6.174 0c-1.183 0-2.156-1.085-2.156-2.419 0-1.333.955-2.418 2.156-2.418 1.21 0 2.18 1.098 2.155 2.418 0 1.334-.945 2.419-2.155 2.419z" />
                </svg>
            </a>
            <a href="https://github.com/minamaherwanis" target="_blank" rel="noopener" aria-label="GitHub"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.167 6.839 9.489.5.092.682-.217.682-.483 0-.237-.009-.868-.014-1.703-2.782.604-3.369-1.342-3.369-1.342-.454-1.153-1.11-1.461-1.11-1.461-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.529 2.341 1.088 2.91.833.091-.647.349-1.088.636-1.338-2.22-.253-4.555-1.112-4.555-4.944 0-1.091.39-1.984 1.032-2.682-.103-.253-.447-1.27.098-2.645 0 0 .84-.269 2.75 1.025A9.563 9.563 0 0112 6.845c.85.004 1.705.115 2.504.338 1.909-1.294 2.748-1.025 2.748-1.025.547 1.375.203 2.392.1 2.645.644.698 1.031 1.591 1.031 2.682 0 3.842-2.338 4.687-4.566 4.937.359.308.678.918.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .268.18.579.688.48C19.137 20.165 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                </svg>
            </a>
            <a href="https://instagram.com/mina_maher_wanis" target="_blank" rel="noopener" aria-label="Instagram"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zm8.75 2.25a.75.75 0 110 1.5.75.75 0 010-1.5zm-4.25 1.25a5.25 5.25 0 110 10.5 5.25 5.25 0 010-10.5zm0 1.5a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                </svg>
            </a>
            <a href="https://www.linkedin.com/in/mina-maher-b91369199" target="_blank" rel="noopener" aria-label="LinkedIn"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M6.94 6.5a2.06 2.06 0 11-.001 4.122A2.06 2.06 0 016.94 6.5zm.06 4.98H4.5V20h2.5V11.48zm4.88 0h-2.5V20h2.5v-4.9c0-1.18.1-2.7 1.64-2.7 1.55 0 1.56 1.32 1.56 2.78V20h2.5v-5.2c0-3.7-.78-5.3-4.1-5.3-1.86 0-2.63 1.03-3.08 1.75h.04V11.5z" />
                </svg>
            </a>
            <a href="https://www.facebook.com/maher.mena.16" target="_blank" rel="noopener" aria-label="Facebook"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.43 8.86 8 9.8V15H8v-3h2v-2.2C10 8.8 11 8 12.76 8c.85 0 1.53.06 1.74.09v2.02h-1.2c-.94 0-1.12.45-1.12 1.1V12h2.3l-.3 3H13.3v6.8c4.57-.94 8-4.96 8-9.8z" />
                </svg>
            </a>
        </div>
        </div>
      </header>

      {/* Body */}
      <div className="flex flex-1">
        <Sidebar activeId={activeId} onSelect={setActiveId} mobileOpen={mobileOpen} onClose={() => setMobileOpen(false)} />

        {/* Main */}
        <main className="flex-1 min-w-0 px-4 sm:px-8 py-10" style={{ maxWidth: '100%' }}>
          <div style={{ maxWidth: 800, margin: '0 auto' }}>

            {searchQuery && filtered ? (
              <div>
                <div style={{ fontFamily: 'Syne', fontWeight: 700, fontSize: '0.9rem', color: '#64748b', marginBottom: 16 }}>
                  {filtered.length} result{filtered.length !== 1 ? 's' : ''} for "<span style={{ color: '#60a5fa' }}>{searchQuery}</span>"
                </div>
                {filtered.length === 0 ? (
                  <div style={{ textAlign: 'center', color: '#334155', padding: '60px 0', fontFamily: 'JetBrains Mono', fontSize: '0.85rem' }}>
                    No endpoints matched your search.
                  </div>
                ) : (
                  <div className="space-y-5">
                    {filtered.map(ep => <EndpointDetail key={ep.id} endpoint={ep} />)}
                  </div>
                )}
              </div>
            ) : (
              <div className="space-y-5">
                <OverviewSection />
                {groups.map(group => (
                  <div key={group}>
                    <div style={{ fontFamily: 'Syne', fontWeight: 700, fontSize: '0.7rem', letterSpacing: '0.15em', textTransform: 'uppercase', color: '#334155', padding: '24px 0 12px', display: 'flex', alignItems: 'center', gap: 10 }}>
                      <span style={{ flex: 1, height: 1, background: 'rgba(59,130,246,0.1)' }}></span>
                      <span style={{ color: '#475569' }}>{group}</span>
                      <span style={{ flex: 1, height: 1, background: 'rgba(59,130,246,0.1)' }}></span>
                    </div>
                    <div className="space-y-4">
                      {endpoints.filter(e => e.group === group).map(ep => (
                        <EndpointDetail key={ep.id} endpoint={ep} />
                      ))}
                    </div>
                  </div>
                ))}

                {/* Footer */}
                <div style={{ textAlign: 'center', padding: '40px 0 20px', borderTop: '1px solid rgba(59,130,246,0.08)', marginTop: 20 }}>
                  <div style={{ fontFamily: 'Syne', fontWeight: 700, fontSize: '1.2rem', color: '#e2e8f0', marginBottom: 6 }}>
                    <span style={{ color: '#3b82f6' }}>W</span> Walletify API
                  </div>
                  <div style={{ fontFamily: 'JetBrains Mono', fontSize: '0.7rem', color: '#334155' }}>
                    v1.0 â€” All rights reserved آ© {new Date().getFullYear()}
                  </div>
                </div>
              </div>
            )}
          </div>
        </main>
      </div>
    </div>
  );
}

ReactDOM.createRoot(document.getElementById('root')).render(<App />);
@endverbatim
</script>
</body>

</html>
