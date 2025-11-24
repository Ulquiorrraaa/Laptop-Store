@extends('layouts.app')

@section('title', 'Edit Product')
 <link rel="stylesheet" href="{{ asset('css/admin/products/edit.css') }}">
@section('content')
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
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" id="brand" name="brand" class="form-control"
                            value="{{ old('brand', $product->brand) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price" class="form-label">Price (₱)</label>
                        <input type="number" id="price" name="price" class="form-control" step="0.01"
                            value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="processor" class="form-label">Processor</label>
                        <input type="text" id="processor" name="processor" class="form-control"
                            value="{{ old('processor', $product->processor) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="ram" class="form-label">RAM</label>
                        <input type="text" id="ram" name="ram" class="form-control"
                            value="{{ old('ram', $product->ram) }}" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="storage" class="form-label">Storage</label>
                        <input type="text" id="storage" name="storage" class="form-control"
                            value="{{ old('storage', $product->storage) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="display" class="form-label">Display</label>
                        <input type="text" id="display" name="display" class="form-control"
                            value="{{ old('display', $product->display) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="stock" class="form-label">Stock Quantity</label>
                    <input type="number" id="stock" name="stock" class="form-control"
                        value="{{ old('stock', $product->stock) }}" required>
                </div>

                <div class="image-upload-box">
                    <label class="form-label" style="margin-bottom: 1rem;">Product Image</label>

                    <div style="margin-bottom: 1.5rem; text-align: center; background: white; padding: 10px; border-radius: 8px;">
                        <p style="font-size: 0.85rem; color: #666; margin-bottom: 5px;">Current Image:</p>
                        @if($product->image)
                            @if(Str::startsWith($product->image, 'http'))
                                <img src="{{ $product->image }}" alt="Current" style="height: 100px; border-radius: 5px;">
                            @else
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current" style="height: 100px; border-radius: 5px;">
                            @endif
                        @else
                            <p style="color: #999; font-style: italic;">No image set</p>
                        @endif
                    </div>

                    <hr style="border: 0; border-top: 1px solid #ddd; margin: 1rem 0;">

                    <label for="image" style="font-size: 0.85rem; font-weight: 600; color: #6c757d;">Option A: Upload File</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*"
                        onchange="previewImage(event)">

                    <div style="text-align: center; margin: 10px 0; font-weight: bold; color: #999;">- OR -</div>

                    <label for="image_url" style="font-size: 0.85rem; font-weight: 600; color: #6c757d;">Option B: Paste Image Link</label>
                    <input type="url" id="image_url" name="image_url" class="form-control"
                        placeholder="https://example.com/laptop.jpg" oninput="previewUrl(this.value)">

                    @error('image') <div class="error-message">{{ $message }}</div> @enderror
                    @error('image_url') <div class="error-message">{{ $message }}</div> @enderror

                    <div id="imagePreview" class="preview-container" style="margin-top: 1rem; display: none;">
                        <p style="font-size: 0.8rem; color: var(--success);">New Image Preview:</p>
                        <img id="preview" alt="Image Preview" style="max-height: 150px; border-radius: 8px; border: 2px solid var(--success);">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-submit">Update Product</button>
                    <a href="{{ route('admin.products') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function for File Upload Preview
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.style.display = 'block';
                    previewDiv.style.textAlign = 'center';
                }
                reader.readAsDataURL(file);
            } else {
                // Don't hide if URL input might be valid, but for now let's clear
                // typically you'd check if URL input is empty too
            }
        }

        // Function for URL Input Preview
        function previewUrl(url) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');

            if (url) {
                preview.src = url;
                previewDiv.style.display = 'block';
                previewDiv.style.textAlign = 'center';
            } else {
                previewDiv.style.display = 'none';
            }
        }
    </script>
@endsection