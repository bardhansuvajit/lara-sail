<?php

namespace App\Http\Controllers\Front\Ip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\IpInterface;

class IpController extends Controller
{
    private IpInterface $ipRepository;

    public function __construct(IpInterface $ipRepository)
    {
        $this->ipRepository = $ipRepository;
    }

    public function index(): View
    {
        $featuredProducts = $this->ipRepository->list('', [], 'all', 'position', 'asc');
        return view('front.home.index', [
            'featuredProducts' => $featuredProducts['data'],
        ]);
    }
}
