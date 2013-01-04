<?php
use Bootstrapper\Buttons;
use Bootstrapper\ButtonGroup;

class Project_Controller extends Base_Controller
{
	public function action_index()
	{
		
	}
	public function action_view($id)
	{
		$project = Project::find($id);
		$tests = $project->tests()->get();
		$button_group = ButtonGroup::open(null, array('class'=>'pull-right bottom-margin'));
		  $button_group .= Buttons::normal('Add Selected to Session', array('id'=>'selected_tests'));
		  $button_group .= Buttons::normal('Add All to Session', array('id'=>'all_tests')); 
		$button_group .= ButtonGroup::close();
		Asset::add('add-to-session', 'js/add_to_session.js');
		return View::make('project.view')
			->with('tests', $tests)
			->with('project', $project)
			->with('btn', $button_group)
			->with('base', URL::base());
	}
	public function action_add()
	{
		
	}
}