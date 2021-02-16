<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $findUser = DB::table('users')
        ->where('email', '=', 'admin@adm.com')->first();
       if(!$findUser) {
            $admin = new User();
            $admin->name = 'Jhon Deo';
            $admin->email = 'admin@adm.com';
            $admin->password = bcrypt('secret');
            $admin->save();
        }

        $findUser = DB::table('users')
            ->where('email', '=', 'vasyaxhd5@gmail.com')->first();
        if(!$findUser) {
            $admin = new User();
            $admin->name = 'Vasya';
            $admin->email = 'vasyaxhd5@gmail.com';
            $admin->password = bcrypt('12345678');
            $admin->save();
        }

    }
}
