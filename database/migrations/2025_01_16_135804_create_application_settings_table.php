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
            $table->longText('pretty_value');
            $table->text('description')->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        /*
        $data = [
            [
                'category' => 'stage1',
                'key' => 'company_domain',
                'value' => 'core-commerce',
                'pretty_value' => 'Core Commerce',
                'description' => 'Default domain category for company setup',
            ],
            [
                'category' => 'stage2',
                'key' => 'domain_name',
                'value' => 'https://example.com',
                'pretty_value' => 'https://example.com',
                'description' => '',
            ],
            [
                'category' => 'stage2',
                'key' => 'company_name',
                'value' => 'Example company LLP',
                'pretty_value' => 'Example company LLP',
                'description' => '',
            ],
            [
                'category' => 'stage2',
                'key' => 'company_establish_year',
                'value' => 2000,
                'pretty_value' => 2000,
                'description' => '',
            ],
            [
                'category' => 'stage2',
                'key' => 'country_code',
                'value' => 'IN',
                'pretty_value' => 'INDIA',
                'description' => '',
            ],
            [
                'category' => 'stage3',
                'key' => 'support_contact',
                'value' => '9038775709',
                'pretty_value' => '+91 903877 5709',
                'description' => '',
            ],
            [
                'category' => 'stage3',
                'key' => 'support_email',
                'value' => 'support@email.com',
                'pretty_value' => 'support@email.com',
                'description' => '',
            ],
            [
                'category' => 'stage3',
                'key' => 'company_address1',
                'value' => 'New Blueview, HN Road, Kolkata, WB 700066',
                'pretty_value' => 'New Blueview, HN Road, Kolkata, WB 700066',
                'description' => '',
            ],
        ];
        */

        $data = [
            // Company Information
            [
                'category' => 'company',
                'key' => 'company_domain',
                'value' => 'core-commerce',
                'pretty_value' => 'Core Commerce',
                'description' => 'Default domain category for company setup',
            ],
            [
                'category' => 'company',
                'key' => 'company_name',
                'value' => 'Example company LLP',
                'pretty_value' => 'Example company LLP',
                'description' => 'Legal company name',
            ],
            [
                'category' => 'company',
                'key' => 'company_establish_year',
                'value' => 2000,
                'pretty_value' => 2000,
                'description' => 'Company establishment year',
            ],
            [
                'category' => 'company',
                'key' => 'company_tagline',
                'value' => 'Your tagline here',
                'pretty_value' => 'Your tagline here',
                'description' => 'Company tagline or slogan',
            ],

            // Contact Information
            [
                'category' => 'contact',
                'key' => 'domain_name',
                'value' => 'https://example.com',
                'pretty_value' => 'https://example.com',
                'description' => 'Primary company website URL',
            ],
            [
                'category' => 'contact',
                'key' => 'support_contact',
                'value' => '9038775709',
                'pretty_value' => '+91 903877 5709',
                'description' => 'Primary support contact number',
            ],
            [
                'category' => 'contact',
                'key' => 'support_email',
                'value' => 'support@email.com',
                'pretty_value' => 'support@email.com',
                'description' => 'Customer support email address',
            ],
            [
                'category' => 'contact',
                'key' => 'primary_phone',
                'value' => '9038775709',
                'pretty_value' => '+91 903877 5709',
                'description' => 'Main company phone number',
            ],
            [
                'category' => 'contact',
                'key' => 'sales_email',
                'value' => 'sales@email.com',
                'pretty_value' => 'sales@email.com',
                'description' => 'Sales department email',
            ],
            [
                'category' => 'contact',
                'key' => 'info_email',
                'value' => 'info@email.com',
                'pretty_value' => 'info@email.com',
                'description' => 'General information email',
            ],
            [
                'category' => 'contact',
                'key' => 'careers_email',
                'value' => 'careers@email.com',
                'pretty_value' => 'careers@email.com',
                'description' => 'Careers and HR email',
            ],
            [
                'category' => 'contact',
                'key' => 'company_address1',
                'value' => 'New Blueview, HN Road, Kolkata, WB 700066',
                'pretty_value' => 'New Blueview, HN Road, Kolkata, WB 700066',
                'description' => 'Primary company address',
            ],

            // Location
            [
                'category' => 'location',
                'key' => 'country_code',
                'value' => 'IN',
                'pretty_value' => 'INDIA',
                'description' => 'Primary country of operation',
            ],

            // Branding & Logos
            [
                'category' => 'branding',
                'key' => 'company_logo',
                'value' => 'logo.png',
                'pretty_value' => 'logo.png',
                'description' => 'Primary company logo',
            ],
            [
                'category' => 'branding',
                'key' => 'company_logo_dark',
                'value' => 'logo-dark.png',
                'pretty_value' => 'logo-dark.png',
                'description' => 'Primary Dark company logo',
            ],
            [
                'category' => 'branding',
                'key' => 'company_favicon',
                'value' => 'favicon.ico',
                'pretty_value' => 'favicon.ico',
                'description' => 'Website favicon',
            ],
            [
                'category' => 'branding',
                'key' => 'logo_square',
                'value' => 'logo-square.png',
                'pretty_value' => 'logo-square.png',
                'description' => 'Square version of logo',
            ],
            [
                'category' => 'branding',
                'key' => 'logo_icon',
                'value' => 'logo-icon.png',
                'pretty_value' => 'logo-icon.png',
                'description' => 'Icon/favicon version',
            ],
            [
                'category' => 'branding',
                'key' => 'logo_watermark',
                'value' => 'watermark.png',
                'pretty_value' => 'watermark.png',
                'description' => 'Watermark version for images',
            ],
            [
                'category' => 'branding',
                'key' => 'logo_svg',
                'value' => 'logo.svg',
                'pretty_value' => 'logo.svg',
                'description' => 'SVG vector version',
            ],  

            // Legal & Compliance
            [
                'category' => 'legal',
                'key' => 'tax_id',
                'value' => 'GSTIN123456789',
                'pretty_value' => 'GSTIN: GSTIN123456789',
                'description' => 'Company GSTIN/Tax ID',
            ],
            [
                'category' => 'legal',
                'key' => 'registration_number',
                'value' => 'U72900WB2000PTC091123',
                'pretty_value' => 'Reg: U72900WB2000PTC091123',
                'description' => 'Company registration number',
            ],
            [
                'category' => 'legal',
                'key' => 'cin_number',
                'value' => 'U72900WB2000PTC091123',
                'pretty_value' => 'CIN: U72900WB2000PTC091123',
                'description' => 'Corporate Identification Number',
            ],

            // Business Operations
            [
                'category' => 'business',
                'key' => 'business_hours',
                'value' => '{"mon_fri":"9:00-18:00","saturday":"10:00-14:00","sunday":"closed"}',
                'pretty_value' => 'Mon-Fri: 9AM-6PM, Sat: 10AM-2PM',
                'description' => 'Business operating hours',
            ],

            // Payment & Currency
            [
                'category' => 'payment',
                'key' => 'default_currency',
                'value' => 'INR',
                'pretty_value' => '₹ INR',
                'description' => 'Default currency',
            ],
            [
                'category' => 'payment',
                'key' => 'currency_symbol',
                'value' => '₹',
                'pretty_value' => '₹',
                'description' => 'Currency symbol',
            ],

            // SEO & Meta
            [
                'category' => 'seo',
                'key' => 'meta_description',
                'value' => 'Default meta description',
                'pretty_value' => 'Default meta description',
                'description' => 'Default meta description for SEO',
            ],
            [
                'category' => 'seo',
                'key' => 'meta_keywords',
                'value' => 'keyword1, keyword2, keyword3',
                'pretty_value' => 'keyword1, keyword2, keyword3',
                'description' => 'Default meta keywords',
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
