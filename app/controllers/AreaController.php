<?php

class AreaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (!Input::get('organization'))
			return Helpers::errorResponse('No organization set!');
		
		$organization = Organization::find(Input::get('organization'));
		if(!is_a($organization, 'Organization') 
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');
		
		$areas = Area::where('organization_id', 
						Input::get('organization'))->get();
		
		return Response::json(array(
				'error' => false,
				'areas' => $areas->toArray()),
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
		$area = new Area();
		$area->title = Input::get('title');
		$area->description = Input::get('description', '');
		
		$organization = Organization::find(Request::get('organization'));
		if(!is_a($organization, 'Organization')
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');

		$area->organization()->associate($organization);
		
		if(!$area->save())
			return Helpers::errorResponse($area->errors
						->all('<p>:message</p>'));
		
		
		return Response::json(array(
				'error' => false,
				'area' => $area->toArray()),
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
		if (!isset($id))
			return Helpers::errorResponse('No id set!');
		$area = Area::find($id);
		if(!is_a($area, 'Area'))
			return Helpers::errorResponse('Area Not Found');
		if(!Auth::user()->hasAccess($area->organization->id))
			return Helpers::errorResponse('You do not have access to that test area.');
		return Response::json(array(
					'error' => false,
					'area' => $area->toArray()),
					200
			);
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
		$area = Area::find($id);
		if(!$area)
			return Helpers::errorResponse('Test area not found');
		if(!Auth::user()->hasAccess($area->organization->id))
			return Helpers::errorResponse('You do not have acces to that area');
		
		$area->title = Input::get('title');
		$area->description = Input::get('description', '');
		
		if(!$area->save())
			return Helpers::errorResponse($area->errors
						->all('<p>:message</p>'));
		
		return Response::json(array(
				'error' => false,
				'message' => 'Area updated'),
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
		$area = Area::find($id);
		if(!$area)
			return Helpers::errorResponse('Test area not found');
		if(!Auth::user()->hasAccess($area->organization->id))
			return Helpers::errorResponse('You do not have acces to that area');

		$area->delete();
		
		return Response::json(array(
					'error' => false,
					'message' => 'Area Deleted'),
					200);
	}

}