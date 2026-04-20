@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container animate-slide-up" style="max-width: 800px;">
    <div style="margin-bottom: 24px;">
        <h2><i class="fas fa-bell text-muted"></i> Activity Notifications</h2>
        <p class="text-muted">Stay updated on your account activity and system alerts.</p>
    </div>

    <div style="display: flex; flex-direction: column; gap: 12px;">
        @forelse($notifications as $notification)
            <div class="card" style="padding: 16px; border-left: 4px solid {{ $notification->is_read ? 'var(--border)' : 'var(--primary)' }}; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                        <span class="badge" style="background: var(--bg-main); color: var(--text-muted);">{{ $notification->type }}</span>
                        <small class="text-muted">{{ $notification->date }}</small>
                    </div>
                    <p style="margin: 0; font-size: 1.05rem; {{ $notification->is_read ? 'color: var(--text-muted);' : 'font-weight: 500;' }}">{{ $notification->text }}</p>
                </div>
                
                @if(!$notification->is_read)
                    <div style="flex-shrink: 0;">
                        <span style="display: block; width: 10px; height: 10px; background: var(--primary); border-radius: 50%; box-shadow: 0 0 10px rgba(14, 165, 233, 0.5);"></span>
                    </div>
                @endif
            </div>
        @empty
            <div class="card text-center py-4 text-muted">
                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 16px; color: var(--border);"></i>
                <h4>You're all caught up!</h4>
                <p>No new notifications at this time.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
