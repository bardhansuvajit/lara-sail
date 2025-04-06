<?php

namespace App\Http\Controllers\Api\Ip;

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

    public function check(String $ip) {
        // dd($request->all());
        $resp = $this->ipRepository->getByIp($ip);
        return $resp;
    }

    public function store(Request $request) {
        // dd($request->all());

        $request->validate([
            'ip' => 'required|ip|string|max:75',
            'country' => 'nullable|string|max:100',
            'countryCode' => 'nullable|string|size:2',
            'state' => 'nullable|string|max:100',
            'stateCode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'currency' => 'nullable|string|size:3',
            'lat' => 'nullable|numeric|between:-90,90',
            'lon' => 'nullable|numeric|between:-180,180',
            'details' => 'nullable|string',
        ]);

        $resp = $this->ipRepository->store([
            'ipv4' => $request->ip,
            'country_code' => $request->countryCode,
            'state_code' => $request->stateCode,
            'city' => $request->city,
            'zip' => $request->zip,
            'currency_code' => $request->currency,
            'resp' => json_encode($request->all()),
        ]);

        return $resp;
    }
}
