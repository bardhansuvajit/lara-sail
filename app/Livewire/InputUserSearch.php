<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class InputUserSearch extends Component
{
    use WithPagination;

    public ?string $user = '';
    public int $user_id;
    public ?string $user_name;
    protected $listeners = ['setUser', 'refreshUsers' => '$refresh'];

    public function mount($user_id = '', $user_name = '')
    {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
    }

    public function setUser($id, $name)
    {
        $this->user_id = $id;
        $this->user_name = $name;
    }

    public function updatedUser()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::when($this->user, function ($query) {
            $query->where('first_name', 'like', '%' . $this->user . '%')
                ->orWhere('last_name', 'like', '%' . $this->user . '%');
        })
        ->orderBy('first_name')
        ->select(['id', 'first_name', 'last_name'])
        ->simplePaginate(15);

        return view('livewire.input-user-search', ['users' => $users]);
    }
}
