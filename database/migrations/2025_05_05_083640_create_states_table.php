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
        Schema::create('states', function (Blueprint $table) {
            $table->id();

            $table->string('country_code', 2);

            $table->string('name');
            $table->string('code')->comment('State/Province code (e.g., CA for California)');
            $table->string('type')->nullable()->comment('e.g., State, Province, Territory etc.');

            $table->string('zone')->nullable()->comment('e.g., Southern, North-Eastern, Central etc.');
            $table->string('capital')->nullable();
            $table->string('population')->nullable()->comment('based on 2011');
            $table->string('area')->nullable()->comment('km square');
            $table->string('language')->nullable()->comment('comma separated');

            $table->boolean('shipping_availability')->default(1);
            $table->boolean('cash_on_delivery_availability')->default(0);

            $table->tinyInteger('status')->default(1)->comment('1:active, 0: inactive');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->unique(['country_code', 'name']);
            $table->unique(['country_code', 'code']);

            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
