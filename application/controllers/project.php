<?php

use Laravel\URL;

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
		$sessions = Underscore::group($project->sessions()->get(), function($session){
			return (bool) $session->active;
		});
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
		$input = Input::all();
		if( isset($input['description']) ) {
			$input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}
		$rules = array(
				'title' => 'required',
		);
		$validation = Validator::make($input, $rules);
		if( $validation->fails() ) {
			return Redirect::to('dashboard')->with_errors($validation);
		}
		$project = new Project();
		$project->title = $input['title'];
		$project->description = $input['description'];
		$project->active = 1;
		$project->save();
		return Redirect::to('dashboard');
	}
	
	public function action_new()
	{
		$form = '';
		$form .= Form::horizontal_open(URL::to('project/add'));
		$form .= Form::control_group(Form::label('title', 'Title'),
				Form::xlarge_text('title'), '');
		$form .= Form::control_group(Form::label('description', 'Description'),
				Form::xlarge_textarea('description', '', array('rows' => '3')));
		$form .= Form::actions(array(Button::primary_submit('Save', array('id'=>'new-project-btn')), Form::button('Cancel')));
		$form .= Form::close();
		return View::make('project.new')->with('form', $form);
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
	
	public function action_all()
	{
		$projects = Project::all();
		$projects_sorted['active'] = Underscore::filter($projects, function($project){
			return (int) $project->active === 1;
		});
		$projects_sorted['completed'] = Underscore::filter($projects, function($project){
			return (int) $project->active === 0;
		});
		return View::make('project.all')->with('projects', $projects_sorted);
	}
}