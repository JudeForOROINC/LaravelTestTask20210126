<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    public static function getList(){
        $result = DB::table('sounds as s')
            ->join('soundcategory as sc','s.category_id','=','sc.id')
            ->select([
                's.id as id',
                's.id',
                's.title',
                's.filename',
                's.author_id',
                's.category_id',
                's.soundstatus_id',
                's.created_at',
                's.updated_at',
                'sc.title as category_name'
            ])
            ->orderBy('sc.id', 'asc')
            ->get();

        return $result;
    }

    public static function getListGroupByCategories($searchString = ''){
        $result = DB::table('sounds as s')
            ->join('soundcategory as sc','s.category_id','=','sc.id')
            ->where('sc.title', 'like', '%'. $searchString .'%')
            ->select([
                's.id as id',
                's.id',
                's.title',
                's.filename',
                's.author_id',
                's.category_id',
                's.soundstatus_id',
                's.created_at',
                's.updated_at',
                'sc.title as category_name'
            ])
            ->orderBy('sc.id', 'asc')
            ->get();

        return $result;
    }


}
