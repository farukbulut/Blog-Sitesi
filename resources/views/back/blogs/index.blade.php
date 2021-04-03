@extends('back\layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong></h6>
            <h6 class="m-0 font-weight-bold float-right text-primary"><strong>{{$blogs->count()}} makale bulundu</strong>
                <a href="{{route('admin.trashed.blog')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i>Silinen Makaleler</a>

            </h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotograf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Görüntülenme Sayısı</th>
                        <th>Oluşturma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>

                    <tbody>
                       @foreach($blogs as $blog)
                    <tr>

                        <td><img src="{{asset($blog->image)}}" width="200"></td>
                        <td>{{$blog->title}}</td>
                        <td>{{$blog->getCategory->name}}</td>
                        <td>{{$blog->hit}}</td>
                        <td>{{$blog->created_at->diffForHumans()}}</td>
                        <td><input type="checkbox" data-on="Aktif"data-off="Pasiff" data-onstyle="success" data-offstyle="danger"
                          class="switch" blogs-id="{{$blog->id}}" @if($blog->status==1) checked @endif data-toggle="toggle"
                            >
                        <td>
                        <a target="_blank" title="Görüntüle" class="btn btn-sm btn-success" href="{{route('single',[$blog->getcategory->slug,$blog->slug])}}"><i class="fa fa-eye"> </i></a>
                        <a  title="Düzenle" class="btn btn-sm btn-primary" href="{{route('admin.makaleler.edit',$blog->id)}}"><i class="fa fa-pen"></i> </a>

                            <a title="Sil" class="btn btn-sm btn-danger"  href="{{route('admin.delete.blog',$blog->id)}}"><i class="fa fa-times"></i> </a>
                        </td>
                    </tr>
                           @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    @endsection
@section('js')

    <script>
        $(function() {
            $('.switch').change(function () {
                    {
                        id = $(this)[0].getAttribute('blogs-id');
                        //
                        //const id = $(this).data('blogs-id');
                       // const statu = $(this).prop('checked');
                        statu = $(this).prop('checked');
                        $.get("{{route('admin.switch')}}", {id: id, statu: statu}, function (data, statu) {
                            console.log(id);
                        });
                    }
                }
            )
        })
    </script>
    @endsection
