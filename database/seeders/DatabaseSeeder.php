<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = new User;

        $user->name = "Jose Socop";
        $user->email = "jp73384@gmail.com";
        $user->password = Hash::make("admin234");
        $user->idRol = 1;

        $user->save();
    }
}
