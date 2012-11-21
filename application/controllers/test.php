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
			$test->test_type = Input::get('type');
			$test->status = Input::get('status');
			$test->section = Input::get('section');
			$test->project = Input::get('project');
			$test->conditions = Input::get('conditions');
			$test->steps = Input::get('steps');
			$test->status = 1;
			/*$test->assigned_id = Input::get('title');
			$test->author_id = Input::get('title');*/
			$test->save();
        return Redirect::to('dashboard');
	}
	public function action_new()
	{
		return View::make('test.new');
	}
	public function action_view($id)
	{
		
	}

}