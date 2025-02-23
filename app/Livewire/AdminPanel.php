<?php

namespace App\Livewire;

use Livewire\Component;

class AdminPanel extends Component
{
    public $showModal = false; // Controla la visibilidad del modal

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.admin-panel');
    }
}
