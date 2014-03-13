<?php

class OrganizationController extends \BaseController {

	/**
	 * Display a listing of all of the user's organizations.
	 *
	 * @return Response
	 */
	public function index()
	{
		$organizations = Auth::user()->organizations()->get();
		
		return Response::json(array(
				'error' => false,
				'organizations' => $organizations->toArray()),
				200
		);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{		
		$organization = new Organization();
		$organization->title = Input::get('title');
		$organization->setSlug();
		
		if(!$organization->save())
			return Helpers::errorResponse($organization->errors
					->all('<p>:message</p>'));
		
		$organization->users()->save(Auth::user());
		
		return Response::json(array(
				'error' => false,
				'organization' => $organization->toArray()),
				200
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$organization = Auth::user()->organizations()->where('organization_id', $id)->first();
		
		return $organization 
			? Response::json(array(
					'error' => false,
					'organization' => $organization->toArray()),
					200)
			: Helpers::errorResponse('Organization not found or you are not a member of that organization.');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{		
		$organization =  Auth::user()->organizations()->where('organization_id', $id)->first();
		//$organization =  Auth::user()->organizations()->find($id);
		
		if ( Request::get('title') )
		{
			$organization->title = Input::get('title');
			$organization->setSlug();
		}
		
		if(!$organization->save())
			return Helpers::errorResponse($organization->errors
					->all('<p>:message</p>'));
		
		return Response::json(array(
				'error' => false,
				'message' => 'organization updated'),
				200
		);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$organization = Auth::user()->organizations()->where('organization_id', $id)->first();
		
		if(!$organization)
			return Helpers::errorResponse('Organization not found or you are not a member of that organization.');
		
		$organization->delete();
		
		return Response::json(array(
					'error' => false,
					'message' => 'Organization Deleted'),
					200);
	}

}