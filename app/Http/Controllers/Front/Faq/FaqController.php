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

}
