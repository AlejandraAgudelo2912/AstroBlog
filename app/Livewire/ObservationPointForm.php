<?php

namespace App\Livewire;

use App\Models\ObservationPoint;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ObservationPointForm extends Component
{
    public $name;

    public $description;

    public $latitude;

    public $longitude;

    public $showForm = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ];

    protected $listeners = ['setCoordinates' => 'setCoordinates'];

    public function setCoordinates($latitude, $longitude)
    {
        $this->latitude = is_numeric($latitude) ? floatval($latitude) : null;
        $this->longitude = is_numeric($longitude) ? floatval($longitude) : null;
        $this->showForm = true;
    }

    public function showObservationForm()
    {
        $this->reset(['name', 'description', 'latitude', 'longitude']);
        $this->showForm = true;
    }

    public function hideObservationForm()
    {
        $this->showForm = false;
    }

    public function save()
    {
        $this->validate();

        ObservationPoint::create([
            'name' => $this->name,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'user_id' => Auth::id(),
        ]);

        session()->flash('message', 'Ubicación guardada correctamente.');

        $this->reset(['name', 'description', 'latitude', 'longitude']);
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.observation-point-form');
    }
}
