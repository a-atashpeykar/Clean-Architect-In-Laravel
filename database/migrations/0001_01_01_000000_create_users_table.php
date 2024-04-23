<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\TableName;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(TableName::user, function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->rememberToken();

            $table->foreignId('created_by')
                ->nullable()
                ->references('id')
                ->on('users');

            $table->foreignId('updated_by')
                ->nullable()
                ->references('id')
                ->on('users');

            $table->softDeletes();

            $table->timestamps();
        });

        Schema::create(TableName::passwordResetTokens, function (Blueprint $table) {
            $table->string('phone_number')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create(TableName::sessions, function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(TableName::user);
        Schema::dropIfExists(TableName::passwordResetTokens);
        Schema::dropIfExists(TableName::sessions);
    }
};
