@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container animate-slide-up" style="max-width: 600px; padding: 40px 20px;">
    <div class="card" style="padding: 40px 30px;">
        <div style="text-align: center; margin-bottom: 32px;">
            <i class="fas fa-user-plus" style="font-size: 3rem; color: var(--secondary); margin-bottom: 16px;"></i>
            <h2>Create an Account</h2>
            <p class="text-muted">Join our community of readers and writers.</p>
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

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div style="display: flex; gap: 16px;">
                <div class="form-group" style="flex: 1;">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-input" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-input" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <div style="position: relative;">
                    <i class="fas fa-envelope text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                    <input type="email" id="email" name="email" class="form-input" style="padding-left: 44px;" required>
                </div>
            </div>
            
            <div style="display: flex; gap: 16px;">
                <div class="form-group" style="flex: 1;">
                    <label class="form-label" for="phone">Phone Number (Optional)</label>
                    <input type="text" id="phone" name="phone" class="form-input" placeholder="+123456789">
                </div>
                <div class="form-group" style="flex: 1;">
                    <label class="form-label" for="role">I want to be a...</label>
                    <select id="role" name="role" class="form-input">
                        <option value="Customer">Customer (Read books)</option>
                        <option value="Author">Author (Publish books)</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="form-label" for="password">Password</label>
                <div style="position: relative;">
                    <i class="fas fa-lock text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                    <input type="password" id="password" name="password" class="form-input" style="padding-left: 44px;" required minlength="6">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary), var(--primary)); width: 100%; font-size: 1.1rem; padding: 12px;">Sign Up</button>
        </form>
        
        <p class="text-center mt-4">
            Already have an account? <a href="{{ route('login') }}" style="font-weight: 600;">Log in returning user</a>
        </p>
    </div>
</div>
@endsection
