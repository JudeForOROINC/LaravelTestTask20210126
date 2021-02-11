<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoundСomplaint extends Model
{
    use HasFactory;
//    public function user()
//    {
//        return $this->hasOne(User::class);
//    }
//
//    public function status()
//    {
//        return $this->hasMany(SoundСomplaintStatus::class);
//    }
    protected $fillable = [
        'user_id',
        'sound_id',
        'description',
        'soundсomplaint_statuses_id'
    ];
}
