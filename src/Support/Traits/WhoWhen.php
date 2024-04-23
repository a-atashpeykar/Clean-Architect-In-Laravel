<?php

namespace Support\Traits;

use Illuminate\Database\Schema\Blueprint;

trait WhoWhen
{
    public function whoWhenSoftDelete(Blueprint $table): void
    {
        $table->foreignId('created_by')
        ->references('id')
        ->on('users');

        $table->foreignId('updated_by')
	        ->nullable()
	        ->references('id')
	        ->on('users');

        $table->softDeletes();

        $table->timestamps();
    }
}
