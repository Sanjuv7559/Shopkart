<!DOCTYPE html>
<html>
<head>
    <title>Add New Shop - Shopkart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    
    <div class="card p-4 shadow" style="width: 400px;">
        <h2 class="text-center mb-4">Add New Shop</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ url('/admin/register') }}">
            @csrf
            <div class="mb-3">
                <label for="shopname" class="form-label">Shopname</label>
                <input type="text" class="form-control" id="shopname" name="shopname" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Register Shop</button>
            
        </form>
        <div class="mt-3 text-center">
            <a href="{{ url('/admin/login') }}">Back to Login</a>
             <a href="/" style="text-decoration: none; color: #007bff; font-weight: bold;">🏠 Home</a>
        </div>
    </div>
</body>
</html>
