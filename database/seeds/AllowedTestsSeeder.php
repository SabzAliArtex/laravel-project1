<?php

use Illuminate\Database\Seeder;

class AllowedTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
          DB::table('tests')->insert([
            'name' => 'CCVT',
            'description' => 'Test under supervision of waggoner experts',
            'is_active' => 1,
        ]);DB::table('tests')->insert([
            'name' => 'Waggoner',
            'description' => 'Test under supervision of waggoner experts',
            'is_active' => 1,
        ]);DB::table('tests')->insert([
            'name' => 'CCVT EYE TEST',
            'description' => 'Test under supervision of waggoner experts',
            'is_active' => 1,
        ]);
    }
}
