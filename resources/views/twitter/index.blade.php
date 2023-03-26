@extends('marketing::layouts.app')

@section('title', __('Social Twitter'))

@section('heading')
    {{ __('Social Sharing Twitter') }}
@endsection

@section('content')
    <!-- The nav !-->
    @include('social::partials.nav')



    <!-- Cards !-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Twitter Login') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <a href="{{ route('social.twitter.login') }}">Login with Twitter</a>

                </div>
            </div>
        </div>

    </div>
@endsection
