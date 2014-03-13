<?php

class TestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Input::get('organization'))
			return Helpers::errorResponse('No organization set!');
		
		$organization = Organization::find(Input::get('organization'));
		if(!is_a($organization, 'Organization') 
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');

		$tests = Test::where('organization_id', 
						$organization->id)->get();
		
		return Response::json(array(
				'error' => false,
				'tests' => $tests->toArray()),
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
		$test = new Test();
		$test->title = Input::get('title');
		$test->description = Input::get('description', '');
		$test->conditions = Input::get('conditions');
		$test->steps = Input::get('steps');
		$test->expected_results = Input::get('expected_results');
		$test->area = '';
		//$test->types = '';
		//$test->projects = '';
		
		$organization = Organization::find(Input::get('organization'));
		if(!is_a($organization, 'Organization')
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');

		$test->organization()->associate($organization);
		$test->status = 1;
		$test->user()->associate(Auth::user());
		if(!$test->save())
			return Helpers::errorResponse($test->errors
						->all('<p>:message</p>'));
		
		
		return Response::json(array(
				'error' => false,
				'test' => $test->toArray()),
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
		$test = Test::find($id);
		if(!is_a($test, 'Test'))
			return Helpers::errorResponse('Test Not Found');
		if(!Auth::user()->hasAccess($test->organization->id))
			return Helpers::errorResponse('You do not have access to that test.');
		return Response::json(array(
				'error' => false,
				'test' => $test->toArray()),
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
		$test = Test::find($id);
		if(!is_a($test, 'Test'))
			return Helpers::errorResponse('Test Not Found');
		if(!Auth::user()->hasAccess($test->organization->id))
			return Helpers::errorResponse('You do not have access to that test.');
		
		$test->title = Input::get('title');
		$test->description = Input::get('description', '');
		$test->conditions = Input::get('conditions');
		$test->expected_results = Input::get('expected_results');
		$test->steps = Input::get('steps');
		$test->status = 1;
		if(!$test->save())
			return Helpers::errorResponse($test->errors
						->all('<p>:message</p>'));
		
		return Response::json(array(
				'error' => false,
				'message' => 'Test updated'),
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
		$test = Test::find($id);
		if(!$test)
			return Helpers::errorResponse('Test not found');
		if(!Auth::user()->hasAccess($test->organization->id))
			return Helpers::errorResponse('You do not have acces to that test');

		$test->delete();
		
		return Response::json(array(
					'error' => false,
					'message' => 'Test Deleted'),
					200);
	}

}