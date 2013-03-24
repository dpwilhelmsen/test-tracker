<?php
class BaseModel extends Eloquent
{
	public function __clone() 
	{
		$clone = new self($this->to_array());
		unset( $clone->id );
		$clone->exists = false;
		return $clone;
	}
}