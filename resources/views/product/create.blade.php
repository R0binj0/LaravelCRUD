
    <h1>Create Product</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input type="text" name="name" required>

        <label for="description">Description</label>
        <textarea name="description"></textarea>

        <label for="price">Price</label>
        <input type="number" name="price" required>

        <label for="category_id">Category</label>
        <select name="category_id" required>
            <option value="">Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Create</button>
    </form>

    