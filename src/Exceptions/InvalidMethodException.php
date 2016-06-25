<?php namespace Anik\Repottern\Exceptions;

class InvalidMethodException extends \Exception
{
	public function __construct ($message = null)
	{
		if ( is_null($message) ) {
			$message = "Method is not available.";
		}
		parent::__construct($message);
	}
}