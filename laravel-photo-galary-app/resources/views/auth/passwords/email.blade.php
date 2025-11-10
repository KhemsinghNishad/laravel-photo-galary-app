<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f7f7;
        }

        .login-card,
        .register-card {
            max-width: 450px;
            margin: 40px auto;
            padding: 25px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb {
            background: #343a40;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .breadcrumb .breadcrumb-item,
        .breadcrumb a {
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- Breadcrumb Section -->
    <section class="pt-3 pb-3 bg-white shadow-sm">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Forgot Password</li>
            </ol>
        </div>
    </section>

    <!-- Forgot Password Form -->
    <section class="mt-4">
        <div class="container">
            <div class="login-card">

                <h4 class="text-center mb-4">Forgot Password</h4>

                @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Registered Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email"
                            value="{{ old('email') }}" required>
                    </div>

                    <button class="btn btn-dark w-100 btn-lg">Send Reset Link</button>
                </form>

                <div class="text-center mt-3">
                    <small>
                        Remembered your password?
                        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                    </small>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
