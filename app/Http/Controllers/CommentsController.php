<?php

namespace Languagebook\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use Validator;

use Languagebook\Http\Requests;
use Languagebook\Http\Controllers\Controller;
use Languagebook\Post as Post;
use Languagebook\Blog as Blog;
use Languagebook\Comment as Comment;
use Illuminate\Support\Facades\Auth as Auth;


class CommentsController extends Controller
{
	/*  this function returns the signed-in user's name to display on the screen */
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
    public function index(Request $request)
    {
		/*  get the user name */
		$username = $this->username();

		$postSelector = $request->input('select_post_id') ; 
		/*   Use the selections to build the query string                                  */
		$querystring = 'select comment.*, post_name from comment, post where comment_post_id = post_id';
		if ($postSelector > "") {
			$querystring = $querystring . " and comment_post_id = " . $postSelector;
		}
		$comments = DB::select($querystring);
		
		return view('comments.index')->with('comments', $comments)->with('username', $username);	
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		/*  get the user name */
		$username = $this->username();
		$comment = new Comment();
		$posts = Post::lists('post_name','post_id');
		if (null !== $request->input('select_post_id')) {
			$postSelector = $request->input('select_post_id') ; 
		}
		else {
			$postSelector = '';
		}
		return view('comments.create')->with('comment',$comment)->with('posts',$posts)->with('postSelector', $postSelector)->with('username', $username);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
				{
				/*  get the user name */
				$username = $this->username();
					
					$rules = array(
						'comment_title'			  => 'required',
			        	'comment_text'            => 'required'      
			    		);

			    $validator = Validator::make($request->all(), $rules);
			    if ($validator->fails()) {
			        $messages = $validator->messages();
			        return redirect('comments/create')->withErrors($validator->errors());
			    } else
		    {
				$comment = Comment::create($request->all());
				$post_id = $request->input('comment_post_id');
				return redirect('posts/'.$post_id)->with('username', $username)->withSuccess('Comment has been created.');
		    }
		}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($comment_id)
    {
		/*  get the user name */
		$username = $this->username();
	
  		$comment = Comment::find($comment_id);
		if ($comment->comment_post_id > 0)  {
			$post = Post::find($comment->comment_post_id);
			$post_name = $post->post_name;
			}
		else {
			$post_name = " ";
			}
		return view('comments.show') ->with('comment', $comment)->with('post_name', $post_name)->with('username', $username);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($comment_id)
    {
		/*  get the user name */
		$username = $this->username();
		
  		$comment = Comment::find($comment_id);
		$posts = Post::lists('post_name','post_id');
		return view('comments.edit') ->with('comment', $comment)->with('posts', $posts)->with('username', $username);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment_id)
	    {
			/*  get the user name */
			$username = $this->username();
		
	     	$comment = Comment::find($comment_id);
		    $comment->comment_title       = $request->input('comment_title');
		    $comment->comment_text 		= $request->input('comment_text');
		    $comment->comment_post_id = $request->input('comment_post_id');
			$comment->comment_user_id = $request->input('comment_user_id');
			$comment->save();
			return redirect('comments/'.$comment->comment_id)->with('username', $username)->withSuccess('Comment has been updated.');
	    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment_id)
    {
		/*  get the user name */
	   $username = $this->username();
		
       $comment = Comment::find($comment_id);
	   $goneTitle = $comment->comment_title;
	   $comment->delete();
	   $comments = Comment::all();
	   return view('comments.index')->with('comments', $comments)->with('username', $username)->withSuccess('Comment ' . $goneTitle . ' has been deleted.');		
    }
}
