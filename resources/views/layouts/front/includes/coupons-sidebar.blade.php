<x-front.sidebar name="coupons" width="xl" mobileWidth="full" direction="right" focusable :show="request('show-coupons-tab') === 'true'">
    <div class="p-2 md:p-4 bg-gray-100 dark:bg-gray-700 h-[100vh]">
        <div class="space-y-4">

            @livewire('coupon-list')

        </div>
    </div>
</x-front.sidebar>