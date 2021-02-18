<?php

namespace App\Http\Controllers;

use App\Models\Sound;
use App\Models\SoundCategory;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sounds = Sound::all();

        return view('sound.index', compact('sounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guest()){
            return redirect('/login');
        }

        $soundCategories = SoundCategory::all();

        return view('sound.create', compact('soundCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guest()) {
            return redirect('login');
        }

        $request->validate([
            'title' => 'required|min:4',
            'file' => 'required|mimes:wav,mp3|max:10240',
            'category_id' => 'required|integer',
        ]);

        $file = $request->file('file');
        $newFileName = Storage::putFile('public', new File($file->getPathname()));

        if ($user = Auth::user()) {
            $userId = $user->id;
        } else {
            $userId = -1;
        }

        $category_id = $request->get('category_id');

        $sound = new Sound([
            'title' => $request->get('title'),
            'filename' => $newFileName,
            'author_id' => $userId,
            'category_id' => $category_id,
            'soundstatus_id' => -1,
        ]);
        $sound->save();

        return redirect('/sound')->with('success', 'Sound saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sound = Sound::find($id);

        $author = DB::table('users')->find($sound->author_id);

        $userName = !empty($author->name) ? $author->name : 'Unknown';

        $fileLink = '/storage/'. basename($sound->filename);

        return view('sound.show', compact('sound', 'fileLink', 'userName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $user = array();



        if ($user === null) {
            return redirect('/login');
        }



        $sound = Sound::find($id);

//        if ($sound->authorid !== $user->id) {
//            return redirect('/sound');
//        }

        return view('sound.edit', compact('sound'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:4',
            //'file' => 'required|mimes:wav,mp3'
        ]);

        $sound = Sound::find($id);

        //dd($sound);

        $sound->title = $request->get('title');
        //$sound->status = $request->get('status');

        $sound->save();

        return redirect('/sound')->with('success', 'Sound updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $sound = Sound::find($id);

//        if( $sound->authorid == $user->id ){
            $sound->delete();

            Storage::delete($sound->filename);

            return redirect('/sound')->with('success', 'Sound deleted!');
//        }
//        else
//            return redirect('/sound');
    }


    public function searchAjax(Request $request){
        $searchString = $request->get('searchString');

        $sounds = Sound::where('title', 'like', '%'. $searchString .'%')->get();

        return view('sound.parts._items', compact('sounds'));
    }


    // index GroupByCategories
    public function soundsGroupByCategories()
    {
//        рабочий вариант, но неправильный
//        $soundCategories = SoundCategory::all();
//        $sounds = Sound::all();
//        foreach ( $soundCategories as $soundCategory ) {
//            foreach ($sounds as $sound ) {
//
//            }
//        }

        // SELECT s.id, s.title, s.filename, s.author_id, s.soundstatus_id, s.created_at, s.updated_at, sc.title as category_name
        // FROM sounds as s
        //	join soundcategory as sc on s.category_id = sc.id

        // одномерный массив
        $results = DB::table('sounds as s')
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

        // получаем уже двумерный массив без лишних проховов по sounds
        $items = self::get2dArraySoundsGroupByCategory($results);

        return view('sound.indexGroupByCategories', compact('items')); // 'sounds', 'soundCategories',
    }

    // ajax
    public function searchAjaxGroupByCategories(Request $request)
    {
        $searchString = $request->get('searchString');

        //$sounds = Sound::where('title', 'like', '%'. $searchString .'%')->get();

        // одномерный массив
        $results = DB::table('sounds as s')
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

        // получаем уже двумерный массив без лишних проховов по sounds
        $items = self::get2dArraySoundsGroupByCategory($results);

        return view('sound.parts._itemsGroupByCategories', compact('items'));
    }

    // результат по саундам в двумерном массиве для индекса по категориям и его ajax-запросу
    private function get2dArraySoundsGroupByCategory($arr = []) : ? array
    {
        $items = [];
        $last_category_id = -1;
        foreach ($arr as $result) {
            if( $result->category_id != $last_category_id ) {
                $last_category_id = $result->category_id;
                // не isset()!
                if( empty($items[$last_category_id]) )
                    $items[$last_category_id] = [
                        'category_id' => $result->category_id,
                        'category_name' => $result->category_name,
                        'sounds' => [],
                    ];
            }
            $items[$last_category_id]['sounds'][] = $result;
        }

        return $items;
    }


}
