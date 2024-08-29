<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #343a40;
            text-align: center;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 50px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="auth_type" class="form-label">Login Method</label>
                <select class="form-select" id="auth_type" name="auth_type" required>
                    <option value="password" selected>Password</option>
                    <option value="otp">OTP</option>
                </select>
            </div>
            <div class="mb-3" id="password-field">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
        </form>
    </div>

    <script>
        document.getElementById('auth_type').addEventListener('change', function() {
            const passwordField = document.getElementById('password-field');
            if (this.value === 'otp') {
                passwordField.style.display = 'none';
                passwordField.querySelector('input').removeAttribute('required');
            } else {
                passwordField.style.display = 'block';
                passwordField.querySelector('input').setAttribute('required', 'required');
            }
        });
    </script>
</body>
</html>
