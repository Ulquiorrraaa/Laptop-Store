@extends('layouts.app')

@section('title', 'Order Details #' . $order->id)

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/orders/show.css') }}">
<div class="page-header">
    <a href="/admin/orders" class="back-btn">← Back to Orders</a>
</div>

<div class="order-header">
    <div class="order-title">
        <h1>Order #{{ $order->id }}</h1>
        <div class="order-meta">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</div>
    </div>
    <div>
        <span class="badge badge-{{ $order->status }}">
            {{ ucfirst($order->status) }}
        </span>
    </div>
</div>

<div class="info-grid">
    
    <div class="content-card">
        <h2 class="section-title">👤 Customer Information</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="info-group">
                <span class="info-label">Name</span>
                <span class="info-value">{{ $order->user->name }}</span>
            </div>
            <div class="info-group">
                <span class="info-label">Phone</span>
                <span class="info-value">{{ $order->phone }}</span>
            </div>
            <div class="info-group" style="grid-column: 1 / -1;">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $order->user->email }}</span>
            </div>
            <div class="info-group" style="grid-column: 1 / -1;">
                <span class="info-label">Shipping Address</span>
                <span class="info-value" style="line-height: 1.6;">{{ $order->shipping_address }}</span>
            </div>
        </div>
    </div>

    <div class="content-card" style="background-color: #fdfdfd;">
        <h2 class="section-title">⚡ Update Status</h2>
        <form action="/admin/orders/{{ $order->id }}/status" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="status" class="info-label" style="margin-bottom: 0.5rem;">Order Status</label>
                <select id="status" name="status" class="status-select" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.8rem; font-weight: 600;">Update Status</button>
        </form>
    </div>
</div>

<div class="content-card">
    <h2 class="section-title">📦 Order Items</h2>
    
    @foreach($order->orderItems as $item)
    <div class="item-row">
        <div class="item-image">
            @if($item->product->image)
                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
            @else
                <span class="item-placeholder">💻</span>
            @endif
        </div>
        
        <div class="item-details">
            <div class="item-name">{{ $item->product->name }}</div>
            <div class="item-meta">
                {{ $item->product->brand }} | {{ $item->product->processor }}
            </div>
            <div class="item-meta">
                Quantity: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}
            </div>
        </div>
        
        <div class="item-price">
            ${{ number_format($item->price * $item->quantity, 2) }}
        </div>
    </div>
    @endforeach

    <div class="totals-box">
        <div class="total-row">
            <span>Subtotal</span>
            <span>${{ number_format($order->total_amount, 2) }}</span>
        </div>
        <div class="total-row">
            <span>Shipping</span>
            <span style="color: var(--success);">Free</span>
        </div>
        <div class="total-row final">
            <span>Total</span>
            <span>${{ number_format($order->total_amount, 2) }}</span>
        </div>
    </div>
</div>
@endsection