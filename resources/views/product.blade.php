<div class="catainer">
    <div class="product-card">
        <div class="image-container">
            <img src="https://retailwire.com/wp-content/uploads/zcdayrowlc0.jpg" alt="Morning Set">
        </div>
        <div class="product-info">
            <p>{{$product->weight}} г.</p>
            <h2>{{$product->name}}</h2>
            <p style="color: black" >Описание:</p>
            <p>{{$product->description}}</p>
            <p style="color: black" >Пищевая ценность:</p>
            <p>ккал | белки | жиры | углеводы</p>
            <div class="tags">
                <span class="tag">{{$product->calories}}</span>
                <span class="tag">{{$product->squirrels}}</span>
                <span class="tag">{{$product->fats}}</span>
                <span class="tag">{{$product->carbohydrates}}</span>
            </div>
            <div class="price-order">
                <span class="price">{{$product->price}} ₽</span>
            </div>
            <td>
                <div class="quantity_inner">

                    <form name='delete_product' action="{{ route('delete-product') }}" method="POST">

                        <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$product->id}}" />
                        {{--                                    <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>--}}
                        <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                        @csrf
                        <button class="bt_minus">
                            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>

                    </form>

                    <input type="number" value="1" size="2" name="quantity" class="quantity" min="1" max="10" readonly/>

                    <form name='plus_product' action="{{ route('plus-product') }}" method="POST">

                        <input type="hidden" name="product_id" placeholder="Product ID" required="required" value="{{$product->id}}" />
                        {{--                                    <label style="color: red"><?php echo $errors['quantity'] ?? ''; ?></label>--}}
                        <input type="hidden" name="quantity" placeholder="Quantity" required="required" value = 1 />

                        @csrf
                        <button class="bt_plus">
                            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>

                    </form>

                </div>
            </td>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #d0d0d0;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .catainer{
        display:flex;
        flex-direction:column;
        margin:0 auto;
        text-align:center;
    }
    .product-card {
        width: 430px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: left;
    }

    .image-container {
        position: relative;
    }

    .image-container img {
        width: 100%;
        border-radius: 15px;
    }

    .favorite-star {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        color: #000;
    }

    .product-info h2 {
        margin: 15px 0 10px;
        font-size: 24px;
    }

    .product-info p {
        font-size: 14px;
        color: #555;
    }

    .tags {
        margin: 10px 0;
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
        margin-top: 15px;
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

    /*Начало стиля кнопок + и -*/
    .quantity_inner * {
        box-sizing: border-box;
    }
    .quantity_inner {
        display: flex;
        justify-content: center;
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
</style>

<script>
    document.querySelector('.favorite-star').addEventListener('click', function() {
        this.classList.toggle('active');
    });

    document.querySelector('.order-button').addEventListener('click', function() {
        alert('Order placed! wait ma plet');
    });
</script>
