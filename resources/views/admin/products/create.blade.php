@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/products/create.css') }}">

<div class="create-wrapper">
    <div class="page-header">
        <h1 class="page-title">✨ Add New Product</h1>
        <a href="/admin/products" class="back-btn">← Back to Products</a>
    </div>

    <div class="create-card">
        <form action="/admin/products" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. MacBook Pro M3" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" id="brand" name="brand" class="form-control" value="{{ old('brand') }}" placeholder="e.g. Apple" required>
                    @error('brand')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ old('price') }}" placeholder="0.00" required>
                    @error('price')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" placeholder="Enter product details..." required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="processor" class="form-label">Processor</label>
                    <input type="text" id="processor" name="processor" class="form-control" value="{{ old('processor') }}" placeholder="e.g. Intel i9" required>
                    @error('processor')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ram" class="form-label">RAM</label>
                    <input type="text" id="ram" name="ram" class="form-control" value="{{ old('ram') }}" placeholder="e.g. 16GB" required>
                    @error('ram')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="storage" class="form-label">Storage</label>
                    <input type="text" id="storage" name="storage" class="form-control" value="{{ old('storage') }}" placeholder="e.g. 1TB SSD" required>
                    @error('storage')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="display" class="form-label">Display</label>
                    <input type="text" id="display" name="display" class="form-control" value="{{ old('display') }}" placeholder="e.g. 15.6 inch 4K" required>
                    @error('display')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="stock" class="form-label">Stock Quantity</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="0" required>
                @error('stock')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="image-upload-box">
                <label for="image" class="form-label" style="margin-bottom: 1rem; cursor: pointer;">
                    📁 Upload Product Image
                </label>
                
                <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                
                <small style="color: #7f8c8d; display: block; margin-top: 0.5rem;">
                    Supported formats: JPG, PNG, GIF (Max: 2MB)
                </small>
                
                @error('image')
                    <div class="error-message" style="text-align: center;">{{ $message }}</div>
                @enderror
                
                <div id="imagePreview" class="preview-container">
                    <img id="preview" alt="Image Preview">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success btn-submit">Create Product</button>
                <a href="/admin/products" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.style.display = 'flex'; // Changed to flex to center it
        }
        reader.readAsDataURL(file);
    } else {
        previewDiv.style.display = 'none';
    }
}
</script>
@endsection