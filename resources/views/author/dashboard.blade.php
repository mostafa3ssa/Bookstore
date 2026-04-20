@extends('layouts.app')

@section('title', 'Author Dashboard')

@section('content')
<div class="container animate-slide-up">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
        <div>
            <h2><i class="fas fa-chart-line text-muted"></i> Author Dashboard</h2>
            <p class="text-muted">Manage your published books.</p>
        </div>
        <a href="{{ route('author.publish.form') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Publish New Book</a>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: var(--radius-sm); margin-bottom: 24px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4" style="background: linear-gradient(135deg, var(--bg-main), #e0f2fe);">
        <div style="display: flex; justify-content: space-around; text-align: center; padding: 16px 0;">
            <div>
                <span style="font-size: 2rem; font-weight: 700; color: var(--primary);">{{ $books->count() }}</span>
                <span style="display: block; font-size: 0.9rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Total Published</span>
            </div>
        </div>
    </div>

    <h3 class="mb-3">Your Portfolio</h3>

    @if($books->count() > 0)
        <div class="grid-auto">
            @foreach($books as $book)
                <div class="card" style="display: flex; flex-direction: column;">
                    <div style="height: 160px; background: #e2e8f0; border-radius: var(--radius-sm); margin-bottom: 16px; display: flex; align-items: center; justify-content: center; position: relative;">
                        <i class="fas fa-book-reader" style="font-size: 3rem; color: #cbd5e1;"></i>
                        <span class="badge" style="position: absolute; top: 12px; right: 12px; background: rgba(0,0,0,0.6); color: white; backdrop-filter: blur(4px);">#{{ $book->id }}</span>
                    </div>
                    <h4 style="margin-bottom: 8px;">{{ $book->title }}</h4>
                    <div style="margin-bottom: 16px; flex-grow: 1;">
                        <p class="text-muted mb-1"><i class="fas fa-tag"></i> {{ $book->genre }}</p>
                        <p class="text-muted mb-1"><i class="fas fa-barcode"></i> {{ $book->isbn }}</p>
                        <p style="font-weight: 700; color: var(--primary);">Price: ${{ number_format($book->price, 2) }}</p>
                    </div>
                    <a href="{{ route('book.view', $book->id) }}" class="btn btn-outline" style="width: 100%;">View Store Page</a>
                </div>
            @endforeach
        </div>
    @else
        <div class="card text-center py-4" style="padding: 60px;">
            <i class="fas fa-pen-nib text-muted" style="font-size: 4rem; margin-bottom: 24px; display: inline-block;"></i>
            <h3 class="text-muted mb-2">You haven't published anything yet</h3>
            <p class="mb-4">Share your knowledge and creativity with the world.</p>
            <a href="{{ route('author.publish.form') }}" class="btn btn-primary" style="padding: 10px 24px;">Start Publishing</a>
        </div>
    @endif
</div>
@endsection
