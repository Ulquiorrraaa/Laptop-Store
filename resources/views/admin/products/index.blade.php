@extends('layouts.app')

@section('title', 'Manage Products - Admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/products/index.css') }}">
<div class="page-header">
    <h1>📦 Manage Products</h1>
    <a href="/admin/products/create" class="btn btn-success">
        <span style="margin-right: 5px;">➕</span> Add New Product
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Inventory</th>
                    <th>Last Updated</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="color: #999;">#{{ $product->id }}</td>
                    <td>
                        <div class="product-info">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Thumb" class="product-thumbnail">
                            @else
                                <div class="placeholder-thumb">💻</div>
                            @endif
                            
                            <div>
                                <span class="product-name">{{ $product->name }}</span>
                                <span class="product-brand">{{ $product->brand }}</span>
                            </div>
                        </div>
                    </td>
                    <td style="font-weight: 600;">₱{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if($product->stock > 10)
                            <span class="badge badge-instock">In Stock ({{ $product->stock }})</span>
                        @elseif($product->stock > 0)
                            <span class="badge badge-low">Low Stock ({{ $product->stock }})</span>
                        @else
                            <span class="badge badge-out">Out of Stock</span>
                        @endif
                    </td>
                    <td style="font-size: 0.9rem; color: #888;">
                        {{ $product->updated_at->format('M d, Y') }}
                    </td>
                    <td>
                        <div class="action-group" style="justify-content: flex-end;">
                            <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-primary btn-sm">
                                ✏️ Edit
                            </a>
                            
                            <form action="/admin/products/{{ $product->id }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete {{ $product->name }}? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem;">
                        <p style="font-size: 1.1rem; color: #999;">No products found in inventory.</p>
                        <a href="/admin/products/create" class="btn btn-primary" style="margin-top: 1rem;">Add First Product</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div style="padding: 1.5rem; border-top: 1px solid #f1f1f1;">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection