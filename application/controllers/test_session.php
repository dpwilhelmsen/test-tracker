<?php
class Test_Session_Controller extends Base_Controller 
{

	public function action_index()
	{
		echo 'hey';
	}
	
	public function action_all()
	{
		$sessions = Test_Session::all();
		$sessions_with_data = Underscore::group($sessions, function($session){
			return (bool) $session->active;
		});
		return View::make('session.all')
			->with('sessions', $sessions_with_data);
	}
	
	public function action_add()
	{
		$input = Input::all();
		var_dump($input);
	}
	
	public function action_view($id)
	{
		$session = Test_Session::find($id);
		$scheduled_tests = $session->tests()->get();
		$button_group = ButtonGroup::open(null, array('class'=>'pull-right bottom-margin'));
		$button_group .= Button::normal('Add Test', array('onclick'=>'$("#create_modal").modal({backdrop: "static"});'));
		$button_group .= ButtonGroup::close();
		return View::make('session.view')
			->with('scheduled_tests', $scheduled_tests)
			->with('session', $session)
			->with('buttons', $button_group)
			->with('ckeditor', new CKEditor())
			->with('project', $session->project()->first());
	}
	
	public function action_test($session_id, $test_id)
	{
		$session = Test_Session::find($session_id);
		$session_project = Project::find($session->project_id);
		$scheduled_tests = $session->tests()->get();
		foreach($scheduled_tests as $key => $test)
		 if($test->test_id === $test_id){
		 	$test_index = $key;
		 	continue;
		}
		$cur_test = null;
		$prev_test = null;
		$next_test = null;
		$cur_test = $scheduled_tests[$test_index];
		if(array_key_exists($test_index-1, $scheduled_tests))
			$prev_test = $scheduled_tests[$test_index-1];
		if(array_key_exists($test_index+1, $scheduled_tests))
			$next_test = $scheduled_tests[$test_index+1];
		$test = $cur_test->test()->first();
		$types = $test->types()->get();
		$projects = $test->projects()->get();
		$tax_array = array('test_type'=>$types,'project'=>$projects,);
		Asset::add('test-status', 'js/test_status.js');
		return View::make('session.test')
			->with('test', $test)
			->with('taxonomy', $tax_array)
			->with('session', $session)
			->with('prev', $prev_test)
			->with('next', $next_test)
			->with('scheduled_test', $cur_test)
			->with('base', URL::base())
			->with('session_project', $session_project);
	}
	
	public function action_resolve()
	{
		$test_id = Input::get('test');
		$status = Input::get('status');
		$scheduled_test = Scheduled_Test::find($test_id);
		switch($status){
			case 'pass':
				$scheduled_test->status = 1;
			break;
			case 'fail':
				$scheduled_test->status = -1;
			break;
			case 'skip':
				$scheduled_test->status = 0;
			break;
		}
		$scheduled_test = Auth::user()->completed_sechduled_tests()->insert($scheduled_test);
		if(!$scheduled_test->save())
			return Response::json(array('error'=>'Error Saving'));
		$session = Test_Session::find($scheduled_test->session_id);
		$tests = $session->tests()->get();
		if(Underscore::matches($tests, function($test){
			return $test->status !== 0;
		}))
			$session->active = 0;
		$session->save();
		return Response::json(array('success'=>'success'));
		
	}
	
	protected function createSession()
	{
		
	}
	
	protected function addTests()
	{
		
	}
}