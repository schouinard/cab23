<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User(['name' => 'cab23', 'email' => 'cab23@cab23.com', 'password' => bcrypt('1qaz2wsx')]);
        $user->save();

        $benevoles = factory('App\Benevole', 50)->create();
        foreach ($benevoles as $benevole) {
            factory('App\Service')->create(['benevole_id' => $benevole->id]);
        }
    }
}
