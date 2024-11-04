<div class="catainer">
    <div class="product-card">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="image-container">
                <label for="image">Загрузите изображение продукта:</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <div class="product-info">
                <h2>Добавить продукт</h2>
                <label for="category_id">Выберите категорию:</label>
                <select name="category_id" id="category_id" required>
                    <option value="">-- Выберите категорию --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="name">Название продукта:</label>
                <input type="text" name="name" id="name" required>

                <label for="description">Описание:</label>
                <textarea name="description" id="description" rows="3" required></textarea>

                <label for="calories">Калории:</label>
                <input type="number" name="calories" id="calories" required>

                <label for="squirrels">Белки:</label>
                <input type="number" name="squirrels" id="squirrels" required>

                <label for="fats">Жиры:</label>
                <input type="number" name="fats" id="fats" required>

                <label for="carbohydrates">Углеводы:</label>
                <input type="number" name="carbohydrates" id="carbohydrates" required>

                <label for="weight">Вес (г):</label>
                <input type="number" name="weight" id="weight" required>

                <label for="price">Цена (₽):</label>
                <input type="number" name="price" id="price" required>

                <label for="quantity">Количество:</label>
                <input type="number" name="quantity" id="quantity" required>

                <button type="submit" class="order-button">Добавить продукт</button>
            </div>
        </form>
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
    .catainer {
        display: flex;
        flex-direction: column;
        margin: 0 auto;
        text-align: center;
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
    .product-info h2 {
        margin: 15px 0 10px;
        font-size: 24px;
    }
    .product-info label {
        font-size: 14px;
        color: #555;
        display: block;
        margin: 10px 0 5px;
    }
    .product-info input, .product-info textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .order-button {
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 20px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 14px;
        width: 100%;
    }
    .order-button:hover {
        background-color: #444;
        color: greenyellow;
    }
</style>
