@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container animate-slide-up" style="max-width: 500px; padding: 40px 20px;">
    <div class="card" style="padding: 40px 30px;">
        <div style="text-align: center; margin-bottom: 32px;">
            <i class="fas fa-book-open" style="font-size: 3rem; color: var(--primary); margin-bottom: 16px;"></i>
            <h2>Welcome Back</h2>
            <p class="text-muted">Enter your credentials to access your account.</p>
        </div>

        @if($errors->any())
            <div style="background: #fee2e2; color: #dc2626; padding: 12px; border-radius: var(--radius-sm); margin-bottom: 16px;">
                <ul style="list-style: none; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                    <input type="email" id="email" name="email" class="form-input" style="padding-left: 44px;" placeholder="john@example.com" required>
                </div>
            </div>
            
            <div class="form-group mb-4">
                <label class="form-label" for="password">Password</label>
                <div style="position: relative;">
                    <i class="fas fa-lock text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                    <input type="password" id="password" name="password" class="form-input" style="padding-left: 44px;" placeholder="••••••••" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; padding: 12px;">Sign In</button>
        </form>
        
        <p class="text-center mt-4">
            Don't have an account? <a href="{{ route('register') }}" style="font-weight: 600;">Sign up here</a>
        </p>
    </div>
</div>
@endsection
