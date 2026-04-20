@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="container animate-slide-up">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('home') }}" class="btn btn-outline" style="padding: 6px 16px;"><i class="fas fa-arrow-left"></i> Back to Store</a>
    </div>

    <!-- Product Display -->
    <div class="card" style="display: grid; grid-template-columns: 350px 1fr; gap: 40px; margin-bottom: 40px;">
        <!-- Left Side: Cover Image -->
        <div style="width: 100%; height: 500px; background: var(--bg-main); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid var(--border);">
            <i class="fas fa-book-open" style="font-size: 6rem; color: #cbd5e1;"></i>
        </div>

        <!-- Right Side: Details -->
        <div style="display: flex; flex-direction: column;">
            <div style="margin-bottom: 24px; border-bottom: 1px solid var(--border); padding-bottom: 24px;">
                <div style="display: flex; gap: 8px; margin-bottom: 12px; flex-wrap: wrap;">
                    <span class="badge" style="background: #f1f5f9; color: var(--text-muted);"><i class="fas fa-barcode"></i> ISBN: {{ $book->isbn }}</span>
                    <span class="badge"><i class="fas fa-tag"></i> {{ $book->genre }}</span>
                </div>
                
                <h1 style="font-size: 2.5rem; margin-bottom: 8px; line-height: 1.2;">{{ $book->title }}</h1>
                <p class="text-muted" style="font-size: 1.2rem;">By <span style="color: var(--text-dark); font-weight: 600;">{{ $book->author->first_name ?? 'Unknown' }}</span></p>
            </div>

            <div style="margin-bottom: 32px; flex-grow: 1;">
                <h3 class="mb-2">Synopsis</h3>
                <p style="font-size: 1.05rem; line-height: 1.8; color: #475569;">
                    {{ $book->description }}
                </p>
            </div>

            <div style="background: var(--bg-main); padding: 24px; border-radius: var(--radius-md); border: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <span class="text-muted" style="display: block; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Price</span>
                    <span style="font-size: 2rem; font-weight: 700; color: var(--primary);">${{ number_format($book->price, 2) }}</span>
                </div>
                
                @if(Auth::check() && Auth::user()->role === 'Customer')
                    @if($status === 'Add to Cart')
                        <form action="{{ route('cart.add', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="padding: 12px 32px; font-size: 1.1rem;"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                        </form>
                    @elseif($status === 'Added to the Cart')
                        <button class="btn btn-secondary disabled" style="padding: 12px 32px; font-size: 1.1rem; background: var(--secondary); color: white;"><i class="fas fa-check"></i> In Cart</button>
                    @elseif($status === 'Purchased')
                        <button class="btn disabled" style="padding: 12px 32px; font-size: 1.1rem; background: #22c55e; color: white;"><i class="fas fa-check-circle"></i> Purchased</button>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <!-- Review Section -->
    <section>
        <h2 class="mb-3">Reviews</h2>
        
        @auth
            <div class="card mb-4">
                <h4 class="mb-2">Leave a Review</h4>
                <form action="{{ route('review.book', $book->id) }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <textarea name="text" class="form-input" rows="3" placeholder="Share your thoughts about this book..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        @endauth

        <div style="display: flex; flex-direction: column; gap: 16px;">
            @forelse($book->reviews as $review)
                <div class="card" style="padding: 16px 24px; border-left: 4px solid var(--primary);">
                    <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px;">
                        <strong><i class="fas fa-user-circle text-muted"></i> {{ $review->user->first_name ?? 'Unknown' }}</strong>
                        <small class="text-muted">{{ $review->date }}</small>
                    </div>
                    <p style="margin: 0; color: #334155;">{{ $review->text }}</p>
                </div>
            @empty
                <p>No reviews yet.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
