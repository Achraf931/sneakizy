<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->lastname = "Hamrouni";
        $user->firstname = "Achraf";
        $user->email = "admin@admin.fr";
        $user->password = Hash::make('achraftest');
        $user->is_admin = true;
        $user->save();
    }
}
