@extends('layouts.app')

@section('title', 'Laptop Store - Home')

@section('content')

  <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
<div class="main-container">
    
    <div class="hero">
        <h1>🎯 Find Your Perfect Laptop</h1>
        <p>Premium performance for professionals, gamers, and creators.</p>
    </div>

    <div class="filter-bar">
        @if(request('search'))
            <h2 class="section-title">Results for "{{ request('search') }}"</h2>
        @else
            <h2 class="section-title">Latest Arrivals</h2>
        @endif

        <div class="search-wrapper">
            <form action="/" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" 
                       placeholder="Search by name, brand, or specs..." 
                       value="{{ request('search') }}">
                
                @if(request('search'))
                    <a href="/" style="color: #999; margin-right: 10px; text-decoration: none; font-size: 1.2rem;">&times;</a>
                @endif

                <button type="submit" class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#ffffff" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
                </button>
            </form>
        </div>

        <span class="result-count">{{ $products->count() }} Items</span>
    </div>

    @if($products->count() > 0)
        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        <a href="/products/{{ $product->id }}" style="display: contents;">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <span class="placeholder-emoji">💻</span>
                            @endif
                        </a>
                    </div>

                    <div class="product-content">
                        <div class="product-brand">{{ $product->brand }}</div>
                        <a href="/products/{{ $product->id }}" style="text-decoration: none;">
                            <h3 class="product-name">{{ $product->name }}</h3>
                        </a>
                        
                        <div class="product-specs-container">
                            <span class="spec-badge">{{ $product->processor }}</span>
                            <span class="spec-badge">{{ $product->ram }}</span>
                            <span class="spec-badge">{{ $product->storage }}</span>
                        </div>

                        <div class="product-footer">
                            <div class="product-price">${{ number_format($product->price, 2) }}</div>
                            
                            @if ($product->stock == 0)
                                <div class="stock-status" style="color: #e74c3c;">
                                    <span class="dot dot-red"></span> Out of Stock
                                </div>
                            @elseif($product->stock < 10)
                                <div class="stock-status" style="color: #f39c12;">
                                    <span class="dot dot-orange"></span> Only {{ $product->stock }} left
                                </div>
                            @else
                                <div class="stock-status" style="color: #27ae60;">
                                    <span class="dot dot-green"></span> In Stock
                                </div>
                            @endif
                        </div>

                        <div class="product-actions">
                            @auth
                                @if (auth()->user()->role === 'customer')
                                    @if ($product->stock > 0)
                                        <form action="/cart/add/{{ $product->id }}" method="POST" style="width: 100%;">
                                            @csrf
                                            <button type="submit" class="btn-custom btn-add">Add to Cart</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn-custom btn-disabled" disabled>Sold Out</button>
                                    @endif
                                @else
                                    <a href="/products/{{ $product->id }}" class="btn-custom btn-view" style="grid-column: 1 / -1;">View Details</a>
                                @endif
                            @else
                                 <a href="/login" class="btn-custom btn-add">Login to Buy</a>
                            @endauth

                            @if(auth()->check() && auth()->user()->role === 'customer')
                                <a href="/products/{{ $product->id }}" class="btn-custom btn-view">View</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 4rem; color: #666;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
            <h3>No products found for "{{ request('search') }}"</h3>
            <p>Try checking your spelling or using different keywords.</p>
            <a href="/" class="btn-custom btn-view" style="display: inline-block; width: auto; margin-top: 1rem;">Clear Search</a>
        </div>
    @endif

    <div style="margin-top: 3rem; display: flex; justify-content: center;">
        {{ $products->withQueryString()->links() }}
    </div>

</div>
@endsection