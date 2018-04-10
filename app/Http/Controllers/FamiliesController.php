<?php
namespace Languagebook\Http\Controllers;

use Illuminate\Http\Request;
use Languagebook\Http\Requests;
use Languagebook\Http\Controllers\Controller;
use Languagebook\Family as Family;
use Languagebook\Language as Language;
use Illuminate\Support\Facades\Auth as Auth;

class FamiliesController extends Controller
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
		$families = Family::all('family_id','family_name','family_description'); 
		foreach ($families as $family) {
			$count = Family::find($family->family_id)->languages->count();
			$family->language_count = $count;
		}
		return view('families.index')->with('families', $families)->with('username', $username); 
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$username = $this->username();

		$family = new Family();
		return view('families.create')->with('family',$family)->with('username', $username);
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

		$family = Family::create($request->all());
		return redirect('families/'.$family->family_id)->with('username', $username)->withSuccess('Family has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($family_id)
    {	
		$username = $this->username();

		$family = Family::find($family_id);
		$languagex = Family::find($family_id)->languages;
		return view('families.show') ->with('family', $family)->with('languages', $languagex)->with('username', $username);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($family_id)
    {
		$username = $this->username();

  		$family = Family::find($family_id);
		return view('families.edit')->with('family', $family)->with('username', $username);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $family_id)
    {
		$username = $this->username();

     	$family = Family::find($family_id);
	    $family->family_name       = $request->input('family_name');
	    $family->family_description = $request->input('family_description');
		$family->save();
		return redirect('families/'.$family->family_id)->with('username', $username)->withSuccess('Family has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($family_id)
    {
	    {
		   $username = $this->username();
		
	       $family = Family::find($family_id);
		   $goneName = $family->family_name;
		   $family->delete();
		   $families = Family::all('family_id','family_name','family_description');
			return redirect('families')->with('username', $username)->withSuccess('Family ' . $goneName . ' has been deleted.');
	    }
    }
}
