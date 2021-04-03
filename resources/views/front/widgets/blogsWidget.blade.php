@if(count($blogs)>0)
@foreach($blogs as $blog)
    <div class="post-preview">
        <a href="{{route('single',[$blog->getCategory->slug,$blog->slug])}}">
            <h2 class="post-title">
                {{$blog->title}}
            </h2>
            <img src="{{asset($blog->image)}}" width="800" height="400">
            <h3 class="post-subtitle">
                {!!substr($blog->contens,0,300)!!}...
            </h3>
        </a>
        <p class="post-meta"> Kategori :
            <a href="#">{{$blog->getCategory->name}}</a>
            <span class="float-right">{{$blog->created_at->DiffForHumans()}}</span>
        </p>
    </div>
    @if(!$loop->last)
        <hr>
    @endif
@endforeach
@else
    <div class="alert alert-danger">
        <h1 >Bu Kategoriye ait yazı bulunamadı</h1>
    </div>
@endif
{{$blogs->links()}}
