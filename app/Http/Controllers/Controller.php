<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
	/**
	 * @param null $content
	 * @param int  $statusCode
	 *
	 * @return Response
	 */
	public function respondWith($content = null, $statusCode = Response::HTTP_OK)
	{
		return response($content, $statusCode);
	}

	public function respondSuccess($content = null)
	{
		$response = [
			'success' => true
		];

		if( !is_null($content) )
			$response['data'] = $content;

		return $this->respondWith($response, Response::HTTP_OK);
	}

	public function respondError($content = null)
	{
		$response = [
			'success' => false
		];

		if( !is_null($content) )
			$response['data'] = $content;

		return $this->respondWith($response, Response::HTTP_FORBIDDEN);
	}
}
