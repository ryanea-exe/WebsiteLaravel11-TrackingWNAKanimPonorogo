<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;

class CleanOldNotifications extends Command
{
    protected $signature = 'notif:clean';
    protected $description = 'Hapus notifikasi lebih dari 1 hari';

    public function handle()
    {
        $deleted = Notification::where('created_at', '<', now()->subDay())->delete();

        $this->info("Berhasil hapus $deleted notifikasi lama");
    }
}