<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class SubscriptionForm extends Component
{
    public string $email = '';
    public bool $success = false;

    public function rules()
    {
        return [
            'email' => 'required|email|max:80',
        ];
    }

    public function submit()
    {
        $validated = $this->validate();

        // Here you would typically:
        // 1. Store the email in your database
        // 2. Maybe send to a mailing service like Mailchimp
        // 3. Send a confirmation email
        
        // For demonstration, we'll just set a success flag
        $this->success = true;
        $this->reset('email');

        $this->dispatch('show-notification', 
            'Thank you for subscribing!', ['type' => 'success']
        );
    }

    public function render()
    {
        return view('livewire.subscription-form');
    }
}