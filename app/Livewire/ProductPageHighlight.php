<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\ProductHighlightList;
use App\Interfaces\ProductHighlightInterface;
use Livewire\Attributes\On;

class ProductPageHighlight extends Component
{
    public int $product_id;
    public ?Collection $highlights;

    // form fields
    public string $icon = '';
    public string $highlight_title = '';
    public string $highlight_description = '';
    private ProductHighlightInterface $productHighlightRepository;

    protected $rules = [
        'icon' => 'required|string',
        'highlight_title' => 'required|string',
        'highlight_description' => 'nullable|string|max:10000',
    ];

    public function mount(ProductHighlightInterface $productHighlightRepository)
    {
        $this->loadHighlights();
    }

    public function loadHighlights()
    {
        $this->highlights = ProductHighlightList::where('product_id', $this->product_id)
                            ->orderBy('position', 'asc')
                            ->get();
    }

    public function createHighlight()
    {
        $this->validate();

        // get max position for given attribute_id and type
        $lastPosition = ProductHighlightList::where('product_id', $this->product_id)
        ->max('position');
        $position = $lastPosition ? $lastPosition + 1 : 1;

        $highlight = ProductHighlightList::create([
            'product_id' => $this->product_id,
            'icon' => $this->icon,
            'title' => $this->highlight_title,
            'description' => $this->highlight_description,
            'position' => $position,
            'status' => 1,
        ]);

        // update the in-memory collection
        $this->highlights->push($highlight);

        // reset form
        $this->reset(['icon', 'highlight_title', 'highlight_description']);

        $this->dispatch('notificationSend', [
            'variant' => 'success',
            'title' => 'Success!',
            'message' => 'Highlight created successfully',
        ]);
    }

    public function deleteHighlight(int $id)
    {
        ProductHighlightList::where('id', $id)
            ->where('product_id', $this->product_id)
            ->delete();
        $this->highlights = $this->highlights->reject(fn($hl) => $hl->id == $id);

        $this->dispatch('notificationSend', [
            'variant' => 'success',
            'title' => 'Success!',
            'message' => 'Highlight deleted successfully',
        ]);
    }

    #[On('updateProductHighlightsOrder')]
    public function updateHighlightOrder(array $ids)
    {
        $productHighlightRepository = app(ProductHighlightInterface::class);
        $positionResp = $productHighlightRepository->position($ids);

        if ($positionResp['code'] == 200) {
            $this->dispatch('notificationSend', [
                'variant' => 'success',
                'title' => 'Position updated',
            ]);

            $this->loadHighlights();
        } else {
            $this->dispatch('notificationSend', [
                'variant' => 'warning',
                'title' => $positionResp['message'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.product-page-highlight');
    }
}
