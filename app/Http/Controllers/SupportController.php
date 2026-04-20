<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function notifications() {
        $notifications = Notification::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        // Mark as read after viewing
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);
        
        return view('user.notifications', compact('notifications'));
    }

    public function showSupport() {
        return view('user.support');
    }

    public function submitSupport(Request $request) {
        $validated = $request->validate([
            'type' => 'required|string',
            'issue' => 'required|string',
        ]);

        Support::create([
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'issue' => $validated['issue']
        ]);

        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'Support Ticket',
            'text' => "We have received your support ticket regarding '{$validated['type']}'. Our team will contact you shortly.",
        ]);

        return redirect()->back()->with('success', 'Ticket Submitted Successfully');
    }
}
