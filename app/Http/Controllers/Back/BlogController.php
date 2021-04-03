<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Str;
use File;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blogs=Blogs::orderBy('created_at','ASC')->get();
        return  view('back.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category=Category::all();
        return  view('back.blogs.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpeg|max:2048'

        ]);
        $blogs=new Blogs();
        $blogs->title=$request->title;
        $blogs->category=$request->category;
        $blogs->contens=$request->contens;
        $blogs->slug=Str::slug($request->title);
        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $blogs->image='uploads/'.$imageName;

        }
           $blogs->save();
        toastr()->success('Başarılı','Makale başarıyla oluşturuldu');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogs=Blogs::findOrFail($id);

        $category=Category::all();
        return  view('back.blogs.update',compact('category','blogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:webp,jpg,png,jpeg|max:2048'

        ]);
        $blogs=Blogs::findOrFail($id);
        $blogs->title=$request->title;
        $blogs->category=$request->category;
        $blogs->contens=$request->contens;
        $blogs->slug=Str::slug($request->title);
        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $blogs->image='uploads/'.$imageName;

        }
        $blogs->save();
        toastr()->success('Başarılı','Makale başarıyla güncellendi');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete($id)
    {
        Blogs::find($id)->delete();
        toastr()->success('Makale,silinen makalelere taşındı');
        return redirect()->route('admin.makaleler.index');
    }

    public function recover($id)
    {
        Blogs::onlyTrashed()->find($id)->restore();
        toastr()->success('Makale başarıyla kurtarıldı');
        return redirect()->back();
    }
    public function switch(Request $request)
    {

        $blogs = Blogs::findOrFail($request->id);


        $blogs->status=$request->statu ? 1:0;
        $blogs->save();
        return $request->id;
    }
    public  function trashed(){
        $blogs=Blogs::onlyTrashed()->orderBy('deleted_at','desc')->get();


        return view('back.blogs.trashed',compact('blogs'));
    }
    public function hardDelete($id)
    {
        $blogs=Blogs::onlyTrashed()->find($id);
        if(File::exists($blogs->image)){
            File::delete(public_path($blogs->image));
        }
        $blogs->forceDelete();
        toastr()->success('Makale başarılı bir şekilde silindi');
        return redirect()->back();
    }
}
