<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $findRole = DB::table('permissions')
        ->where('name', '=', 'Approve instruction')->first();
        if(!$findRole) {
            $approveInstruction = new Permission();
            $approveInstruction->name = "Approve instruction";
            $approveInstruction->save();
        }


     $findRole = DB::table('permissions')
        ->where('name', '=', 'Decline instruction')->first();
        if(!$findRole) {
            $declineInstruction = new Permission();
            $declineInstruction->name = 'Decline instruction';
            $declineInstruction->save();
        }

    }
}
