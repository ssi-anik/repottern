<?php namespace Anik\Repottern\Exceptions;

/**
 * Created by PhpStorm.
 * User: anik
 * Date: 6/25/16
 * Time: 9:29 PM
 */
class InvalidModelException extends \Exception
{
	public function __construct ($message = null)
	{
		if ( is_null($message) ) {
			$message = "Model must be an instance of Illuminate\\Database\\Eloquent\\Model.";
		}
		parent::__construct($message);
	}
}