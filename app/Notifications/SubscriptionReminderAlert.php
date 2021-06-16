<?php

namespace App\Notifications;

use App\EmailLayout;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionReminderAlert extends Notification
{
    use Queueable;
    public $user;
    public $license;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user = $user??'';
        $this->token = $token??'';
        $this->license = $license??'';
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
       $url = URL::temporarySignedRoute('user.home', now()->addMinutes(5), ['user' => $this->user]);
       $emaillayou = EmailLayout::where('name','=','subscription_alert')->first();
       $emaillayout = json_decode($emaillayou);
       return (new MailMessage)->view('emails.trialactivated', compact("user" ,'token', "url","license","emaillayout"))->subject('Subscription Expired');
     

       
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
