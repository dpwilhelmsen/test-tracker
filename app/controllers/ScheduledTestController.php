<?php

class ScheduledTestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Input::get('session'))
				return Helpers::errorResponse('No session set!');
			
		$testSession = TestSession::find(Input::get('session'));
			$organization = $testSession->organization;
			if(!is_a($organization, 'Organization') 
					or !Auth::user()->hasAccess($organization->id))
				return Helpers::errorResponse('You do not have access!');
			
			return Response::json(array(
					'error' => false,
					'testSessions' => $testSession->tests()->toArray()),
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
		$session = TestSession::find(Input::get('session'));
		if(!is_a($session, 'Session')
				or !Auth::user()->hasAccess($session->organization_id))
			return Helpers::errorResponse('You do not have access!');
		
		$scheduledTest = new ScheduledTest();
		$scheduledTest->test_id = Input::get('test');
		$scheduledTest->status = Input::get('status', 1);
		$scheduledTest->assigned_user = Input::get('assigned_user');
		
		if(!$scheduledTest->save())
			return Helpers::errorResponse($scheduledTest->errors
					->all('<p>:message</p>'));
		
		
		return Response::json(array(
				'error' => false,
				'test' => $scheduledTest->toArray()),
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
		$scheduledTest = ScheduledTest::find($id);
		if(!is_a($scheduledTest, 'Scheduled Test'))
			return Helpers::errorResponse('Scheduled Test Not Found');
		if(!Auth::user()->hasAccess($scheduledTest->session->organization->id))
			return Helpers::errorResponse('You do not have access to that.');
		return Response::json(array(
				'error' => false,
				'testSession' => $scheduledTest->toArray()),
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
		$scheduledTest = ScheduledTest::find($id);
		if(!is_a($scheduledTest, 'ScheduledTest'))
			return Helpers::errorResponse('Scheduled Test Not Found');
		$session = TestSession::find(Input::get('session'));
		if(!is_a($session, 'Session')
				or !Auth::user()->hasAccess($session->organization_id))
			return Helpers::errorResponse('You do not have access!');
		
		$scheduledTest->status = Input::get('status', 1);
		$scheduledTest->assigned_user = Input::get('assigned_user');
		$scheduledTest->completed_user = Input::get('completed_user');
		$scheduledTest->defects = Input::get('defects');
		
		if(!$scheduledTest->save())
			return Helpers::errorResponse($scheduledTest->errors
					->all('<p>:message</p>'));
		
		
		return Response::json(array(
				'error' => false,
				'message' => 'Scheduled Test Updated'),
				200
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$scheduledTest = ScheduledTest::find($id);
		if(!$scheduledTest)
			return Helpers::errorResponse('Scheduled Test not found');
		if(!Auth::user()->hasAccess($scheduledTest->organization->id))
			return Helpers::errorResponse('You do not have acces to that test');

		$scheduledTest->delete();
		
		return Response::json(array(
					'error' => false,
					'message' => 'Scheduled Test Deleted'),
					200);
	}

}