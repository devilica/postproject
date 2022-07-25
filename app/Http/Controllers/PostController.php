<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function show(Post $post){

       // dd($id);

        return view('blog-post', [
            'post'=>$post
        ]);
    }

    public function create(){

        // dd($id);
 
         return view('admin.posts.create', [
             
         ]);
     }

     public function store(Request $request){

        $inputs=request()->validate([
            'title'=>'required|min:6',
           'post_image'=>'file',
            'body'=>'required'

        ]); 
        /*if(request('post_image')){
            $inputs['post_image']=request('post_image')->store('images');
        }
*/
        $imageName = time().'.'.$request->post_image->extension();  
            
        $path = Storage::disk('s3')->put('devilica', $request->post_image);
        $path = Storage::disk('s3')->url($path);

        

        
        auth()->user()->posts()->create($inputs);
        return back()->with('message', 'Successfully created!');



     }



}
