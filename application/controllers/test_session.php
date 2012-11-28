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
		$sessions_with_data = array();
		foreach ($sessions as $key=>$session) 
		{
			$sessions_with_data[$key]['session'] = $session;
			$sessions_with_data[$key]['user'] = $session->user()->first();
			//$session_with_data[$key]['tests'] = $session->tests();
		}
		return View::make('session.all')
			->with('sessions', $sessions_with_data);
	}

}