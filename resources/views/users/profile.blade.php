@extends('layouts.app')

@section('content')
    <?php /** @var App\User $user */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1>{{ $user->name }} Profile</h1>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row panel">
                        <div class="col-md-2 picture bg_blur ">
                            <img src="{{ url('img/users/logo_250x171.png') }}" class="img-thumbnail" />
                        </div>
                        <div class="col-md-10 userinfo">
                            <div class="header">
                                <h1>{{ $user->name }}</h1>
                                <h4>some title?</h4>
                                <span>Short auto-description?Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-5">
                        <div class="col-md-2"><h2><Notifications></Notifications></h2></div>
                        <div class="col-md-10" >
                            @foreach($statistics as $key => $statistic)
                                <div class="row mb-2 ">
                                    <div class="col-md-2 col-xs-4 border-bottom" style="margin-left: 5%">
                                        {{ $key }}
                                    </div>
                                    <div class="col-md-1 border-bottom">
                                        {{ $statistic }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-5">
                        <div class="col-md-2"><h2>Statistics</h2></div>
                        <div class="col-md-10" >
                            @foreach($statistics as $key => $statistic)
                                <div class="row mb-2 ">
                                    <div class="col-md-2 col-xs-4 border-bottom" style="margin-left: 5%">
                                        {{ $key }}
                                    </div>
                                    <div class="col-md-1 border-bottom">
                                        {{ $statistic }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
