<?php

use App\Route;
use App\User;
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
        Model::unguard();

        User::create([
            'username' => 'user1',
            'password' => Hash::make('pass1'),
            'name' => 'Mohamad Mohebifar'
        ]);

        User::create([
            'username' => 'user2',
            'password' => Hash::make('pass2'),
            'name' => 'Saman Soltani'
        ]);

        Route::create([
            'from' => 'Tehran',
            'to' => 'Sao Paulo',
            'user_id' => 1,
            'type' => 'requested',
            'time' => new DateTime('+10 days')
        ]);

        Route::create([
            'from' => 'Tehran',
            'to' => 'Texas',
            'user_id' => 1,
            'type' => 'offered',
            'time' => new DateTime('+15 days')
        ]);
    }

}
