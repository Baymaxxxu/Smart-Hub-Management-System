<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Smart Hub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #111827;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            width: 360px;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Smart Hub Login</h2>
        <p>Masuk sebagai admin untuk mengelola data.</p>

        @if ($errors->any())
            <div class="error">
                Email atau password salah.
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>