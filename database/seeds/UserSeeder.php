<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Eugen Girlescu';
        $user->email = 'euugen90@yahoo.com';
        $user->user_role = 'ADMIN';
        $user->password = '$2y$10$7QSUyVK.NhBNsmJzhjD5G.wjXSBCwviUuKwvU5LwlhiCvYGnDRcvq';
        $user->save();
    }
}