<?php
class Type extends BaseModel 
{
	public function tests()
	{
		return $this->has_many_and_belongs_to('Test');
	}
}