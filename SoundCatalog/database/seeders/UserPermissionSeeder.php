<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', '=', 'admin@adm.com')->firstOrFail();
        $approveInstructionPermission = Permission::where('name', '=', 'Approve instruction')->firstOrFail();

        $admin->permissions()->attach($approveInstructionPermission->id);
    }
}
