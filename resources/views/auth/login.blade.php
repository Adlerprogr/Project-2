<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
</head>
<body>
<h1>Вход</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Войти</button>
</form>
</body>
</html>

