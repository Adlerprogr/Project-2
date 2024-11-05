@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
    <div class="container">
        <div class="row">
            <div class="title-box">
                <h1>САЛАТЫ И ЗАКУСКИ</h1>
            </div>
            @foreach ($categoryProducts as $categoryProduct)
                <div class="product-card">
                    <a class="bk" href="{{ route('product.show', ['id' => $categoryProduct->id]) }}">
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $categoryProduct->image->way) }}" alt="Morning Set">
                        </div>
                        <div class="product-info">
                            <p>{{ $categoryProduct->weight }} г.</p>
                            <h2>{{ $categoryProduct->name }}</h2>
                            <div class="price-order">
                                <span class="price">
                                    @if($showInUSD)
                                        {{ number_format($categoryProduct->price * $exchangeRate, 2) }} $
                                    @else
                                        {{ number_format($categoryProduct->price, 2) }} ₽
                                    @endif
                                </span>
                            </div>
                            <div class="quantity_inner">
                                <form name='delete_product' action="{{ route('delete-product') }}" method="POST">

                                    <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$categoryProduct->id}}" />
                                    <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                    @csrf
                                    <button class="bt_minus">
                                        <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>

                                </form>

                                <input type="number" value="1" size="2" name="quantity" class="quantity" min="1" max="10" readonly/>

                                <form name='plus_product' action="{{ route('plus-product') }}" method="POST">

                                    <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$categoryProduct->id}}" />
                                    <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                    @csrf
                                    <button class="bt_plus">
                                        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>

                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="title-box">
                <h1>ВСЕ ПРОДУКТЫ</h1>
            </div>
            @foreach ($products as $product)
                <div class="product-card">
                    <a class="bk" href="{{ route('product.show', ['id' => $product->id]) }}">
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $product->image->way) }}" alt="Morning Set">
                        </div>
                        <div class="product-info">
                            <p>{{ $product->weight }} г.</p>
                            <h2>{{ $product->name }}</h2>
                            <div class="price-order">
                                <span class="price">
                                    @if($showInUSD)
                                        {{ number_format($product->price * $exchangeRate, 2) }} $
                                    @else
                                        {{ number_format($product->price, 2) }} ₽
                                    @endif
                                </span>
                            </div>
                            <div class="quantity_inner">
                                <form name='delete_product' action="{{ route('delete-product') }}" method="POST">

                                    <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$product->id}}" />
                                    <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                    @csrf
                                    <button class="bt_minus">
                                        <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>

                                </form>

                                <input type="number" value="1" size="2" name="quantity" class="quantity" min="1" max="10" readonly/>

                                <form name='plus_product' action="{{ route('plus-product') }}" method="POST">

                                    <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$product->id}}" />
                                    <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                    @csrf
                                    <button class="bt_plus">
                                        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    </button>

                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection


