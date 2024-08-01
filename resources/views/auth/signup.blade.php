<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.register') }}</title>
</head>
<body>

<h1>{{ __('messages.register') }}</h1>

@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="name">{{ __('messages.name') }}</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
        <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">{{ __('messages.email') }}</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">{{ __('messages.password') }}</label>
        <input type="password" id="password" name="password" required>
        @error('password')
        <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">{{ __('messages.confirm_password') }}</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">{{ __('messages.submit') }}</button>
    </div>
</form>
</body>
</html>