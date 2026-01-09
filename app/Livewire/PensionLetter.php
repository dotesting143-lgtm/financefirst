<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PensionLetter as PensionLetterModel;

class PensionLetter extends Component
{
    public $pens_letter, $letterId;
    public $letterContent = '';
    protected $rules = [
        'pens_letter' => 'required|string',
    ];

    public function mount()
    {
        $lastLetter = PensionLetterModel::latest()->first();

        if ($lastLetter) {
            $this->pens_letter = $lastLetter->pens_letter;
            $this->letterId = $lastLetter->id;
        }
    }

    public function submitForm()
    {
        $this->validate();

        $lastLetter = PensionLetterModel::updateOrCreate(['id' => $this->letterId], [
            'pens_letter' => $this->pens_letter,
        ]);
  
        session()->flash('message', 
            $this->letterId ? 'Pension letter updated successfully.' : 'Pension letter created successfully.');

        $this->letterId = $lastLetter->id;
    }

    public function render()
    {
        return view('livewire.pension-letter');
    }
}
