<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoundСomplaintStatus;
use Illuminate\Support\Facades\DB;

class SoundComplaintStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $findStatus = DB::table('soundсomplaint_statuses')
            ->where('tittle', '=', 'pending')->first();
        if(!$findStatus) {
            $pending = new SoundСomplaintStatus();
            $pending->tittle = 'pending';
            $pending->save();
        }
        $findStatus = DB::table('soundсomplaint_statuses')
            ->where('tittle', '=', 'processed')->first();
        if(!$findStatus) {
            $processed = new SoundСomplaintStatus();
            $processed->tittle = 'processed';
            $processed->save();
        }
    }
}
