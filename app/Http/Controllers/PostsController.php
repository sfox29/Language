<?php

namespace Languagebook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use Validator;

use Languagebook\Http\Requests;
use Languagebook\Http\Controllers\Controller;
use Languagebook\Post as Post;
use Languagebook\Blog as Blog;
use Illuminate\Support\Facades\Auth as Auth;

class PostsController extends Controller
{
	public function username()
	{
		$user = Auth::user();
		if (isset($user)) {
			$username = $user->username;
		}
		else {
			$username = '';
		}
		return $username;		
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$username = $this->username();
			$posts = Post::all('post_id','post_name','post_text','post_blog_id','post_topic')->sortByDesc('post_id');
			return view('posts.index')->with('posts', $posts)->with('username', $username);	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		$username = $this->username();
		$blog_id = $request->input('blog_id');
		$post = new Post();
		$blogs = Blog::lists('blog_name','blog_id');
		return view('posts.create')->with('post',$post)->with('blogs',$blogs)->with('username', $username)->with('blog_id', $blog_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
		{
			$username = $this->username();	
			$rules = array(
	        	'post_text'        	   => 'required',                        
	        	'post_name'            => 'required'      
	    		);

	    $validator = Validator::make($request->all(), $rules);
	    if ($validator->fails()) {
	        $messages = $validator->messages();
	        return redirect('posts/create')->with('username', $username)->withErrors($validator->errors());
	    } else
    {
		$post = Post::create($request->all());
		return redirect('posts/'.$post->post_id)->with('username', $username)->withSuccess('Post has been created.');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
		$username = $this->username();
  		$post = Post::find($post_id);
		if ($post->post_blog_id > 0)  {
			$blog = Blog::find($post->post_blog_id);
			$blog_name = $blog->blog_name;
			}
		else {
			$blog_name = " ";
			}
		$querystring = 'select comment.* from comment where comment_post_id = ' . $post_id;
		$comments = DB::select($querystring);
		if ($post->post_created_at > ' ') {
			$timestamp = strtotime($post->post_created_at);
			$created_at = date("F j, Y", $timestamp);
		}
		else
		{
			$created_at = '';
		}
			
		return view('posts.show') ->with('post', $post)->with('username', $username)->with('comments', $comments)->with('blog_name', $blog_name)->with('created_at', $created_at);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
		$username = $this->username();
  		$post = Post::find($post_id);
		$blogs = Blog::lists('blog_name','blog_id');
		return view('posts.edit') ->with('post', $post)->with('username', $username)->with('blogs', $blogs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {
		$username = $this->username();
     	$post = Post::find($post_id);
	    $post->post_name = $request->input('post_name');
	    $post->post_text = $request->input('post_text');
	    $post->post_blog_id = $request->input('post_blog_id');
		$post->post_topic = $request->input('post_topic');
		$post->post_user_id = $request->input('post_user_id');
		$post->save();
		return redirect('posts/'.$post->post_id)->with('username', $username)->withSuccess('Post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
	   $username = $this->username();
       $post = Post::find($post_id);
	   $goneName = $post->post_name;
	   $post->delete();
	   $posts = Post::all('post_id','post_name','post_text','post_blog_id', 'post_topic');
	   return view('posts.index')->with('posts', $posts)->with('username', $username)->withSuccess('Post ' . $goneName . ' has been deleted.');		
    }
}
