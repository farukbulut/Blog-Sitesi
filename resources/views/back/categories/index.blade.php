@extends('back\layouts.master')
@section('title','Tüm Kategoriler')
@section('content')


    <!-- Custom styles for this page -->


   <div class="row">
       <div class="col-md-4">

           <div class="card shadow mb-4" >
               <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
               </div>
               <div class="card-body" >
                   <form method="post" action="{{route('admin.category.create')}}">
                       @csrf
                   <div class="form-group">
                       <label>Kategori Adı</label>
                       <input type="text" name="name" class="form-control" required> </input>
                   </div>
                   <div class="form-group">

                       <button type="submit"  class="btn btn-primary btn-block" > Makale Oluştur</button>
                   </div>
                   </form>
               </div>
           </div>
       </div>


       <div class="col-md-8">

           <div class="card shadow mb-4" >
               <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
               </div>
               <div class="card-body" >
                   <div class="table-responsive">
                       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                           <tr>
                               <th>Kategori Adı</th>
                               <th>Makale Sayısı</th>
                               <th>Durum</th>
                               <th>İşlemler</th>
                           </tr>
                           </thead>

                           <tbody>
                           @foreach($categories as $category)
                               <tr>
                                   <td>{{$category->name}}</td>
                                   <td>{{$category->blogCount()}}</td>
                                   <td><input type="checkbox" data-on="Aktif"data-off="Pasiff" data-onstyle="success" data-offstyle="danger"
                                              class="switch" category-id="{{$category->id}}" @if($category->status==1) checked @endif data-toggle="toggle">
                                   <td> <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit" title="Kategoriyi Düzenle"><i class="fa fa-edit text-white"></i></a>
                                       <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->blogcount()}}" class="btn btn-sm btn-danger remove" title="Kategoriyi Sil"><i class="fa fa-times text-white"></i></a>
                                   </td>

                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>

               </div>
           </div>
       </div>

   </div>
    <div id="editmodal" class="modal">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kategoriyi Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form class="form-group" method="post" action="{{route('admin.category.update')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input id="category" class="form-control" type="text" name="category" >
                            <input id="category-id"  type="hidden" name="id" >
                        </div>

                        <div class="form-group">
                            <label>Kategori Slug</label>
                            <input id="slug" class="form-control" type="text" name="slug" >
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-success" >Kaydet</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>

    <div id="deletemodal" class="modal">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title">Kategoriyi Sil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div id="body" class="modal-body">
                    <div id="blogsalert" class="alert alert-danger"></div>
                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                            <form method="post" action="{{route('admin.category.delete')}}">
                                @csrf
                                <input type="hidden" name="id" id="deleteid">
                                <button id="deletebutton" type="submit" class="btn btn-success" >Sil</button>
                            </form>
                            </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('.remove').click(function () {
                id = $(this)[0].getAttribute('category-id');
                count=$(this)[0].getAttribute('category-count');
                names=$(this)[0].getAttribute('category-name');


                if(id==1){
                    $('#blogsalert').html(names +" kategorisi silinemez.");
                    $('#deletebutton').hide();
                    $('#body').show();
                    $('#deletemodal').modal();
                    return;
                }
                $('#deleteid').val(id);
                $('#blogsalert').html('');
                $('#body').hide();
                  if(count>0){

                        $('#blogsalert').html("Bu kategoriye ait "+count+" makale bulunmaktadır. Silmek istediğinize emin misiniz.")
                      $('#body').show();
                      $('#deletebutton').show();
                    }
                        $('#deletemodal').modal();

            });

            $('.edit').click(function () {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type:'GET',
                    url:'{{route('admin.category.getData')}}',
                    data:{id:id},
                    success:function (data) {
                        $('#category').val(data.name);
                        $('#slug').val(data.slug);
                        $('#category-id').val(data.id);
                        $('#editmodal').modal();
                    }

                });

            });

            $('.switch').change(function () {
                    {
                        id = $(this)[0].getAttribute('category-id');
                        statu = $(this).prop('checked');
                        $.get("{{route('admin.category.switch')}}", {id: id, statu: statu}, function (data, statu) {
                            console.log(data);

                        });
                    }
                }
            )
        })
    </script>
@endsection
