<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
	protected $fillable = ['name'];
	
	public function coordinates()
	{
		return $this->hasMany(Coordinates::class);
	}
}