<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f7f7;
        }

        .auth-card {
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

    <!-- Breadcrumb -->
    <section class="pt-3 pb-3 bg-white shadow-sm">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Reset Password</li>
            </ol>
        </div>
    </section>

    <!-- Reset Form -->
    <section class="mt-4">
        <div class="container">
            <div class="auth-card">

                <h4 class="text-center mb-4">Reset Password</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ request('email') ?? old('email') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               required>
                    </div>

                    <button class="btn btn-dark w-100 btn-lg">Reset Password</button>
                </form>

                <div class="text-center mt-3">
                    <small>
                        Back to
                        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                    </small>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
