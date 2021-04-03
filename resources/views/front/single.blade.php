@extends('front.layouts.master')
@section('title', $blogs->title)
@section('bg',asset($blogs->image))
@section('content')

            <div class="col-md-9 mx-auto">
              {!!$blogs->contens!!}
                <br> <br>
                <span class="text-red">Okunma Sayısı: <b> {{$blogs->hit}}</b></span>
            </div>

@include('front.widgets.categoryWidget')
@endsection
