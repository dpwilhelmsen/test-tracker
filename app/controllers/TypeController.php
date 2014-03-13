<?php

class TypeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( !Input::get('organization'))
			return Helpers::errorResponse('No organization set!');
		
		$organization = Organization::find(Input::get('organization'));
		if(!is_a($organization, 'Organization') 
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');
		
		$types = Type::where('organization_id', 
						Input::get('organization'))->get();
		
		return Response::json(array(
				'error' => false,
				'types' => $types->toArray()),
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
		$type = new Type();
		$type->title = Input::get('title');
		$type->description = Input::get('description', '');
		
		$organization = Organization::find(Request::get('organization'));
		if(!is_a($organization, 'Organization')
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');

		$type->organization()->associate($organization);
		if(!$type->save())
			return Helpers::errorResponse($type->errors
						->all('<p>:message</p>'));
		
		
		return Response::json(array(
				'error' => false,
				'type' => $type->toArray()),
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
		$type = Type::find($id);
		if(!is_a($type, 'Type'))
			return Helpers::errorResponse('Type Not Found');
		if(!Auth::user()->hasAccess($type->organization->id))
			return Helpers::errorResponse('You do not have access to that test type.');
		return Response::json(array(
					'error' => false,
					'type' => $type->toArray()),
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
		$type = Type::find($id);
		if(!$type)
			return Helpers::errorResponse('Test Type not found');
		if(!Auth::user()->hasAccess($type->organization->id))
			return Helpers::errorResponse('You do not have acces to that type');
		
		$type->title = Input::get('title');
		$type->description = Input::get('description', '');
		
		if(!$type->save())
			return Helpers::errorResponse($type->errors
					->all('<p>:message</p>'));
		
		return Response::json(array(
				'error' => false,
				'message' => 'Type updated'),
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
		$type = Type::find($id);
		if(!$type)
			return Helpers::errorResponse('Test Type not found');
		if(!Auth::user()->hasAccess($type->organization->id))
			return Helpers::errorResponse('You do not have acces to that type');

		$type->delete();
		
		return Response::json(array(
					'error' => false,
					'message' => 'Type Deleted'),
					200);
	}

}