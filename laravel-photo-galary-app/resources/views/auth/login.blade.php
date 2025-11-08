<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
        }

        .login-card {
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
                <li class="breadcrumb-item active">Login</li>
            </ol>
        </div>
    </section>

    <section class="mt-4">
        <div class="container">
            <div class="login-card">
                <h4 class="text-center mb-4">Login</h4>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif


                <form action="" id="userLoginForm" name="userLoginForm" method="POST">

                    <div class="mb-3">
                        <label class="form-label">User ID</label>
                        <input type="number" class="form-control" name="user_id" placeholder="Enter your User ID">
                        <p></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <p></p>
                    </div>

                    <div class="text-end mb-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 btn-lg">Login</button>
                </form>

                <div class="text-center mt-3">
                    <small>Don't have an account?
                        <a href="{{ route('register') }}">Register Now</a>
                    </small>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#userLoginForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('login.process') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.status === false) {

                    var errors = response.errors;
                    if (errors.user_id) {
                        $('input[name="user_id"]').addClass('is-invalid');
                        $('input[name="user_id"]').next('p').html(errors.user_id[0]).addClass(
                            'text-danger');
                    } else {
                        $('input[name="user_id"]').removeClass('is-invalid');
                        $('input[name="user_id"]').next('p').html('').removeClass('text-danger');
                    }
                    if (errors.password) {
                        $('input[name="password"]').addClass('is-invalid');
                        $('input[name="password"]').next('p').html(errors.password[0]).addClass(
                            'text-danger');
                    } else {
                        $('input[name="password"]').removeClass('is-invalid');
                        $('input[name="password"]').next('p').html(errors.password[0]).removeClass(
                            'text-danger');
                    }
                }

                if (response.status === true) {
                    window.location.href = "{{ route('home') }}";
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX error: ' + textStatus + ' : ' + errorThrown);
            }
        });
    });
</script>

</html>
