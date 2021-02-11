<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', '=', 'Admin')->firstOrFail();
        $approveInstructionPermission = Permission::where('name', '=', 'Approve instruction')->firstOrFail();
        $declineInstructionPermission = Permission::where('name', '=', 'Decline instruction')->firstOrFail();

        $adminRole->permissions()->attach($approveInstructionPermission->id);
        $adminRole->permissions()->attach($declineInstructionPermission->id);
    }
}
