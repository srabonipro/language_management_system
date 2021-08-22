@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    <h3>{{ __('add_translation_for') }}</h3>
                    <hr>
                    <h3>{{ __('back') }}</h3>
                    <hr>
                    <h3>{{ __('languages') }}</h3>
                    <hr>
                    <h3>{{ __('laravel') }}</h3>
                    <hr>
                    <h3>{{ __('add_language') }}</h3>
                    <hr>
                    <h3>{{ __('documentation') }}</h3>
                    <hr>
                    <h3>{{ __('laravel_news') }}</h3>
                    <hr>
                    <h3>{{ __('vibrant_ecosystem') }}</h3>
                    <hr>
                    <h3>{{ __('laracasts') }}</h3>
                    <hr>
                    <h3>{{ __('save') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
