<?php namespace Languagebook;
use Illuminate\Database\Eloquent\Model;
class Language extends Model {
protected $primaryKey = 'language_id';
protected $table = 'language';
public $timestamps = false;
protected $fillable = array('language_id', 'language_name', 'language_description', 'language_family_id', 'language_speakers', 'language_area');
public function family() {
	return $this->belongsTo('Languagebook\Family', 'family_id', 'language_family_id');
	}
public function item() {
	return $this->hasMany('Languagebook\Item', 'item_language_id', 'item_id');
	}	
}
