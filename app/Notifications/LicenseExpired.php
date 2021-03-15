<?php

namespace App\Notifications;

use App\EmailLayout;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LicenseExpired extends Notification
{
    use Queueable;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user , $token)
    {
        $this->user = $user;
        $this->token = $token;

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


        $url = URL::temporarySignedRoute('user.activelicense', now()->addDays(0), ['user' => $this->user]);
        
        $emaillayout = EmailLayout::where('name','=','LicenseExpired')->first();
        return (new MailMessage)->view("emails.trialActivated", compact("user" ,'token', "url", "license","emaillayout"))->subject('Trial Expired');
        // return (new MailMessage)->view("emails.licenseexpired", compact("user" ,'token', "url"))->subject('Trial Expired');
        
            
        



       

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
