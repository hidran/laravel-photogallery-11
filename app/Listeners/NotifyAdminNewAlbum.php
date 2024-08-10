<?php

namespace App\Listeners;

use App\Events\NewAlbumCreated;
use App\Mail\NotifyAdminNewAlbum as NotifyAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotifyAdminNewAlbum
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NewAlbumCreated $event
     * @return void
     */
    public function handle(NewAlbumCreated $event)
    {
        $admins = User::select(['email', 'name'])->where('user_role',
            'admin')->get();
      
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NotifyAdmin($admin,
                $event->album));
        }
    }
}
