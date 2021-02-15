<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sound extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'filename',
        'author_id',
        'category_id',
        'soundstatus_id'
    ];

    //public $timestamps = false;
}
