<?php namespace Anik\Repottern;

use Anik\Repottern\Exceptions\InvalidModelException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Grammar
{
	protected $methods;

	/**
	 * Grammar constructor.
	 */
	public function __construct ()
	{

	}

	/**
	 * Build the model, check if is an instance of Illuminate\Database\Eloquent\Model or not
	 * @return mixed
	 * @throws \Anik\Repottern\Exceptions\InvalidModelException
	 */
	protected final function buildModel ()
	{
		$model = App::make($this->model());
		if ( !$model instanceof Model ) {
			throw new InvalidModelException();
		}

		return $model;
	}

	/**
	 * Adds to methods those are called
	 * to fetch data from model
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return $this
	 */
	protected function addToMethod ($name, $arguments)
	{
		$this->methods[] = [
			$name,
			$arguments,
		];

		return $this;
	}

	/**
	 * Fetches the result when all/lists/paginate/get method is called
	 * @return mixed
	 * @throws \Anik\Repottern\Exceptions\InvalidModelException
	 */
	protected function fetchResult ()
	{
		// build the model
		$model = $this->buildModel();
		// get the methods, those were called to fetch data
		foreach ( $this->methods as $method ) {
			// extract the method and arguments
			list( $name, $arguments ) = $method;
			// call the function
			$model = $this->call_user_method($model, $name, $arguments);
		}

		return $model;
	}

	/**
	 * @param $instance
	 * @param $method
	 * @param $args
	 *
	 * @return mixed
	 */
	protected function call_user_method ($instance, $method, $args)
	{
		switch ( count($args) ) {
			case 0:
				return $instance->$method();
			case 1:
				return $instance->$method($args[0]);
			case 2:
				return $instance->$method($args[0], $args[1]);
			case 3:
				return $instance->$method($args[0], $args[1], $args[2]);
			case 4:
				return $instance->$method($args[0], $args[1], $args[2], $args[3]);
			default:
				return call_user_func_array([
					$instance,
					$method,
				], $args);
		}
	}
}