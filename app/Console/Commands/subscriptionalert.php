<?php

namespace App\Console\Commands;

use App\UserSubscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubscriptionReminderAlert;

class subscriptionalert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Mail to User depending upon subscription expiry';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $usersub = UserSubscription::where('type','=','1')->get();
        
        Notification::send($usersub,new SubscriptionReminderAlert($usersub));
    }
}
