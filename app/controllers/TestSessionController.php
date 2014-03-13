<?php

class TestSessionController extends \BaseController {

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
	
			$testSessions = TestSession::where('organization_id', 
							$organization->id)->get();
			
			return Response::json(array(
					'error' => false,
					'testSessions' => $testSessions->toArray()),
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
		$testSession = new TestSession();
		$testSession->title = Input::get('title', 
				'Test Session #'.$testSession->getLastSessionId());
		if(Input::get('project') 
				and is_a($project = Project::find(Input::get('project')), 'Project'))
			$testSession->project()->associate($project);

		$organization = Organization::find(Input::get('organization'));
		if(!is_a($organization, 'Organization')
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');

		$testSession->organization()->associate($organization);
		$testSession->active = 1;
		$testSession->user()->associate(Auth::user());
		if(!$testSession->save())
			return Helpers::errorResponse($testSession->errors
						->all('<p>:message</p>'));
		
		if(Input::get('tests'))
			foreach(json_decode(Input::get('tests')) as $test)
				$testSession->tests()->save(new ScheduledTest(array('test_id' => $test)));
		
		return Response::json(array(
				'error' => false,
				'testSession' => $testSession->toArray()),
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
		$testSession = TestSession::find($id);
		if(!is_a($testSession, 'TestSession'))
			return Helpers::errorResponse('Test Session Not Found');
		if(!Auth::user()->hasAccess($testSession->organization->id))
			return Helpers::errorResponse('You do not have access to that test session.');
		return Response::json(array(
				'error' => false,
				'testSession' => $testSession->toArray()),
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
		$testSession = TestSession::find($id);
		if(!is_a($testSession, 'TestSession'))
			return Helpers::errorResponse('Test Session Not Found');
		if(!Auth::user()->hasAccess($testSession->organization->id))
			return Helpers::errorResponse('You do not have access to that test session.');
		
		$testSession->title = Input::get('title', 
				'Test Session #'.$testSession->getLastSessionId());
		if(Input::get('project') 
				and is_a($project = Project::find(Input::get('project')), 'Project'))
			$testSession->project()->associate($project);

		$testSession->active = Input::get('active');

		if(!$testSession->save())
			return Helpers::errorResponse($testSession->errors
						->all('<p>:message</p>'));
		
		if(Input::get('tests'))
			foreach(json_decode(Input::get('tests')) as $test)
			$testSession->tests()->save(new ScheduledTest(array('test_id' => $test)));
		
		return Response::json(array(
				'error' => false,
				'message' => 'Test Session updated'),
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
		$testSession = TestSession::find($id);
		if(!$testSession)
			return Helpers::errorResponse('Test Session not found');
		if(!Auth::user()->hasAccess($testSession->organization->id))
			return Helpers::errorResponse('You do not have acces to that test session');

		$testSession->delete();
		
		return Response::json(array(
					'error' => false,
					'message' => 'Test Session Deleted'),
					200);
	}

}