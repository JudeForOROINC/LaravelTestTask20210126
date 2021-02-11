<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', '=', 'admin@adm.com')->firstOrFail();
        $adminRole = Role::where('name', '=', 'Admin')->firstOrFail();

        $admin->roles()->attach($adminRole);
    }
}
