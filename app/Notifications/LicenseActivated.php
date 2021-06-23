<?php

namespace App\Notifications;

use App\EmailLayout;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LicenseActivated extends Notification
{
    use Queueable;
    public $user;
    public $license;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user , $license)
    {
        $this->user = $user??'';
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
        $license = $this->license;
        $emaillayou = EmailLayout::where('name','=','license_activated')->first();
        $emaillayout = json_decode($emaillayou);
        return (new MailMessage)->view('emails.licenseactivated', compact("user","license","emaillayout"))->subject('License Activation');
        
            
        
       

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
