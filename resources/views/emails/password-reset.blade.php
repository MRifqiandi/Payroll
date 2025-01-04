<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
</head>

<body>
    <h1>Password Reset Request</h1>
    <p>We received a request to reset your password. Please click the button below to reset your password:</p>
    <a href="{{ route('password.reset', ['token' => $token]) }}"
        style="display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px;">Reset
        Password</a>
    <p>If you did not request this, please ignore this email.</p>
    <p>Thank you,<br>SIMGAJI</p>
</body>

</html>
