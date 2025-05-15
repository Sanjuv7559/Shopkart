<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Order;

// Homepage – List all shops
Route::get('/', function () {
    $shops = Shop::all();
    return view('index', compact('shops'));
});

// View products by shop
Route::get('/shop/{id}', function ($id) {
    $shop = Shop::findOrFail($id);
    $products = Product::where('admin_id', $id)->get();
    return view('shops.products', compact('shop', 'products'));
});

// Admin Register (GET)
Route::get('/admin/register', function () {
    return view('admin.register');
});

// Admin Register (POST)
Route::post('/admin/register', function (Request $request) {
    $validated = $request->validate([
        'shopname' => 'required|unique:shops,shopname',
        'password' => 'required|min:4',
    ]);

    Shop::create([
        'shopname' => $validated['shopname'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect('/admin/login')->with('success', 'Shop registered successfully!');
});

// Admin Login (GET)
Route::get('/admin/login', function () {
    return view('admin.login');
});

// Admin Login (POST)
Route::post('/admin/login', function (Request $request) {
    $request->validate([
        'shopname' => 'required',
        'password' => 'required',
    ]);

    $shop = Shop::where('shopname', $request->shopname)->first();

    if ($shop && Hash::check($request->password, $shop->password)) {
        Session::put('admin_id', $shop->id);
        return redirect('/admin/products');
    } else {
        return back()->withErrors(['Invalid credentials']);
    }
});

// Admin Product List + Add Product Page (GET)
Route::get('/admin/products', function () {
    if (!Session::has('admin_id')) {
        return redirect('/admin/login');
    }

    $adminId = Session::get('admin_id');
    $shop = Shop::find($adminId);
    $products = Product::where('admin_id', $adminId)->latest()->get();

    return view('admin.add_product', compact('products', 'shop'));
});

// Admin Product Save (POST)
Route::post('/admin/products', function (Request $request) {
    if (!Session::has('admin_id')) {
        return redirect('/admin/login');
    }

    $request->validate([
        'name'   => 'required|string|max:255',
        'image'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'price'  => 'required|numeric',
        'stock'  => 'required|integer',
    ]);

    $imagePath = $request->file('image')->store('products', 'public');

    Product::create([
        'name'     => $request->name,
        'image'    => $imagePath,
        'price'    => $request->price,
        'stock'    => $request->stock,
        'admin_id' => Session::get('admin_id'),
    ]);

    return back()->with('success', 'Product added successfully!');
});

// User Login Page Placeholder (or build later)
Route::get('/user/login', function () {
    return "User Login Page (Coming soon)";
});






Route::post('/order', function (Request $request) {
    $request->validate([
        'shop_id' => 'required|exists:shops,id',
        'product_id' => 'required|exists:products,id',
        'customer_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:15',
        'location' => 'required|string',
    ]);

    Order::create($request->only('shop_id', 'product_id', 'customer_name', 'mobile', 'location'));

    return back()->with('success', 'Order placed successfully!');
});





Route::get('/admin/products', function () {
    if (!Session::has('admin_id')) {
        return redirect('/admin/login');
    }

    $adminId = Session::get('admin_id');
    $shop = Shop::find($adminId);
    $products = Product::where('admin_id', $adminId)->latest()->get();

    // Fetch orders for the current admin's shop
    $orders = Order::where('shop_id', $adminId)->with('product')->latest()->get();

    return view('admin.add_product', compact('products', 'shop', 'orders'));
});
