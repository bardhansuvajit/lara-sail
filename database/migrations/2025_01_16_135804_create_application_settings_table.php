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
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id();

            $table->string('category', 100);
            $table->string('key', 200)->unique();
            $table->longText('value');
            $table->text('description');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            [
                'category' => 'stage1',
                'key' => 'domain_name',
                'value' => 'www.example.com',
                'description' => '',
            ],
            [
                'category' => 'stage1',
                'key' => 'company_name',
                'value' => 'Example company LLP',
                'description' => '',
            ],
            [
                'category' => 'stage2',
                'key' => 'country_id',
                'value' => 82,
                'description' => 'application country id from countries table',
            ],
        ];

        DB::table('application_settings')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_settings');
    }
};
