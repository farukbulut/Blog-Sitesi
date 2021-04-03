<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Category;

use App\Models\Contact;
use App\Models\Page;
use Validator;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function __construct(){
    view()->share('pages',Page::orderBy('order','ASC')->get());
        view()->share('categories',Category::inRandomOrder()->get());
    }
 public function index(){
     $data['blogs']=Blogs::orderBy('created_at','DESC')->paginate(2);
         $data['blogs']->withPath(url('sayfa'));


     return view( 'front.homepage',$data);

 }
 public function single($category,$slug){
    $category= Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı');


     $blogs=Blogs::where('slug',$slug)->whereCategory($category->id)->first() ?? abort(403,'Böyle bir yazı bulunamadı');
     $blogs->increment('hit');
      $data['blogs']=$blogs;



return view('front.single',$data);
 }
 public function category($slug){
     $category= Category::whereSlug($slug)->first() ?? abort(403,'Böyle bir kategori bulunamadı');
     $data['category']=$category;
     $data['blogs']=Blogs::where('category',$category->id)->orderBy('created_at','DESC')->paginate(1);


     return view('front.category',$data);

 }
 public function page($slug){
     $page=Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa Bulunamadı');
     $data['page']=$page;

     return view('front.page',$data);

 }
 public function contact(){

        return view('front.contact');
 }
 public function contactpost(Request $request){
      $rules=['name'=>'required||min:5',
          'email'=>'required|email',
          'topic'=>'required',
          'message'=>'required|min:10'
          ];


       $validate=Validator::make($request->post(),$rules);
       if($validate->fails()){

           return redirect()->route('contact')->withErrors($validate)->withInput();
       }
       $contact=new Contact;
        $contact->name=$request->name;
     $contact->email=$request->email;
     $contact->topic=$request->topic;
     $contact->message=$request->message;
     $contact->save();
     return redirect()->route('contact')->with('success','Mesajınız bize iletildi.Teşşekür ederiz!');
 }
}
