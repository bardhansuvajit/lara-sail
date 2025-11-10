<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->nullable(); // School code

            // Icon Fields
            $table->text('thumbnail_icon')->nullable();
            $table->text('logo_path')->nullable();

            // Additional Metadata
            $table->text('description')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->string('type')->default('government'); // government, private, aided
            $table->string('level')->default('secondary'); // primary, secondary, higher_secondary

            // SEO & Display
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Tags as JSON for flexibility
            $table->json('tags')->nullable();

            // Statistics
            $table->integer('question_papers_count')->default(0);

            // Timestamps
            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1 active, 0 inactive');
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index(['status', 'position']);
            $table->index('district');
            $table->index('type');
        });

        $schools = [
            [
                'name' => 'Bankura Zilla School',
                'slug' => 'bankura-zilla-school',
                'code' => 'BZS',
                'position' => 1,
                'status' => 1,
                'thumbnail_icon' => $this->getSchoolSvg('#DC2626'),
                'description' => 'Bankura Zilla School, one of the oldest and most prestigious schools in Bankura district, West Bengal.',
                'district' => 'Bankura',
                'address' => 'Bankura, West Bengal',
                'type' => 'government',
                'level' => 'higher_secondary',
                'meta_title' => 'Bankura Zilla School Question Papers - WBBSE WBCHSE',
                'meta_description' => 'Question papers and study materials from Bankura Zilla School for WBBSE and WBCHSE boards.',
                'tags' => json_encode(['bankura', 'zilla_school', 'government', 'prestigious']),
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Midnapore Collegiate School',
                'slug' => 'midnapore-collegiate-school',
                'code' => 'MCS',
                'position' => 2,
                'status' => 1,
                'thumbnail_icon' => $this->getSchoolSvg('#7C3AED'),
                'description' => 'Midnapore Collegiate School, a renowned institution in West Medinipur district with excellent academic records.',
                'district' => 'West Medinipur',
                'address' => 'Midnapore, West Bengal',
                'type' => 'government',
                'level' => 'higher_secondary',
                'meta_title' => 'Midnapore Collegiate School Question Papers',
                'meta_description' => 'Question papers from Midnapore Collegiate School for secondary and higher secondary levels.',
                'tags' => json_encode(['midnapore', 'collegiate_school', 'government', 'renowned']),
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hooghly Collegiate School',
                'slug' => 'hooghly-collegiate-school',
                'code' => 'HCS',
                'position' => 3,
                'status' => 1,
                'thumbnail_icon' => $this->getSchoolSvg('#10B981'),
                'description' => 'Hooghly Collegiate School, established in 1836, is one of the oldest schools in Hooghly district.',
                'district' => 'Hooghly',
                'address' => 'Chinsurah, Hooghly, West Bengal',
                'type' => 'government',
                'level' => 'higher_secondary',
                'meta_title' => 'Hooghly Collegiate School Question Papers',
                'meta_description' => 'Question papers from Hooghly Collegiate School for WBBSE and WBCHSE examinations.',
                'tags' => json_encode(['hooghly', 'collegiate_school', 'historic', 'government']),
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'South Point High School',
                'slug' => 'south-point-high-school',
                'code' => 'SPHS',
                'position' => 4,
                'status' => 1,
                'thumbnail_icon' => $this->getSchoolSvg('#F59E0B'),
                'description' => 'South Point High School, a premier private school in Kolkata known for academic excellence.',
                'district' => 'Kolkata',
                'address' => 'Kolkata, West Bengal',
                'type' => 'private',
                'level' => 'higher_secondary',
                'meta_title' => 'South Point High School Question Papers',
                'meta_description' => 'Question papers from South Point High School for secondary and higher secondary levels.',
                'tags' => json_encode(['kolkata', 'south_point', 'private', 'premier']),
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('schools')->insert($schools);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }

    private function getSchoolSvg($color)
    {
        return '<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="20" y="25" width="40" height="30" rx="4" fill="'.$color.'" opacity="0.1"/>
            <rect x="25" y="30" width="30" height="20" rx="2" fill="'.$color.'" opacity="0.2"/>
            <rect x="30" y="25" width="20" height="25" rx="2" fill="'.$color.'" opacity="0.3"/>
            <rect x="35" y="20" width="10" height="5" rx="1" fill="'.$color.'"/>
            <circle cx="40" cy="40" r="3" fill="'.$color.'" opacity="0.7"/>
            <path d="M25 55L55 55" stroke="'.$color.'" stroke-width="2"/>
        </svg>';
    }
};