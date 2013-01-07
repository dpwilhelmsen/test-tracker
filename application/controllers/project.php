<?php

use Laravel\Response;

use Laravel\Input;

class Project_Controller extends Base_Controller
{
	public function action_index()
	{
		
	}
	public function action_view($id)
	{
		$project = Project::find($id);
		$tests = $project->tests()->get();
		$sessions['active'] = $project->active_sessions()->get();
		$sessions['completed'] = $project->completed_sessions()->get();
		$button_group = ButtonGroup::open(null, array('class'=>'pull-right bottom-margin'));
		  $button_group .= Button::normal('Create New Session From Selected', array('id'=>'selected_tests'));
		  $button_group .= Button::normal('Add All to New Session', array('id'=>'all_tests')); 
		$button_group .= ButtonGroup::close();
		$sections = Tabbable::tabs(
			Navigation::links(
				array(
					array(
						'Sessions',
						View::make('session.session_table', array('sessions'=>$sessions)),
						true
					),
					array(
						'Tests',
						$button_group.View::make('test.test_table', array('tests'=>$tests)),
					),
				)
			)
		);
		Asset::add('add-to-session', 'js/add_to_session.js');
		return View::make('project.view')
			->with('project', $project)
			->with('sections', $sections)
			->with('base', URL::base());
	}
	public function action_add()
	{
		
	}
	
	public function action_create_session()
	{
		$test_ids = Input::get('tests');
		$project_id = Input::get('project');
		$session = new Test_Session();
		$project = Project::find($project_id);
		$session->project_id = $project->id;
		$session->status = 'active';
		$session->save();
		foreach($test_ids as $test_id) {
			$scheduled_test = new Scheduled_Test();
			$scheduled_test->session_id = $session->id;
			$scheduled_test->test_id = $test_id;
			$scheduled_test->save();
		}
		return Response::json(array('status'=>'success'));
	}
}