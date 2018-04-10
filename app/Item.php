<?php namespace Languagebook;
use Illuminate\Database\Eloquent\Model;
class Item extends Model {
protected $primaryKey = 'item_id';
protected $table = 'item';
public $timestamps = false;
protected $fillable = array('item_id', 'item_class', 'item_subclass', 'item_language_id', 'item_formclass', 
'item_lemma', 'item_tam', 'item_person', 'item_number', 'item_gender', 'item_nomcase', 'item_polarity', 'item_related_to', 'item_source', 'item_meaning', 'item_notes', 'item_etymology', 'item_type');
public function language() {
	return $this->belongsTo('Languagebook\Language', 'language_id', 'item_language_id');
	}
 public function scopeFilter($query, $params)
    {
        if ( isset($params['select_language_id']) && trim($params['select_language_id']) !== '' )
        {
            $query->where('item_language_id', 'LIKE', trim($params['select_language_id'] . '%'));
        }

        if ( isset($params['select_item_type']) && trim($params['select_item_type']) !== '' )
        {
            $query->where('item_type', '=', trim($params['select_item_type']));
        }

        if ( isset($params['select_item_class']) && trim($params['select_item_class']) !== '' )
        {
            $query->where('item_class', '=', trim($params['select_item_class']));
        }

        if ( isset($params['select_item_subclass']) && trim($params['select_item_subclass']) !== '' )
        {
            $query->where('item_subclass', '=', trim($params['select_item_subclass']));
        }

        if ( isset($params['select_item_formclass']) && trim($params['select_item_formclass']) !== '' )
        {
            $query->where('item_formclass', '=', trim($params['select_item_formclass']));
        }

        if ( isset($params['select_item_tam']) && trim($params['select_item_tam']) !== '' )
        {
            $query->where('item_tam', '=', trim($params['select_item_tam']));
        }
        return $query;
    }	
}
