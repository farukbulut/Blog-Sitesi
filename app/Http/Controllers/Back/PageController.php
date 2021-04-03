<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

class PageController extends Controller
{
    public function index(){
        $pages=Page::all();
        return view('back.pages.index',compact('pages'));

    }
    public function switch(Request $request)
    {
        $page=Page::findOrFail($request->id);



        if($request->statu==1){

            $page->status=1;
            $page->save();
            die();
        } else {
            $page->status=0;
            $page->save();
            die();
        }

        return $request->id;
    }
    public function create(){

        return view('back.pages.create');
    }
    public function update($id){
        $page=Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function post(Request $request)
    {
        $last=Page::orderBy('order','desc')->first();
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpeg|max:2048'

        ]);
        $pages=new Page();
        $pages->title=$request->title;
        $pages->contens=$request->contens;
        $pages->slug=Str::slug($request->title);
        $pages->order=$last->order+1;
        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $pages->image='uploads/'.$imageName;

        }
        $pages->save();
        toastr()->success('Başarılı','Sayfa başarıyla oluşturuldu');
        return redirect()->route('admin.page.index');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:webp,jpg,png,jpeg|max:2048'

        ]);

        $pages=Page::findOrFail($id);
        $pages->title=$request->title;
        $pages->contens=$request->contens;
        $pages->slug=Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName=Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $pages->image='uploads/'.$imageName;

        }
        $pages->save();
        toastr()->success('Başarılı','Sayfa başarıyla güncellendi');
        return redirect()->route('admin.page.index');
    }

    public function delete($id)
    {
        $page=Page::find($id);
        if(File::exists($page->image)){
            File::delete(public_path($page->image));
        }
        $page->delete();
        toastr()->success('Makale başarılı bir şekilde silindi');
        return redirect()->back();
    }
}
