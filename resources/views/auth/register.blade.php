<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<h1>Регистрация</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="first_name">Фамилия:</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
    </div>
    <div>
        <label for="last_name">Имя:</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Подтверждение пароля:</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>

