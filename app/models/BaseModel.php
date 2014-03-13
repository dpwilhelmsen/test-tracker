<?php
class BaseModel extends Eloquent
{
	public $errors;
	public static $rules = array();
	public static $messages = array(
			'belongs_to_user_organization'
			=> 'The :attribute belongs to a different organization.');
	
	public static function boot()
	{
		parent::boot();
		static::saving(function($model){
			return $model->validate();
		});
	}
	
	public function validate()
	{
		$validation = Validator::make($this->attributes, static::$rules, static::$messages);
		if($validation->passes()) return true;
		
		$this->errors = $validation->messages();
		return false;
	}
}