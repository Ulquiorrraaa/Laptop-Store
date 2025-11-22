@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/products/edit.css') }}">
<div class="edit-wrapper">
    <div class="page-header">
        <h1 class="page-title">✏️ Edit Product</h1>
        <a href="{{ route('admin.products') }}" class="back-btn">← Back to Products</a>
    </div>

    <div class="edit-card">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" id="brand" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}" required>
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="processor" class="form-label">Processor</label>
                    <input type="text" id="processor" name="processor" class="form-control" value="{{ old('processor', $product->processor) }}" required>
                </div>

                <div class="form-group">
                    <label for="ram" class="form-label">RAM</label>
                    <input type="text" id="ram" name="ram" class="form-control" value="{{ old('ram', $product->ram) }}" required>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="storage" class="form-label">Storage</label>
                    <input type="text" id="storage" name="storage" class="form-control" value="{{ old('storage', $product->storage) }}" required>
                </div>

                <div class="form-group">
                    <label for="display" class="form-label">Display</label>
                    <input type="text" id="display" name="display" class="form-control" value="{{ old('display', $product->display) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="stock" class="form-label">Stock Quantity</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="image-upload-box">
                <label class="form-label" style="margin-bottom: 1rem;">Product Image</label>
                
                <div style="display: flex; gap: 2rem; align-items: flex-start; flex-wrap: wrap;">
                    <div>
                        <span style="font-size: 0.85rem; font-weight: 600; color: #6c757d; display: block; margin-bottom: 0.5rem;">Current:</span>
                        <div class="current-image-preview">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image">
                            @else
                                <div style="width: 150px; height: 100px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 6px; color: #999;">
                                    No Image
                                </div>
                            @endif
                        </div>
                    </div>

                    <div style="flex: 1;">
                        <label for="image" style="font-size: 0.85rem; font-weight: 600; color: #6c757d; display: block; margin-bottom: 0.5rem;">Upload New:</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" style="padding: 0.5rem;">
                        <p class="upload-hint">Leave this blank if you don't want to change the image.</p>
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-submit">Update Product</button>
                <a href="{{ route('admin.products') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection