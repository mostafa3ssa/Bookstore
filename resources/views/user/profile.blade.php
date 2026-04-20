@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container animate-slide-up" style="max-width: 600px;">
    <div class="card" style="padding: 40px;">
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, var(--secondary), var(--primary)); color: white; display: flex; align-items: center; justify-content: center; font-size: 3rem; border-radius: 50%; margin: 0 auto 16px;">
                {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
            </div>
            <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
            <span class="badge" style="font-size: 0.9rem; padding: 6px 16px;"><i class="fas fa-id-badge"></i> {{ $user->role }}</span>
        </div>

        <div style="background: var(--bg-main); border-radius: var(--radius-md); padding: 24px; margin-bottom: 32px; border: 1px solid var(--border);">
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border); padding-bottom: 8px;">
                    <span class="text-muted"><i class="fas fa-envelope"></i> Email Profile</span>
                    <strong>{{ $user->email }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span class="text-muted"><i class="fas fa-phone"></i> Registered Phone</span>
                    <strong>{{ $user->phone ?? 'Not Provided' }}</strong>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 16px;">
            <a href="{{ route('home') }}" class="btn btn-outline" style="flex: 1;"><i class="fas fa-home"></i> Back to Store</a>
            <form action="{{ route('logout') }}" method="POST" style="flex: 1; display: flex;">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%;"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection
