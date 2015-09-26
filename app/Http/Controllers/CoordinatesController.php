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
			$q->orderBy('created_at', 'desc')->first();
		}])->where('name', $name)->first();

		$return = ['success' => false];

		if($container && $container->coordinates && $container->coordinates->count() > 0)
		{
			$return['success'] = true;
			$return['data'] = $container->coordinates->first()->toArray();
		}

		return $return;
	}

	public function create($name)
	{
		$request = app(Request::class);
		
		if( !$request->has('longitude') || !$request->has('latitude') )
			return ['success' => false, 'error' => 'No name longitude and/or latitude.'];

		$container = Container::where('name', $name)->first();

		if( !$container )
			return $this->respondError('Container does not exist.');

		$coordinates = Coordinate::create(
			array_merge(['container_id' => $container->id], $request->only(['longitude', 'latitude']))
		);

		return $this->respondSuccess($coordinates);
	}

	public function update($id, Request $request)
	{
		if( !$request->has('longitude') || !$request->has('latitude') )
			return $this->respondError('No name longitude and/or latitude.');

		$coordinates = Coordinate::find($id);

		if( !$coordinates )
			return $this->respondError('Coordinates do not exist.');

		return $this->respondSuccess($coordinates);
	}

	public function destroy($id)
	{
		$coordinate = Coordinate::find($id)->delete();

		if( !$coordinates )
			return $this->respondError('Coordinates do not exist.');

		return $this->respondSuccess();
	}
}