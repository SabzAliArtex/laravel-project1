<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'role' => 1,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@ystsol.com',
            'password' =>Hash::make('password'),
            'phone' => '32324-423',
            'country' => 'XYZ',
            'state' => 'XYZ',
            'city' => 'XYZ',
            'is_active' => 1,
            'is_deleted' => 0,
            'commission' => 'Super',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'thumb' => 'files/upload/admin/Mohammad_64226791.png',
        ]);
    }
}
