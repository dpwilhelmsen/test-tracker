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
		var_dump($sessions_with_data);
		return View::make('session.all')
			->with('sessions', $sessions_with_data);
	}
	
	public function action_add()
	{
		$input = Input::all();
		var_dump($input);
	}
	
	protected function createSession()
	{
		
	}
	
	protected function addTests()
	{
		
	}
}