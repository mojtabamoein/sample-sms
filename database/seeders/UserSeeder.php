<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'snap',
            'email'=>'snap',
            'email_verified_at'=>now(),
            'password'=>bcrypt('snap'),
            'created_at'=>now()
        ]);
    }
}
