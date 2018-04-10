<?php namespace Languagebook;
use Illuminate\Database\Eloquent\Model;
class Post extends Model {
protected $primaryKey = 'post_id';
protected $table = 'post';
public $timestamps = true;
const CREATED_AT = 'post_created_at';
const UPDATED_AT = 'post_updated_at';
protected $fillable = array('post_id', 'post_name', 'post_text', 'post_blog_id', 'post_topic', 'post_user_id', 'post_created_at', 'post_updated_at');
public function blog() {
	return $this->belongsTo('Languagebook\Post', 'blog_id', 'post_blog_id');
	}
public function comment() {
	return $this->hasMany('Languagebook\Comment', 'comment_post_id', 'post_id');
	}	
}
