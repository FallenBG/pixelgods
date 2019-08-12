@extends('layouts.app')

@section('content')
    <?php /** @var App\Story $story */ ?>
    <?php /** @var App\StoriesEntries $entry */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card">
                <div class="card-header"><h1>{{ $story->title }}</h1></div>

                <div class="card-body">
                    <div class="scroll-box" id="storyBox" style="border:1px solid gray;">
                        @foreach($entries as $entry)
                            <p>
                                {{ $entry->entry }} <b>({{ $entry->user->name }})</b>
                            </p>
                        @endforeach
                    </div>
                    <div>
                        <input class="jscolor {onFineChange:'update(this)'} form-control width80 float-right mt-2 ml-4">
                        <div class="float-right mt-3">
                            Font size:
                            <button id="plus" onclick="resizeText(1)">+</button>
                            <button id="minus" onclick="resizeText(-1)">-</button>
                        </div>
                        <br>
                    </div>
                </div>

                @if(auth()->user()->stories->contains($story))
                    <div class="card-footer">
                        <textarea rows="10" class="width100p"></textarea>
                        <div>size and color controls for the text above</div>
                        <button type="button" class="btn btn-primary btn-lg float-right">Send</button>
                    </div>
                @endif
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
                        <button type="button" class="btn btn-primary btn-lg width100p">Leave The Story</button>
                    @else
                        <button type="button" class="btn btn-primary btn-lg width100p">Join The Story</button>
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
