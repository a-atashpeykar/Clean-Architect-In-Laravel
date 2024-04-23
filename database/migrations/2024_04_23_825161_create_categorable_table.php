<?php

use Support\TableName;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(TableName::categorable, function (Blueprint $table) {
            $table->id();
			
			$table->morphs("categorable");
			
			$table->foreignId("category_id")
				->references("id")
				->on(TableName::category);
	        
	        $table->softDeletes();
	        
	        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(TableName::categorable);
    }
};
