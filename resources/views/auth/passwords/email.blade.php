<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - Reset Password</title>
</head>
<body>
    <h2>{{ __('Reset Password') }}</h2>

    <p>{{ __('You are receiving this email because we received a password reset request for your account.') }}</p>
    <p>
        {{ __('Click the button below to reset your password:') }}
        <br>
        <a href="{{ url('password/reset', $token) }}?email={{ urlencode($email) }}" target="_blank">{{ __('Reset Password') }}</a>
    </p>
    <p>{{ __('If you did not request a password reset, no further action is required.') }}</p>

    <p>{{ __('Regards,') }}</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>

