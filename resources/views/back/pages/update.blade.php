@extends('back\layouts.master')
@section('title',$page->title.' sayfasını güncelle')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong></h6>
        </div>


        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.page.edit',$page->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Sayfa Başlığı</label>
                    <input type="text" name="title" value="{{$page->title}}" class="form-control" required> </input>
                </div>

                <div class="form-group">
                    <label>Sayfa Fotoğrafı</label> <br>
                    <img src="{{asset($page->image)}} " class="img-thumbnail rounded" width="300" >
                    <input type="file" name="image" class="form-group">
                </div>
                <div class="form-group">
                    <label>Sayfa İçeriği</label>
                    <textarea  id="editor" name="contens"   class="form-control" rows="4">{!!$page->contens!!}</textarea>
                </div>
                <div class="form-group">

                    <button type="submit"  class="btn btn-primary btn-block" > Sayfa Güncelle</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#editor').summernote(
                {'height':300}
            );

        });

    </script>
    <script src="{{asset('back/')}}/js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
@endsection
