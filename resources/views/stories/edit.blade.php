@extends('layouts.app')

@section('content')
    <?php /** @var App\Story $story */ ?>
    <?php /** @var App\StoriesEntries $entry */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card">
                <div class="card-header"><h1>{{ $story->title }}</h1></div>
                <form action="/story/{{$story->id }}/update" method="post">
                    <div class="card-body">
                            @csrf
                            @include('stories.forms.edit', [
                                'create' => 'true'
                            ])
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
                    <a href="/story/{{$story->id }}">
                        <button type="button" class="btn btn-primary btn-lg width100p">
                            Cancle
                        </button>
                    </a>
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
