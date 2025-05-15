<!DOCTYPE html>
<html>
<head>
    <title>Add Product - Shopkart</title>
     <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light admin">
    @if(isset($shop))
        <div style="position: fixed; top: 0; left: 0; width: 100%; background: white; z-index: 9999; padding: 10px; border-bottom: 1px solid #ccc;">
        <h3 style="margin: 0; text-align: center;">Welcome, {{ $shop->shopname }}</h3>
        <a href="/" style="text-decoration: none; color: #007bff; font-weight: bold;">🏠 Home</a>
    </div>
    @endif
    <div class="card p-4 shadow" style="width: 500px;">
        <h2 class="text-center mb-4">Add Product</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Product</button>
        </form>
    </div>
    <hr class="my-4">

{{-- <h4 class="text-center mb-3">Product Preview</h4> --}}


@if($products->count())
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price: ₹{{ $product->price }}</p>
                        <p class="card-text">Stock: {{ $product->stock }}</p>
                        <p class="card-text"><small class="text-muted">Added on {{ $product->created_at->format('d M Y, h:i A') }}</small></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p class="text-muted text-center">No products added yet.</p>
@endif
{{-- <div style=" top: 0; left: 0; width: 100%; background: white; z-index: 9999; padding: 10px 20px; border-bottom: 1px solid #ccc; display: flex; justify-content: space-between; align-items: center;">
    <!-- Home Button -->
    <a href="/" style="text-decoration: none; color: #007bff; font-weight: bold;">🏠 Home</a>
</div> --}}
</div>
<div class="container mt-5 orders">
    <h3 class="text-center mb-4">Orders Received</h3>

    @if($orders->count())
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Mobile</th>
                        <th>Location</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->product->name ?? 'Deleted Product' }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->mobile }}</td>
                            <td>{{ $order->location }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-muted">No orders received yet.</p>
    @endif
</div>





</body>
</html>
