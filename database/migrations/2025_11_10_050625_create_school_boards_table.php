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
        Schema::create('school_boards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->unique()->nullable(); // WBBSE, WBCHSE, etc.

            // SVG Icon Fields
            $table->text('thumbnail_icon')->nullable();

            // Additional Metadata
            $table->text('description')->nullable();
            $table->string('region')->default('West Bengal');
            $table->string('type')->default('State Board'); // State Board, National, etc.

            // SEO & Display
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Tags as JSON for flexibility
            $table->json('tags')->nullable();

            // Statistics
            $table->integer('schools_count')->default(0);
            $table->integer('question_papers_count')->default(0);

            // Timestamps
            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1 active, 0 inactive');
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index(['status', 'position']);
            $table->index('code');
        });

        $boards = [
            [
                'name' => 'West Bengal Board of Secondary Education',
                'slug' => 'wbbse',
                'code' => 'WBBSE',
                'position' => 1,
                'status' => 1,
                'thumbnail_icon' => $this->getWbbseSvg(),
                'description' => 'West Bengal Board of Secondary Education (WBBSE) - Responsible for conducting Madhyamik Pariksha (Class 10 examinations) in West Bengal.',
                'region' => 'West Bengal',
                'type' => 'State Board',
                'meta_title' => 'WBBSE Question Papers - Madhyamik Board West Bengal',
                'meta_description' => 'Access WBBSE question papers, Madhyamik previous year papers, and study materials for Class 9 and 10.',
                'tags' => json_encode(['wbbse', 'madhyamik', 'secondary_education', 'west_bengal', 'state_board']),
                'schools_count' => 0,
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'West Bengal Council of Higher Secondary Education',
                'slug' => 'wbchse',
                'code' => 'WBCHSE',
                'position' => 2,
                'status' => 1,
                'thumbnail_icon' => $this->getWbchseSvg(),
                'description' => 'West Bengal Council of Higher Secondary Education (WBCHSE) - Responsible for conducting Higher Secondary (Class 12) examinations in West Bengal.',
                'region' => 'West Bengal',
                'type' => 'State Board',
                'meta_title' => 'WBCHSE Question Papers - HS Board West Bengal',
                'meta_description' => 'Access WBCHSE question papers, Higher Secondary previous year papers, and study materials for Class 11 and 12.',
                'tags' => json_encode(['wbchse', 'higher_secondary', 'hs', 'west_bengal', 'state_board']),
                'schools_count' => 0,
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Central Board of Secondary Education',
                'slug' => 'cbse',
                'code' => 'CBSE',
                'position' => 3,
                'status' => 0,
                'thumbnail_icon' => $this->getCbseSvg(),
                'description' => 'Central Board of Secondary Education (CBSE) - National level board of education in India for public and private schools, controlled and managed by Union Government of India.',
                'region' => 'National',
                'type' => 'National Board',
                'meta_title' => 'CBSE Question Papers - Class 10 & 12 Board Papers',
                'meta_description' => 'Access CBSE question papers, previous year board papers, sample papers, and study materials for Class 1 to 12.',
                'tags' => json_encode(['cbse', 'central_board', 'national_board', 'all_india', 'class_10', 'class_12']),
                'schools_count' => 0,
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Council for the Indian School Certificate Examinations',
                'slug' => 'icse',
                'code' => 'ICSE',
                'position' => 4,
                'status' => 0,
                'thumbnail_icon' => $this->getIcseSvg(),
                'description' => 'Council for the Indian School Certificate Examinations (CISCE) - Conducts ICSE (Class 10) and ISC (Class 12) examinations for private schools in India.',
                'region' => 'National',
                'type' => 'National Board',
                'meta_title' => 'ICSE/ISC Question Papers - CISCE Board Papers',
                'meta_description' => 'Access ICSE Class 10 and ISC Class 12 question papers, previous year papers, and study materials from CISCE board.',
                'tags' => json_encode(['icse', 'isc', 'cisce', 'private_board', 'class_10', 'class_12', 'national_board']),
                'schools_count' => 0,
                'question_papers_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('school_boards')->insert($boards);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_boards');
    }

    private function getWbbseSvg()
    {
        return '<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="15" y="15" width="50" height="50" rx="8" fill="#DC2626" opacity="0.1"/>
            <rect x="20" y="20" width="40" height="40" rx="6" fill="#DC2626" opacity="0.2"/>
            <rect x="25" y="25" width="30" height="30" rx="4" fill="#DC2626"/>
            <text x="40" y="42" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="12" font-weight="bold">WBBSE</text>
            <text x="40" y="58" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="8">Madhyamik</text>
            <path d="M20 20L30 15M60 20L50 15" stroke="#DC2626" stroke-width="2" stroke-linecap="round"/>
        </svg>';
    }

    private function getWbchseSvg()
    {
        return '<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="15" y="15" width="50" height="50" rx="8" fill="#7C3AED" opacity="0.1"/>
            <rect x="20" y="20" width="40" height="40" rx="6" fill="#7C3AED" opacity="0.2"/>
            <rect x="25" y="25" width="30" height="30" rx="4" fill="#7C3AED"/>
            <text x="40" y="42" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="10" font-weight="bold">WBCHSE</text>
            <text x="40" y="58" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="8">HS Education</text>
            <path d="M25 20L30 25L35 20M55 20L50 25L45 20" stroke="#7C3AED" stroke-width="2" stroke-linecap="round"/>
        </svg>';
    }

    private function getCbseSvg()
    {
        return '<?xml version="1.0" encoding="utf-8"?>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
            <rect x="10" y="10" width="80" height="80" rx="5" ry="5" fill="#004684"/>
            <text x="50" y="45" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="14" font-weight="bold">CBSE</text>
            <text x="50" y="65" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="8">EDUCATION</text>
        </svg>';
    }

    private function getIcseSvg()
    {
        return '<?xml version="1.0" encoding="utf-8"?>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="40" fill="#8B0000"/>
            <text x="50" y="45" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="12" font-weight="bold">ICSE</text>
            <text x="50" y="65" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="8">ISC</text>
        </svg>';
    }
};