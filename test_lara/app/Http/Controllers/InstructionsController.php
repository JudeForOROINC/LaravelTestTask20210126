<?php

namespace App\Http\Controllers;

use App\Models\Instructions;
use http\Env\Response;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class InstructionsController extends Controller
{
    const INSTRUCTION_NEW = 1;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sessionVars = Session::all();
        //dd($sessionVars);

        //$user = Auth::user();
        //dd($user->name);

        $instructions = Instructions::all();
        return view('instructions', compact('instructions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (Auth::guest()){
//            return redirect('/login');
//        }

        return view('instructions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guest()) {
            return redirect('login');
        }


        $request->validate([
            'name' => 'required|min:4',
            'description' => 'required',
            'file' => 'required|mimes:pdf,jpg,png'
        ]);

        $file = $request->file('file');
        $newFileName = Storage::putFile('public', new File($file->getPathname()));


        if ($user = Auth::user()) {
            $userId = $user->id;
        } else {
            $userId = -1;
        }


        $instruction = new Instructions([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'filename' => $newFileName,
            'status' => self::INSTRUCTION_NEW,
            'authorId' => $userId,
        ]);
        $instruction->save();


        return redirect('/instructions')->with('success', 'Instruction saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instruction = Instructions::find($id);
        $fileContent = Storage::get($instruction->filename);

        return view('instructions.show', compact('instruction', 'fileContent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if ($user === null) {
            return redirect('/login');
        }


        $instruction = Instructions::find($id);

        if ($instruction->authorId !== $user->id) {
            return redirect('/instructions');
        }

        return view('instructions.edit', compact('instruction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $instruction = Instructions::find($id);
        $instruction->name = $request->get('name');
        $instruction->description = $request->get('description');
        $instruction->status = $request->get('status'); // TODO: admin can update the status.
        $instruction->save();

        return redirect('/instructions')->with('success', 'Instruction updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $instruction = Instructions::find($id);

        if( $instruction->authorId == $user->id ){
            $instruction->delete();
            return redirect('/instructions')->with('success', 'Instruction deleted!');
        }
        else
            return redirect('/instructions');
    }

    public function search(Request $request){
        $searchString = $request->get('searchString');

        $instructions = Instructions::where('name', 'like', '%'.$searchString.'%')->get();

        return view('instructions', compact('instructions'));
    }

}
