<?php

namespace App\Http\Controllers;

use App\Events\StoryEvent;
use App\StoriesEntries;
use App\Story;
use App\StoryStatistics;
use Illuminate\Http\Request;

class StoriesEntriesController extends Controller
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
     * @param  \App\StoriesEntries  $storiesEntries
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        // As the decision to skip step is taken in the vue template we need to send enough records to determine it.
        $take = $story->visible_history;
        if ($story->visible_history < $story->skip_step) {
            $take = $story->skip_step;
        }
        // Get all the story entries with the user, order them by created time desc(latest)
        // and take only the amount we have set in this story visible_history and then reverse their values.
        return $story->entries()->with('user')
            ->orderBy('created_at', 'desc')
            ->take($take)->get()->reverse()->values();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoriesEntries  $storiesEntries
     * @return \Illuminate\Http\Response
     */
    public function edit(StoriesEntries $storiesEntries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoriesEntries  $storiesEntries
     * @return array
     */
    public function update(Story $story, StoriesEntries $storiesEntries)
    {
        $validatedData = $this->validateData($story->chars_per_turn);
        $resp = $storiesEntries->create($validatedData);

        $this->statistics($resp);

        broadcast(new StoryEvent($resp->user()->get()->first(), $resp))->toOthers();

        return ['response' => 'message sent!', 'message' => \request('entry'), 'name' => $resp->user->name];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoriesEntries  $storiesEntries
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoriesEntries $storiesEntries)
    {
        //
    }

    public function validateData($chars_per_turn)
    {
        $attributes = \Request::validate(
            [
                'entry'       => [
                    'required',
                    'max:'.$chars_per_turn
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

    /**
     * Update the statistics based on user and story.
     *
     * @param $resp
     */
    private function statistics($resp) {
        $statistics = StoryStatistics::firstOrNew([
            'user_id' => $resp->user_id,
            'story_id' => $resp->story_id
        ]);

        $statistics->words += count(explode(' ', $resp->entry));
        $statistics->chars += strlen($resp->entry);
        $statistics->entries++;
        $statistics->save();
    }
}
