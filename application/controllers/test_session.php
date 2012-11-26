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
		return View::make('session.all')
			->with('sessions', $sessions);
	}

}