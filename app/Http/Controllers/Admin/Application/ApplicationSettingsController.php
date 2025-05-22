<?php

namespace App\Http\Controllers\Admin\Application;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\CartSettingInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApplicationSettingsController
{
    private CartSettingInterface $cartSettingRepository;

    public function __construct(CartSettingInterface $cartSettingRepository)
    {
        $this->cartSettingRepository = $cartSettingRepository;
    }

    /**
     * Show the form for indexing the specified resource.
     */
    public function index($model): View
    {
        if ($model == "basic") {
            return view('admin.application.basic.index');
        } elseif ($model == "cart") {
            $resp = $this->cartSettingRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.cart.index', [
                'data' => $resp['data'],
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($model): View
    {
        if ($model == "basic") {
            return view('admin.application.basic.edit');
        } elseif ($model == "cart") {
            $resp = $this->cartSettingRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.cart.edit', [
                'data' => $resp['data'],
            ]);
        }
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->id as $index => $value) {
            $this->cartSettingRepository->update([
                'id' => $request->id[$index],
                'min_order_value' => $request->min_order_value[$index],
                'shipping_charge' => $request->shipping_charge[$index],
                'free_shipping_threshold' => $request->free_shipping_threshold[$index],
                'tax_rate' => $request->tax_rate[$index],
                'tax_name' => $request->tax_name[$index],
                'tax_type' => $request->tax_type[$index],
                'tax_exclusive' => $request->tax_exclusive[$index]
            ]);
        }

        return redirect()->back()->with('success', 'Changes have been saved');
    }
}
