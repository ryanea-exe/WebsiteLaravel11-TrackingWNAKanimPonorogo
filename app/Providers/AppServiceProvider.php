<?php

namespace App\Providers;

use App\Models\WNAImport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        WNAImport::whereNotNull('updated_at')
            ->whereRaw(
                'updated_at <= DATE_SUB(NOW(), INTERVAL 3 MONTH)'
            )
            ->delete();

            Notification::where(
                'created_at',
                '<=',
                Carbon::now()->subDay()
            )->delete();

            // hapus pivot yatim
            DB::table('notification_user')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('notifications')
                        ->whereColumn(
                            'notifications.id',
                            'notification_user.notification_id'
                        );
                })
                ->delete();
    }
}