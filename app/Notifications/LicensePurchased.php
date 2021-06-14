<?php

namespace App\Notifications;

use App\EmailLayout;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LicensePurchased extends Notification
{
    use Queueable;
    public $license;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$license)
    {
        //
        $this->license = $license;
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
        $license = $this->license;
        $token = rand();
        $url = URL::temporarySignedRoute('user.createpassword', now()->addMinutes(30), ['user' => $this->user->email]);
        
        $emaillayout = EmailLayout::where('name','=','license_purchased')->first();
        return (new MailMessage)->view("emails.trialActivated", compact("user" ,'token', "url", "license","emaillayout"))->subject('License Purchased');

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
