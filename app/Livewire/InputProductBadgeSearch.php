<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductBadge;

class InputProductBadgeSearch extends Component
{
    use WithPagination;

    // search text
    public ?string $product = '';

    // single-mode fields
    public ?int $product_id = null;
    public ?string $product_title = '';

    // multi-mode selection (array of badge ids)
    public array $selected = [];

    // 'single' or 'multiple' - pass from mount
    public string $mode = 'single';

    protected $listeners = ['refreshProducts' => '$refresh'];

    // mount signature: mode, optional single id/title, or array of selected ids for multi
    public function mount(string $mode = 'single', $product_id = null, $product_title = '', $selected_ids = [])
    {
        $this->mode = $mode === 'multiple' ? 'multiple' : 'single';

        if ($this->mode === 'single') {
            $this->product_id = $product_id ? (int)$product_id : null;
            $this->product_title = $product_title ?? '';
            if ($this->product_id) {
                $this->selected = [$this->product_id]; // keep selected in sync
            }
        } else {
            // multi
            $this->selected = is_array($selected_ids) ? array_values(array_map('intval', $selected_ids)) : [];
        }
    }

    // select a badge by id (called from blade via wire:click)
    public function selectProduct(int $id)
    {
        $badge = ProductBadge::select('id','title','icon','tailwind_classes')->find($id);
        if (! $badge) return;

        // If it's already selected -> toggle (remove)
        if (in_array($badge->id, $this->selected, true)) {
            $this->removeProduct($badge->id);
            // reset search & page after toggling off as well
            $this->product = '';
            $this->resetPage();
            return;
        }

        if ($this->mode === 'single') {
            $this->selected = [$badge->id];
            $this->product_id = $badge->id;
            $this->product_title = $badge->title;
        } else {
            // multiple: add if not exists
            if (! in_array($badge->id, $this->selected, true)) {
                $this->selected[] = $badge->id;
            }
        }

        // reset search & page
        $this->product = '';
        $this->resetPage();
    }

    public function removeProduct(int $id)
    {
        $this->selected = array_values(array_filter($this->selected, fn($v) => $v !== $id));
        if ($this->mode === 'single') {
            $this->product_id = null;
            $this->product_title = '';
        }
    }

    public function updatedProduct()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = ProductBadge::when($this->product, function ($query) {
                $query->where('title', 'like', '%' . $this->product . '%')
                    ->orWhere('short', 'like', '%' . $this->product . '%')
                    ->orWhere('description', 'like', '%' . $this->product . '%')
                    ->orWhere('meta', 'like', '%' . $this->product . '%');
            })
            // ->where('status', 1)
            ->orderBy('position')
            ->select(['id', 'title', 'icon', 'tailwind_classes'])
            ->simplePaginate(15);

        // fetch full badge data for selected ids (to render chips)
        $selectedBadges = [];
        if (count($this->selected) > 0) {
            $selectedBadges = ProductBadge::whereIn('id', $this->selected)
                ->select(['id','title','icon','tailwind_classes'])
                ->get()
                ->keyBy('id');
        }

        return view('livewire.input-product-badge-search', [
            'products' => $products,
            'selectedBadges' => $selectedBadges,
        ]);
    }
}
