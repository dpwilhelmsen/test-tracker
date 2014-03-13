<?php
class Helpers
{
	public static function errorResponse($message, $status = 200)
	{
		return Response::json(array(
				'error' => true,
				'message' => $message),
				$status
		);
	}
}