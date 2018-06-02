<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        factory(App\User::class)->create(['username' => 'M-App', 'email' => 'app@m.app']);
        factory(App\User::class)->create(['email' => 'trial@trial.com']);
    }
}
