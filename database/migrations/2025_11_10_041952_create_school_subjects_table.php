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
		Schema::create('school_subjects', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug')->unique();
			$table->string('code')->nullable(); // Subject code

			// SVG Icon Fields
			$table->text('thumbnail_icon')->nullable();
			$table->text('logo_path')->nullable();

			// Additional Metadata
			$table->text('description')->nullable();
			$table->string('category')->default('general'); // science, commerce, arts, language, general
			$table->boolean('is_core')->default(false);

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
			$table->index('category');
			$table->index('is_core');
		});

		$subjects = [
			// Science Subjects
			[
				'name' => 'Mathematics',
				'slug' => 'mathematics',
				'code' => 'MATH',
				'position' => 1,
				'thumbnail_icon' => $this->getMathSvg(),
				'description' => 'Mathematics subject covering algebra, geometry, trigonometry, and calculus for secondary and higher secondary levels.',
				'category' => 'science',
				'is_core' => true,
				'meta_title' => 'Mathematics Question Papers - WBBSE WBCHSE',
				'meta_description' => 'Mathematics question papers, solutions, and study materials for WBBSE and WBCHSE boards.',
				'tags' => json_encode(['mathematics', 'math', 'algebra', 'geometry', 'calculus', 'science']),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Physical Science',
				'slug' => 'physical-science',
				'code' => 'PHYSCI',
				'position' => 2,
				'thumbnail_icon' => $this->getPhysicalScienceSvg(),
				'description' => 'Physical Science covering Physics and Chemistry concepts for secondary education.',
				'category' => 'science',
				'is_core' => true,
				'meta_title' => 'Physical Science Question Papers - WBBSE',
				'meta_description' => 'Physical Science question papers and study materials for WBBSE Madhyamik examination.',
				'tags' => json_encode(['physical_science', 'physics', 'chemistry', 'science']),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Life Science',
				'slug' => 'life-science',
				'code' => 'LIFESCI',
				'position' => 3,
				'thumbnail_icon' => $this->getLifeScienceSvg(),
				'description' => 'Life Science covering Biology and Environmental studies.',
				'category' => 'science',
				'is_core' => true,
				'meta_title' => 'Life Science Question Papers - WBBSE WBCHSE',
				'meta_description' => 'Life Science and Biology question papers for secondary and higher secondary levels.',
				'tags' => json_encode(['life_science', 'biology', 'environment', 'science']),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Physics',
				'slug' => 'physics',
				'code' => 'PHY',
				'position' => 4,
				'thumbnail_icon' => $this->getPhysicsSvg(),
				'description' => 'Physics for higher secondary level covering mechanics, optics, electricity, and modern physics.',
				'category' => 'science',
				'is_core' => true,
				'meta_title' => 'Physics Question Papers - WBCHSE HS',
				'meta_description' => 'Physics question papers and study materials for WBCHSE Higher Secondary examination.',
				'tags' => json_encode(['physics', 'science', 'higher_secondary']),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Chemistry',
				'slug' => 'chemistry',
				'code' => 'CHEM',
				'position' => 5,
				'thumbnail_icon' => $this->getChemistrySvg(),
				'description' => 'Chemistry for higher secondary level covering organic, inorganic, and physical chemistry.',
				'category' => 'science',
				'is_core' => true,
				'meta_title' => 'Chemistry Question Papers - WBCHSE HS',
				'meta_description' => 'Chemistry question papers and study materials for WBCHSE Higher Secondary examination.',
				'tags' => json_encode(['chemistry', 'science', 'higher_secondary']),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Biology',
				'slug' => 'biology',
				'code' => 'BIO',
				'position' => 6,
				'thumbnail_icon' => $this->getBiologySvg(),
				'description' => 'Biology for higher secondary level covering botany, zoology, and human physiology.',
				'category' => 'science',
				'is_core' => true,
				'meta_title' => 'Biology Question Papers - WBCHSE HS',
				'meta_description' => 'Biology question papers and study materials for WBCHSE Higher Secondary examination.',
				'tags' => json_encode(['biology', 'science', 'higher_secondary']),
				'created_at' => now(),
				'updated_at' => now(),
			],

			// Arts & Humanities
			[
				'name' => 'History',
				'slug' => 'history',
				'code' => 'HIST',
				'position' => 7,
				'thumbnail_icon' => $this->getHistorySvg(),
				'description' => 'History covering ancient, medieval, and modern history of India and World.',
				'category' => 'arts',
				'is_core' => true,
				'meta_title' => 'History Question Papers - WBBSE WBCHSE',
				'meta_description' => 'History question papers and study materials for secondary and higher secondary levels.',
				'tags' => json_encode(['history', 'arts', 'humanities']),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Geography',
				'slug' => 'geography',
				'code' => 'GEOG',
				'position' => 8,
				'thumbnail_icon' => $this->getGeographySvg(),
				'description' => 'Geography covering physical geography, human geography, and Indian geography.',
				'category' => 'arts',
				'is_core' => true,
				'meta_title' => 'Geography Question Papers - WBBSE WBCHSE',
				'meta_description' => 'Geography question papers and study materials for secondary and higher secondary levels.',
				'tags' => json_encode(['geography', 'arts', 'humanities']),
				'created_at' => now(),
				'updated_at' => now(),
			],

			// Languages
			[
				'name' => 'English',
				'slug' => 'english',
				'code' => 'ENG',
				'position' => 9,
				'thumbnail_icon' => $this->getEnglishSvg(),
				'description' => 'English language and literature for secondary and higher secondary levels.',
				'category' => 'language',
				'is_core' => true,
				'meta_title' => 'English Question Papers - WBBSE WBCHSE',
				'meta_description' => 'English question papers, literature, and language study materials.',
				'tags' => json_encode(['english', 'language', 'literature']),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Bengali',
				'slug' => 'bengali',
				'code' => 'BENG',
				'position' => 10,
				'thumbnail_icon' => $this->getBengaliSvg(),
				'description' => 'Bengali language and literature for secondary and higher secondary levels.',
				'category' => 'language',
				'is_core' => true,
				'meta_title' => 'Bengali Question Papers - WBBSE WBCHSE',
				'meta_description' => 'Bengali question papers, literature, and language study materials.',
				'tags' => json_encode(['bengali', 'language', 'literature']),
				'created_at' => now(),
				'updated_at' => now(),
			],
		];

		DB::table('school_subjects')->insert($subjects);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('school_subjects');
	}

	private function getMathSvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 30" role="img" aria-label="Mathematics">
			<defs>
				<linearGradient id="mathGradient" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#1E88E5"/>
				<stop offset="100%" stop-color="#90CAF9"/>
				</linearGradient>
			</defs>
			<text x="50%" y="60%" dominant-baseline="middle" text-anchor="middle"
				font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
				font-size="40" font-weight="700" letter-spacing="1"
				fill="url(#mathGradient)">
				Maths
			</text>
		</svg>';
	}

	private function getPhysicalScienceSvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 40" role="img" aria-label="Phy. Science">
			<defs>
				<linearGradient id="phyScienceGradient" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#8E24AA"/>
				<stop offset="100%" stop-color="#CE93D8"/>
				</linearGradient>
			</defs>
			<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="40" font-weight="700" letter-spacing="1"
					fill="url(#phyScienceGradient)">
				Phy. Science
			</text>
		</svg>';
	}

	private function getLifeScienceSvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 40" role="img" aria-label="Life Science">
			<defs>
				<linearGradient id="lifeScienceGradient" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#2E7D32"/>
				<stop offset="100%" stop-color="#A5D6A7"/>
				</linearGradient>
			</defs>
			<text x="50%" y="60%" dominant-baseline="middle" text-anchor="middle"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="40" font-weight="700" letter-spacing="1"
					fill="url(#lifeScienceGradient)">
				Life Science
			</text>
		</svg>';
	}

	private function getPhysicsSvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 40" role="img" aria-label="Physics">
			<defs>
				<linearGradient id="physicsGradient" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#1565C0"/>
				<stop offset="100%" stop-color="#64B5F6"/>
				</linearGradient>
			</defs>
			<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="40" font-weight="700" letter-spacing="1"
					fill="url(#physicsGradient)">
				Physics
			</text>
		</svg>';
	}

	private function getChemistrySvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 40" role="img" aria-label="Chemistry">
			<defs>
				<linearGradient id="chemistryGradient" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#00897B"/>
				<stop offset="100%" stop-color="#80CBC4"/>
				</linearGradient>
			</defs>
			<text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="40" font-weight="700" letter-spacing="1"
					fill="url(#chemistryGradient)">
				Chemistry
			</text>
		</svg>';
	}

	private function getBiologySvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130 40" role="img" aria-label="Biology">
			<defs>
				<linearGradient id="bioGrad" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#2E7D32"/>
				<stop offset="100%" stop-color="#A5D6A7"/>
				</linearGradient>
			</defs>
			<text x="0" y="55%" dominant-baseline="middle" text-anchor="start"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="36" font-weight="700" letter-spacing="0.2"
					fill="url(#bioGrad)">
				Biology
			</text>
		</svg>';
	}

	private function getHistorySvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 125 35" role="img" aria-label="History">
			<defs>
				<linearGradient id="histGrad" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#EF6C00"/>
				<stop offset="100%" stop-color="#FFCC80"/>
				</linearGradient>
			</defs>
			<text x="0" y="50%" dominant-baseline="middle" text-anchor="start"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="36" font-weight="700" letter-spacing="0.2"
					fill="url(#histGrad)">
				History
			</text>
		</svg>';
	}

	private function getGeographySvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190 40" role="img" aria-label="Geography">
			<defs>
				<linearGradient id="geoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#00796B"/>
				<stop offset="100%" stop-color="#80CBC4"/>
				</linearGradient>
			</defs>
			<text x="2" y="45%" dominant-baseline="middle" text-anchor="start"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="36" font-weight="700" letter-spacing="0.2"
					fill="url(#geoGrad)">
				Geography
			</text>
		</svg>';
	}

	private function getEnglishSvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 125 40" role="img" aria-label="English">
			<defs>
				<linearGradient id="engGrad" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#3949AB"></stop>
				<stop offset="100%" stop-color="#9FA8DA"></stop>
				</linearGradient>
			</defs>
			<text x="0" y="50%" dominant-baseline="middle" text-anchor="start" font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif" font-size="36" font-weight="700" letter-spacing="0.2" fill="url(#engGrad)">
				English
			</text>
		</svg>';
	}

	private function getBengaliSvg()
	{
		return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130 35" role="img" aria-label="Bengali">
			<defs>
				<linearGradient id="benGrad" x1="0%" y1="0%" x2="100%" y2="100%">
				<stop offset="0%" stop-color="#B71C1C"/>
				<stop offset="100%" stop-color="#FF8A80"/>
				</linearGradient>
			</defs>
			<text x="0" y="50%" dominant-baseline="middle" text-anchor="start"
					font-family="Inter, Roboto, Helvetica Neue, Arial, sans-serif"
					font-size="36" font-weight="700" letter-spacing="0.2"
					fill="url(#benGrad)">
				Bengali
			</text>
		</svg>';
	}

};