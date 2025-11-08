<?php

namespace App\Http\Controllers\Admin\Application;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Interfaces\ApplicationSettingInterface;
use App\Interfaces\DeveloperSettingInterface;
use App\Interfaces\CartSettingInterface;
use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\ShippingMethodInterface;
use Illuminate\Support\Facades\Validator;

class ApplicationSettingsController
{
    private ApplicationSettingInterface $applicationSettingRepository;
    private DeveloperSettingInterface $developerSettingRepository;
    private CartSettingInterface $cartSettingRepository;
    private PaymentMethodInterface $paymentMethodRepository;
    private ShippingMethodInterface $shippingMethodRepository;

    public function __construct(
        ApplicationSettingInterface $applicationSettingRepository,
        DeveloperSettingInterface $developerSettingRepository,
        CartSettingInterface $cartSettingRepository, 
        PaymentMethodInterface $paymentMethodRepository,
        ShippingMethodInterface $shippingMethodRepository
    )
    {
        $this->applicationSettingRepository = $applicationSettingRepository;
        $this->developerSettingRepository = $developerSettingRepository;
        $this->cartSettingRepository = $cartSettingRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->shippingMethodRepository = $shippingMethodRepository;
    }

    /**
     * Show the form for indexing the specified resource.
     */
    public function index($model): View
    {
        if ($model == "basic") {
            $resp = $this->applicationSettingRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.basic.index', [
                'data' => $resp['data'],
            ]);
        } elseif ($model == "cart") {
            $resp = $this->cartSettingRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.cart.index', [
                'data' => $resp['data'],
            ]);
        } elseif ($model == "payment") {
            $resp = $this->paymentMethodRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.payment.index', [
                'data' => $resp['data'],
            ]);
        } elseif ($model == "shipping") {
            $resp = $this->shippingMethodRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.shipping.index', [
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
            $resp = $this->applicationSettingRepository->list('', [], 'all', 'id', 'asc');
            $productTypes = $this->developerSettingRepository->getByKey('company_category');

            return view('admin.application.basic.edit', [
                'data' => $resp['data'],
                'productTypes' => json_decode($productTypes['data']->value)
            ]);
        } elseif ($model == "cart") {
            $resp = $this->cartSettingRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.cart.edit', [
                'data' => $resp['data'],
            ]);
        } elseif ($model == "payment") {
            $resp = $this->paymentMethodRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.payment.edit', [
                'data' => $resp['data'],
            ]);
        } elseif ($model == "shipping") {
            $resp = $this->shippingMethodRepository->list('', [], 'all', 'id', 'asc');

            return view('admin.application.shipping.edit', [
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

        if ($request->type == "basic") {
            $validator = Validator::make($request->all(), [
                'id' => 'required|array',
                'id.*' => 'integer|min:1',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            foreach ($request->id as $index => $value) {
                $this->applicationSettingRepository->update([
                    'id' => $request->id[$index],
                    // 'key' => $request->key[$index],
                    'value' => $request->value[$index],
                    'pretty_value' => $request->pretty_value[$index],
                ]);
            }
        } elseif ($request->type == "cart") {
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
        } elseif ($request->type == "payment") {
            $validator = Validator::make($request->all(), [
                'id' => 'required|array',
                'id.*' => 'integer|min:1',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            foreach ($request->id as $index => $value) {
                $this->paymentMethodRepository->update([
                    'id' => $request->id[$index],
                    'method' => $request->method[$index],
                    'title' => $request->title[$index],
                    'description' => $request->description[$index],

                    'charge_title' => $request->charge_title[$index],
                    'charge_amount' => $request->charge_amount[$index],
                    'charge_type' => $request->charge_type[$index],
                    'discount_title' => $request->discount_title[$index],
                    'discount_amount' => $request->discount_amount[$index],
                    'discount_type' => $request->discount_type[$index],
                ]);
            }
        } elseif ($request->type == "shipping") {
            $validator = Validator::make($request->all(), [
                'id' => 'required|array',
                'id.*' => 'integer|min:1',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            foreach ($request->id as $index => $value) {
                $this->shippingMethodRepository->update([
                    'id' => $request->id[$index],
                    'method' => $request->method[$index],
                    'title' => $request->title[$index],
                    'subtitle' => $request->subtitle[$index],
                    'description' => $request->description[$index],
                    'icon' => $request->icon[$index],
                    'cost' => $request->cost[$index]
                ]);
            }
        }

        return redirect()->back()->with('success', 'Changes have been saved');
    }
}
