<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<body>
<h1>Вход</h1>

<form action="{{ route('login') }}" method="POST">
    @csrf
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
    <button type="submit">Войти</button>
</form>
</body>
</html>

