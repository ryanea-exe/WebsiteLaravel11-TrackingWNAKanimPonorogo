<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function read($id)
    {
        $user = auth()->user();

        $notif = Notification::findOrFail($id);

        // tandai notif sebagai sudah dibaca
        $user->notifications()->updateExistingPivot($notif->id, [
            'is_read' => true
        ]);

        // jika request ajax/fetch
        if (request()->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        // tetap di halaman yang sama
        return back();
    }
}