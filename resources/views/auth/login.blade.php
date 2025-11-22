@extends('layouts.app')

@section('title', 'Login - LappyToppy')

@section('content')

  <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">

<div class="login-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Welcome👋</h2>
            <p>Please enter your details to sign in</p>
        </div>
        
        <form action="/login" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" 
                       class="form-control" 
                       value="{{ old('email') }}" 
                       placeholder="name@example.com" 
                       required>
                @error('email')
                    <div class="error-message">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" 
                       class="form-control" 
                       placeholder="••••••••" 
                       required>
                @error('password')
                    <div class="error-message">⚠️ {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account yet? <a href="/register">Create Account</a></p>
        </div>
    </div>
</div>
@endsection