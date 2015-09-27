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

		if( !$container )
			return $this->respondError('Container does not exist.');

		return $container;
	}

	public function create(Request $request)
	{
		if( !$request->has('name') )
			return $this->respondError('No name provided.');

		$container = Container::create($request->only(['name']));

		if( !$container )
			return $this->respondError('Could not create a container.');

		$container->coordinates()->create($request->only(['longitude', 'latitude']));

		return $this->respondSuccess($container);
	}

	public function update($id, Request $request)
	{
		if( !$request->has('name') )
			return $this->respondError('No name provided.');

		$container = Container::find($id);

		if( !$container )
			return $this->respondError('Container does not exist.');

		return $this->respondSuccess($container->update(['name']));
	}

	public function destroy($id)
	{
		$container = Container::find($id)->delete();

		return ['success' => $container];
	}

}