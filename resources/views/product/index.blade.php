
    <h1>Products</h1>
    
    <form method="GET" action="{{ route('products.index') }}">
        <label for="category">Filter by Category</label>
        <select name="category_id">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>

    <a href="{{ route('products.create') }}">Create Product</a>

    <ul>
        @foreach ($products as $product)
            <li>
                {{ $product->name }} - ${{ $product->price }} (Category: {{ $product->category->name ?? 'Uncategorized' }})
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

