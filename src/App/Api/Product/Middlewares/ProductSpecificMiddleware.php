<?php

namespace App\Api\Product\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductSpecificMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  Closure(Request): (Response)  $next
	 */
	public function handle(Request $request, Closure $next): Response
	{
		// TODO: Handle Product Specific Logic Here
		
		return $next($request);
	}
}