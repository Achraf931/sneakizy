<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->lastname = "Hamrouni";
        $user->firstname = "Achraf";
        $user->email = "admin@admin.fr";
        $user->password = bcrypt('achraftest');
        $user->is_admin = true;
        $user->save();
    }
}
