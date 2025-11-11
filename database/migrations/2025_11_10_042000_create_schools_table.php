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
            $table->string('country_code')->nullable()->default('IN');

            // Icon Fields
            $table->text('logo_path')->nullable();

            // Additional Metadata
            $table->text('description')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable()->default('West Bengal');
            $table->string('pincode')->nullable();

            // School Type & Level
            $table->string('type')->default('government'); // government, private, aided
            $table->string('level')->default('secondary'); // primary, secondary, higher_secondary
            $table->string('board_affiliation')->nullable(); // WBBSE, WBCHSE, CBSE, ICSE, etc.

            // Contact Information
            $table->string('official_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->string('website')->nullable();
            $table->string('fax')->nullable();

            // Contact Person Details
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_designation')->nullable();
            $table->string('contact_person_mobile')->nullable();
            $table->string('contact_person_email')->nullable();

            // Academic Information
            $table->unsignedSmallInteger('established_year')->nullable();
            $table->string('principal_name')->nullable();
            
            // SEO & Display
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            // Tags as JSON for flexibility
            $table->json('tags')->nullable();

            // Statistics
            $table->integer('question_papers_count')->default(0);
            $table->integer('student_count')->nullable();
            $table->integer('teacher_count')->nullable();

            // Timestamps & Status
            $table->unsignedSmallInteger('position')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1 active, 0 inactive');
            $table->boolean('is_featured')->default(false);
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index(['status', 'position']);
            $table->index('district');
            $table->index('type');
            $table->index('level');
            $table->index('board_affiliation');
            $table->index('is_featured');
            $table->index('established_year');
        });

        $schools = [
            [
                'name' => 'Bankura Zilla School',
                'slug' => 'bankura-zilla-school',
                'code' => 'BZS',
                'position' => 1,
                'status' => 1,
                'description' => 'Bankura Zilla School, one of the oldest and most prestigious schools in Bankura district, West Bengal.',
                'district' => 'Bankura',
                'address' => 'Bankura, West Bengal',
                'city' => 'Bankura',
                'state' => 'West Bengal',
                'country_code' => 'IN',
                'pincode' => '722101',
                'type' => 'government',
                'level' => 'higher_secondary',
                'board_affiliation' => 'WBBSE, WBCHSE',
                'official_email' => 'bankurazillaschool@edu.in',
                'phone_number' => '+91-3242-XXXXXX',
                'website' => 'https://bankurazillaschool.edu.in',
                'contact_person_name' => 'Mr. Pinaki Banerjee',
                'contact_person_designation' => 'Principal',
                'contact_person_mobile' => '+91-9876543210',
                'established_year' => 1845,
                'principal_name' => 'Dr. S. K. Mukherjee',
                'meta_title' => 'Bankura Zilla School Question Papers - WBBSE WBCHSE',
                'meta_description' => 'Question papers and study materials from Bankura Zilla School for WBBSE and WBCHSE boards.',
                'tags' => json_encode(['bankura', 'zilla_school', 'government', 'prestigious', 'wbbse', 'wbchse']),
                'question_papers_count' => 0,
                'student_count' => 1200,
                'teacher_count' => 45,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Midnapore Collegiate School',
                'slug' => 'midnapore-collegiate-school',
                'code' => 'MCS',
                'position' => 2,
                'status' => 1,
                'description' => 'Midnapore Collegiate School, a renowned institution in West Medinipur district with excellent academic records.',
                'district' => 'West Medinipur',
                'address' => 'Midnapore, West Bengal',
                'city' => 'Midnapore',
                'state' => 'West Bengal',
                'country_code' => 'IN',
                'pincode' => '721101',
                'type' => 'government',
                'level' => 'higher_secondary',
                'board_affiliation' => 'WBBSE, WBCHSE',
                'official_email' => 'midnaporecollegiate@edu.in',
                'phone_number' => '+91-3222-XXXXXX',
                'website' => 'https://midnaporecollegiateschool.edu.in',
                'contact_person_name' => 'Dr. A. K. Sen',
                'contact_person_designation' => 'Principal',
                'contact_person_mobile' => '+91-9876543211',
                'established_year' => 1834,
                'principal_name' => 'Dr. A. K. Sen',
                'meta_title' => 'Midnapore Collegiate School Question Papers',
                'meta_description' => 'Question papers from Midnapore Collegiate School for secondary and higher secondary levels.',
                'tags' => json_encode(['midnapore', 'collegiate_school', 'government', 'renowned', 'wbbse', 'wbchse']),
                'question_papers_count' => 0,
                'student_count' => 1500,
                'teacher_count' => 52,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hooghly Collegiate School',
                'slug' => 'hooghly-collegiate-school',
                'code' => 'HCS',
                'position' => 3,
                'status' => 1,
                'description' => 'Hooghly Collegiate School, established in 1836, is one of the oldest schools in Hooghly district.',
                'district' => 'Hooghly',
                'address' => 'Chinsurah, Hooghly, West Bengal',
                'city' => 'Chinsurah',
                'state' => 'West Bengal',
                'country_code' => 'IN',
                'pincode' => '712101',
                'type' => 'government',
                'level' => 'higher_secondary',
                'board_affiliation' => 'WBBSE, WBCHSE',
                'official_email' => 'hooghlycollegiate@edu.in',
                'phone_number' => '+91-33-XXXXXX',
                'website' => 'https://hooghlycollegiateschool.edu.in',
                'contact_person_name' => 'Mr. Rajesh Kudrapalli',
                'contact_person_designation' => 'Principal',
                'contact_person_mobile' => '+91-9876543212',
                'established_year' => 1836,
                'principal_name' => 'Dr. P. K. Ghosh',
                'meta_title' => 'Hooghly Collegiate School Question Papers',
                'meta_description' => 'Question papers from Hooghly Collegiate School for WBBSE and WBCHSE examinations.',
                'tags' => json_encode(['hooghly', 'collegiate_school', 'historic', 'government', 'wbbse', 'wbchse']),
                'question_papers_count' => 0,
                'student_count' => 1100,
                'teacher_count' => 48,
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'South Point High School',
                'slug' => 'south-point-high-school',
                'code' => 'SPHS',
                'position' => 4,
                'status' => 1,
                'description' => 'South Point High School, a premier private school in Kolkata known for academic excellence.',
                'district' => 'Kolkata',
                'address' => 'Kolkata, West Bengal',
                'city' => 'Kolkata',
                'state' => 'West Bengal',
                'country_code' => 'IN',
                'pincode' => '700026',
                'type' => 'private',
                'level' => 'higher_secondary',
                'board_affiliation' => 'WBBSE, WBCHSE, ISC',
                'official_email' => 'info@southpoint.edu.in',
                'phone_number' => '+91-33-XXXXXX',
                'website' => 'https://southpoint.edu.in',
                'contact_person_name' => 'Mr. PK Sarkar',
                'contact_person_designation' => 'Administrative Officer',
                'contact_person_mobile' => '+91-9876543213',
                'established_year' => 1954,
                'principal_name' => 'Ms. R. S. Sarker',
                'meta_title' => 'South Point High School Question Papers',
                'meta_description' => 'Question papers from South Point High School for secondary and higher secondary levels.',
                'tags' => json_encode(['kolkata', 'south_point', 'private', 'premier', 'wbbse', 'wbchse', 'isc']),
                'question_papers_count' => 0,
                'student_count' => 3000,
                'teacher_count' => 120,
                'is_featured' => true,
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

};