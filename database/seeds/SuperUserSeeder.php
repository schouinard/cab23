<?php

use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'cab23',
            'email' => 'cab23@cab23.com',
            'password' => bcrypt('1qaz2wsx'),
            'isAdmin' => true,
        ]);
    }
}
