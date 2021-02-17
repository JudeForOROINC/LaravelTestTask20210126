<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = DB::table('roles')
            ->where('name', '=', 'Admin')->first();
        if ($role) {
            $findRolePermission = DB::table('permission_role')
                ->where('role_id', '=', $role->id)->first();
            if (!$findRolePermission) {
            $adminRole = Role::where('name', '=', 'Admin')->firstOrFail();
            $approveInstructionPermission = Permission::where('name', '=', 'Approve instruction')->firstOrFail();
            $declineInstructionPermission = Permission::where('name', '=', 'Decline instruction')->firstOrFail();

            $adminRole->permissions()->attach($approveInstructionPermission->id);
            $adminRole->permissions()->attach($declineInstructionPermission->id);
        }
    }
}
}
