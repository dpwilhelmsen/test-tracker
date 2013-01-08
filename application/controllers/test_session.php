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
		return View::make('session.view')
			->with('scheduled_tests', $scheduled_tests);
	}
	
	protected function createSession()
	{
		
	}
	
	protected function addTests()
	{
		
	}
}