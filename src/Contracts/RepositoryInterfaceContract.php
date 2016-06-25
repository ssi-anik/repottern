<?php namespace Anik\Repottern\Contracts;

interface RepositoryInterfaceContract
{
	/*public function where();*/
	public function all();
	public function get();
	public function find();
	public function lists($value, $key = null);
}