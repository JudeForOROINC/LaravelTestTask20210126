<?php

namespace App\Http\Controllers;

use App\Models\SoundCategory;
use Illuminate\Http\Request;

class SoundCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soundcategory = SoundCategory::all();

        return view('soundcategory', compact('soundcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soundcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
        ]);

        $soundcategory = new SoundCategory([
            'title' => $request->get('title'),
        ]);
        $soundcategory->save();

        return redirect('/soundcategory')->with('success', 'ound Category saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $soundcategory = SoundCategory::find($id);

        return view('soundcategory.show', compact('soundcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $soundcategory = SoundCategory::find($id);

        return view('soundcategory.edit', compact('soundcategory'));
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
            'title' => 'required|min:3',
        ]);

        $soundcategory = SoundCategory::find($id);

        $soundcategory->title = $request->get('title');
        $soundcategory->save();

        return redirect('/soundcategory')->with('success', 'ound Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soundcategory = SoundCategory::find($id);

        $soundcategory->delete();

        return redirect('/soundcategory')->with('success', 'Sound Category deleted!');
    }
}
