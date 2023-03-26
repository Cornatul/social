@extends('marketing::layouts.app')

@section('title', __('Instagram Login'))

@section('heading')
    {{ __('Instagram') }}
@endsection

@section('content')
    <!-- The nav !-->
    @include('social::partials.nav')



    <!-- Cards !-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Instagram Login') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('social.instagram.login') }}">Login with instagram</a>
                </div>
            </div>
        </div>

    </div>
@endsection
