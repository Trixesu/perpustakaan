<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(rgba(202, 205, 231, 0.75),
                rgba(103, 115, 205, 0.75)),
            url("{{ asset('images/images.jpg') }}");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);

            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;

            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .login-card h3 {
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .btn-login {
            background: linear-gradient(135deg,
                    #1a237e,
                    #3949ab);

            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-login:hover {
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <i class="bi bi-book" style="font-size:3rem; color:#2c3e50;"></i>
            <h3>Perpustakaan</h3>
            <p class="text-muted">Silakan login untuk melanjutkan</p>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="/perpustakaan/public/login">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="name" class="form-control"
                    placeholder="Masukkan username" value="{{ old('name') }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control"
                    placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>
    </div>
</body>

</html>