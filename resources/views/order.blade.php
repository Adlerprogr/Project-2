<header>
    <h3>Оформление</h3>
</header>

<main>

    <section class="checkout-form">
        <form action="{{ route('order') }}" method="POST">
            <h6>Контактная информация</h6>
            <div class="form-control">
                <label for="last_name">Ваше имя *</label>
                <div>
                    <span class="fa fa-envelope"></span>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your email...">
                </div>
            </div>
            <div class="form-control">
                <label for="checkout-email">E-mail *</label>
                <div>
                    <span class="fa fa-envelope"></span>
                    <input type="email" id="checkout-email" name="checkout-email" placeholder="Enter your email...">
                </div>
            </div>
            <div class="form-control">
                <label for="checkout-phone">Телефон *</label>
                <div>
                    <span class="fa fa-phone"></span>
                    <input type="tel" name="checkout-phone" id="checkout-phone" placeholder="Enter you phone...">
                </div>
            </div>
            <br>
            <h6>Доставка</h6>
            <div class="form-control">
                <label for="address">Адрес Доставки *</label>
                <div>
                    <span class="fa fa-home"></span>
                    <input type="text" name="address" id="address" placeholder="Your address...">
                </div>
            </div>
            <div class="form-control">
                <label for="entrance">Подъезд</label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="entrance" name="entrance" placeholder="Enter you name...">
                </div>
            </div>
            <div class="form-control">
                <label for="floor">Этаж</label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="floor" name="floor" placeholder="Enter you name...">
                </div>
            </div>
            <div class="form-control">
                <label for="flat">Квартира</label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="flat" name="flat" placeholder="Enter you name...">
                </div>
            </div>
            <div class="form-control">
                <label for="intercom">Домофон</label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="intercom" name="intercom" placeholder="Enter you name...">
                </div>
            </div>
            <div class="form-control">
                <label for="comment">Комментарий к заказу</label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="comment" name="comment" placeholder="Enter you name...">
                </div>
            </div>
            <div class="form-control">
                <label for="city">Город *</label>
                <div>
                    <span class="fa fa-user-circle"></span>
                    <input type="text" id="city" name="city" placeholder="Enter you name...">
                </div>
            </div>
            <div class="form-group">
                <div class="form-control">
                    <label for="delivery_date">Дата доставки *</label>
                    <div>
                        <span class="fa fa-globe"></span>
                        <input type="date" name="delivery_date" id="delivery_date">
                    </div>
                </div>

                <div class="form-control">
                    <label for="delivery_time">Время доставки *</label>
                    <div>
                        <span class="fa fa-globe"></span>
                        <input type="time" name="delivery_time" id="delivery_time">
                    </div>
                </div>
            </div>
{{--            <div class="form-control checkbox-control">--}}
{{--                <input type="checkbox" name="checkout-checkbox" id="checkout-checkbox">--}}
{{--                <label for="checkout-checkbox">Save this information for next time</label>--}}
{{--            </div>--}}
            <div class="form-control-btn">
                <button>Оформить</button>
            </div>
        </form>
    </section>

    <section class="checkout-details">
        <div class="checkout-details-inner">
            @foreach($userProducts as $userProduct)
            <div class="checkout-lists">
                <div class="card">
                    <div class="card-image"><img src="https://retailwire.com/wp-content/uploads/zcdayrowlc0.jpg" alt=""></div>
                    <div class="card-details">
                        <div class="card-name">{{$userProduct->product->name}}</div>
                        <h5>{{$userProduct->product->weight}} г.</h5>
                        <div class="card-price">{{$userProduct->product->price * $userProduct->quantity}} ₽</div>
                        <div class="quantity_inner">
                            <form name='delete_product' action="{{ route('delete-product') }}" method="POST">
                                <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$userProduct->product->id}}" />
                                {{--                                    <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>--}}
                                <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                @csrf
                                <button class="bt_minus">
                                    <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                </button>
                            </form>

                            <input type="number" value="{{$userProduct->quantity}}" size="2" name="quantity" class="quantity" min="1" max="10" readonly/>

                            <form name='plus_product' action="{{ route('plus-product') }}" method="POST">
                                <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$userProduct->product->id}}" />
                                {{--                                    <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>--}}
                                <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                                @csrf
                                <button class="bt_plus">
                                    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="checkout-shipping">
                <h6>Доставка:</h6>
                <p>{{$deliveryAmount}} ₽</p>
            </div>
                <div class="checkout-shipping">
                    <h6>Итого:</h6>
                    <p>{{$totalPrice}} ₽</p>
                </div>
            <div class="checkout-total">
                <h6>Всего к оплате:</h6>
                <p>{{$totalToBePaid}} ₽</p>
            </div>
        </div>
    </section>

