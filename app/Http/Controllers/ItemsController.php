<?php

namespace Languagebook\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use Validator;

use Languagebook\Http\Requests;
use Languagebook\Http\Controllers\Controller;
use Languagebook\Language as Language;
use Languagebook\Family as Family;
use Languagebook\Item as Item;
use Illuminate\Support\Facades\Auth as Auth;


class ItemsController extends Controller
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
		/*  Pick up the selections that were made on the select boxes */
		$languageSelector = $request->input('select_language_id') ; 
		$typeSelector = $request->input('select_item_type') ;
		$classSelector = $request->input('select_item_class') ;  
		$subclassSelector = $request->input('select_item_subclass') ;  
		$formclassSelector = $request->input('select_item_formclass') ;  
		$tamSelector = $request->input('select_item_tam') ;  
		/*   Use the selections to build the query string                                  */
		$querystring = 'select item.*, language_name from item, language where item_language_id = language_id';
		if ($languageSelector > ' ') { $querystring = $querystring . ' and item_language_id = ' . $languageSelector;}
		if ($typeSelector > ' ') { $querystring = $querystring . ' and item_type = ' . $typeSelector;}
		if ($classSelector > ' ') { $querystring = $querystring . " and item_class = '" . $classSelector . "'";}
		if ($subclassSelector > ' ') { $querystring = $querystring . " and item_subclass = '" . $subclassSelector . "'";}
		if ($formclassSelector > ' ') { $querystring = $querystring . " and item_formclass = '" . $formclassSelector . "'";}
		if ($tamSelector > ' ') { $querystring = $querystring . " and item_tam = '" . $tamSelector . "'";}
		$items = DB::select($querystring);
	 
		$languages = Language::lists('language_name','language_id')->toArray();
		$types = array(1=>'Lexical Item',2=>'Pattern');	
		
		/* put the distinct classes in an array */
		$raw_classes = Item::select('item_class')->distinct()->get()->toArray() ;
		$classes = array();
		foreach ($raw_classes as $class_row) {
			foreach($class_row as $sub_row) {
				$classes[$sub_row] = $sub_row;
			}
		}
		/* put the distinct subclasses in an array */
		$raw_subclasses = Item::select('item_subclass')->distinct()->get()->toArray() ;
		$subclasses = array();
		foreach ($raw_subclasses as $subclass_row) {
			foreach($subclass_row as $subsub_row) {
				$subclasses[$subsub_row] = $subsub_row;
			}
		}
		/* put the distinct formclasses in an array */
		$raw_formclasses = Item::select('item_formclass')->distinct()->get()->toArray() ;
		$formclasses = array();
		foreach ($raw_formclasses as $formclass_row) {
			foreach($formclass_row as $subform_row) {
				$formclasses[$subform_row] = $subform_row;
			}
		}	
		/* put the distinct tams in an array */
		$raw_tams = Item::select('item_tam')->distinct()->get()->toArray() ;
		$tams = array();
		foreach ($raw_tams as $tam_row) {
			foreach($tam_row as $subtam_row) {
				$tams[$subtam_row] = $subtam_row;
			}
		}					
		return view('items.index')->with('items', $items)->with('languages',$languages)->with('types',$types)->with('classes',$classes)->with('subclasses',$subclasses)->with('formclasses',$formclasses)->with('tams',$tams)->with('setLanguage',$languageSelector)->with('setType',$typeSelector)->with('setClass',$classSelector)->with('setFormclass',$formclassSelector)->with('setSubclass',$subclassSelector)->with('setTam',$tamSelector)->with('username', $username);	
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		/*  get the user name */
		$username = $this->username();
		$item = new Item();
		$languages = Language::lists('language_name','language_id');
		$types = array(1=>'Lexical Item',2=>'Pattern');
		return view('items.create')->with('item',$item)->with('languages',$languages)->with('types',$types)->with('username', $username);
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
						'item_type'				=> 'required|numeric',
			        	'item_lemma'            => 'required'      
			    		);

			    $validator = Validator::make($request->all(), $rules);
			    if ($validator->fails()) {
			        $messages = $validator->messages();
			        return redirect('items/create')->withErrors($validator->errors());
			    } else
		    {
				$item = Item::create($request->all());
				return redirect('items/'.$item->item_id)->with('username', $username)->withSuccess('Item has been created.');
		    }
		}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($item_id)
    {
		/*  get the user name */
		$username = $this->username();
	
  		$item = Item::find($item_id);
		if ($item->item_language_id > 0)  {
			$language = Language::find($item->item_language_id);
			$language_name = $language->language_name;
			}
		else {
			$language_name = " ";
			}
		return view('items.show') ->with('item', $item)->with('language_name', $language_name)->with('username', $username);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($item_id)
    {
		/*  get the user name */
		$username = $this->username();
		
  		$item = Item::find($item_id);
		$languages = Language::lists('language_name','language_id');
		$types = array(1=>'Lexical Item', 2=>'Pattern');
		return view('items.edit') ->with('item', $item)->with('languages', $languages)->with('types', $types)->with('username', $username);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item_id)
	    {
			/*  get the user name */
			$username = $this->username();
		
	     	$item = Item::find($item_id);
		    $item->item_lemma       = $request->input('item_lemma');
		    $item->item_class 		= $request->input('item_class');
		    $item->item_subclass 	= $request->input('item_subclass');
		    $item->item_formclass 	= $request->input('item_formclass');
		    $item->item_tam 		= $request->input('item_tam');
		    $item->item_person 		= $request->input('item_person');
		    $item->item_number 		= $request->input('item_number');
		    $item->item_gender 		= $request->input('item_gender');
		    $item->item_nomcase 	= $request->input('item_nomcase');
		    $item->item_polarity 	= $request->input('item_polarity');
		    $item->item_source 		= $request->input('item_source');
		    $item->item_meaning 	= $request->input('item_meaning');
		    $item->item_notes 		= $request->input('item_notes');
		    $item->item_etymology 	= $request->input('item_etymology');
		    $item->item_language_id = $request->input('item_language_id');
		    $item->item_related_to = $request->input('item_related_to');
			$item->item_type 		= $request->input('item_type');
			$item->save();
			return redirect('items/'.$item->item_id)->with('username', $username)->withSuccess('Item has been updated.');
	    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($item_id)
    {
		/*  get the user name */
	   $username = $this->username();
		
       $item = Item::find($item_id);
	   $goneLemma = $item->item_lemma;
	   $item->delete();
	   $items = Item::all();
	   return view('items.index')->with('items', $items)->with('username', $username)->withSuccess('Item ' . $goneLemma . ' has been deleted.');		
    }
}
