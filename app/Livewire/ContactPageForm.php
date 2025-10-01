<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserFeedback;

class ContactPageForm extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $phone_no = '';
    public string $phone_country_code = 'IN';
    public string $email = '';
    public string $message = '';
    public string $category = 'contact_form';
    public string $page = '';

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_country_code' => 'required|string|size:2',
            'phone_no' => 'required|integer|digits:'.COUNTRY['phoneNoDigits'],
            'email' => 'nullable|email|max:100',
            'message' => 'required|string|max:1000',
            'category' => 'nullable|string|max:100',
        ];
    }

    public function submit()
    {
        $this->validate();

        $feedback = UserFeedback::create([
            'category' => $this->category ?: 'contact_form',
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email ?: null,
            'country_code' => $this->phone_country_code,
            'primary_phone_no' => $this->phone_no ?: null,
            'message' => $this->message ?: null,
            'page' => $this->page,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // reset fields
        $this->reset(['first_name','last_name','phone_no','phone_country_code','email','message']);
        // send notification
        $this->dispatch('show-notification', 'Message sent successfully. We will Contact you soon !', ['type' => 'success']);
    }

    public function render()
    {
        return view('livewire.contact-page-form');
    }
}
