@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<div class="container animate-slide-up">
    <div style="margin-bottom: 24px;">
        <h2><i class="fas fa-shopping-cart text-muted"></i> Shopping Cart</h2>
        <p class="text-muted">Review your selected items before checkout.</p>
    </div>

    @if($items->count() > 0)
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 24px; align-items: start;">
            <!-- Cart Items List -->
            <div style="display: flex; flex-direction: column; gap: 16px;">
                @foreach($items as $item)
                    <div class="card" style="display: flex; gap: 24px; padding: 16px;">
                        <div style="width: 100px; height: 140px; background: #e2e8f0; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-book" style="font-size: 2rem; color: #cbd5e1;"></i>
                        </div>
                        <div style="flex-grow: 1; display: flex; flex-direction: column;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <h3 style="margin-bottom: 4px;">{{ $item->book->title }}</h3>
                                    <p class="text-muted"><i class="fas fa-user-edit"></i> {{ $item->book->author->first_name ?? 'Unknown' }}</p>
                                </div>
                                <span style="font-weight: 700; color: var(--primary); font-size: 1.25rem;">${{ number_format($item->book->price, 2) }}</span>
                            </div>
                            <div style="margin-top: auto;">
                                <form action="{{ route('cart.remove', $item->book_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.85rem; color: #ef4444; border-color: #ef4444;"><i class="fas fa-trash-alt"></i> Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="card" style="position: sticky; top: 100px; padding: 24px;">
                <h3 style="margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid var(--border);">Order Summary</h3>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 16px; color: var(--text-muted);">
                    <span>Subtotal ({{ $items->count() }} items)</span>
                    <span>${{ number_format($totalAmount, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 16px; color: var(--text-muted);">
                    <span>Estimated Tax</span>
                    <span>$0.00</span>
                </div>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 24px; padding-top: 16px; border-top: 1px solid var(--border); font-size: 1.25rem; font-weight: 700;">
                    <span>Total</span>
                    <span style="color: var(--primary);">${{ number_format($totalAmount, 2) }}</span>
                </div>

                <a href="{{ route('cart.checkout') }}" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; padding: 12px;">Proceed to Checkout</a>
                
                <div class="mt-4" style="text-align: center;">
                    <a href="{{ route('home') }}" style="font-size: 0.9rem; color: var(--text-muted);"><i class="fas fa-arrow-left"></i> Continue Shopping</a>
                </div>
            </div>
        </div>
    @else
        <div class="card text-center py-4" style="padding: 60px;">
            <i class="fas fa-shopping-cart text-muted" style="font-size: 4rem; margin-bottom: 24px; display: inline-block;"></i>
            <h3 class="text-muted mb-2">Your cart is empty</h3>
            <p class="mb-4">Looks like you haven't added any books to your cart yet.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 10px 24px;">Browse Books</a>
        </div>
    @endif
</div>
@endsection
