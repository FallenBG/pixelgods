<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('auth');

        $user = User::findOrFail($id);

        $result = $user->statistics()->get();
        $statistics = [ 'Total Entries' => 0, 'Total Words' => 0, 'Total Characters' => 0];
        foreach ($result as $statistic) {
            $statistics['Total Entries']    += $statistic->entries;
            $statistics['Total Words']      += $statistic->words;
            $statistics['Total Characters'] += $statistic->chars;
        }
        $statistics['Owned Stories']    = $user->ownedStories()->where('deleted', '=', '0')->count();
        $statistics['Deleted Stories']  = $user->ownedStories()->where('deleted', '=', '1')->count();
        $statistics['Joined Stories']   = $user->joinedStories()->count();
//        dd($statistics);


        return view('users.profile', compact('user', 'statistics'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
