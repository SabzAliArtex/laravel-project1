<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  $this->call(UsersTableSeeder::class);
        $this->call(EmailLayouts::class);
        $this->call(UserSeeder::class);
        $this->call(UserRolesSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(AllowedTestsSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
