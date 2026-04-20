@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container animate-slide-up" style="max-width: 600px;">
    <div style="margin-bottom: 24px; text-align: center;">
        <h2><i class="fas fa-lock text-muted"></i> Secure Checkout</h2>
        <p class="text-muted">Complete your purchase using our demo payment gateway.</p>
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

    <div class="card" style="padding: 32px;">
        <div style="background: #f8fafc; padding: 20px; border-radius: var(--radius-sm); border: 1px solid var(--border); margin-bottom: 24px; text-align: center;">
            <span style="display: block; color: var(--text-muted); font-size: 0.9rem; margin-bottom: 8px;">TOTAL TO PAY</span>
            <span style="font-size: 2.5rem; font-weight: 700; color: var(--primary);">${{ number_format($totalAmount, 2) }}</span>
        </div>

        <form action="{{ route('cart.process') }}" method="POST">
            @csrf
            <!-- Hidden verification value matching the total amount -->
            <input type="hidden" name="amount" value="{{ $totalAmount }}">
            
            <h4 class="mb-3">Select Payment Method</h4>
            
            <div class="form-group mb-4">
                <label class="form-label" for="bank_id">Supported Banks</label>
                <div style="position: relative;">
                    <i class="fas fa-university text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                    <select name="bank_id" id="bank_id" class="form-input" style="padding-left: 44px;" required>
                        @foreach($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-muted" style="display: block; margin-top: 8px;"><i class="fas fa-info-circle"></i> This is a simulated transaction. No real money will be charged.</small>
            </div>

            <div style="display: flex; gap: 16px;">
                <a href="{{ route('cart.view') }}" class="btn btn-outline" style="flex: 1;"><i class="fas fa-arrow-left"></i> Back to Cart</a>
                <button type="submit" class="btn btn-primary" style="flex: 2; background: #10b981; font-size: 1.1rem;"><i class="fas fa-check-circle"></i> Confirm Payment</button>
            </div>
        </form>
    </div>
</div>
@endsection
