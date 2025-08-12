<?php

namespace App\Http\Controllers\Front\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
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
        $userId = auth()->guard('web')->user()->id;
        $data = $this->wishlistRepository->exists([
            'user_id' => $userId
        ]);

        return view('front.account.wishlist.index', [
            'user' => auth()->guard('web')->user(),
            'data' => $data['data']
        ]);
    }

    public function checkStatus(Request $request): JsonResponse
    {
        if (auth()->guard('web')->check()) {
            try {
                $userId = auth()->guard('web')->user()->id;

                $wishlistData = $this->wishlistRepository->checkStatus($request->product_ids, $userId);

                return response()->json([
                    'code' => 200,
                    'status' => 'success',
                    'data' => $wishlistData['data']
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 500,
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        return response()->json([
            'code' => 500,
            'status' => 'warning',
            'message' => 'User not logged in'
        ]);

        // dd($productId, $userId);
    }

    public function toggle($productId): JsonResponse
    {
        if (!auth()->guard('web')->check()) {
            return response()->json([
                'code' => 401,
                'status' => 'warning',
                'message' => 'Love something? Login to add it to your wishlist!',
            ]);
        }

        $userId = auth()->guard('web')->user()->id;
        $wishlistData = $this->wishlistRepository->exists([
            'product_id' => $productId,
            'user_id' => $userId
        ]);

        if ($wishlistData['code'] == 200) {
            $wishlistResp = $this->wishlistRepository->delete($wishlistData['data'][0]->id);
        } else {
            $wishlistResp = $this->wishlistRepository->store([
                'product_id' => $productId,
                'user_id' => $userId
            ]);
        }

        if ($wishlistResp['code'] == 200) {
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => $wishlistResp['message'],
            ]);
        } else {
            return response()->json([
                'code' => 500,
                'status' => 'error',
                'message' => $wishlistResp['message']
            ]);
        }

        // dd($productId, $userId);
    }
}
