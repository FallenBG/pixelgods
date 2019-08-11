<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatEvent;
use App\Story;
use Illuminate\Http\Request;

class ChatController extends Controller
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
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat, Story $story)
    {
//        dd('kur');
        //
        return $story->chats()->with('user')->get();
//        $chats = $chat->story()->chats()->with('user')->get();
//        dd($chats);
//        $story->chats()->with('user')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
        $validatedData = $this->validateProject();
        $resp = $chat->create($validatedData);

//        \Log::debug('PUTKA');
        broadcast(new ChatEvent($resp->user()->get()->first(), $resp))->toOthers();

        return ['response' => 'message sent!', 'message' => \request('message'), 'name' => $resp->user->name];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function validateProject()
    {
        $attributes = \Request::validate(
            [
                'message'       => [
                    'required'
                ],
                'story_id'       => [
                    'required'
                ]
            ]
        );

        $attributes['user_id'] = auth()->id();
        $attributes['deleted'] = 0;

        return $attributes;

    }//end validateProject()
}
