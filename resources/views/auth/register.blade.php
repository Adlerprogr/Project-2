<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<h1>Регистрация</h1>

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="first_name">Фамилия:</label>
        @error('first_name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
    </div>
    <div>
        <label for="last_name">Имя:</label>
        @error('last_name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
    </div>
    <div>
        <label for="email">Email:</label>
        @error('email')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        @error('password')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <input type="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Подтверждение пароля:</label>
        @error('password_confirmation')
        <div style="color: red;">{{ $message }}</div>
        @enderror
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>

