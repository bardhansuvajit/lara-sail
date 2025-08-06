<?php

namespace App\Http\Controllers\Front\Collection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function detail(): View
    {
        return view('front.collection.detail');
    }
}
