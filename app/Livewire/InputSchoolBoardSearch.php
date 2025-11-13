<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SchoolBoard;

class InputSchoolBoardSearch extends Component
{
    use WithPagination;

    // search text
    public string $search = '';

    // single-mode fields
    public ?int $product_id = null;
    public ?string $product_title = '';

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

    public function selectProduct(int $id)
    {
        $badge = SchoolBoard::select('id','name','thumbnail_icon')->find($id);
        if (!$badge) return;

        // If it's already selected -> toggle (remove)
        if (in_array($badge->id, $this->selected, true)) {
            $this->removeProduct($badge->id);
            // reset search & page after toggling off as well
            $this->search = '';
            $this->resetPage();
            return;
        }

        if ($this->mode === 'single') {
            $this->selected = [$badge->id];
            $this->product_id = $badge->id;
            $this->product_title = $badge->title;
        } else {
            // multiple: add if not exists
            if (!in_array($badge->id, $this->selected, true)) {
                $this->selected[] = $badge->id;
            }
        }

        // reset search & page
        $this->search = '';
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

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = SchoolBoard::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('meta_title', 'like', '%' . $this->search . '%')
                    ->orWhere('tags', 'like', '%' . $this->search . '%');
            })
            ->orderBy('position')
            ->select(['id', 'name', 'slug', 'thumbnail_icon'])
            ->where('status', 1)
            ->simplePaginate(15);

        // fetch full badge data for selected ids (to render chips)
        $selectedBadges = [];
        if (count($this->selected) > 0) {
            $selectedBadges = SchoolBoard::whereIn('id', $this->selected)
                ->select(['id','name','thumbnail_icon'])
                ->get()
                ->keyBy('id');
        }

        return view('livewire.input-school-board-search', [
            'data' => $data,
            'selectedBadges' => $selectedBadges,
        ]);
    }
}
