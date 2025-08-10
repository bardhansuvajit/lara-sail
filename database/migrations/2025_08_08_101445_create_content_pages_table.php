<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('sections')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        $now = now();

        $data = [
            [
                'slug' => 'terms-and-conditions',
                'title' => 'Terms and Conditions',
                'content' => '<h2>1. Introduction</h2>
<p>Welcome to our e-commerce platform. These terms govern your use of our website and services.</p>

<h2>2. Account Registration</h2>
<p>You must provide accurate information when creating an account. You are responsible for maintaining the confidentiality of your account.</p>

<h2>3. Orders and Payments</h2>
<p>All orders are subject to availability and confirmation. We accept various payment methods as displayed during checkout.</p>

<h2>4. Returns and Refunds</h2>
<p>Please refer to our Return Policy for details on returns and refunds.</p>

<h2>5. Intellectual Property</h2>
<p>All content on this website is our property and protected by copyright laws.</p>',
                'meta_title' => 'Terms and Conditions | Your Store Name',
                'meta_description' => 'Read our terms and conditions for using our e-commerce platform and services.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'privacy-policy',
                'title' => 'Privacy Policy',
                'content' => '<h2>1. Information We Collect</h2>
<p>We collect personal information when you register, place orders, or interact with our site. This may include name, email, address, and payment details.</p>

<h2>2. How We Use Your Information</h2>
<p>Your information is used to process orders, improve our services, and communicate with you. We do not sell your data to third parties.</p>

<h2>3. Data Security</h2>
<p>We implement security measures to protect your information, including SSL encryption and secure payment processing.</p>

<h2>4. Cookies</h2>
<p>Our website uses cookies to enhance your shopping experience. You can disable cookies in your browser settings.</p>

<h2>5. Your Rights</h2>
<p>You have the right to access, correct, or delete your personal information stored with us.</p>',
                'meta_title' => 'Privacy Policy | Your Store Name',
                'meta_description' => 'Learn how we collect, use, and protect your personal information on our e-commerce platform.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'return-policy',
                'title' => 'Return Policy',
                'content' => '<h2>1. Return Eligibility</h2>
<p>Items must be returned within 30 days of receipt, unused, and in original packaging with tags attached.</p>

<h2>2. How to Return</h2>
<p>Contact our support team to initiate a return. You will receive a return authorization number and instructions.</p>

<h2>3. Return Shipping</h2>
<p>Customers are responsible for return shipping costs unless the return is due to our error.</p>

<h2>4. Refund Processing</h2>
<p>Refunds will be processed within 5-7 business days after we receive and inspect the returned item.</p>

<h2>5. Non-Returnable Items</h2>
<p>Certain items like perishable goods, intimate apparel, and personalized products cannot be returned.</p>',
                'meta_title' => 'Return Policy | Your Store Name',
                'meta_description' => 'Learn about our return policy including eligibility, process, and refund timelines.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'refund-policy',
                'title' => 'Refund Policy',
                'content' => '<h2>1. Refund Methods</h2>
<p>Refunds will be issued to the original payment method. Processing times vary by payment provider.</p>

<h2>2. Partial Refunds</h2>
<p>Some items may be subject to partial refunds if returned used or damaged.</p>

<h2>3. Shipping Costs</h2>
<p>Original shipping costs are non-refundable unless the return is due to our error.</p>

<h2>4. Late or Missing Refunds</h2>
<p>If you haven\'t received your refund, first check your bank account, then contact your credit card company before contacting us.</p>

<h2>5. Sale Items</h2>
<p>Only regular-priced items may be refunded. Sale items cannot be refunded.</p>',
                'meta_title' => 'Refund Policy | Your Store Name',
                'meta_description' => 'Details about our refund process including methods, timelines, and special cases.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'support',
                'title' => 'Support',
                'content' => '<h2>1. Contact Methods</h2>
<p>Reach our support team via email at support@yourstore.com or through our live chat during business hours.</p>

<h2>2. Response Times</h2>
<p>We aim to respond to all inquiries within 24 hours during business days.</p>

<h2>3. Order Assistance</h2>
<p>For order-related questions, please have your order number ready when contacting us.</p>

<h2>4. Technical Support</h2>
<p>For website issues, please describe the problem and include screenshots if possible.</p>

<h2>5. Business Hours</h2>
<p>Our support team is available Monday-Friday, 9AM-5PM EST.</p>',
                'meta_title' => 'Customer Support | Your Store Name',
                'meta_description' => 'Contact information and support options for our e-commerce store.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'cookie-policy',
                'title' => 'Cookie Policy',
                'content' => '<h2>1. What Are Cookies</h2>
<p>Cookies are small text files stored on your device when you visit websites.</p>

<h2>2. How We Use Cookies</h2>
<p>We use cookies to remember your preferences, analyze site traffic, and personalize content.</p>

<h2>3. Cookie Types</h2>
<ul>
<li><strong>Essential:</strong> Required for site functionality</li>
<li><strong>Performance:</strong> Help us understand visitor behavior</li>
<li><strong>Functional:</strong> Remember your preferences</li>
<li><strong>Advertising:</strong> Used for personalized ads</li>
</ul>

<h2>4. Managing Cookies</h2>
<p>You can control cookies through your browser settings. Note that disabling cookies may affect site functionality.</p>',
                'meta_title' => 'Cookie Policy | Your Store Name',
                'meta_description' => 'Information about how we use cookies on our e-commerce website.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'shipping-info',
                'title' => 'Shipping Information',
                'content' => '<h2>1. Shipping Options</h2>
<p>We offer standard (3-5 business days) and express (1-2 business days) shipping options.</p>

<h2>2. Processing Time</h2>
<p>Orders are processed within 1-2 business days after payment confirmation.</p>

<h2>3. Shipping Costs</h2>
<p>Shipping costs vary by destination and package weight. Free shipping is available for orders over $50.</p>

<h2>4. International Shipping</h2>
<p>We ship to most countries worldwide. Additional customs fees may apply.</p>

<h2>5. Order Tracking</h2>
<p>You will receive a tracking number via email once your order ships.</p>',
                'meta_title' => 'Shipping Information | Your Store Name',
                'meta_description' => 'Details about our shipping options, costs, and delivery timelines.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'size-guide',
                'title' => 'Size Guide',
                'content' => '<h2>1. How to Measure</h2>
<p>Use a soft measuring tape to measure your body as shown in our diagrams.</p>

<h2>2. Clothing Sizes</h2>
<table>
<thead>
<tr><th>Size</th><th>Chest (in)</th><th>Waist (in)</th><th>Hip (in)</th></tr>
</thead>
<tbody>
<tr><td>XS</td><td>32-34</td><td>25-27</td><td>35-37</td></tr>
<tr><td>S</td><td>35-37</td><td>28-30</td><td>38-40</td></tr>
<tr><td>M</td><td>38-40</td><td>31-33</td><td>41-43</td></tr>
</tbody>
</table>

<h2>3. Footwear Sizes</h2>
<table>
<thead>
<tr><th>US</th><th>EU</th><th>UK</th><th>CM</th></tr>
</thead>
<tbody>
<tr><td>7</td><td>40</td><td>6</td><td>25</td></tr>
<tr><td>8</td><td>41</td><td>7</td><td>26</td></tr>
<tr><td>9</td><td>42</td><td>8</td><td>27</td></tr>
</tbody>
</table>

<h2>4. Returns for Size Issues</h2>
<p>If an item doesn\'t fit, you may return it according to our Return Policy.</p>',
                'meta_title' => 'Size Guide | Your Store Name',
                'meta_description' => 'Comprehensive size guide for clothing and footwear to help you find the perfect fit.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('content_pages')->insert($data);
    }

    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};