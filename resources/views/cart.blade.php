<body>
<div class="container">
    <div class="back"><a href="http://localhost/main"><h3>Shop</h3></a></div>
    <div class="title-box">
        <h1>Корзина</h1>
    </div>
    @foreach($userProducts as $userProduct)
    <div class="product-box">
        <div class="img-box">
            <img src="https://retailwire.com/wp-content/uploads/zcdayrowlc0.jpg" alt="vacuum">
        </div>
        <div class="info-box">
            <h2>{{$userProduct->product->name}}</h2>
            <h5>{{$userProduct->product->weight}} г.</h5>
{{--            <p>{{$userProduct->quantity}}</p>--}}
            <p class="stock">{{$userProduct->product->price * $userProduct->quantity}} ₽</p>
{{--            <div class="amount-box">--}}
{{--                <div class="minus-box">--}}
{{--                    <i class="fa-solid fa-minus"></i>--}}
{{--                </div>--}}
{{--                <input type="number" readonly value="1" min="0" max="10" class="amount" id="amount">--}}
{{--                <div class="plus-box">--}}
{{--                    <i class="fa-solid fa-plus"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
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
    @endforeach
    <hr>
    <div class="cost-box">
        <div>
            <p>Доставка:</p>
            <p>{{$totals['deliveryAmount']}} ₽</p>
        </div>
        <div>
            <p>Итого:</p>
            <p class="VAT">{{$totals['totalPrice']}} ₽</p>
        </div>
        <div>
            <p>Всего к оплате:</p>
            <p class="NOK">{{$totals['totalToBePaid']}} ₽</p>
        </div>
{{--        <p class="gift">Got a gift card or a promotional code?</p>--}}
        <span class="applied">Promo Applied</span>
    </div>
{{--    <button class="Checkout-btn">Checkout</button>--}}
    <a href="http://localhost/order"><button class="Checkout-btn"><span>Оформить заказ</span></button></a>
</div>
<div class="promo-box">
    <h5>Enter your promo code</h5>
    <input type="text" maxlength="6"  id="promo">
    <button class="send-promo">Send</button>
</div>
<script src="script.js"></script>
</body>

<style>
    /*Начало кнопка для перехода в main*/
    .back {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

        max-width: 2000px;
        max-height: 60px;
        font-family: 'Nunito', sans-serif;
        font-size: 22px;
        text-transform: uppercase;
        letter-spacing: 1.3px;
        font-weight: 700;
        color: #313133;
        background: #4FD1C5;
        background: linear-gradient(90deg, rgba(109,130,217,1) 0%, rgba(79,209,197,1) 100%);
        border: none;
        border-radius: 1000px;
        box-shadow: 12px 12px 24px rgba(79,209,197,.64);
        transition: all 0.3s ease-in-out 0s;
        cursor: pointer;
        outline: none;
        position: relative;
        padding: 10px;
    }    /*Конец кнопка для перехода в main*/

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

    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    *,*:before,*:after{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root{
        font-size: 62.5%;
    }

    body{
        font-family: 'Montserrat', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #d0d0d0;
        text-rendering: optimizeLegibility;
    }
    .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 2rem;
        width: 100%;
        max-width: 80rem;
        padding: 4rem;
        color: #191a3c;
        background-color: #fff;
        border-radius: 3rem;
        position: relative;
        transition: all .3s linear;
    }
    .container::before{
        content: '';
        position: absolute;
        background-color: #777777;
        top: -4rem;
        left: -4rem;
        width: 100%;
        height: 100%;
        z-index: -1;
        border-radius: 3rem;
        box-shadow: 0 7px 50px #b6d2e3;
    }
    .title-box >h1 {
        font-size: 2.4rem;
        text-align: center;
    }
    .title-box >p{
        margin-top: .5rem;
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: .03rem;
    }
    .product-box{
        display: flex;
        justify-content: flex-start;
        gap: 2rem;
    }
    img{
        width: 25rem;
    }
    .info-box >h5{
        font-size: 1.3rem;
        padding: 1rem .0rem;
        font-weight: 300;
    }
    .info-box>p{
        margin-top: 1rem;
        font-size: 1.2rem;
        background-color: #83bd46;
        color: #fff;
        width: fit-content;
        padding: .3rem 1.1rem;
        border-radius: 2rem;
    }
    .info-box>.amount-box{
        margin-top: 2rem;
        display: flex;
        gap: .3rem;
    }
    .info-box>.amount-box >div{
        width: 2.5rem;
        border-radius: .3rem;
        aspect-ratio: 1;
        background-color: #e0f2f9;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.4rem;
        color: #191a3cee;
        cursor: pointer;
    }
    .amount{
        width: 2.5rem;
        border: 1px solid #d1d1d1;
        outline: none;
        border-radius: .3rem;
        text-align: center;
        color: #191a3c;
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
    hr{
        border: none;
        border-top: 1px solid #e9e9e9;
    }
    .cost-box{
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
    .cost-box >div{
        display: flex;
        justify-content: space-between;
        font-size: 1.3rem;
    }
    .cost-box>div:nth-of-type(1)>p:nth-of-type(2){
        font-weight: bold;
    }
    .cost-box>div:nth-of-type(2)>p:nth-of-type(2){
        font-weight: bold;
    }
    .cost-box>div:nth-of-type(3)>p{
        font-weight: bold;
    }
    .cost-box>p{
        color: #5381f8;
        font-size: 1.1rem;
        text-decoration: underline;
        cursor: pointer;
    }
    .applied{
        position: absolute;
        background-color: #191a3c;
        border-radius: 5px 0 0 5px;
        color: #fff;
        padding: .5rem 1rem;
        bottom: 9.6rem;
        right: 0;
        opacity: 0;
        transition: all .3s linear;
    }
    .Checkout-btn{
        position: relative;
        margin-top: .5rem;
        width: 90%;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        background-color: #5381f8;
        border: none;
        color: #fff;
        padding: 1rem 3rem;
        font-size: 1.5rem;
        border-radius: 2rem;
        cursor: pointer;
        transition: all .25s linear;
    }
    .Checkout-btn:hover{
        background-color: #fff;
        color: #191a3c;
        box-shadow: inset 0 0 0 1px #191a3c,
        inset 10px 0 0 6px #191a3c;
    }
    .promo-box{
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        width: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        padding: 5rem;
        background-color: #191a3c;
        border-radius: 1rem;
        color: #fff;
        opacity: 0;
        display: none;
        transition: all .3s linear;
    }
    .promo-box>h5{
        font-size: 1.6rem;
    }
    #promo{
        width: 10rem;
        outline: none;
        border: none;
        padding: .4rem 1rem;
        font-family: 'Montserrat', sans-serif;
        font-size: 1.7rem;
    }
    .send-promo{
        border: none;
        outline: none;
        padding: .2rem .6rem;
        border-radius: 3px;
        margin-top: .3rem;
        color: #191a3c;
        font-family: 'Montserrat', sans-serif;
        cursor: pointer;
        font-weight: bold;
    }
</style>

<script>
    const container = document.querySelector(".container");
    const minus = document.querySelector(".minus-box");
    const amount = document.getElementById("amount");
    const plus = document.querySelector(".plus-box");
    const stock = document.querySelector(".stock");
    const checkoutBtn = document.querySelector(".gift");
    const promoBox = document.querySelector(".promo-box");
    const promoInput = document.getElementById("promo");
    const sendPromoBtn = document.querySelector(".send-promo");
    const promoApplied = document.querySelector(".applied");

    const vat = document.querySelector(".VAT");
    const nok = document.querySelector(".NOK");

    let vatValueDefault = 879;
    let nokValueDefault = 4395;

    let free = false;

    plus.addEventListener("click",()=>{
        if(amount.value<10){
            amount.value ++;
            if(amount.value !== 0 && free === false){
                vat.innerHTML = `${vatValueDefault*amount.value},-`;
                nok.innerHTML = `${nokValueDefault*amount.value},-`;
            }
        }
        if(amount.value == 10){
            stock.style.backgroundColor ="#BE3144";
            stock.innerHTML = "out of stock";
        }
    })

    minus.addEventListener("click",()=>{
        if(amount.value>0){
            amount.value --;
            if(amount.value !== 0 && free === false){
                vat.innerHTML = `${vatValueDefault*amount.value},-`;
                nok.innerHTML = `${nokValueDefault*amount.value},-`;
            }
        }
        stock.style.backgroundColor = "#83bd46";
        stock.innerHTML = "In stock";
    })

    checkoutBtn.addEventListener("click", ()=>{
        if(!promoInput.classList.contains("applied")){
            container.style.opacity = ".5";
            container.style.pointerEvents = "none";
            promoBox.style.opacity = "1";
            promoBox.style.display = "flex";
        }
    })
    sendPromoBtn.addEventListener("click",()=>{
        if(promoInput.value.length >=1){
            container.style.opacity = "1";
            container.style.pointerEvents = "auto";
            promoBox.style.opacity = "0";
            promoBox.style.display = "none";
            promoInput.classList.add("applied");
            promoApplied.style.opacity = "1";
            promoApplied.style.display = "block"
            vat.innerHTML = `It's free for you`;
            nok.innerHTML = `It's free for you`;
            free = true;
        }
    })
</script>
