@extends('layouts.app')

@section('title', 'Help & Support')

@section('content')
<div class="container animate-slide-up" style="max-width: 600px;">
    <div style="margin-bottom: 24px;">
        <h2><i class="fas fa-headset text-muted"></i> Customer Support</h2>
        <p class="text-muted">Need help? Open a ticket and our team will get back to you.</p>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: var(--radius-sm); margin-bottom: 24px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <form action="{{ route('support.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="type">Issue Route</label>
                <select id="type" name="type" class="form-input" required>
                    <option value="" disabled selected>Select category...</option>
                    <option value="Billing/Payment">Billing & Payment</option>
                    <option value="Technical Bug">Technical Issue / Bug</option>
                    <option value="Account Access">Account Access</option>
                    <option value="Book Delivery">Digital Delivery missing</option>
                    <option value="Other">Other Query</option>
                </select>
            </div>
            
            <div class="form-group mb-4">
                <label class="form-label" for="issue">Describe Your Problem</label>
                <textarea id="issue" name="issue" class="form-input" placeholder="Please provide specific details so we can assist you better..." required style="min-height: 150px;"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;"><i class="fas fa-paper-plane"></i> Submit Ticket</button>
        </form>
    </div>
</div>
@endsection
