<?php

namespace App\Http\Controllers;

use App\Models\Instructions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\File;


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
        $user = Auth::user();
       // dd($user->name);
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file'=>'required',
        ]);
        $file = $request->file("file");
        //dd($file);
      //  $res =  Storage::putFile('file', new File($file->getPathname()));
     //$res = new File($file->getPathname());
        $fileName = time().rand().'_.txt';
        $newFileName = Storage::putFileAs('public', new File($file->getPathname()), $fileName);
       // dd($res);
        $instruction = new Instructions([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'filename' => $newFileName,
            'status' => self::INSTRUCTION_NEW,
            'authorId' => 1,
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
        //dd($fileContent);
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
        $instruction = Instructions::find($id);
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
        $instruction->status = $request->get('status');
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
        $instruction = Instructions::find($id);
        $instruction->delete();

        return redirect('/instructions')->with('success', 'Instruction deleted!');
    }
}
