<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class Friend_Request extends Notification implements ShouldBroadcast
{
    use Queueable;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'id'  => $this->user->id,
           'titel' => 'Send Request',
           'user_id' =>Auth::user()->id,
           'user_name' => Auth::user()->name,
           'user_img' =>Auth::user()->img,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
           // 'message' => "$this->user (User $notifiable->name)"
           'id'  => $this->user->id,
           'titel' => 'Send Request',
           'user_id' =>Auth::user()->id,
           'user_name' => Auth::user()->name,
           'user_img' =>Auth::user()->img,
        ]);
    }

}
