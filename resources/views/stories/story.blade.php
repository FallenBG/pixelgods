@extends('layouts.app')

@section('content')
    <?php /** @var App\Story $story */ ?>
    <?php /** @var App\StoriesEntries $entry */ ?>
    <?php /** @var App\StoryStatistics $stat */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="row">
{{--@dd($entries)--}}
                <story-body :user="{{ json_encode(auth()->user()) }}"
                            :story="{{ json_encode($story) }}"
                            :contains="{{ json_encode(auth()->user()->stories->contains($story)) }}"
                ></story-body>
            </div>

            <div class="row mt-5">

                <div class="col-md-6 float-right">
                    <table class="ordinary">
                        <tr>
                            <th style="text-align: left;">Writer</th>
                            <th>Words</th>
                            <th>Chars</th>
                            <th>Entries</th>
                        </tr>
                        @foreach($stats as $stat)
                            <tr>
                                <td style="text-align: left;">{{ $stat->user->name }}</td>
                                <td>{{ $stat->words }} ({{ round(($stat->words*100)/$perStats['totalWords']) }}%)</td>
                                <td>{{ $stat->chars }} ({{ round(($stat->chars*100)/$perStats['totalChars']) }}%)</td>
                                <td>{{ $stat->entries }} ({{ round(($stat->entries*100)/$perStats['totalEntries']) }}%)</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-6">
                    <story-row
                            :name="{{ json_encode('Created') }}"
                            :value="{{ json_encode(\Carbon\Carbon::parse($story->created_at)->diffForHumans().' by '.$story->owner->name)}}"
                    ></story-row>
                    <story-row
                            :name="{{ json_encode('Updated') }}"
                            :value="{{ json_encode(\Carbon\Carbon::parse($story->updated_at)->diffForHumans()) }}"
                    ></story-row>
                    <story-row
                            :name="{{ json_encode('Participants') }}"
                            :value="{{ json_encode($story->members->count()+1) }}"
                    ></story-row>
                    <story-row
                            :name="{{ json_encode('Pages') }}"
                            :value="{{ json_encode($perStats['pages']) }}"
                    ></story-row>
                    <story-row
                            :name="{{ json_encode('Total Words') }}"
                            :value="{{ json_encode($perStats['totalWords']) }}"
                    ></story-row>
                    <story-row
                            :name="{{ json_encode('Total Chars') }}"
                            :value="{{ json_encode($perStats['totalChars']) }}"
                    ></story-row>
                    <story-row
                            :name="{{ json_encode('Total Entries') }}"
                            :value="{{ json_encode($perStats['totalEntries']) }}"
                    ></story-row>
                </div>

            </div>
        </div>

        <div class="col-md-3">

            <div class="card">
                <div class="card-body">
                    @if(auth()->user()->ownedStories->contains($story))
                        <a href="/story/{{ $story->id }}/edit">
                            <button type="button" class="btn btn-primary btn-lg width100p">Manage The Story</button>
                        </a>
                    @elseif(auth()->user()->joinedStories->contains($story))
                        <a href="/story/{{ $story->id }}/leave">
                            <button type="button" class="btn btn-primary btn-lg width100p">Leave The Story</button>
                        </a>
                    @elseif ( ($users->count() + 1) <= $story->max_participants )
                        <a href="/story/{{ $story->id }}/join">
                            <button type="button" class="btn btn-primary btn-lg width100p">Join The Story</button>
                        </a>
                    @else
                        Story is full.
                    @endif
                </div>
            </div>

            <story-writers
                    :users="{{ json_encode($users) }}"
                    :owner="{{ json_encode($story->owner->name) }}"
            ></story-writers>

            <story-note
                    :story="{{ json_encode($story) }}"
            ></story-note>

            {{--@dd($story->chats()->get())--}}
            @if(auth()->user()->stories->contains($story))
                <story-chat
                        :user="{{ json_encode(auth()->user()) }}"
                        :story="{{ json_encode($story) }}"
                        :chats="{{ json_encode($chats) }}"
                ></story-chat>
            @endif


        </div>
    </div>
</div>
@endsection
