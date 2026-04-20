<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function dashboard() {
        $books = Book::where('author_id', Auth::id())->get();
        return view('author.dashboard', compact('books'));
    }

    public function showPublishForm() {
        return view('author.publish');
    }

    public function publishBook(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'price' => 'required|numeric',
            'isbn' => 'required|string|max:20',
            'description' => 'required|string'
        ]);

        $book = Book::create([
            'author_id' => Auth::id(),
            'title' => $validated['title'],
            'genre' => $validated['genre'],
            'price' => $validated['price'],
            'isbn' => $validated['isbn'],
            'description' => $validated['description'],
        ]);

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'Book Published',
            'text' => 'You have successfully published "' . $book->title . '".',
        ]);

        return redirect()->route('author.dashboard')->with('success', 'Book Published successfully!');
    }
}
