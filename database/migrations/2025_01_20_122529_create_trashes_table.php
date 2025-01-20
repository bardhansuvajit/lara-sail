<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trashes', function (Blueprint $table) {
            $table->id();

            $table->string('model', 100);
            $table->string('table_name', 100);
            $table->bigInteger('deleted_row_id');
            $table->string('title');
            $table->text('description');
            $table->string('status', 20)->default('deleted')->comment('deleted, restored');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trashes');
    }
};
