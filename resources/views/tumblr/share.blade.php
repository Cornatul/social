@extends('marketing::layouts.app')

@section('title', __('Social Sharing tumblr'))

@section('heading')
    {{ __('Social Sharing tumblr') }}
@endsection

@section('content')
    <!-- The nav !-->
    @include('social::partials.nav')



    <!-- Cards !-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('tumblr Share') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <form action="{{ route('social.tumblr.shareAction') }}" method="post">
                        @csrf
                        <textarea name="message" class="form-control" placeholder="Summary"></textarea>
                        <button type="submit" class="btn btn-primary">Share</button>
                    </form>

            </div>
        </div>

    </div>
@endsection
