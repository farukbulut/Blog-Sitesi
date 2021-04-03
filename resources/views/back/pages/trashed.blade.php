@extends('back\layouts.master')
@section('title','Silinen Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>@yield('title')</strong></h6>
            <h6 class="m-0 font-weight-bold float-right text-primary"><strong>{{$blogs->count()}} makale bulundu</strong>
                <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm">Aktif Makaleler</a>

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
                          <td>

                              <a title="Silmekten Kurtar" class="btn btn-sm btn-primary"  href="{{route('admin.recover.blog',$blog->id)}}"><i class="fa fa-recycle"></i> </a>
                                <a title="Sil" class="btn btn-sm btn-danger"  href="{{route('admin.hard.delete.blog',$blog->id)}}"><i class="fa fa-times"></i> </a>
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
                        id = $(this)[0].getAttribute('blogs-id');
                        statu = $(this).prop('checked');
                        $.get("{{route('admin.switch')}}", {id: id, statu: statu}, function (data, statu) {
                            console.log(data);

                        });
                    }
                }
            )
        })
    </script>
@endsection
