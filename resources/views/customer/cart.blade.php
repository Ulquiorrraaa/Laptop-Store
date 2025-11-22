@extends('layouts.app')

@section('title', 'Shopping Cart - LappyToppy')

@section('content')
   <link rel="stylesheet" href="{{ asset('css/customer/cart.css') }}">

<div class="page-header">
    <h1>🛒 Shopping Cart</h1>
</div>

@if(count($cart) > 0)
    <div class="cart-grid">
        
        <div class="cart-items-wrapper">
            @foreach($cart as $id => $item)
            <div class="cart-item">
                <div class="cart-img-box">
                    @if(isset($item['image']) && $item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    @else
                        <span class="placeholder-icon">💻</span>
                    @endif
                </div>

                <div class="item-details">
                    <div>
                        <div class="item-header">
                            <div class="item-name">{{ $item['name'] }}</div>
                            <div class="item-price">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                        </div>
                        
                        <div class="item-meta">
                            <div class="qty-control-group">
                                <form action="/cart/update/{{ $id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="qty-btn">−</button>
                                </form>

                                <span class="qty-display">{{ $item['quantity'] }}</span>

                                <form action="/cart/update/{{ $id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="qty-btn">+</button>
                                </form>
                            </div>

                            <span style="color: #ddd;">|</span>
                            <span style="font-size: 0.85rem;">${{ number_format($item['price'], 2) }} each</span>
                        </div>
                    </div>

                    <div style="text-align: right; margin-top: 0.5rem;">
                        <form action="/cart/remove/{{ $id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-remove">Remove Item</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <div style="padding: 1.5rem; text-align: center;">
                <a href="/" style="text-decoration: none; font-weight: 500; color: var(--primary);">
                    ← Continue Shopping
                </a>
            </div>
        </div>

        <div class="cart-summary">
            <div class="summary-title">Order Summary</div>
            
            <div class="summary-row">
                <span>Subtotal</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            
            <div class="summary-row">
                <span>Shipping</span>
                <span style="color: var(--success); font-weight: 600;">Free</span>
            </div>

            <div class="summary-total">
                <span>Total</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>

            <form action="/checkout" method="POST" class="checkout-form">
                @csrf
                
                <div>
                    <label for="shipping_address" class="form-label">Shipping Address</label>
                    <textarea id="shipping_address" name="shipping_address" class="form-input" required>{{ auth()->user()->address }}</textarea>
                </div>

                <div>
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-input" value="{{ auth()->user()->phone }}" required>
                </div>

                <button type="submit" class="btn btn-success" style="width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 600;">
                    💳 Complete Order
                </button>
                
                <p style="text-align: center; margin-top: 1rem; font-size: 0.8rem; color: #999;">
                    🔒 Secure Checkout
                </p>
            </form>
        </div>
    </div>
@else
    <div class="empty-cart">
        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.6;">🛒</div>
        <h2 style="margin-bottom: 1rem;">Your cart is empty</h2>
        <p style="color: #7f8c8d; margin-bottom: 2rem;">Looks like you haven't added any laptops yet.</p>
        <a href="/" class="btn btn-primary">Browse Products</a>
    </div>
@endif

@endsection