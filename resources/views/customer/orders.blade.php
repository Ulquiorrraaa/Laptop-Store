@extends('layouts.app')

@section('title', 'My Orders - LappyToppy')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/customer/orders.css') }}">

<div class="page-header">
    <h1>📦 My Order History</h1>
    <a href="/" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Continue Shopping</a>
</div>

<div class="card">
    @if($orders->count() > 0)
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date Placed</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <span class="order-id">#{{ $order->id }}</span>
                        </td>
                        <td>
                            {{ $order->created_at->format('M d, Y') }}
                            <br>
                            <span style="font-size: 0.8rem; color: #999;">{{ $order->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="order-total">
                            ${{ number_format($order->total_amount, 2) }}
                        </td>
                        <td>
                            <span class="status-badge status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="/orders/{{ $order->id }}" class="btn btn-primary" style="padding: 0.4rem 1rem; font-size: 0.85rem;">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
            <div style="padding: 1.5rem; border-top: 1px solid #eee;">
                {{ $orders->links() }}
            </div>
        @endif

    @else
        <div class="empty-state">
            <div class="empty-icon">🛍️</div>
            <h3>No orders found</h3>
            <p class="empty-text">It looks like you haven't purchased anything yet.</p>
            <a href="/" class="btn btn-primary">Start Shopping Now</a>
        </div>
    @endif
</div>
@endsection