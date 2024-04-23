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
        Schema::create(TableName::product, function (Blueprint $table) {
            $table->id();
			
			$table->string("title");
			$table->decimal("price", 12);
			
            $this->whoWhenSoftDelete($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(TableName::product);
    }
};
