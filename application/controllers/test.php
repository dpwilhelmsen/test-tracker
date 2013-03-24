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
        	'section' => 'required', 
        	'conditions' => 'required', 
        	'steps' => 'required',
        );
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
			$type = Input::get('type');
			$test->conditions = Input::get('conditions');
			$test->steps = Input::get('steps');
			$test->status = 1;
			/*$test->assigned_id = Input::get('title');
			$test->author_id = Input::get('title');*/
			$test->save();
			$this->process_projects($test, Input::get('project_option'), Input::get('project'));
			$this->process_types($test, Input::get('type_option'), Input::get('type'));
			
       return Redirect::to('dashboard');
	}
	
	public function action_save()
	{
		$input = Input::all();
		if( isset($input['description']) ) {
			$input['description'] = filter_var($input['description'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}
		$rules = array(
				'name' => 'required',
				'description' => 'required',
				'section' => 'required',
				'conditions' => 'required',
				'steps' => 'required',
		);
		$validation = Validator::make($input, $rules);
		if( $validation->fails() ) {
			Input::flash();
			return Redirect::to('test/edit/3')->with_errors($validation);
		}
		$test = Test::find($input['id']);
		$test->name = Input::get('name');
		$test->description = Input::get('description');
		$test->status = Input::get('status');
		$section = Area::where('title', '=', Input::get('section'))->first() 
			?: new Area(array('title'=>Input::get('section')));
		$section->save();
		$type = Input::get('type');
		$test->conditions = Input::get('conditions');
		$test->steps = Input::get('steps');
		$test->status = 1;
		$test->area_id = $section->id;
		//TODO - Try to get this to work
		//$test->area()->insert($section);
		$test->save();		
		$this->process_projects($test, Input::get('project_option'), Input::get('project'));
		$this->process_types($test, Input::get('type_option'), Input::get('type'));
			
		return Redirect::to_action('test@view', array('id'=>$input['id']));
	}
	
	private function process_projects($test, $existing_projects=null, $new_projects=null)
	{
		if(empty($existing_projects) && empty($new_projects)) return;
		if(is_array($existing_projects)) 
			$test->projects()->sync($existing_projects);
		if(empty($new_projects)) return;
		$project = new Project(array('title'=>$new_projects, 'active'=>true));
		$project->save();
		$test->projects()->attach($project);
	}
	
	private function process_types($test, $existing_types=null, $new_types=null)
	{
		if(empty($existing_types) && empty($new_types)) return;
		if(is_array($existing_types))
				$test->types()->sync($type);
		if(empty($new_types)) return;
		$type = new Type(array('title'=>$new_types));
		$type->save();
		$test->types()->attach($type);
	}
	
	public function action_new()
	{
		return View::make('test.new');
	}
	
	public function action_view($id)
	{
		$test = Test::find($id);
		$types = $test->types()->get();
		$projects = $test->projects()->get();
		$tax_array = array('test_type'=>$types,'project'=>$projects,);
		return View::make('test.view')
			->with('test', $test)
			->with('taxonomy', $tax_array);
	}
	
	public function action_edit($id)
	{
		$test = Test::find($id);
		$types = $test->types()->get();
		$sections = $test->area;
		$projects = $test->projects()->get();
		$tax_array = array('test_type'=>$types,'section'=>$sections,'project'=>$projects,);
		return View::make('test.edit')
			->with('test', $test)
			->with('taxonomy', $tax_array)
			->with('ckeditor', new CKEditor());
	}
	
	public function action_all()
	{
		$tests = Test::all();
		return View::make('test.all')
			->with('tests', $tests)
			->with('ckeditor', new CKEditor());
	}

}