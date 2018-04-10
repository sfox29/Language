<?php namespace Languagebook;
use Illuminate\Database\Eloquent\Model;
class Blog extends Model {
protected $primaryKey = 'blog_id';
protected $table = 'blog';
public $timestamps = false;
protected $fillable = array('blog_id', 'blog_name', 'blog_description');
public $post_count;
public function posts() {
	return $this->hasMany('Languagebook\Post', 'post_blog_id', 'blog_id');
	}
public function post_count($count_key) {
	$post_count = 0;
	$posts = Post::all();
	foreach ($posts as $post) {
		if ($post->post_blog_id == $count_key) {
			$post_count++;
		}
	}
	return $post_count;
	}	
}
