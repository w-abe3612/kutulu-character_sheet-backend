<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@test.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'abe',
                'email' => 'abe@test.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'public_page_token' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'yamada',
                'email' => 'yamada@test.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'public_page_token' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
