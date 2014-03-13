<?php

class ProjectController extends \BaseController {

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
		
		$projects = Project::where('organization_id', 
						Input::get('organization'))->get();
		
		return Response::json(array(
				'error' => false,
				'projects' => $projects->toArray()),
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
		
		$project = new Project();
		$project->title = Input::get('title');
		$project->description = Input::get('description', '');
		
		$organization = Organization::find(Request::get('organization'));
		if(!is_a($organization, 'Organization')
				or !Auth::user()->hasAccess($organization->id))
			return Helpers::errorResponse('You do not have access!');

		$project->organization()->associate($organization);
		$project->active = 1;
		if(!$project->save())
			return Helpers::errorResponse($project->errors
						->all('<p>:message</p>'));
		
		
		return Response::json(array(
				'error' => false,
				'project' => $project->toArray()),
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
		$project = Project::find($id);
		if(!is_a($project, 'Project'))
			return Helpers::errorResponse('Project Not Found');
		if(!Auth::user()->hasAccess($project->organization->id))
			return Helpers::errorResponse('You do not have access to that project.');
		return Response::json(array(
				'error' => false,
				'project' => $project->toArray()),
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
		$project = Project::find($id);
		if(!$project)
			return Helpers::errorResponse('Project not found');
		if(!Auth::user()->hasAccess($project->organization->id))
			return Helpers::errorResponse('You do not have acces to that project');
		
		$project->title = Input::get('title');
		$project->description = Input::get('description', '');
		$project->active = Input::get('active', '1');
		
		if(!$project->save())
			return Helpers::errorResponse($project->errors
					->all('<p>:message</p>'));
		
		return Response::json(array(
				'error' => false,
				'message' => 'Project updated'),
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
		$project = Project::find($id);
		if(!$project)
			return Helpers::errorResponse('Project not found');
		if(!Auth::user()->hasAccess($project->organization->id))
			return Helpers::errorResponse('You do not have acces to that project');

		$project->delete();
		
		return Response::json(array(
					'error' => false,
					'message' => 'Project Deleted'),
					200);
	}

}