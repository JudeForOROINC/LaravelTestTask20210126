<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoundСomplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'sound',
        'description',
        'soundсomplaint_statuses_id'
    ];
}
