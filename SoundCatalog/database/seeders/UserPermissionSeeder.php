<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')
            ->where('email', '=', 'admin@adm.com')->first();
        if ($user) {
            $findUserPermission = DB::table('permission_user')
                ->where('user_id', '=', $user->id)->first();

            if (!$findUserPermission) {

                $admin = User::where('email', '=', 'admin@adm.com')->firstOrFail();
                $approveInstructionPermission = Permission::where('name', '=', 'Approve instruction')->firstOrFail();

                $admin->permissions()->attach($approveInstructionPermission->id);
            }
        }

        $user = DB::table('users')
            ->where('email', '=', 'vasyaxhd5@gmail.com')->first();
        if ($user) {
            $findUserPermission = DB::table('permission_user')
                ->where('user_id', '=', $user->id)->first();

            if (!$findUserPermission) {
                $admin = User::where('email', '=', 'vasyaxhd5@gmail.com')->firstOrFail();
                $approveInstructionPermission = Permission::where('name', '=', 'Approve instruction')->firstOrFail();

                $admin->permissions()->attach($approveInstructionPermission->id);
            }
        }
    }
}
