<?php

namespace Languagebook\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use Languagebook\Http\Requests;
use Languagebook\Http\Controllers\Controller;
use Languagebook\Language as Language;
use Languagebook\Family as Family;
use Illuminate\Support\Facades\Auth as Auth;

class LanguagesController extends Controller
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
			$languages = Language::all('language_id','language_name','language_description','language_family_id','language_speakers');
			return view('languages.index')->with('languages', $languages)->with('username', $username);	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$username = $this->username();
		$language = new Language();
		$families = Family::lists('family_name','family_id');
		return view('languages.create')->with('language',$language)->with('families',$families)->with('username', $username);
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
	        	'language_speakers'        => 'required|numeric',                        
	        	'language_name'            => 'required'      
	    		);

	    $validator = Validator::make($request->all(), $rules);
	    if ($validator->fails()) {
	        $messages = $validator->messages();
	        return redirect('languages/create')->with('username', $username)->withErrors($validator->errors());
	    } else
    {
		$language = Language::create($request->all());
		return redirect('languages/'.$language->language_id)->with('username', $username)->withSuccess('Language has been created.');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language_id)
    {
		$username = $this->username();
  		$language = Language::find($language_id);
		if ($language->language_family_id > 0)  {
			$family = Family::find($language->language_family_id);
			$family_name = $family->family_name;
			}
		else {
			$family_name = " ";
			}
		return view('languages.show') ->with('language', $language)->with('username', $username)->with('family_name', $family_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language_id)
    {
		$username = $this->username();
  		$language = Language::find($language_id);
		$families = Family::lists('family_name','family_id');
		return view('languages.edit') ->with('language', $language)->with('username', $username)->with('families', $families);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $language_id)
    {
		$username = $this->username();
     	$language = Language::find($language_id);
	    $language->language_name       = $request->input('language_name');
	    $language->language_description = $request->input('language_description');
	    $language->language_family_id = $request->input('language_family_id');
		$language->language_speakers = $request->input('language_speakers');
		$language->save();
		return redirect('languages/'.$language->language_id)->with('username', $username)->withSuccess('Language has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($language_id)
    {
	   $username = $this->username();
       $language = Language::find($language_id);
	   $goneName = $language->language_name;
	   $language->delete();
	   $languages = Language::all('language_id','language_name','language_description','language_family_id');
	   return view('languages.index')->with('languages', $languages)->with('username', $username)->withSuccess('Language ' . $goneName . ' has been deleted.');		
    }
}
