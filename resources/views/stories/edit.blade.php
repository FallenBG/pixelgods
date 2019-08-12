@extends('layouts.app')

@section('content')
    <?php /** @var App\Story $story */ ?>
    <?php /** @var App\StoriesEntries $entry */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card">
                <div class="card-header"><h1>{{ isset($story->title) ? $story->title : 'Begin a new story...' }}</h1></div>
                <form action="/story{{ isset($story->id) ? '/' . $story->id . '/update' : '/create' }}" method="post">
                    <div class="card-body">
                            @csrf
                            @include('stories.forms.edit')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-lg width100p">Update</button>
                    </div>
                </form>
            </div>


        </div>
        <div class="col-md-3">

            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-lg width100p">Delete The Story</button>
                </div>
            </div>

            <story-writers
                    :users="{{ json_encode($users) }}"
                    :owner="{{ json_encode($story->owner->name) }}"
            ></story-writers>

            <story-note
                    :story="{{ json_encode($story) }}"
                    :edit="{{ json_encode('true') }}"
            ></story-note>


        </div>
    </div>
</div>
@endsection
