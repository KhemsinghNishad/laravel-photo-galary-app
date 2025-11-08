<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
        }

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
    <section class="pt-3 pb-3 bg-white shadow-sm">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Register</li>
            </ol>
        </div>
    </section>

    <section class="mt-4">
        <div class="container">
            <div class="register-card">
                <h4 class="text-center mb-4">Register Now</h4>

                <form action="{{ route('register.process') }}" id="userRegisterForm" name="userRegisterForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">UserId</label>
                        <input type="number" class="form-control @error('user_id') is-invalid @enderror" id="UserId" name="user_id"
                            placeholder="Enter your UserId" value="{{ old('user_id') }}">
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            placeholder="Enter your full name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            placeholder="Enter your email" value="{{ old('email') }}">
                             @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address </label>
                        <input type="address" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                            placeholder="Enter your address" value="{{ old('address') }}">
                             @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                            placeholder="Phone number" value="{{ old('phone') }}">
                             @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                            placeholder="Create password">
                             @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm password">
                    </div>

                    <div class="text-end mb-3">
                        <a href="#" class="text-decoration-none">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 btn-lg">Register</button>

                </form>

                <div class="text-center mt-3">
                    <small>Already have an account? <a href="login.php">Login Now</a></small>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
