<?php

class Test_Controller extends Base_Controller {

	public function action_index()
	{
		//return View::make('home.index');
	}
	
	/**
	 * Processes the form to add new tests
	 */
	public function action_add()
	{
		$input = Input::all();
        if( isset($input['description']) ) {
            $input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        }
        $rules = array(
        	'title' => 'required',
        	'description' => 'required',
        	'type' => 'required', 
        	'section' => 'required', 
        	'project' => 'required',
        	'conditions' => 'required', 
        	'steps' => 'required',
        );
        /*
         * 
         */
        $validation = Validator::make($input, $rules);
        if( $validation->fails() ) {
            return Redirect::to('dashboard')->with_errors($validation);
        }
            $test = new Test();
			$test->name = Input::get('title');
			$test->description = Input::get('description');
			//$test->test_type = Input::get('type');
			$test->status = Input::get('status');
			//$test->section = Input::get('section');
			$project = Input::get('project');
			$test->conditions = Input::get('conditions');
			$test->steps = Input::get('steps');
			$test->status = 1;
			/*$test->assigned_id = Input::get('title');
			$test->author_id = Input::get('title');*/
			$test->save();
			if(!empty($project)) {
				$project = new Project(array('title'=>$project, 'active'=>true));
				$test->projects()->insert($project);
			}
			foreach (Input::get('project_option') as $project)
				$test->projects()->attach($project);
			
       return Redirect::to('dashboard');
	}
	
	public function action_new()
	{
		return View::make('test.new');
	}
	
	public function action_view($id)
	{
		$test = Test::find($id);
		$types = $test->types()->get();
		$sections = $test->sections()->get();
		$projects = $test->projects()->get();
		$tax_array = array('test_type'=>$types,'section'=>$sections,'project'=>$projects,);
		return View::make('test.view')
			->with('test', $test)
			->with('taxonomy', $tax_array);
	}
	
	public function action_all()
	{
		$tests = Test::all();
		return View::make('test.all')
			->with('tests', $tests);
	}

}