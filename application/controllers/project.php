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
		$button_group = ButtonGroup::open(null, array('class'=>'pull-right bottom-margin'));
		  $button_group .= Button::normal('Add Selected to Session', array('id'=>'selected_tests'));
		  $button_group .= Button::normal('Add All to Session', array('id'=>'all_tests')); 
		$button_group .= ButtonGroup::close();
		Asset::add('add-to-session', 'js/add_to_session.js');
		return View::make('project.view')
			->with('tests', $tests)
			->with('project', $project)
			->with('btn', $button_group)
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
		$session->title =  $project->title.' - '.date("m-d-Y H:i:s");
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