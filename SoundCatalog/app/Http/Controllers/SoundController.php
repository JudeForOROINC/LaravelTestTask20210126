<?php

namespace App\Http\Controllers;

use App\Models\Sound;
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
        $sound = Sound::all();

        return view('sound.list', compact('sound'));
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

        return view('sound.create');
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
            'file' => 'required|mimes:wav,mp3|max:10240'

        ]);

        $file = $request->file('file');
        $newFileName = Storage::putFile('public', new File($file->getPathname()));

        if ($user = Auth::user()) {
            $userId = $user->id;
        } else {
            $userId = -1;
        }

        $sound = new Sound([
            'title' => $request->get('title'),
            'filename' => $newFileName,
            'author_id' => $userId,
            'category_id' => -1,
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

        $userName = DB::table('users')->find($sound->author_id)->name;
        //$fileContent = Storage::get($sound->filename);

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
}
