<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuitabilityLetter as SuitabilityLetterModel;

class SuitabilityLetter extends Component
{
    public $suit_letter, $letterId;
    public $letterContent = '';
    protected $rules = [
        'suit_letter' => 'required|string',
    ];

    public function mount()
    {
        $lastLetter = SuitabilityLetterModel::latest()->first();

        if ($lastLetter) {
            $this->suit_letter = $lastLetter->suit_letter;
            $this->letterId = $lastLetter->id;
        }
    }

    public function submitForm()
    {
        $this->validate();

        $lastLetter = SuitabilityLetterModel::updateOrCreate(['id' => $this->letterId], [
            'suit_letter' => $this->suit_letter,
        ]);
  
        session()->flash('message', 
            $this->letterId ? 'Suitability letter updated successfully.' : 'Suitability letter created successfully.');

        $this->letterId = $lastLetter->id;
    }

    public function render()
    {
        return view('livewire.suitability-letter');
    }
}
