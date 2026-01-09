<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PersonalAccSuitabilityLetter as PersonalAccSuitabilityLetterModel;

class PersonalAccSuitabilityLetter extends Component
{
    public $persaccsuit_letter, $letterId;
    public $letterContent = '';
    protected $rules = [
        'persaccsuit_letter' => 'required|string',
    ];

    public function mount()
    {
        $lastLetter = PersonalAccSuitabilityLetterModel::latest()->first();

        if ($lastLetter) {
            $this->persaccsuit_letter = $lastLetter->persaccsuit_letter;
            $this->letterId = $lastLetter->id;
        }
    }

    public function submitForm()
    {
        $this->validate();

        $lastLetter = PersonalAccSuitabilityLetterModel::updateOrCreate(['id' => $this->letterId], [
            'persaccsuit_letter' => $this->persaccsuit_letter,
        ]);
  
        session()->flash('message', 
            $this->letterId ? 'Personal Acc Suitability letter updated successfully.' : 'Personal Acc Suitability letter created successfully.');

        $this->letterId = $lastLetter->id;
    }

    public function render()
    {
        return view('livewire.personal-acc-suitability-letter');
    }
}
