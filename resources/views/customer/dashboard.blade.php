@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/customer/dashboard.css') }}">

<div class="dashboard-header">
    <h1>👋 Welcome {{ auth()->user()->name }}!</h1>
    <p>Manage your orders and profile from your dashboard</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="icon">📦</div>
        <div class="value">{{ auth()->user()->orders()->count() }}</div>
        <div class="label">Total Orders</div>
    </div>
    
    <div class="stat-card">
        <div class="icon">⏳</div>
        <div class="value">{{ auth()->user()->orders()->where('status', 'pending')->count() }}</div>
        <div class="label">Pending Orders</div>
    </div>
    
    <div class="stat-card">
        <div class="icon">✅</div>
        <div class="value">{{ auth()->user()->orders()->where('status', 'delivered')->count() }}</div>
        <div class="label">Delivered Orders</div>
    </div>
    
    <div class="stat-card">
        <div class="icon">💰</div>
        <div class="value">₱{{ number_format(auth()->user()->orders()->where('status', 'delivered')->sum('total_amount'), 2) }}</div>
        <div class="label">Total Spent</div>
    </div>
</div>

<div class="recent-orders">
    <h2>Recent Orders</h2>
    
    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="order-item">
            <div>
                <strong>Order #{{ $order->id }}</strong><br>
                <small style="color: #7f8c8d;">{{ $order->created_at->format('M d, Y') }}</small>
            </div>
            <div style="text-align: right;">
                <div><strong>₱{{ number_format($order->total_amount, 2) }}</strong></div>
                <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
            <div>
                <a href="/orders/{{ $order->id }}" class="btn btn-primary" style="padding: 0.5rem 1rem;">View Details</a>
            </div>
        </div>
        @endforeach
        
        <div style="margin-top: 1.5rem; text-align: center;">
            <a href="/orders" class="btn btn-secondary">View All Orders</a>
        </div>
    @else
        <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No orders yet. <a href="/">Start shopping!</a></p>
    @endif
</div>

<div style="margin-top: 2rem; text-align: center;">
    <a href="/" class="btn btn-primary" style="margin-right: 1rem;">🛍️ Continue Shopping</a>
    <a href="/customer/profile" class="btn btn-secondary">👤 Edit Profile</a>
</div>
@endsection

<!-- Save as: resources/views/customer/dashboard.blade.php -->