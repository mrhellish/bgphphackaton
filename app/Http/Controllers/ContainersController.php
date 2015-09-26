<?php

namespace App\Http\Controllers;

use App\Container;

class ContainersController extends Controller {

	public function index()
	{
		return Container::all();
	}

	public function get($id)
	{
		$container = Container::findOrFail($id);

		return $container;
	}

	public function create()
	{

	}

	public function update($id)
	{

	}

	public function destroy($id)
	{

	}

}