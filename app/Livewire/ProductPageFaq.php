<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\ProductFaq;
use App\Interfaces\ProductFaqInterface;
use Livewire\Attributes\On;

class ProductPageFaq extends Component
{
    public Int $product_id;
    public ?Collection $faqs;

    // form fields
    public string $faq_question = '';
    public string $faq_answer = '';
    private ProductFaqInterface $productFaqRepository;

    protected $rules = [
        'faq_question' => 'required|string|max:1000',
        'faq_answer' => 'nullable|string|max:10000',
    ];

    public function mount(ProductFaqInterface $productFaqRepository)
    {
        $this->loadFaqs();
    }

    public function loadFaqs()
    {
        $this->faqs = ProductFaq::where('product_id', $this->product_id)
                            ->orderBy('position', 'asc')
                            ->get();
    }

    public function createFaq()
    {
        $this->validate();

        // get max position for given attribute_id and type
        $lastPosition = ProductFaq::where('product_id', $this->product_id)
        ->max('position');
        $position = $lastPosition ? $lastPosition + 1 : 1;

        $faq = ProductFaq::create([
            'product_id' => $this->product_id,
            'question' => $this->faq_question,
            'answer' => $this->faq_answer,
            'position' => $position,
            'status' => 1,
        ]);

        // update the in-memory collection
        $this->faqs->push($faq);

        // reset form
        $this->reset(['faq_question', 'faq_answer']);

        $this->dispatch('notificationSend', [
            'variant' => 'success',
            'title' => 'Success!',
            'message' => 'FAQ created successfully',
        ]);
    }

    public function deleteFaq(int $id)
    {
        ProductFaq::where('id', $id)
            ->where('product_id', $this->product_id)
            ->delete();
        $this->faqs = $this->faqs->reject(fn($hl) => $hl->id == $id);

        $this->dispatch('notificationSend', [
            'variant' => 'success',
            'title' => 'Success!',
            'message' => 'FAQ deleted successfully',
        ]);
    }

    #[On('updateProductFaqsOrder')]
    public function updateFaqOrder(array $ids)
    {
        $productFaqRepository = app(ProductFaqInterface::class);
        $positionResp = $productFaqRepository->position($ids);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
            ]);

            $this->loadFaqs();
        } else {
            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => $positionResp['message'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.product-page-faq');
    }
}
