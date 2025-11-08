<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
     <p>Hi {{ $user->name ?? $user->email }},</p>
  <p>You requested a password reset. Click the link below to reset your password. This link will expire in 60 minutes.</p>
  <p><a href="{{ $resetUrl }}">{{ $resetUrl }}</a></p>
  <p>If you did not request this, ignore this email.</p>
</body>
</html>