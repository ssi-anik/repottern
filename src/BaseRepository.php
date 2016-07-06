<?php namespace Anik\Repottern;

use Anik\Repottern\Contracts\RepositoryInterfaceContract;
use Anik\Repottern\Exceptions\InvalidMethodException;
use Anik\Repottern\Exceptions\InvalidModelException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

abstract class BaseRepository extends Grammar implements RepositoryInterfaceContract
{
	protected $model;
	protected $instance;
	protected $methods = [ ];

	/**
	 * Abstract method for getting the model name,
	 * that will bind the repository model to call the methods
	 * @return mixed
	 */
	abstract public function model ();

	/**
	 * BaseRepository constructor.
	 */
	public function __construct ()
	{

	}

	/**
	 * @param array ...$args
	 *
	 * @return mixed
	 */
	protected function all (...$args)
	{
		// add all to the methods
		$this->addToMethod("all", $args);

		// call the get method
		return $this->get();
	}

	/**
	 * @param array ...$args
	 *
	 * @return mixed
	 */
	protected function find (...$args)
	{
		// add find to the methods
		$this->addToMethod("find", $args);

		// call the get method
		return $this->get();
	}

	/**
	 * @param array ...$args
	 *
	 * @return mixed
	 */
	protected function paginate (...$args)
	{
		// add paginate to the methods
		$this->addToMethod("paginate", $args);

		// call the get method
		return $this->get();

	}

	/**
	 * @param array ...$args
	 *
	 * @return mixed
	 */
	protected function lists (...$args)
	{
		// add lists to the methods
		$this->addToMethod("lists", $args);

		// call the get method
		return $this->get();
	}

	/**
	 * @param array ...$args
	 *
	 * @return mixed
	 */
	protected function get (...$args)
	{
		$result = $this->fetchResult();
		if ( $result instanceof Builder || count($this->methods) === 0 ) {
			return $this->call_user_method($result, "get", $args);
		}

		return $result;
	}

	/**
	 * @param $method
	 * @param $arguments
	 *
	 * @return $this
	 */
	public function __call ($method, $arguments)
	{
		// check if the method exists or not
		if ( method_exists($this, $method) ) {

			return $this->call_user_method($this, $method, $arguments);
		} else {
			// save the method name and its arguments
			$this->addToMethod($method, $arguments);
		}

		return $this;
	}

	/**
	 * @param $method
	 * @param $args
	 *
	 * @return mixed
	 */
	public static function __callStatic ($method, $args)
	{
		$instance = new static;

		return $instance->call_user_method($instance, $method, $args);
	}

}