<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoundСomplaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SoundСomplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest()) {
            return redirect('/login');
       // abort(403);
        }
        else {
            $userId = Auth::user()->id;
           // dd($userId);
            $roleUser = DB::table('role_user')
                ->where('user_id', '=', $userId)->first();
          //  dd($roleUser);
            if (!$roleUser) $role = ' ';
            else {
                $role = DB::table('roles')->find($roleUser->role_id)->name;
            }

            $complaints = DB::table('soundсomplaints')
                ->join('users', 'soundсomplaints.user_id', '=', 'users.id')
                ->join('soundсomplaint_statuses', 'soundсomplaints.soundсomplaint_statuses_id', '=', 'soundсomplaint_statuses.id')
                ->select('soundсomplaints.*', 'soundсomplaint_statuses.tittle as tittle', 'users.name as name')
                ->get();

            return view('complaints', compact('complaints', 'role'));
        }
    }

    public function soundComplaints($id)
    {
        if(Auth::guest()) {
            return redirect('/login');
            // abort(403);
        }
            $complaints = DB::table('soundсomplaints')
                ->join('users', 'soundсomplaints.user_id', '=', 'users.id')
                ->join('soundсomplaint_statuses', 'soundсomplaints.soundсomplaint_statuses_id', '=', 'soundсomplaint_statuses.id')
                ->where('sound_id', '=', $id)
                ->select('soundсomplaints.description as description','soundсomplaints.created_at as created_at','soundсomplaints.updated_at as updated_at',
                    'soundсomplaint_statuses.tittle as tittle', 'users.name as name')
                ->get();

            return view('complaints', compact('complaints'));

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complaints.create');
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
            'description' => 'required|min:3',
        ]);
        $userId =Auth::user()->id;
        $soundcomplaint = new SoundСomplaint([
            'description' => $request->get('description'),
            'user_id' => $userId,
            'sound_id' => $request->get('sound_id'),
            'soundсomplaint_statuses_id' => $request->get('soundсomplaint_statuses_id'),

        ]);
        $soundcomplaint->save();

        return redirect('/complaints')->with('success', 'Sound Complaint saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaint = SoundСomplaint::find($id);
        $userName =DB::table('users')
            ->find($complaint->user_id)->name;

        return view('complaints.show', compact('complaint', 'userName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $complaint = SoundСomplaint::find($id);
        $statusId = DB::table('soundсomplaint_statuses')
            ->where('tittle', '=', 'processed')->first()->id;
        //dd($statusId );
        $complaint->soundсomplaint_statuses_id=$statusId;
        $complaint->save();

        return redirect('/complaints')->with('success', 'Sound Complaint updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complaint = SoundСomplaint::find($id);

        $complaint->delete();

        return redirect('/complaints')->with('success', 'Sound Category deleted!');
    }
}
