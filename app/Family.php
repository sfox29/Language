<?php namespace Languagebook;
use Illuminate\Database\Eloquent\Model;
class Family extends Model {
protected $primaryKey = 'family_id';
protected $table = 'family';
public $timestamps = false;
protected $fillable = array('family_id', 'family_name', 'family_description');
public $language_count;
public function languages() {
	return $this->hasMany('Languagebook\Language', 'language_family_id', 'family_id');
	}
public function language_count($count_key) {
	$language_count = 0;
	$languages = Language::all();
	foreach ($languages as $language) {
		if ($language->language_family_id == $count_key) {
			$language_count = $language_count + 1;
		}
	}
	return $language_count;
	}	
}
