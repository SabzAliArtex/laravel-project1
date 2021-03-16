<?php

namespace App\Notifications;

use App\EmailLayout;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreatedFromApp extends Notification
{
    use Queueable;
    public $user;
    public $token;
    public $license;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$token,$license)
    {
        //
        $this->user = $user;
        $this->token = $token;
        $this->license = $license;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        $user = $this->user;
        $token = $this->token;
        $license = $this->license;
        $url = URL::temporarySignedRoute('user.home', now()->addMinutes(10), ['user' => $this->user]);
        
        $emaillayout = EmailLayout::where('name','=','user_created_from_app')->first();
        return (new MailMessage)->view("emails.trialActivated", compact("user" ,'token', "url", "license","emaillayout"))->subject('Welcome');
        // return (new MailMessage)->view("emails.newuser", compact("user" ,'token', "url", "license"))->subject('Welcome');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
