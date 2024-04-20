<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppServiceProvider extends ServiceProvider
{
	public function register(): void {}
	
	public function boot(): void
	{
		Factory::guessFactoryNamesUsing(function (string $modelName) {
			$namespace = 'Database\\Factories\\';
			$modelName = Str::afterLast($modelName, '\\');
			
			return $namespace . $modelName . 'Factory';
		});
	}
}
