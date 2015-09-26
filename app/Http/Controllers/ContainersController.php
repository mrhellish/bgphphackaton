<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Container;

class ContainersController extends Controller {

	public function index()
	{
		return Container::all();
	}

	public function get($id)
	{
		$container = Container::find($id);

		return $container;
	}

	public function create(Request $request)
	{
		if( !$request->has('name') )
		{
			return ['success' => false, 'error' => 'No name provided.'];
		}

		return ['success' => true, 'data' => Container::create($request->only(['name']))];
	}

	public function update($id, Request $request)
	{
		if( !$request->has('name') )
		{
			return ['success' => false, 'error' => 'No name provided.'];
		}

		return ['success' => true, 'data' => Container::find($id)->update($request->only(['name']))];
	}

	public function destroy($id)
	{
		$container = Container::find($id)->delete();

		return ['success' => $container];
	}

}