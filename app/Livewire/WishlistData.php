<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;

class WishlistData extends Component
{
    public Collection $data;

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.wishlist-data');
    }
}
