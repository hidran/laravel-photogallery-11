<?php

namespace App\Listeners;

use App\Events\NewAlbumCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdminNewAlbum as NotifyAdmin;
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
     * @param  NewAlbumCreated  $event
     * @return void
     */
    public function handle(NewAlbumCreated $event)
    {
       $admins = User::select(['email','name'])->where('user_role', 'admin')->get();
       foreach ($admins as $admin){
           Mail::to($admin->email)->send(new NotifyAdmin($admin, $event->album));
       }
    }
}
