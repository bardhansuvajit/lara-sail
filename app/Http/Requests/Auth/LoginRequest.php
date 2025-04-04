<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Interfaces\CountryInterface;

class LoginRequest extends FormRequest
{
    private CountryInterface $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dynamic phone number digits based on country
        $phoneNumberDigits = 10;

        // phone number country code fetch
        if (!empty($this->input('phone_country_code'))) {
            $countryData = $this->countryRepository->getByShortName($this->input('phone_country_code'));
        }
        if($countryData['code'] == 200) $phoneNumberDigits = $countryData['data']->phone_no_digits;

        return [
            'phone_country_code' => ['required', 'string', 'min:1', 'max:5'],
            'phone_no' => ['required', 'integer', 'digits:'.$phoneNumberDigits],
            'password' => ['required', 'string', 'min:2', 'max:50'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // dd($this->input());
        $this->ensureIsNotRateLimited();

        $credentials = [
            'primary_phone_no' => $this->input('phone_no'),
            'password' => $this->input('password')
        ];

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'phone_no' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
