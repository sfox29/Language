<?php
namespace Languagebook\Http\Controllers;

use Illuminate\Http\Request;
use Languagebook\Http\Requests;
use Languagebook\Http\Controllers\Controller;
use Languagebook\Blog as Blog;
use Languagebook\Post as Post;
use Illuminate\Support\Facades\Auth as Auth;

class BlogsController extends Controller
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
		$blogs = Blog::all('blog_id','blog_name','blog_description'); 
		foreach ($blogs as $blog) {
			$count = Blog::find($blog->blog_id)->posts->count();
			$blog->post_count = $count;
		}
		return view('blogs.index')->with('blogs', $blogs)->with('username', $username); 
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$username = $this->username();

		$blog = new Blog();
		return view('blogs.create')->with('blog',$blog)->with('username', $username);
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

		$blog = Blog::create($request->all());
		return redirect('blogs/'.$blog->blog_id)->with('username', $username)->withSuccess('Blog has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($blog_id)
    {	
		$username = $this->username();

		$blog = Blog::find($blog_id);
		$postx = Blog::find($blog_id)->posts->sortByDesc('post_id');
		return view('blogs.show') ->with('blog', $blog)->with('posts', $postx)->with('username', $username);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blog_id)
    {
		$username = $this->username();

  		$blog = Blog::find($blog_id);
		return view('blogs.edit')->with('blog', $blog)->with('username', $username);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blog_id)
    {
		$username = $this->username();

     	$blog = Blog::find($blog_id);
	    $blog->blog_name       = $request->input('blog_name');
	    $blog->blog_description = $request->input('blog_description');
		$blog->save();
		return redirect('blogs/'.$blog->blog_id)->with('username', $username)->withSuccess('Blog has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog_id)
    {
	    {
		   $username = $this->username();
		
	       $blog = Blog::find($blog_id);
		   $goneName = $blog->blog_name;
		   $blog->delete();
		   $blogs = Blog::all('blog_id','blog_name','blog_description');
			return redirect('blogs')->with('username', $username)->withSuccess('Blog ' . $goneName . ' has been deleted.');
	    }
    }
}
