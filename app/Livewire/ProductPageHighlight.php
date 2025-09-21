<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\ProductHighlightList;

class ProductPageHighlight extends Component
{
    public Int $product_id;
    public ?Collection $highlights;

    // form fields
    public string $icon = '';
    public string $highlight_title = '';
    public string $highlight_description = '';

    protected $rules = [
        'icon' => 'required|string',
        'highlight_title' => 'required|string',
        'highlight_description' => 'nullable|string|max:10000',
    ];

    public function mount()
    {
        $this->highlights = ProductHighlightList::where('product_id', $this->product_id)->get();
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

    public function render()
    {
        return view('livewire.product-page-highlight');
    }
}
