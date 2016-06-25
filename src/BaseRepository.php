<?php namespace Anik\Repottern;

use Anik\Repottern\Contracts\RepositoryInterfaceContract;
use Anik\Repottern\Exceptions\InvalidMethodException;
use Anik\Repottern\Exceptions\InvalidModelException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

abstract class BaseRepository extends Grammar implements RepositoryInterfaceContract
{
	protected $model;
	protected $instance;

	abstract public function model ();

	protected final function buildModel ()
	{
		$model = App::make($this->model());
		if ( !$model instanceof Model ) {
			throw new InvalidModelException();
		}
	}

	public function __construct ()
	{
		// build the model if it is an instance of Illuminate\Database\Eloquent\Model
		$this->buildModel();
	}

	public function all ()
	{
		return $this->get();
	}

	public function get ()
	{
		return 1;
	}

	public function find ()
	{
		return $this->get();
	}

	public function lists ($value, $key = null)
	{
		return $this->get();
	}

	public function __call ($name, $arguments)
	{
		// save the method name and its arguments
		return $this;
	}
}