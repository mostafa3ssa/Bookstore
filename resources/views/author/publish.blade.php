@extends('layouts.app')

@section('title', 'Publish Book')

@section('content')
<div class="container animate-slide-up" style="max-width: 800px;">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('author.dashboard') }}" class="btn btn-outline" style="padding: 6px 16px; margin-bottom: 16px;"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        <h2><i class="fas fa-plus-circle text-primary"></i> Publish a New Book</h2>
        <p class="text-muted">Fill out the details below to add your book to the marketplace.</p>
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
        <form action="{{ route('author.publish') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="title">Book Title</label>
                <div style="position: relative;">
                    <i class="fas fa-book text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                    <input type="text" id="title" name="title" class="form-input" style="padding-left: 44px; font-weight: 600; font-size: 1.1rem;" placeholder="e.g., The Great Adventure" required>
                </div>
            </div>

            <div style="display: flex; gap: 24px; margin-bottom: 20px;">
                <div class="form-group" style="flex: 1; margin-bottom: 0;">
                    <label class="form-label" for="genre">Genre / Category</label>
                    <div style="position: relative;">
                        <i class="fas fa-tag text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                        <select name="genre" id="genre" class="form-input" style="padding-left: 44px;" required>
                            <option value="Fiction">Fiction</option>
                            <option value="Non-Fiction">Non-Fiction</option>
                            <option value="Science">Science</option>
                            <option value="History">History</option>
                            <option value="Technology">Technology</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Mystery">Mystery</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="flex: 1; margin-bottom: 0;">
                    <label class="form-label" for="price">Price ($)</label>
                    <div style="position: relative;">
                        <i class="fas fa-dollar-sign text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                        <input type="number" step="0.01" min="0" id="price" name="price" class="form-input" style="padding-left: 44px;" placeholder="29.99" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="isbn">ISBN Number</label>
                <div style="position: relative;">
                    <i class="fas fa-barcode text-muted" style="position: absolute; left: 16px; top: 14px;"></i>
                    <input type="text" id="isbn" name="isbn" class="form-input" style="padding-left: 44px;" placeholder="e.g., 978-3-16-148410-0" required>
                </div>
                <small class="text-muted" style="display: block; margin-top: 6px;">International Standard Book Number</small>
            </div>

            <div class="form-group mb-4">
                <label class="form-label" for="description">Full Description / Synopsis</label>
                <textarea id="description" name="description" class="form-input" placeholder="Provide a compelling summary of your book..." required style="min-height: 200px; font-family: inherit; line-height: 1.6;"></textarea>
            </div>

            <div style="background: #f8fafc; padding: 20px; border-radius: var(--radius-sm); border: 1px solid var(--border); margin-bottom: 24px; display: flex; align-items: start; gap: 16px;">
                <i class="fas fa-info-circle text-primary" style="font-size: 1.5rem; margin-top: 2px;"></i>
                <div>
                    <strong>Publishing Guidelines</strong>
                    <p class="text-muted" style="margin: 4px 0 0; font-size: 0.9rem;">By publishing this book, you confirm that you own the rights to this content and it aligns with LitHub's terms of service. The book will be instantly available in the marketplace.</p>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; padding: 14px;"><i class="fas fa-upload"></i> Publish to Marketplace</button>
        </form>
    </div>
</div>
@endsection
