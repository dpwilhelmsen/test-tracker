<?php
use Underscore\Types\Arrays;

class Project_Controller extends Base_Controller
{
	public function action_index()
	{
		
	}
	public function action_view($id)
	{
		$project = Project::find($id);
		$tests = $project->tests()->get();
		$sessions = $project->sessions()->get();
		if($sessions)
			$sessions = Underscore::group($sessions, function($session){
				return (bool) $session->active;
			});
		$button_group = ButtonGroup::open(null, array('class'=>'pull-right bottom-margin'));
		  $button_group .= Button::normal('Session From Selected', array('id'=>'selected_tests'));
		  $button_group .= Button::normal('Add Test', array('onclick'=>'$("#create_modal").modal({backdrop: "static"});')); 
		$button_group .= ButtonGroup::close();
		$sections = Tabbable::tabs(
			Navigation::links(
				array(
					array(
						'Sessions',
						'<div id="session-container">'
							. View::make('session.session_table', 
									array('sessions'=>$sessions))
							.'</div>',
						true
					),
					array(
						'Tests',
						$button_group.View::make('test.test_table', array('tests'=>$tests))
							->with('ckeditor', new CKEditor()),
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
		$session->active = 1;
		$session->save();
		$tests = Arrays::each($test_ids, function($t){
			return array('test_id'=>$t, 'status'=>0);
		});
		$session->tests()->save($tests);
		$sessions = $project->sessions()->get();
		if($sessions)
			$sessions = Underscore::group($sessions, function($session){
			return (bool) $session->active;
		});
		return Response::json(array('status'=>'success',
				'markup'=>render('session.session_table', 
						array('sessions'=>$sessions))));
	}
	
	public function action_requeue_session()
	{
		$oldSession = Test_Session::find(Input::get('session'));
		$tests = Arrays::each($oldSession->tests()->get(), function($t){
			return array('test_id'=>$t->test_id, 'status'=>0);
		});
		$newSession = new Test_Session();
		$project = Project::find(Input::get('project'));
		$newSession->project_id = $project->id;
		$newSession->active = 1;
		$newSession->save();
		$newSession->tests()->save($tests);
		$sessions = $project->sessions()->get();
		if($sessions)
			$sessions = Underscore::group($sessions, function($session){
				return (bool) $session->active;
			});
		return View::make('session.session_table', array('sessions'=>$sessions));
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