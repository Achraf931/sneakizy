<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $user->name = "Achraf";
        $user->email = "achraf@achraf.fr";
        $user->password = bcrypt('achraftest');
        $user->is_admin = true;
        $user->save();
    }
}
