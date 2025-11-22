<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $orders = auth()->user()->orders()->latest()->take(5)->get();
        return view('customer.dashboard', compact('orders'));
    }

    public function profile()
    {
        return view('customer.profile');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {

            // 1. Handle Increase/Decrease
            if ($request->action == 'decrease') {
                $cart[$id]['quantity']--;
            } else {
                // Check stock before increasing
                $product = Product::find($id);
                
                // Ensure product exists and has enough stock
                if($product && $product->stock > $cart[$id]['quantity']) {
                    $cart[$id]['quantity']++;
                } else {
                    return redirect()->back()->with('error', 'Sorry, maximum stock reached for this item.');
                }
            }

            // 2. Remove item if quantity is 0 or less (Handles removal for Decrease action)
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }

            // 3. Save to session (Must be OUTSIDE the if/else blocks above)
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'nullable|min:6|confirmed'
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully');
    }
}