<?php namespace Languagebook;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model {
protected $primaryKey = 'comment_id';
protected $table = 'comment';
public $timestamps = true;
const UPDATED_AT = 'comment_updated_at';
const CREATED_AT = 'comment_created_at';
protected $fillable = array('comment_id', 'comment_title', 'comment_text', 'comment_post_id', 'comment_user_id', 'comment_created_at', 'comment_updated_at');
public function post() {
	return $this->belongsTo('Languagebook\Post', 'post_id', 'comment_post_id');
	}
}