@extends('layouts.app')

@section('content')
<?php /** @var App\Story $story */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1>Search Stories</h1>
                    </div>
                </div>

                <div class="card-body">
                    <vuetable v-bind:datadest="{{ json_encode('apiSearchStories') }}"></vuetable>
                    {{--<vuetable v-bind:datadest="{{ json_encode('https://vuetable.ratiw.net/api/users') }}"></vuetable>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
