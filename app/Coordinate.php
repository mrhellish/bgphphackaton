<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
	protected $table = 'container_coordinates';
	protected $fillable = ['container_id', 'longitude', 'latitude'];

	public function container()
	{
		return $this->belongsTo(Container::class);
	}
}