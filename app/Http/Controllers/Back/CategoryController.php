<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public  function  index(){
        $categories=Category::all();
        return view('back.categories.index',compact("categories"));
    }
    public function switch(Request $request)
    {
        $category=Category::findOrfail($request->id);
        $category->status=$request->statu ? 1 : 0;
        $category->save();
        return $request->id;
    }


    public function create(Request $request){
       $isExits=Category::whereSlug(Str::slug($request->name))->first();
        if($isExits){
            toastr()->error($request->name." adında bir kategori zaten mevcut!");
            return redirect()->back();
        }


        $category=new Category();
        $category->name=$request->name;
        $category->slug=Str::slug($request->name);
        $category->save();
        toastr()->success('Kategori başarıyla oluşturuldu');
        return redirect()->back();


    }


    public function getData(Request $request)
    {
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }


    public function update(Request $request)
    {
        $isExits=Category::whereSlug(Str::slug($request->slug))->whereNotIN('id',[$request->id])->first();
        $isName=Category::whereName($request->category)->whereNotIN('id',[$request->id])->first();
        if($isExits or $isName){
            toastr()->error($request->category." adında bir kategori zaten mevcut!");
            return redirect()->back();
        }


        $category=Category::find($request->id);
        $category->name=$request->category;
        $category->slug=Str::slug($request->slug);
        $category->save();
        toastr()->success('Kategori başarıyla güncellendi');
        return redirect()->back();
    }
    public function delete(Request $request){
        $category=Category::findOrFail($request->id);
        $default=Category::find(1);
        $message="";
        if($category->id==1){
            toastr()->error('Bu kataegori silinemez');
        }
        $count=$category->blogcount();
        if ($count>0){
            Blogs::where('category',$category->id)->update(['category'=>1]);
            $message='Bu kategoriye ait'.$count.' makale '.$default->name.' kategorisine taşındı';

        }

        toastr()->success('Kataegori başarıyla silindi, '.$message);
        $category->delete();
        return redirect()->back();
    }
}
