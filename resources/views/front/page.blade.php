@extends('front.layouts.master')
@section('title', $page->title)
@section('bg',asset($page->image))
@section('content')

    <div class="col-md-9 mx-auto">
        {!! $page->contens !!}

    </div>


@endsection
