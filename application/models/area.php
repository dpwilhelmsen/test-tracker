<?php
class Area extends BaseModel
{
	public function test()
	{
		return $this->has_many('Test');
	}
}