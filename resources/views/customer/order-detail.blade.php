@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="/orders" class="btn btn-secondary">← Back to Orders</a>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem;">
        <div>
            <h1>Order #{{ $order->id }}</h1>
            <p style="color: #7f8c8d;">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>
        <span class="badge badge-{{ $order->status }}" style="font-size: 1rem; padding: 0.5rem 1rem;">
            {{ ucfirst($order->status) }}
        </span>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
        <div>
            <h2 style="margin-bottom: 1rem;">Order Items</h2>
            @foreach($order->orderItems as $item)
            <div style="display: flex; gap: 1rem; padding: 1rem; border: 1px solid #eee; border-radius: 8px; margin-bottom: 1rem;">
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">💻</div>
                <div style="flex-grow: 1;">
                    <h3>{{ $item->product->name }}</h3>
                    <p style="color: #7f8c8d;">Quantity: {{ $item->quantity }}</p>
                    <p style="font-weight: bold; color: #27ae60;">₱{{ number_format($item->price, 2) }} each</p>
                </div>
                <div style="text-align: right;">
                    <strong style="font-size: 1.25rem;">₱{{ number_format($item->price * $item->quantity, 2) }}</strong>
                </div>
            </div>
            @endforeach
        </div>

        <div>
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1rem;">
                <h3 style="margin-bottom: 1rem;">Shipping Information</h3>
                <p><strong>Address:</strong><br>{{ $order->shipping_address }}</p>
                <p style="margin-top: 0.5rem;"><strong>Phone:</strong> {{ $order->phone }}</p>
            </div>

            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                <h3 style="margin-bottom: 1rem;">Order Summary</h3>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Subtotal</span>
                    <span>₱{{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Shipping</span>
                    <span>Free</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding-top: 1rem; border-top: 2px solid #2c3e50; font-weight: bold; font-size: 1.25rem;">
                    <span>Total</span>
                    <span>₱{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
