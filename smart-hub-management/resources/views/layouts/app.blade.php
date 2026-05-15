<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Smart Hub Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        .navbar {
            background: #111827;
            color: white;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a, .navbar button {
            color: white;
            background: transparent;
            border: none;
            text-decoration: none;
            margin-left: 16px;
            cursor: pointer;
            font-size: 14px;
        }

        .container {
            padding: 32px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .stat {
            font-size: 32px;
            font-weight: bold;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f9fafb;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 14px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
        }

        .alert {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        .error {
            color: #dc2626;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div>
            <strong>Smart Hub Management</strong>
        </div>

        <div>
            <a href="/dashboard">Dashboard</a>
            <a href="/web/equipment">Equipment</a>

            <form action="/logout" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>