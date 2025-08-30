<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    function list(){
        $bloglist = Blog::all();
        return view('admin.blogs.index',compact('bloglist'));
    }
    function createPage(){
        return view('admin.blogs.create');
    }
    function store(Request $request){
        $validate = $request->
        validate([
            'title' =>'required',
            'description' =>'required',
            ]);
        $validate['status'] = $request->status;
        $validate['message'] = $validate['description'];
        if ($request->hasFile('image')) {
              $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(20) . '.' . $extension;
            $destination = public_path('blog_images');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $validate['image'] = asset('blog_images/' . $filename);
        }
        if(isset($request->id)){
            $msg= "Blog Updated Successfully";
            Blog::where('id',$request->id)->update($validate);
        }else{
            Blog::create($validate);
            $msg = 'Blog created successfully';
        }
        return redirect()->back()->with('success',$msg);

    }
}
