<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A | P ADLER PRO</title>
</head>
<body>
<header>
    <div class="header-top">
        <div class="logo"><img src="https://i.postimg.cc/0N8MTP5P/logo.png" alt="logo"></div>
        <div class="cart">
            <a href="http://localhost/cart">
                <div class="cart-image">
                    <img src="https://i.postimg.cc/JnYk3vLm/icon_cart.png" alt="Cart">
                </div>
                <button class="cart-button" type="submit">
                    <span style="color: #121618">{{ $totalQuantity }} шт</span>
                </button>
            </a>
        </div>
    </div>
    <ul class="nav active">
        <li><a href="#" class="active">HOME</a></li>
        <li><a href="#">MENU</a></li>
        <li><a href="#">FEATURES</a></li>
        <li><a href="#">ABOUT</a></li>
        <li><a href="#">BLOG</a></li>
        <li><a href="#">SHOP</a></li>
        <li><a href="#">CONTACT</a></li>
    </ul>
</header>

<main>
    @yield('content')
</main>

</body>
</html>