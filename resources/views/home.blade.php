@extends('layouts.app')

@section('title', 'Welcome to LitHub')

@section('content')
<div class="container">
    <div class="hero-section animate-slide-up">
        <h1>Discover Your Next Great Adventure</h1>
        <p class="text-muted mb-4" style="font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Join thousands of readers exploring our vast collection of digital literature spanning over countless genres.</p>
        <div style="display: flex; gap: 16px; justify-content: center;">
            <a href="#browse" class="btn btn-primary" style="padding: 12px 24px; font-size: 1.1rem;">Browse Collection</a>
        </div>
    </div>

    <!-- Books Collection -->
    <section id="browse" class="mb-4">
        <h2 class="mb-3" style="display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-book text-muted"></i> Featured Books
        </h2>
        
        <div class="grid-auto">
            @forelse($books as $book)
                <div class="card" style="display: flex; flex-direction: column;">
                    <div style="height: 200px; background: #e2e8f0; border-radius: var(--radius-sm); margin-bottom: 16px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-book-medical" style="font-size: 3rem; color: #cbd5e1;"></i>
                    </div>
                    <h3 style="margin-bottom: 8px;">{{ $book->title }}</h3>
                    <div style="margin-bottom: 16px; flex-grow: 1;">
                        <p class="text-muted mb-1" style="display: flex; align-items: center; gap: 6px;"><i class="fas fa-user-edit"></i> {{ $book->author->first_name ?? 'Unknown' }}</p>
                        <p class="text-muted mb-1"><span class="badge">{{ $book->genre }}</span></p>
                        <p style="font-weight: 700; color: var(--primary); font-size: 1.25rem;">${{ number_format($book->price, 2) }}</p>
                    </div>
                    <a href="{{ route('book.view', $book->id) }}" class="btn btn-primary" style="width: 100%;">View Details</a>
                </div>
            @empty
                <p>No books found.</p>
            @endforelse
        </div>
    </section>

    <!-- Community Reviews Section -->
    <section style="margin-top: 60px; padding-top: 40px; border-top: 1px solid var(--border);">
        <h2>Community Reviews</h2>
        
        <div class="grid-auto" style="grid-template-columns: 1fr 2fr;">
            @auth
                <div class="card">
                    <h3 class="mb-3">Leave a review for the site</h3>
                    <form action="{{ route('review.site') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="rating">Rating</label>
                            <select name="rating" id="rating" class="form-input">
                                <option value="5">★★★★★ (5 Stars)</option>
                                <option value="4">★★★★☆ (4 Stars)</option>
                                <option value="3">★★★☆☆ (3 Stars)</option>
                                <option value="2">★★☆☆☆ (2 Stars)</option>
                                <option value="1">★☆☆☆☆ (1 Star)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="comment">Your Comment</label>
                            <textarea name="comment" id="comment" class="form-input" placeholder="What did you think of the service?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Review</button>
                    </form>
                </div>
            @else
                <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 40px;">
                    <i class="fas fa-lock text-muted" style="font-size: 2.5rem; margin-bottom: 16px;"></i>
                    <h4>Login Required</h4>
                    <p class="text-muted mb-3">You must be logged in to leave a community review.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 10px 24px;">Log In Now</a>
                </div>
            @endauth

            <div>
                @forelse($siteReviews as $review)
                    <div class="card mb-2" style="background: white; border-left: 4px solid var(--primary);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                            <strong><i class="fas fa-user-circle"></i> {{ $review->user_name }}</strong>
                            <span style="color: #fbbf24;">{{ str_repeat('★', $review->rating) }}</span>
                        </div>
                        <p class="text-muted mb-1">{{ $review->text }}</p>
                        <small style="color: #94a3b8;">{{ $review->date }}</small>
                    </div>
                @empty
                    <p>No site reviews yet. Be the first!</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
