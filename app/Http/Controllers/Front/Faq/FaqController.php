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
        return view('front.faq.index');
    }

    public function showTerms(): View { return $this->showPage('terms-and-conditions'); }
    public function showPrivacy(): View { return $this->showPage('privacy-policy'); }
    public function showReturn(): View { return $this->showPage('return-policy'); }
    public function showRefund(): View { return $this->showPage('refund-policy'); }
    public function showSupport(): View { return $this->showPage('support'); }
    public function showCookie(): View { return $this->showPage('cookie-policy'); }
    public function showShipping(): View { return $this->showPage('shipping-info'); }
    public function showSizeGuide(): View { return $this->showPage('size-guide'); }

    private function showPage(string $slug): View
    {
        $content = $this->contentPageRepository->getBySlug($slug);

        if ($content['code'] != 200) {
            abort(404);
        }

        return view('front.content.detail', [
            'content' => $content['data'],
            'metaTitle' => $content['data']->meta_title ?? $content['data']->title,
            'metaDescription' => $content['data']->meta_description,
        ]);
    }

    public function contactUs(Request $request) : View { return view('front.content.contact-us'); }
    public function aboutUs(Request $request) : View { return view('front.content.about-us'); }

}
