<?php

namespace App\Notifications;

use App\EmailLayout;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateLicenseUser extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user , $license_key)
    {
        //
        $this->user = $user;
        $this->license_key = $license_key; 
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
        $license_key = $this->license_key;


        $url = URL::temporarySignedRoute('user.activelicense', now()->addDays(0), ['user' => $this->user]);
        
        $emaillayout = EmailLayout::where('name','=','create_new_user')->first();
        return (new MailMessage)->view("emails.trialactivated", [
            "user"=>$user ,
             "url"=>$url,
              "license"=>$license_key,
              "emaillayout"=>$emaillayout])->subject('License Created');
        // return (new MailMessage)->view("emails.licensecreated", compact("user" ,'license_key','url'))->subject('License Created');
        
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
