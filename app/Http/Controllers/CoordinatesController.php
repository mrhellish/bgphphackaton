<?php

namespace App\Http\Controllers;

use App\Coordinate;

class CoordinatesController extends Controller {

	public function index()
	{
		return Coordinate::all();
	}

	public function get($id)
	{
		$container = Coordinate::findOrFail($id);

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