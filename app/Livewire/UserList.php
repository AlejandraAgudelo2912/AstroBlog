<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.user-list', [
            'users' => User::paginate(10),
        ]);
    }
}
