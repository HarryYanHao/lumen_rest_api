<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        factory('App\Model\User', 50)->create()->each(function($u) {
            $u->posts()->save(factory('App\Post')->make());
        });
    }
}
