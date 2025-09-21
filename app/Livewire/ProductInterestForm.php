<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductInterestEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductInterestForm extends Component
{
    public int $product_id;
    public ?int $product_variation_id;
    public string $email = '';
    public bool $success = false;

    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|max:80',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please provide a valid email address.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email may not be greater than 80 characters.',
        ];
    }

    public function submit()
    {
        $validated = $this->validate();

        try {
            $subscription = ProductInterestEmail::firstOrCreate(
                [
                    'email' => $validated['email'],
                    'product_id' => $this->product_id,
                    // 'product_variation_id' => $this->product_variation_id
                ],
                [
                    'product_id' => $this->product_id,
                    'product_variation_id' => $this->product_variation_id ?? null,
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'unsubscribe_token' => Str::random(64),
                    'source' => $this->determineSubscriptionSource(),
                    'meta' => $this->prepareMetadata(),
                ]
            );

            if ($subscription->wasRecentlyCreated) {
                $this->handleNewSubscription($subscription);
            } else {
                $this->handleExistingSubscription($subscription);
            }

        } catch (\Exception $e) {
            // Log::error('Subscription failed: ' . $e->getMessage());
            // $this->dispatch('show-notification', 
            //     'Subscription failed. Please try again later.', 
            //     ['type' => 'error']
            // );

            Log::error('Subscription failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            $this->dispatch('show-notification', 
                // 'Subscription failed: ' . $e->getMessage(), // 👈 show actual error (temp)
                'Subscription failed. Please try again later.',
                ['type' => 'error']
            );
        }
    }

    protected function determineSubscriptionSource(): string
    {
        // Customize this logic based on your needs
        return request()->has('utm_source') 
            ? request()->get('utm_source')
            : 'website footer';
    }

    protected function prepareMetadata(): array
    {
        return [
            'subscribed_via' => 'livewire_form',
            'initial_referrer' => request()->header('referer'),
            'landing_page' => url()->current(),
            'utm_params' => request()->only([
                'utm_source', 
                'utm_medium', 
                'utm_campaign'
            ]),
        ];
    }

    protected function handleNewSubscription(ProductInterestEmail $subscription): void
    {
        // Optional: Add to mailing service (Mailchimp, etc.)
        // Optional: Send confirmation email

        $this->success = true;
        $this->reset('email');

        $this->dispatch('show-notification', 
            'Thank you for subscribing!', 
            ['type' => 'success']
        );
    }

    protected function handleExistingSubscription(ProductInterestEmail $subscription): void
    {
        if ($subscription->unsubscribed_at) {
            // Resubscribe if previously unsubscribed
            $subscription->update([
                'unsubscribed_at' => null,
                'subscribed_at' => now(),
            ]);

            $this->dispatch('show-notification', 
                'Welcome back! You have been resubscribed.', 
                ['type' => 'success']
            );
        } else {
            $subscription->increment('subscription_count');

            $this->dispatch('show-notification', 
                'You are already subscribed!', 
                ['type' => 'info']
            );
        }
    }

    public function render()
    {
        return view('livewire.product-interest-form');
    }
}