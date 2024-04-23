<?php

use Support\TableName;
use Support\Traits\WhoWhen;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	use WhoWhen;
	
    public function up(): void
    {
        Schema::create(TableName::category, function (Blueprint $table) {
            $table->id();
			
			$table->string("title");
			
            $this->whoWhenSoftDelete($table);
        });
    }
	
    public function down(): void
    {
        Schema::dropIfExists(TableName::category);
    }
};
