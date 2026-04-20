<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserBook;
use App\Models\Notification;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function viewCart() {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $items = CartItem::with('book')->where('cart_id', $cart->id)->get();
        
        $totalAmount = $items->sum(function($item) {
            return $item->book->price;
        });

        $cart->update(['total_amount' => $totalAmount]);

        return view('cart.view', compact('items', 'totalAmount'));
    }

    public function addToCart($bookId) {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        CartItem::firstOrCreate([
            'cart_id' => $cart->id,
            'user_id' => $user->id,
            'book_id' => $bookId,
        ]);

        return redirect()->route('cart.view');
    }

    public function removeFromCart($bookId) {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        if ($cart) {
            CartItem::where('cart_id', $cart->id)->where('book_id', $bookId)->delete();
        }

        return redirect()->route('cart.view');
    }

    public function showCheckout() {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $banks = Bank::all();
        $totalAmount = $cart ? $cart->total_amount : 0;
        
        return view('cart.checkout', compact('banks', 'totalAmount'));
    }

    public function processCheckout(Request $request) {
        $validated = $request->validate([
            'bank_id' => 'required|exists:banks,id',
            'amount' => 'required|numeric'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart || $cart->total_amount != $validated['amount']) {
            return redirect()->back()->withErrors(['amount' => 'Payment validation failed.']);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'bank_id' => $validated['bank_id'],
            'total_price' => $validated['amount'],
        ]);

        $items = CartItem::where('cart_id', $cart->id)->get();
        foreach ($items as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'book_id' => $item->book_id,
                'user_id' => $user->id,
                'bank_id' => $validated['bank_id'],
            ]);

            UserBook::firstOrCreate([
                'user_id' => $user->id,
                'book_id' => $item->book_id,
            ]);

            // Notify User
            Notification::create([
                'user_id' => $user->id,
                'type' => 'Payment',
                'text' => 'You have purchased ' . $item->book->title,
            ]);
        }

        // Clear cart
        CartItem::where('cart_id', $cart->id)->delete();
        $cart->update(['total_amount' => 0]);

        return redirect()->route('user.books')->with('success', 'Checkout successful!');
    }

    public function myBooks() {
        $purchases = UserBook::with('book')->where('user_id', Auth::id())->get();
        return view('user.books', compact('purchases'));
    }
}
