<!DOCTYPE html>
<html>
<head>
    <title>{{ $shop->shopname }} Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">{{ $shop->shopname }}'s Products</h2>
        <a href="{{ url('/') }}" class="btn btn-secondary mb-4">Back to Shop List</a>

        @if($products->count())
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Price: ₹{{ $product->price }}</p>
                                <p class="card-text">Stock: {{ $product->stock }}</p>
                                <!-- Buy Now button -->
<button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#buyModal{{ $product->id }}">
    Buy Now
</button>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Form -->
<div class="modal fade" id="buyModal{{ $product->id }}" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('/order') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order {{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" name="customer_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <textarea class="form-control" name="location" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</div>
                @endforeach
            </div>
         
        @else
            <p class="text-muted text-center">No products available.</p>
        @endif
    </div>
       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
