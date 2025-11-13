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
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 40" role="img" aria-label="WBBSE">
            <defs>
                <linearGradient id="uniqueGradientId" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#1565C0" />
                <stop offset="100%" stop-color="#64B5F6" />
                </linearGradient>
            </defs>

            <text x="50%" y="55%" 
                    dominant-baseline="middle" 
                    text-anchor="middle"
                    font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
                    font-size="40" 
                    font-weight="700" 
                    letter-spacing="1" 
                    fill="url(#uniqueGradientId)">
                WBBSE
            </text>
        </svg>';
    }

    private function getWbchseSvg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 195 40" role="img" aria-label="WBCHSE">
            <defs>
                <linearGradient id="wbchseGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#8E24AA" />
                <stop offset="100%" stop-color="#F48FB1" />
                </linearGradient>
            </defs>

            <text x="50%" y="55%" 
                    dominant-baseline="middle" 
                    text-anchor="middle"
                    font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
                    font-size="40" 
                    font-weight="700" 
                    letter-spacing="1" 
                    fill="url(#wbchseGradient)">
                WBCHSE
            </text>
        </svg>';
    }

    private function getCbseSvg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 40" role="img" aria-label="CBSE">
            <defs>
                <linearGradient id="cbseGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#0288D1" />
                <stop offset="100%" stop-color="#4DD0E1" />
                </linearGradient>
            </defs>

            <text x="50%" y="55%" 
                    dominant-baseline="middle" 
                    text-anchor="middle"
                    font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
                    font-size="40" 
                    font-weight="700" 
                    letter-spacing="1" 
                    fill="url(#cbseGradient)">
                CBSE
            </text>
        </svg>';
    }

    private function getIcseSvg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 82 40" role="img" aria-label="ICSE">
            <defs>
                <linearGradient id="icseGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#F57C00" />
                <stop offset="100%" stop-color="#FFCA28" />
                </linearGradient>
            </defs>

            <text x="50%" y="55%" 
                    dominant-baseline="middle" 
                    text-anchor="middle"
                    font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
                    font-size="40" 
                    font-weight="700" 
                    letter-spacing="1" 
                    fill="url(#icseGradient)">
                ICSE
            </text>
        </svg>';
    }
};