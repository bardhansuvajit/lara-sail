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
                'key' => 'company_domain',
                'value' => 'core-commerce',
                'description' => 'Default domain category for company setup',
            ],
            [
                'category' => 'stage1',
                'key' => 'domain_name',
                'value' => 'https://example.com',
                'description' => '',
            ],
            [
                'category' => 'stage1',
                'key' => 'company_name',
                'value' => 'Example company LLP',
                'description' => '',
            ],
            [
                'category' => 'stage1',
                'key' => 'company_establish_year',
                'value' => 2000,
                'description' => '',
            ],
            [
                'category' => 'stage2',
                'key' => 'country_code',
                'value' => 'IN',
                'description' => '',
            ],
            [
                'category' => 'stage3',
                'key' => 'support_contact',
                'value' => '9038775709',
                'description' => '',
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
