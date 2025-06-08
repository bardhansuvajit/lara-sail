<?php

namespace App\Http\Controllers\Front\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\WishlistInterface;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class WishlistController extends Controller
{
    private WishlistInterface $wishlistRepository;

    public function __construct(
        WishlistInterface $wishlistRepository,
    )
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function index(): View
    {
        $userId = auth()->guard('web')->id();
        $data = $this->wishlistRepository->exists([
            'user_id' => $userId
        ]);

        return view('front.account.wishlist.index', [
            'user' => auth()->guard('web')->user(),
            'data' => $data['data']
        ]);
    }
}
