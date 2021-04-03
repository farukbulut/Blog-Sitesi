@extends('front.layouts.master')
@section('title', $category->name.' Kategorisi')
@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">

            @include('front.widgets.blogsWidget')

    <!-- Pager -->



    </div>
    @include('front.widgets.categoryWidget')
@endsection
