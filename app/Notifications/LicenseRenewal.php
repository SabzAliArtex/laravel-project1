<?php

namespace App\Notifications;

use App\EmailLayout;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LicenseRenewal extends Notification
{
    use Queueable;
    public $user,$license;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$license)
    {
        //
        $this->user = $user;
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
        
        $url = URL::temporarySignedRoute('login', now()->addMinutes(5), ['user' => $this->user->email]);
        $emaillayout = EmailLayout::where('name','=','LicenseRenewal')->first();
        return (new MailMessage)->view("emails.trialActivated", compact("user" ,'token', "url", "license","emaillayout"))->subject('License Renewal');
        // return (new MailMessage)->view("emails.licenserenewal",['user'=>$this->user,'license'=>$this->license,'url'=>$url])->subject('License Renewal');
        
            
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
