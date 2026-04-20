<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookReview;
use App\Models\SiteRanking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function home() {
        $books = Book::with('author')->get();
        $siteReviews = SiteRanking::orderBy('date', 'desc')->get();
        
        return view('home', compact('books', 'siteReviews'));
    }

    public function viewBook($id) {
        $book = Book::with(['author', 'reviews.user'])->findOrFail($id);
        
        $status = 'Add to Cart';
        if (Auth::check() && Auth::user()->role === 'Customer') {
            $user = Auth::user();
            if ($user->purchases()->where('book_id', $id)->exists()) {
                $status = 'Purchased';
            } elseif ($user->cart && $user->cart->items()->where('book_id', $id)->exists()) {
                $status = 'Added to the Cart';
            }
        }

        return view('books.view', compact('book', 'status'));
    }

    public function submitSiteReview(Request $request) {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        SiteRanking::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->first_name,
            'rating' => $validated['rating'],
            'text' => $validated['comment'],
        ]);

        return redirect()->back()->with('success', 'Review added successfully');
    }

    public function addComment(Request $request, $id) {
        $validated = $request->validate([
            'text' => 'required|string',
        ]);

        $book = Book::findOrFail($id);
        
        BookReview::create([
            'book_id' => $id,
            'user_id' => Auth::id(),
            'text' => $validated['text'],
        ]);

        // Notify Author
        if ($book->author_id) {
            \App\Models\Notification::create([
                'user_id' => $book->author_id,
                'type' => 'Review Added',
                'text' => Auth::user()->first_name . ' left a review on your book "' . $book->title . '".',
            ]);
        }

        return redirect()->back()->with('success', 'Comment added.');
    }
}
