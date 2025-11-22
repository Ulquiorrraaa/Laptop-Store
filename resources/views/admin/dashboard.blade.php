@extends('layouts.app')

@section('title', 'Admin Dashboard - LappyToppy')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
<div class="admin-header">
    <h1>🔧 Command Center</h1>
    <p>Welcome back, Admin. Here's what's happening in your store today.</p>
</div>

<div class="stats-grid">
    <div class="stat-card" style="border-bottom: 4px solid #3498db;">
        <div class="stat-header">
            <div class="stat-label">Inventory</div>
            <div class="stat-icon" style="color: #3498db; background: #ebf5fb;">📦</div>
        </div>
        <div class="stat-value">{{ $totalProducts }}</div>
        <div style="font-size: 0.85rem; color: #95a5a6; margin-top: 0.5rem;">Total Products</div>
    </div>
    
    <div class="stat-card" style="border-bottom: 4px solid #e67e22;">
        <div class="stat-header">
            <div class="stat-label">Sales</div>
            <div class="stat-icon" style="color: #e67e22; background: #fdf2e9;">🛍️</div>
        </div>
        <div class="stat-value">{{ $totalOrders }}</div>
        <div style="font-size: 0.85rem; color: #95a5a6; margin-top: 0.5rem;">Total Orders Placed</div>
    </div>
    
    <div class="stat-card" style="border-bottom: 4px solid #9b59b6;">
        <div class="stat-header">
            <div class="stat-label">Customers</div>
            <div class="stat-icon" style="color: #9b59b6; background: #f4ecf7;">👥</div>
        </div>
        <div class="stat-value">{{ $totalUsers }}</div>
        <div style="font-size: 0.85rem; color: #95a5a6; margin-top: 0.5rem;">Registered Users</div>
    </div>
    
    <div class="stat-card" style="border-bottom: 4px solid #27ae60;">
        <div class="stat-header">
            <div class="stat-label">Revenue</div>
            <div class="stat-icon" style="color: #27ae60; background: #e9f7ef;">💰</div>
        </div>
        <div class="stat-value">${{ number_format($totalRevenue, 2) }}</div>
        <div style="font-size: 0.85rem; color: #95a5a6; margin-top: 0.5rem;">Delivered Orders</div>
    </div>
</div>

<h2 class="section-title">⚡ Quick Actions</h2>
<div class="quick-actions">
    <a href="/admin/products/create" class="quick-action-btn">
        <span class="qa-icon">✨</span>
        <span class="qa-text">Add New Product</span>
    </a>
    
    <a href="/admin/products" class="quick-action-btn">
        <span class="qa-icon">📦</span>
        <span class="qa-text">Inventory</span>
    </a>
    
    <a href="/admin/orders" class="quick-action-btn">
        <span class="qa-icon">📋</span>
        <span class="qa-text">Orders</span>
    </a>
    
    <a href="/admin/users" class="quick-action-btn">
        <span class="qa-icon">👤</span>
        <span class="qa-text">Customers</span>
    </a>
</div>

<div class="recent-section">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="margin: 0; font-size: 1.4rem; color: var(--dark);">Recent Orders</h2>
        <a href="/admin/orders" class="btn btn-secondary" style="padding: 0.4rem 1rem; font-size: 0.9rem;">View All</a>
    </div>
    
    @if($recentOrders->count() > 0)
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr>
                    <td style="font-weight: bold; color: var(--primary);">#{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td style="font-weight: 600;">${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <a href="/admin/orders/{{ $order->id }}" class="btn btn-primary" style="padding: 0.3rem 0.8rem; font-size: 0.85rem;">
                            Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div style="text-align: center; padding: 3rem; color: #95a5a6;">
        <p style="font-size: 3rem; margin-bottom: 1rem;">📭</p>
        <p>No orders have been placed yet.</p>
    </div>
    @endif
</div>
@endsection