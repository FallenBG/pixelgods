@extends('layouts.app')

@section('content')
<?php /** @var App\Story $story */ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1>FAQ</h1>
                    </div>
                    <a href="/story/create">
                        <button type="button" class="btn btn-primary btn-lg float-right">
                            Ask a question
                        </button>
                    </a>
                </div>

                <div class="card-body">
                    faqs
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
