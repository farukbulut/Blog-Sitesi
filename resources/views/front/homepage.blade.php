@extends('front.layouts.master')
@section('title', 'Blog Sitesi')
@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        @include('front.widgets.blogsWidget')
    </div>
    @include('front.widgets.categoryWidget')
@endsection
