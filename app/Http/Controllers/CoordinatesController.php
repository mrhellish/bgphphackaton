<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Container;
use App\Coordinate;

class CoordinatesController extends Controller {

	public function index()
	{
		return Coordinate::all();
	}

	public function getByContainer($name)
	{
		$container = Container::with(['coordinates' => function($q){
			$q->orderBy('created_at', 'desc')->first(['longitude', 'latitude']);
		}])->where('name', $name)->first();

		$return = ['success' => false];

		if(!!$container)
		{
			$return['success'] = true;
			$return['data'] = $container->coordinates;
		}

		return $return;
	}

	public function create($name, Request $request)
	{
		if( !$request->has('longitude') || !$request->has('latitude') )
		{
			return ['success' => false, 'error' => 'No name longitude and/or latitude.'];
		}

		$container = Container::where('name', $name)->first();

		if( !$container )
		{
			return ['success' => false, 'error' => 'Container does not exist']
		}

		return ['success' => true, 'data' => Coordinate::create(
			array_merge(['container_id' => $container->id], $request->only(['longitude', 'latitude']))
		)];
	}

	public function update($id, Request $request)
	{
		if( !$request->has('longitude') || !$request->has('latitude') )
		{
			return ['success' => false, 'error' => 'No name longitude and/or latitude.'];
		}

		return ['success' => true, 'data' => Coordinate::find($id)->update($request->only(['longitude', 'latitude']))];
	}

	public function destroy($id)
	{
		$coordinate = Coordinate::find($id)->delete();

		return ['success' => $coordinate];
	}
}