<style>
    body {
        background-color: #d0d0d0;
    }

    .catainer{
        display:flex;
        flex-direction:column;
        margin:0 auto;
        text-align:center;
    }

    .product-card {
        width: 300px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: left;
        margin: 15px;
    }

    .image-container img {
        width: 100%;
        border-radius: 15px;
    }

    .product-info {
        display: flex; /* Включаем flexbox */
        flex-direction: column; /* Выстраиваем элементы по вертикали */
        justify-content: space-between; /* Распределяем элементы по вертикали с равными отступами */
        align-items: flex-start; /* Выравниваем элементы по левому краю */
    }

    .product-info h2 {
        margin: 15px 0 10px;
        font-size: 24px;
    }

    .product-info p {
        font-size: 14px;
        color: #555;
        margin-top: 10px;
    }

    .tags {
        margin: 10px 0;
    }

    .bk {
        text-decoration: none;
        color: #000;
        font-weight: bold;
        vertical-align: bottom; /* Привязываем текст к низу */
    }

    .bk:hover {
        color: #000;
    }

    .tag {
        cursor:pointer;
        display: inline-block;
        background-color:orange ;
        border-radius: 10px;
        padding: 5px 10px;
        font-size: 12px;
        margin-right: 5px;
    }
    .tag:hover {
        background-color:greenyellow;
    }
    .price-order {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /*margin-top: 15px;*/
        margin-left: auto;

        width: 100%;
        padding-top: 10px;
        border-top: 1px solid #ddd;
    }

    .price {
        font-size: 24px;
        font-weight: bold;
    }

    .order-button {
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
    }

    .order-button:hover {
        background-color: #444;
        color:greenyellow;
    }
    .favorite-star{
        cursor:pointer;
    }
    .favorite-star.active {
        color: gold;
    }

    @import url('https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html{
        font-family: "PT Sans Narrow", sans-serif;
        color: #dce4e8;
        font-size: 14px;
    }

    header{
        background: #777777;
        padding: 50px 90px;
    }

    .header-top{
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 50px;
    }

    .logo {
        margin: 0 auto;
    }

    .schedule{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .schedule img{
        max-width: 25px;
        margin-right: 25px;
    }

    .schedule-right .phone, .cart-left .amount{
        font-size: 15px;
        font-weight: bold;
        letter-spacing: 3px;
        margin-bottom: 10px;
    }

    .schedule-right .time, .cart-left .items{
        color: #dce4e8;
        letter-spacing: 2px;
        opacity: .5;
        transition: .25s;
    }

    .logo img{
        max-width: 180px;
    }

    .cart{
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row-reverse;
        text-align: right;
        cursor: pointer;
        transition: .25s;
    }

    .cart img{
        max-width: 35px;
        margin-left: 25px;
    }

    .cart:hover .items{
        color: #ffc851;
        opacity: 1;
    }

    .cart:active img{
        transform: scale(0.9);
    }

    .nav{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav li{
        list-style: none;
        margin: 0 20px;
    }

    .nav li a{
        position: relative;
        display: inline-block;
        text-decoration: none;
        color: #dce4e8;
        letter-spacing: 3px;
        transition: .25s;
    }

    .nav li a:hover{
        color: #4e4e4e;
    }

    .nav li a.active::after{
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 10px;
        height: 1px;
        background: #dce4e8;
    }

    .menu-btn{
        position: absolute;
        top: -30px;
        right: 20px;
        cursor: pointer;
        display: none;
    }

    .menu-btn span{
        display: block;
        width: 20px;
        height: 2px;
        background: #dce4e8;
        margin: 5px;
    }

    .menu-btn.active span:nth-child(1){
        transform: rotate(45deg) translateY(5px);
    }

    .menu-btn.active span:nth-child(2){
        display: none;
    }

    .menu-btn.active span:nth-child(3){
        transform: rotate(-45deg) translateY(-5px);
    }

    .hero{
        min-height: 100vh;
        background: url('https://i.postimg.cc/FzmBcTj9/slide-1.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 90px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: row-reverse;
    }

    .img-box img{
        max-width: 600px;
        filter: drop-shadow(5px 15px 20px #000);
    }

    .content-box{
        max-width: 700px;
        margin-right: 50px;
    }

    .content-box h1{
        font-size: 60px;
        letter-spacing: 10px;
        font-weight: 100;
    }

    .content-box h2{
        font-size: 30px;
        font-weight: 100;
        letter-spacing: 5px;
        border-bottom: 3px solid #dce4e8;
        padding-bottom: 10px;
        margin-bottom: 40px;
    }

    .content-box p{
        font-family: 'Open Sans', sans-serif;
        font-size: 18px;
        font-weight: 100;
        letter-spacing: 3px;
        margin-bottom: 20px;
    }

    .content-box .btn{
        padding: 10px 20px;
        background: #ffc851;
        display: inline-block;
        color: #121618;
        letter-spacing: 2px;
        border: 2px solid #ffc851;
        cursor: pointer;
        transition: .25s;
    }

    .content-box .btn:hover{
        background: transparent;
        color: #ffc851;
    }

    /*MEDIA QUERIES*/

    @media screen and (max-width: 1200px){
        header{
            padding: 50px;
        }

        .nav li{
            margin: 0 10px;
        }

        .img-box img{
            max-width: 400px;
        }
    }

    @media screen and (max-width: 1024px){
        .header-top{
            justify-content: center;
        }

        .schedule, .cart{
            display: none;
        }

        .hero{
            flex-direction: column;
            justify-content: center;
        }

        .img-box{
            margin-bottom: 30px;
        }

        .content-box{
            margin-right: 0;
            text-align: center;
        }
    }

    @media screen and (max-width: 768px){
        header{
            padding: 60px 20px;
            padding-bottom: 20px;
        }

        /* .header-top{
            margin-bottom: 0;
        } */

        .nav{
            display: none;
        }

        .menu-btn{
            display: block;
        }

        .nav.active{
            margin-top: 60px;
            padding-top: 10px;
            border-top: 1px solid #fff5;
            display: block;
        }

        .nav li{
            margin: 15px 0;
        }

        .nav li a.active::after{
            display: none;
        }

        .hero{
            padding: 90px 20px;
        }
    }

    @media screen and (max-width: 550px){
        .img-box img{
            max-width: 300px;
        }

        .content-box h1{
            font-size: 40px;
        }

        .content-box h2{
            font-size: 25px;
        }
    }

    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800&display=swap');

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif
    }

    .container {
        margin: 30px auto
    }

    .navbar-nav .nav-link {
        color: #000 !important;
        padding: 0.5rem 0rem !important;
        border-color: transparent;
        margin-left: 1.5rem;
        transition: none
    }

    .navbar .navbar-toggler:focus {
        box-shadow: none
    }

    .navbar-nav .nav-link.active,
    .border-red {
        border-bottom: 3px solid #b71c1c
    }

    .navbar-nav .nav-link:hover {
        border-bottom: 3px solid #b71c1c
    }

    .container .product-item {
        min-height: 450px;
        border: none;
        overflow: hidden;
        position: relative;
        border-radius: 0
    }

    .container .product-item .product {
        width: 100%;
        height: 350px;
        position: relative;
        overflow: hidden;
        cursor: pointer
    }

    .container .product-item .product img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .container .product-item .product .icons .icon {
        width: 40px;
        height: 40px;
        background-color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.6s ease;
        transform: rotate(180deg);
        cursor: pointer
    }

    .container .product-item .product .icons .icon:hover {
        background-color: #b71c1c;
        color: #fff
    }

    .container .product-item .product .icons .icon:nth-last-of-type(3) {
        transition-delay: 0.2s
    }

    .container .product-item .product .icons .icon:nth-last-of-type(2) {
        transition-delay: 0.15s
    }

    .container .product-item .product .icons .icon:nth-last-of-type(1) {
        transition-delay: 0.1s
    }

    .container .product-item:hover .product .icons .icon {
        transform: translateY(-60px)
    }

    .container .product-item .tag {
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 500;
        position: absolute;
        top: 10px;
        left: 20px;
        padding: 0 0.4rem
    }

    .container .product-item .title {
        font-size: 0.95rem;
        letter-spacing: 0.5px
    }

    .container .product-item .fa-star {
        font-size: 0.65rem;
        color: goldenrod
    }

    .container .product-item .price {
        margin-top: 10px;
        margin-bottom: 10px;
        font-weight: 600
    }

    .fw-800 {
        font-weight: 800
    }

    .bg-green {
        background-color: #208f20 !important;
        color: #fff
    }

    .bg-black {
        background-color: #1f1d1d;
        color: #fff
    }

    .bg-red {
        background-color: #bb3535;
        color: #fff
    }

    @media (max-width: 767.5px) {

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            background-color: #b71c1c;
            color: #fff !important
        }

        .navbar-nav .nav-link {
            border: 3px solid transparent;
            margin: 0.8rem 0;
            display: flex;
            border-radius: 10px;
            justify-content: center
        }
    }

    /*Начало стиля кнопок + и -*/
    .quantity_inner * {
        box-sizing: border-box;
    }
    .quantity_inner {
        display: flex;
        justify-content: flex-start;
    }
    .quantity_inner .bt_minus,
    .quantity_inner .bt_plus,
    .quantity_inner .quantity {
        color: #BFE2FF;
        height: 30px;
        width: 30px;
        padding: 0;
        margin: 10px 2px;
        border-radius: 10px;
        border: 4px solid #a2a2a2;
        background: #ffffff;
        cursor: pointer;
        outline: 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2), 0 4px 6px rgba(0,0,0,0.2);
    }
    .quantity_inner .quantity {
        width: 50px;
        text-align: center;
        font-size: 22px;
        color: #a2a2a2;
        font-family:Menlo,Monaco,Consolas,"Courier New",monospace;
    }
    .quantity_inner .bt_minus svg,
    .quantity_inner .bt_plus svg {
        stroke: #a2a2a2;
        stroke-width: 4;
        transition: 0.5s;
        margin: 4px;
    }
    .quantity_inner .bt_minus:hover svg,
    .quantity_inner .bt_plus:hover svg {
        stroke: #FFF;
    }
    /*Конец стиля кнопок + и -*/

    .title-box >h1 {
        font-size: 2.4rem;
        text-align: center;
    }
</style>
