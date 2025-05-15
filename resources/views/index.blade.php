<!DOCTYPE html>
<html>
<head>
    <title>Shopkart - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    
    <div class="text-center">
        <h1 class="mb-4 "></h1>
        
        {{-- <a href="{{ url('/admin/login') }}" class="btn btn-primary btn-lg me-3">Admin Login</a> --}}
       
    </div>

     <div class="container mt-5">
        <h2 class="mb-4 text-center">Select a Shop</h2>
        <div class="list-group">
            @foreach($shops as $shop)
                <a href="{{ url('/shop/' . $shop->id) }}" class="list-group-item list-group-item-action">
                    {{ $shop->shopname }}
                </a>
            @endforeach
        </div>
    </div>
     <div class="d-flex justify-content-end admin">
            <a href="{{ url('/admin/login') }}" class="btn btn-outline-primary">Admin Login</a>
        </div>
</body>
</html>
