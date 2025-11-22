@extends('layouts.app')

@section('title', 'My Profile - LappyToppy')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/customer/profile.css') }}">

<div class="profile-wrapper">
    <div class="profile-card">
        
        <div class="profile-header">
            <div class="avatar-circle">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <h2>{{ auth()->user()->name }}</h2>
            <p>Customer Member since {{ auth()->user()->created_at->format('Y') }}</p>
        </div>

        <div class="profile-body">
            <form action="/customer/profile" method="POST">
                @csrf
                @method('PUT')

                <h3 class="section-title">👤 Personal Information</h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" required>
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="address">Shipping Address</label>
                        <textarea id="address" name="address" class="form-control" rows="3" required>{{ old('address', auth()->user()->address) }}</textarea>
                        @error('address')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h3 class="section-title">🔒 Security</h3>
                
                <div class="password-section">
                    <p style="font-size: 0.9rem; color: #666; margin-bottom: 1rem;">
                        Leave these fields blank if you don't want to change your password.
                    </p>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••">
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    <a href="/customer/dashboard" class="btn btn-secondary btn-block" style="text-align: center; background: #e2e6ea; color: #333;">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection