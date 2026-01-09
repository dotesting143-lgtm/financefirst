<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MortgageSuitabilityLetter as MortgageSuitabilityLetterModel;

class MortgageSuitabilityLetter extends Component
{
    public $mortsuit_letter, $letterId;
    public $letterContent = '';
    protected $rules = [
        'mortsuit_letter' => 'required|string',
    ];

    public function mount()
    {
        $lastLetter = MortgageSuitabilityLetterModel::latest()->first();

        if ($lastLetter) {
            $this->mortsuit_letter = $lastLetter->mortsuit_letter;
            $this->letterId = $lastLetter->id;
        }
    }

    public function submitForm()
    {
        $this->validate();

        $lastLetter = MortgageSuitabilityLetterModel::updateOrCreate(['id' => $this->letterId], [
            'mortsuit_letter' => $this->mortsuit_letter,
        ]);
  
        session()->flash('message', 
            $this->letterId ? 'Mortgage Suitability letter updated successfully.' : 'Mortgage Suitability letter created successfully.');

        $this->letterId = $lastLetter->id;
    }

    public function render()
    {
        return view('livewire.mortgage-suitability-letter');
    }
}
