@extends('layouts.app')

@section('title', 'Create Account - LappyToppy')

@section('content')
 
  <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
    <div class="register-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <h2>🚀 Create Account</h2>
                <p>Join us to get the best deals on laptops</p>
            </div>

            <form action="/register" method="POST">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="John Doe" required>
                        @error('name')
                            <div class="error-message">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="09123456789" required maxlength="11" minlength="11" pattern="\d{11}"
                            inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            title="Please enter exactly 11 digits">

                        @error('phone')
                            <div class="error-message">⚠️ {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group full-width">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="name@example.com" required>
                        @error('email')
                            <div class="error-message">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group full-width">
                        <label for="address">Shipping Address</label>
                        <textarea id="address" name="address" class="form-control" rows="2"
                            placeholder="123 Tech Street, Silicon Valley, CA" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="error-message">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
                            required>
                        @error('password')
                            <div class="error-message">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register Account</button>
            </form>

            <div class="auth-footer">
                <p>Already have an account? <a href="/login">Login here</a></p>
            </div>
        </div>
    </div>
@endsection
