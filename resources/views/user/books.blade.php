@extends('layouts.app')

@section('title', 'Purchased Books')

@section('content')
<div class="container animate-slide-up">
    <div style="margin-bottom: 24px;">
        <h2><i class="fas fa-book-reader text-muted"></i> Your Library</h2>
        <p class="text-muted">Books you have purchased and own permanently.</p>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: var(--radius-sm); margin-bottom: 24px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($purchases->count() > 0)
        <div class="grid-auto">
            @foreach($purchases as $purchase)
                <div class="card" style="display: flex; flex-direction: column;">
                    <div style="height: 180px; background: #e2e8f0; border-radius: var(--radius-sm); margin-bottom: 16px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-book" style="font-size: 3rem; color: #cbd5e1;"></i>
                    </div>
                    <h3 style="margin-bottom: 8px;">{{ $purchase->book->title }}</h3>
                    <div style="margin-bottom: 16px; flex-grow: 1;">
                        <p class="text-muted mb-1"><strong>Author:</strong> {{ $purchase->book->author->first_name ?? 'Unknown' }}</p>
                        <p class="text-muted mb-1"><strong>Genre:</strong> {{ $purchase->book->genre }}</p>
                        <p class="text-muted mb-1"><strong>Purchased:</strong> {{ $purchase->created_at->format('M d, Y') }}</p>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('book.view', $purchase->book_id) }}" class="btn btn-outline" style="flex: 1; padding: 6px; font-size: 0.9rem;">Details</a>
                        <a href="#" class="btn btn-primary" onclick="alert('Downloading PDF is mocked for this demo.')" style="flex: 1; padding: 6px; font-size: 0.9rem;">Read Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card text-center py-4" style="padding: 60px;">
            <i class="fas fa-book text-muted" style="font-size: 4rem; margin-bottom: 24px; display: inline-block;"></i>
            <h3 class="text-muted mb-2">You haven't bought any books</h3>
            <p class="mb-4">Explore the marketplace and start building your reading library.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 10px 24px;">Go to Store</a>
        </div>
    @endif
</div>
@endsection
