@extends('back\layouts.master')
@section('title','Tüm Sayfalar')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong></h6>
            <h6 class="m-0 font-weight-bold float-right text-primary"><strong>{{$pages->count()}} Sayfa bulundu</strong>
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
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>

                    <tbody>
                       @foreach($pages as $page)
                    <tr>

                        <td><img src="{{asset($page->image)}}" width="200"></td>
                        <td>{{$page->title}}</td>
                        <td>
                            <input  type="checkbox" data-on="Aktif"data-off="Pasiff" data-onstyle="success" data-offstyle="danger"
                                   class="switch" page-id="{{$page->id}}" @if($page->status==1) checked @endif data-toggle="toggle"

                            >

                        </td>
                            <td>
                                <a target="_blank" title="Görüntüle" class="btn btn-sm btn-success" href="{{route('page',$page->slug)}}"><i class="fa fa-eye"> </i></a>
                        <a  title="Düzenle" class="btn btn-sm btn-primary" href="{{route('admin.page.update',$page->id)}}"><i class="fa fa-pen"></i> </a>

                            <a title="Sil" class="btn btn-sm btn-danger"  href="{{route('admin.page.delete',$page->id)}}"><i class="fa fa-times"></i> </a>
                        </td>
                    </tr>
                           @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(function() {
            $('.switch').change(function () {
                    {
                        id = $(this)[0].getAttribute('page-id');
                        statu = $(this).prop('checked');
                        $.get("{{route('admin.page.switch')}}", {id: id, statu: statu}, function (data, statu) {
                            console.log(statu);

                        });
                    }
                }
            )
        })
    </script>
@endsection
