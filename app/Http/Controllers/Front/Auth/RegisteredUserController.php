<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Interfaces\CountryInterface;

class RegisteredUserController extends Controller
{
    private CountryInterface $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        // dynamic phone number digits based on country
        $phoneNumberDigits = 10;

        // phone number country code fetch
        if (!empty($request->phone_country_code)) {
            $countryData = $this->countryRepository->getByShortName($request->phone_country_code);
        }
        if($countryData['code'] == 200) $phoneNumberDigits = $countryData['data']->phone_no_digits;

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_country_code' => ['required', 'string', 'min:1', 'max:5'],
            'phone_no' => ['required', 'integer', 'digits:'.$phoneNumberDigits, 'unique:'.User::class.',primary_phone_no'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:2', 'max:50', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country_id' => $countryData['data']->id,
            'primary_phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender_id' => 4
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('front.profile.index', absolute: false));
    }
}
