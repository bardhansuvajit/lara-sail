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
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            // SVG Icon Fields
            $table->text('thumbnail_icon')->nullable();

            // Additional Metadata
            $table->text('description')->nullable();

            // SEO & Display
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Tags as JSON for flexibility
            $table->json('tags')->nullable();

            // Statistics
            $table->integer('question_papers_count')->default(0);
            $table->integer('subjects_count')->default(0);

            // Timestamps
            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1 active, 0 inactive');
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index(['status', 'position']);
        });

        $classes = [
            [
                'name' => '9',
                'slug' => 'class-9',
                'position' => 1,
                'status' => 1,
                'thumbnail_icon' => $this->getClass9Svg(),
                'description' => 'Class 9 - West Bengal Board of Secondary Education (WBBSE). Build strong foundation for Madhyamik examination.',
                'meta_title' => 'Class 9 Question Papers - WBBSE | West Bengal Board',
                'meta_description' => 'Access Class 9 question papers, study materials, and previous year papers for West Bengal Board (WBBSE). All subjects covered.',
                'tags' => json_encode(['wbbse', 'secondary_education', 'madhyamik_preparation', 'foundation', 'class_9']),
                'question_papers_count' => 0,
                'subjects_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '10',
                'slug' => 'class-10',
                'position' => 2,
                'status' => 1,
                'thumbnail_icon' => $this->getClass10Svg(),
                'description' => 'Class 10 - Madhyamik Preparation, West Bengal Board of Secondary Education (WBBSE). Board examination focused materials.',
                'meta_title' => 'Class 10 Madhyamik Question Papers - WBBSE Board',
                'meta_description' => 'Class 10 Madhyamik question papers, sample papers, and previous year papers for West Bengal Board (WBBSE) examination.',
                'tags' => json_encode(['wbbse', 'madhyamik', 'board_exam', 'secondary', 'class_10', 'final_exam']),
                'question_papers_count' => 0,
                'subjects_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '11',
                'slug' => 'class-11',
                'position' => 3,
                'status' => 1,
                'thumbnail_icon' => $this->getClass11Svg(),
                'description' => 'Class 11 - West Bengal Council of Higher Secondary Education (WBCHSE). Choose from Science, Commerce, and Arts streams.',
                'meta_title' => 'Class 11 Question Papers - WBCHSE | Higher Secondary',
                'meta_description' => 'Class 11 question papers for WBCHSE board. Science, Commerce, and Arts stream materials with term-wise question papers.',
                'tags' => json_encode(['wbchse', 'higher_secondary', 'science', 'commerce', 'arts', 'class_11', 'stream_selection']),
                'question_papers_count' => 0,
                'subjects_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '12',
                'slug' => 'class-12',
                'position' => 4,
                'status' => 1,
                'thumbnail_icon' => $this->getClass12Svg(),
                'description' => 'Class 12 - Higher Secondary Examination, West Bengal Council of Higher Secondary Education (WBCHSE). Final year preparation.',
                'meta_title' => 'Class 12 HS Question Papers - WBCHSE Board Exam',
                'meta_description' => 'Class 12 Higher Secondary question papers, board exam papers, and previous year papers for WBCHSE examination.',
                'tags' => json_encode(['wbchse', 'higher_secondary', 'hs_exam', 'board_exam', 'science', 'commerce', 'arts', 'class_12', 'final_year']),
                'question_papers_count' => 0,
                'subjects_count' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('school_classes')->insert($classes);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }

    private function getClass9Svg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
  <!-- I -->
  <path d="M55 55 L50 60 L50 140 L55 145 L60 140 L60 60 Z" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
  <!-- X -->
  <path d="M120 65 L165 135 M165 65 L120 135" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
  <!-- top and bottom bars -->
  <path d="M25 30 Q100 25 175 30" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
  <path d="M25 170 Q100 175 175 170" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
</svg>';
    }

    private function getClass10Svg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
  <!-- X -->
  <path d="M60 65 L140 135 M140 65 L60 135" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
  <!-- top and bottom bars -->
  <path d="M25 30 Q100 25 175 30" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
  <path d="M25 170 Q100 175 175 170" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
</svg>';
    }

    private function getClass11Svg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
  <!-- X -->
  <path d="M40 65 L95 135 M95 65 L40 135" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
  <!-- I -->
  <path d="M135 60 L130 65 L130 135 L135 140 L140 135 L140 65 Z" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
  <!-- top and bottom bars -->
  <path d="M25 30 Q100 25 175 30" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
  <path d="M25 170 Q100 175 175 170" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
</svg>';
    }

    private function getClass12Svg()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
  <!-- X -->
  <path d="M25 65 L80 135 M80 65 L25 135" fill="none" stroke="currentColor" stroke-width="10" stroke-linecap="round" stroke-linejoin="round"/>
  <!-- II -->
  <path d="M110 60 L105 65 L105 135 L110 140 L115 135 L115 65 Z" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M140 60 L135 65 L135 135 L140 140 L145 135 L145 65 Z" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
  <!-- top and bottom bars -->
  <path d="M25 30 Q100 25 175 30" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
  <path d="M25 170 Q100 175 175 170" fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round"/>
</svg>';
    }
};
