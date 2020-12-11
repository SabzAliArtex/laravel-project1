<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_roles')->insert([
                 
            'license_id'=>1
            'sales_person_id'=>1
            'commission'=>120
            'is_approved'=>1
           
            
        ]);
    }
}