</main>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    body {
        font-family: "Poppins", sans-serif;
        height: 100vh;
        width: 70%;
        margin: 0px auto;
        padding: 50px 0px 0px;
        color: #4E5150;


        header {

            height: 5%;
            margin-bottom: 30px;

            > h3 {
                font-size: 25px;
                color: #4E5150;
                font-weight: 500;
            }

        }

        main {
            height: 85%;
            display: flex;
            column-gap: 100px;

            .checkout-form  {
                width: 50%;

                form {

                    h6 {
                        font-size: 12px;
                        font-weight: 500;
                    }

                    .form-control  {
                        margin: 10px 0px;
                        position: relative;

                        label:not([for="checkout-checkbox"]) {
                            display: block;
                            font-size: 10px;
                            font-weight: 500;
                            margin-bottom: 2px;
                        }

                        input:not([type="checkbox"]) {
                            width: 100%;
                            padding: 10px 10px 10px 40px;
                            border-radius: 10px;
                            outline: none;
                            border: .2px solid #4e515085;
                            font-size: 12px;
                            font-weight: 700;

                            &::placeholder {
                                font-size: 10px;
                                font-weight: 500;
                            }
                        }

                        label[for="checkout-checkbox"] {
                            font-size: 9px;
                            font-weight: 500;
                            line-height: 10px;
                        }

                        > div {
                            position: relative;

                            span.fa {
                                position: absolute;
                                top: 50%;
                                left: 0%;
                                transform: translate(15px, -50%);
                            }
                        }
                    }

                    .form-group {
                        display: flex;
                        column-gap: 25px;
                    }

                    .checkbox-control {
                        display: flex;
                        align-items: center;
                        column-gap: 10px;
                    }

                    .form-control-btn {
                        display: flex;
                        align-items: center;
                        justify-content: flex-end;

                        button {
                            padding: 10px 25px;
                            font-size: 10px;
                            color: #fff;
                            background: #F2994A;
                            border: 0;
                            border-radius: 7px;
                            letter-spacing: .5px;
                            font-weight: 200;
                            cursor: pointer;
                        }
                    }
                }
            }

            .checkout-details {
                width: 40%;

                .checkout-details-inner {
                    background: #F2F2F2;
                    border-radius: 10px;
                    padding: 20px;


                    .checkout-lists {
                        display: flex;
                        flex-direction: column;
                        row-gap: 15px;
                        margin-bottom: 40px;

                        .card {
                            width: 100%;
                            display: flex;
                            column-gap: 15px;

                            .card-image {
                                width: 35%;

                                img {
                                    width: 100%;
                                    object-fit: fill;
                                    border-radius: 10px;
                                }
                            }

                            .card-details {
                                display: flex;
                                flex-direction: column;

                                .card-name {
                                    font-size: 12px;
                                    font-weight: 500;
                                }
                                .card-price {
                                    font-size: 10px;
                                    font-weight: 500;
                                    color: #F2994A;
                                    margin-top: 5px;

                                    span {
                                        color: #4E5150;
                                        text-decoration: line-through;
                                        margin-left: 10px;
                                    }
                                }
                                .card-wheel {
                                    margin-top: 17px;
                                    border: .2px solid #4e515085;
                                    width: 90px;
                                    padding: 8px 8px;
                                    border-radius: 10px;
                                    font-size: 12px;
                                    display: flex;
                                    justify-content: space-between;

                                    button {
                                        background: #E0E0E0;
                                        color: #828282;
                                        width: 15px;
                                        height: 15px;
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        border: 0;
                                        cursor: pointer;
                                        border-radius: 3px;
                                        font-weight: 500;
                                    }
                                }
                            }
                        }
                    }

                    .checkout-shipping, .checkout-total {
                        display: flex;
                        font-size: 16px;
                        padding: 5px 0px;
                        border-top: 1px solid #BDBDBD;
                        justify-content: space-between;

                        p {
                            font-size: 10px;
                            font-weight: 500;
                        }
                    }
                }
            }
        }

        footer {

            height: 5%;
            color: #BDBDBD;
            display: -ms-grid;
            display: grid;
            place-items: center;
            font-size: 12px;

            a {
                text-decoration: none;
                color: inherit;
            }

        }

    }

    @media screen and (max-width: 1024px) {
        body {
            width: 80%;

            main {
                column-gap: 70px;
            }
        }
    }

    @media screen and (max-width: 768px) {
        body {
            width: 92%;

            main {
                flex-direction: column-reverse;
                height: auto;
                margin-bottom: 50px;

                .checkout-form {
                    width: 100%;
                    margin-top: 35px;
                }

                .checkout-details {
                    width: 100%;
                }
            }

            footer {
                height: 10%;
            }
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
        border: 4px solid #c6edf8;
        background: #b1d4f0;
        cursor: pointer;
        outline: 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2), 0 4px 6px rgba(0,0,0,0.2);
    }
    .quantity_inner .quantity {
        width: 50px;
        text-align: center;
        font-size: 22px;
        color: #5b6a77;
        font-family:Menlo,Monaco,Consolas,"Courier New",monospace;
    }
    .quantity_inner .bt_minus svg,
    .quantity_inner .bt_plus svg {
        stroke: #5b6a77;
        stroke-width: 4;
        transition: 0.5s;
        margin: 4px;
    }
    .quantity_inner .bt_minus:hover svg,
    .quantity_inner .bt_plus:hover svg {
        stroke: #FFF;
    }
    /*Конец стиля кнопок + и -*/
</style>
