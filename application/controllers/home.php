<?php

class Home_Controller extends Base_Controller {
	public function action_index()
	{
		$projects = Project::where_active(1)->order_by('created_at', 'desc')
			->take(10)->get();
		$sessions = Test_Session::where_active(1)->order_by('created_at', 'desc')
			->take(10)->get();
		return View::make('home')->with('projects', $projects)
			->with('sessions',$sessions);
	}

}