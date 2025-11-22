@extends('layouts.app')

@section('title', $product->name)

@section('content')
  <link rel="stylesheet" href="{{ asset('css/products/show.css') }}">


<div style="margin-bottom: 2rem;">
    <a href="/" class="btn btn-secondary">← Back to Products</a>
</div>

<div class="product-detail">
    <div>
        <div class="product-image-large">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            @else
                <span class="placeholder-icon">💻</span>
            @endif
        </div>
    </div>
    
    <div class="product-info">
        <div class="product-brand-large">{{ $product->brand }}</div>
        <h1>{{ $product->name }}</h1>
        <div class="product-price-large">${{ number_format($product->price, 2) }}</div>
        
        <div class="product-description">
            {{ $product->description }}
        </div>

        <div class="specs-table">
            <h3>Technical Specifications</h3>
            <table>
                <tr>
                    <td>Processor</td>
                    <td>{{ $product->processor }}</td>
                </tr>
                <tr>
                    <td>Memory (RAM)</td>
                    <td>{{ $product->ram }}</td>
                </tr>
                <tr>
                    <td>Storage</td>
                    <td>{{ $product->storage }}</td>
                </tr>
                <tr>
                    <td>Display</td>
                    <td>{{ $product->display }}</td>
                </tr>
                <tr>
                    <td>Availability</td>
                    <td>
                        @if($product->stock > 10)
                            <span class="badge badge-delivered" style="color: green;">In Stock ({{ $product->stock }} units)</span>
                        @elseif($product->stock > 0)
                            <span class="badge badge-pending" style="color: orange; color: black;">Limited Stock ({{ $product->stock }} units)</span>
                        @else
                            <span class="badge badge-cancelled" style="color: red;">Out of Stock</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        @auth
            @if(auth()->user()->role === 'customer' && $product->stock > 0)
            <div class="purchase-section">
                <h3>Purchase Now</h3>
                <form action="/cart/add/{{ $product->id }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success" style="width: 100%; padding: 1rem; font-size: 1.1rem; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        🛒 Add to Cart
                    </button>
                </form>
            </div>
            @endif
        @else
            <div class="purchase-section">
                <p>Please <a href="/login" style="color: #667eea; font-weight: bold;">login</a> to purchase this product.</p>
            </div>
        @endauth
    </div>
</div>
@endsection