
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label for="description">Description</label>
        <textarea name="description">{{ $product->description }}</textarea>

        <label for="price">Price</label>
        <input type="number" name="price" value="{{ $product->price }}" required>

        <label for="category_id">Category</label>
        <select name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Update</button>
    </form>

