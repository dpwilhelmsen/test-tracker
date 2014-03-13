<?php
class TestSession extends BaseModel
{
	protected $table = 'test_sessions';
	private $_lastSessionId;
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	public function project()
	{
		return $this->belongsTo('Project');
	}
	
	public function tests()
	{
		return $this->hasMany('ScheduledTest', 'session_id');
	}
	
	public function getLastSessionId()
	{
		if($this->_lastSessionId) return $this->_lastSessionId;
		
		return $this->_lastSessionId = 
			DB::select('select id from test_sessions ORDER BY DESC LIMIT ?', array(1));
	}
	
	public function organization()
	{
		return $this->belongsTo('Organization');
	}
}