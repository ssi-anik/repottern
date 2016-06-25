<?php namespace Anik\Repottern;

class Grammar
{
	protected $methods;

	public function __construct ()
	{
		$this->methods = [
			"with",
			"where",
			"take",
			"offset",
			"limit",
		];
	}

	public function getMethods ()
	{
		return $this->methods;
	}
}