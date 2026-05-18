<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Notification;

class NotificationHelper
{
    public static function send($role, $title, $message, $type, $reference_id = null)
    {
        // buat notif
        $notif = Notification::create([
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'reference_id' => $reference_id
        ]);

        // ambil user berdasarkan role
        $users = User::where('role', $role)->get();

        // attach notif ke semua user
        foreach ($users as $user) {
            $user->notifications()->attach($notif->id, [
                'is_read' => false
            ]);
        }
    }
}