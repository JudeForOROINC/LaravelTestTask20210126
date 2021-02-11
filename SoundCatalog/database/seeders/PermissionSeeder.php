<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $approveInstruction = new Permission();
        $approveInstruction->name = "Approve instruction";
        $approveInstruction->save();

        $declineInstruction = new Permission();
        $declineInstruction->name = 'Decline instruction';
        $declineInstruction->save();
    }
}
