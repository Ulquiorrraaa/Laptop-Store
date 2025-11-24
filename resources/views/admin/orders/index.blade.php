@extends('layouts.app')

@section('title', 'Manage Orders - Admin')

@section('content')
 <link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">

<div class="page-header">
    <h1>📋 Manage Orders</h1>
    </div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date Placed</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <span class="text-primary">#{{ $order->id }}</span>
                    </td>
                    <td>
                        <span class="text-bold">{{ $order->user->name }}</span>
                        </td>
                    <td>
                        {{ $order->created_at->format('M d, Y') }}
                        <br>
                        <span class="text-muted">{{ $order->created_at->format('h:i A') }}</span>
                    </td>
                    <td>
                        <span class="text-bold">₱{{ number_format($order->total_amount, 2) }}</span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <a href="/admin/orders/{{ $order->id }}" class="btn btn-primary btn-sm">
                            View Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem;">
                        <div style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.5;">📭</div>
                        <p style="color: #7f8c8d;">No orders found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
        <div style="padding: 1.5rem; border-top: 1px solid #f1f1f1;">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection