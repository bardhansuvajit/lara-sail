<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Interfaces\WishlistInterface;

class WishlistData extends Component
{
    public int $userId;
    public Collection $data;
    private WishlistInterface $wishlistRepository;

    public function mount(int $userId, WishlistInterface $wishlistRepository)
    {
        $this->userId = $userId;
        $this->wishlistRepository = $wishlistRepository;

        $this->loadData();
    }

    public function loadData(): void
    {
        $items = $this->wishlistRepository->exists(['user_id' => $this->userId]);
        $this->data = collect($items['data'] ?? []);
    }

    public function render()
    {
        return view('livewire.wishlist-data');
    }
}
