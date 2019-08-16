<?php

namespace App\Http\Controllers;

use App\StoriesEntries;
use App\Story;
use App\User;
use App\UserStory;
use Carbon\Carbon;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ownedStories = auth()->user()->ownedStories()->orderBy('updated_at', 'desc')->get();
        $joinedStories = auth()->user()->joinedStories()->orderBy('updated_at', 'desc')->get();

        return view('home', compact(['ownedStories', 'joinedStories']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');

//        $entries    = $story->entries()->get();
//        $users      = $story->members()->get();

        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth');

        $attributes = $this->validateParams($request);
        $attributes['owner_id'] = auth()->user()->id;
        $attributes['finished'] = 0;
        $attributes['published'] = 0;
        $attributes['deleted'] = 0;
//        $attributes['finished'] = 0;

        $story = Story::create($attributes);

        return redirect('/story/'.$story->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story )
    {
//        $this->authorize('update', $story);

        //
        $entries    = $story->entries()->with('user')->get();
        $users      = $story->members()->get();
        $chats      = $story->chats()->with('user')->get();
        $stats      = $story->statistics()->with('user')->get();
        $perStats   = $this->getPercantageStatistics($stats);


        return view('stories.story', compact(['entries', 'users', 'story', 'chats', 'stats', 'perStats']));
    }

    private function getPercantageStatistics($stats) {
        $perStats = ['totalWords' => 0, 'totalChars' => 0, 'totalEntries' => 0];
        foreach ($stats as $stat) {
            $perStats['totalWords']     += $stat->words;
            $perStats['totalChars']     += $stat->chars;
            $perStats['totalEntries']   += $stat->entries;
        }
        $perStats['pages'] = round($perStats['totalWords'] / 300);
        return $perStats;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story $story
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Story $story)
    {
        $this->authorize('manage', $story);

        $entries    = $story->entries()->get();
        $users      = $story->members()->get();

        return view('stories.edit', compact(['entries', 'users', 'story']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Story $story
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Story $story)
    {

        $this->authorize('manage', $story);

        $attributes = $this->validateParams($request);

        $story->update($attributes);

        return redirect()->back();

    }

    private function validateParams($request) {
        $attributes = \Request::validate([
            'title'             => ['required', 'max:75'],
            'description'       => ['required', 'max:500'],
            'genre'             => ['required', 'max:100'],
            'max_participants'  => ['required', 'numeric', 'min:1'],
            'skip_step'         => ['required', 'numeric', 'min:1'],
            'chars_per_turn'    => ['required', 'numeric', 'min:1'],
            'visible_history'   => ['required', 'numeric', 'min:1']
        ]);
        $public = isset($request->public) ? 1 : 0;
        $attributes['public'] = $public;

        return $attributes;
    }

    public function join(UserStory $us, Story $story)
    {

        $this->middleware('auth');
        $us->create([
            'user_id' => auth()->user()->id,
            'story_id' => $story->id
        ]);

        return redirect()->back();
    }

    public function leave(Story $story)
    {
        $this->middleware('auth');
        $us = UserStory::where([
                    ['user_id', '=', auth()->user()->id],
                    ['story_id', '=', $story->id]
                ]);

        $us->delete();

        return redirect()->back();
    }

    /**
     * Update Finished/Published properties
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Story $story
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateFinishPublish(Story $story)
    {
        $this->authorize('manage', $story);
        $attributes = \Request::validate(
            [
                'value' => [
                    'required',
                    'bool',
                ],
                'name' => [
                    'required',
                    Rule::in(['finished', 'published'])
                    
                ]
            ]
        );

        $name =  $attributes['name'];
        $story->$name = $attributes['value'];
//        dd($attributes['value']);
        $story->update();

        return json_encode(['message' => 'success']);
    }


    /**
     * Update Finished/Published properties
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Story $story
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateNote(Story $story)
    {
        $this->authorize('manage', $story);
        $attributes = \Request::validate(
            [
                'notes' => [
                    'required',
                    'max:10000',
                ]
            ]
        );

        $story->update($attributes);

        return json_encode(['message' => 'success']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }

    /**
     * Call from the stories main page to show user's stories he joined
     *
     * @return json_encode string
     */
    public function apiJoinedStories()
    {
        $sorting = explode('|', \request('sort'));
        $sortBy = $sorting[0];
        $sortOrder = $sorting[1];
//        $ownedStories = auth()->user()->ownedStories()->orderBy('updated_at', 'desc')->get();
        $joinedStories = auth()->user()->joinedStories()->orderBy($sortBy, $sortOrder)->paginate(\request('per_page'));

        $json = [
            "total" => $joinedStories->total(),
            "per_page" => \request('per_page'),
            "current_page" => $joinedStories->currentPage(),
            "last_page" => $joinedStories->lastPage(),
            "next_page_url" => $joinedStories->nextPageUrl(),
            "prev_page_url" => $joinedStories->previousPageUrl(),
            "from" => $joinedStories->firstItem(),
            "to" => $joinedStories->lastItem(),
        ];
        $data = [];
        foreach ($joinedStories as $story) {
            $data[] = [
                'id'            => $story->id,
                'title'         => $story->title,
                'description'   => $story->description,
                'participants'  => $story->members()->count(),
                'created_at'    => Carbon::parse($story->created_at)->diffForHumans(),
                'updated_at'    => Carbon::parse($story->updated_at)->diffForHumans(),
                'public'        => $story->public,
                'finished'      => $story->finished,
                'published'     => $story->published,
            ];
        }
        $json['data'] = $data;

        return json_encode($json);
    }

    /**
     * Call from the stories main page to show user's owned stories
     *
     * @return json_encode string
     */
    public function apiOwnProjects()
    {
        $sorting = explode('|', \request('sort'));
        $sortBy = $sorting[0];
        $sortOrder = $sorting[1];
//        $ownedStories = auth()->user()->ownedStories()->orderBy('updated_at', 'desc')->get();
        $ownedStories = auth()->user()->ownedStories()->orderBy($sortBy, $sortOrder)->paginate(\request('per_page'));


        $json = [
            "total" => $ownedStories->total(),
            "per_page" => \request('per_page'),
            "current_page" => $ownedStories->currentPage(),
            "last_page" => $ownedStories->lastPage(),
            "next_page_url" => $ownedStories->nextPageUrl(),
            "prev_page_url" => $ownedStories->previousPageUrl(),
            "from" => $ownedStories->firstItem(),
            "to" => $ownedStories->lastItem(),
        ];
        $data = [];
        foreach ($ownedStories as $story) {
            $data[] = [
                'id'            => $story->id,
                'title'         => $story->title,
                'description'   => $story->description,
                'participants'  => $story->members()->count(),
                'created_at'    => Carbon::parse($story->created_at)->diffForHumans(),
                'updated_at'    => Carbon::parse($story->updated_at)->diffForHumans(),
                'public'        => $story->public,
                'finished'      => $story->finished,
                'published'     => $story->published,
            ];
        }
        $json['data'] = $data;

        return json_encode($json);
    }
}
