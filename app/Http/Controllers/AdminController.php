<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'customer')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'totalUsers', 'totalRevenue', 'recentOrders'));
    }

    // Product Management
    public function products()
    {
        $products = Product::paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // ... other fields ...
            'image' => 'nullable|image|max:2048', // File validation
            'image_url' => 'nullable|url'          // New URL validation
        ]);

        // Logic: Check File -> Then Check URL
        if ($request->hasFile('image')) {
            // 1. Handle File Upload
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        } elseif ($request->filled('image_url')) {
            // 2. Handle URL Download
            try {
                $url = $request->image_url;
                $contents = Http::get($url)->body();

                // Generate a random name
                $name = 'products/' . Str::random(40) . '.jpg';

                // Save to public disk
                Storage::disk('public')->put($name, $contents);
                $validated['image'] = $name;
            } catch (\Exception $e) {
                return back()->withErrors(['image_url' => 'Could not download image from URL.']);
            }
        }

        // Remove 'image_url' from array before creating, as it's not in DB
        unset($validated['image_url']);

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product created successfully');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // ... other fields ...
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url'
        ]);

        // Handle Image (File OR URL)
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('products', 'public');
        } elseif ($request->filled('image_url')) {
            try {
                $contents = Http::get($request->image_url)->body();
                $name = 'products/' . Str::random(40) . '.jpg';
                Storage::disk('public')->put($name, $contents);
                $newImage = $name;
            } catch (\Exception $e) {
                return back()->withErrors(['image_url' => 'Could not download image.']);
            }
        }

        // If we got a new image (from file or URL), delete old and update
        if ($newImage) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $newImage;
        }

        unset($validated['image_url']); // Clean up

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // 1. Delete the image file from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // 2. Delete the database record
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }

    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->status = $validated['status'];
        $order->save();

        return back()->with('success', 'Order status updated successfully');
    }

    // User Management
    public function users()
    {
        $users = User::where('role', 'customer')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete admin user');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
}
