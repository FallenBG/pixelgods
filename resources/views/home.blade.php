@extends('layouts.app')

@section('content')
<?php /** @var App\Story $story */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1>Your Stories</h1>
                    </div>
                    <a href="/story/create">
                        <button type="button" class="btn btn-primary btn-lg float-right">
                            Create new Story
                        </button>
                    </a>
                </div>

                <div class="card-body">
                    <vuetable v-bind:datadest="{{ json_encode('apiOwnStories') }}"></vuetable>
                    {{--<vuetable v-bind:datadest="{{ json_encode('https://vuetable.ratiw.net/api/users') }}"></vuetable>--}}
                </div>
            </div>


            <div class="card mt-3">
                <div class="card-header"><h1>Stories you are part of</h1></div>

                <div class="card-body">
                    <vuetable v-bind:datadest="{{ json_encode('apiJoinedStories') }}"></vuetable>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
