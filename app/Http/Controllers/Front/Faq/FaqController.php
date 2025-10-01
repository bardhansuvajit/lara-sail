<?php

namespace App\Http\Controllers\Front\Faq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ContentPageInterface;

class FaqController
{
    private ContentPageInterface $contentPageRepository;

    public function __construct(ContentPageInterface $contentPageRepository)
    {
        $this->contentPageRepository = $contentPageRepository;
    }

    public function index(Request $request) : View
    {
        $categories = ['All', 'Orders', 'Payments', 'Shipping', 'Returns', 'Account'];
        $activeCategory = request('category', 'All');

        $faqs = [
            ['q' => 'How do I place an order?', 'a' => 'Simply browse products, add them to your cart, and proceed to checkout.', 'cat' => 'Orders'],
            ['q' => 'What payment methods are accepted?', 'a' => 'We accept credit/debit cards, UPI, net banking, and popular wallets.', 'cat' => 'Payments'],
            ['q' => 'How long does shipping take?', 'a' => 'Standard delivery takes 3-5 business days; express delivery is 1-2 days.', 'cat' => 'Shipping'],
            ['q' => 'How do I track my order?', 'a' => 'You can track your order from your account dashboard under "My Orders".', 'cat' => 'Orders'],
            ['q' => 'Can I return a product?', 'a' => 'Yes, returns are accepted within 7 days if the product is unused and in original packaging.', 'cat' => 'Returns'],
            ['q' => 'How do I reset my password?', 'a' => 'Go to login page, click "Forgot Password", and follow the instructions.', 'cat' => 'Account'],
        ];

        return view('front.faq.index', [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'faqs' => $faqs,
        ]);
    }

}
