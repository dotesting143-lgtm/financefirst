<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PensionThankyouLetter as PensionThankyouLetterModel;

class PensionThankyouLetter extends Component
{
    public $thanks_letter, $letterId;
    public $letterContent = '';
    protected $rules = [
        'thanks_letter' => 'required|string',
    ];

    public function mount()
    {
        $lastLetter = PensionThankyouLetterModel::latest()->first();

        if ($lastLetter) {
            $this->thanks_letter = $lastLetter->thanks_letter;
            $this->letterId = $lastLetter->id;
        }
    }

    public function submitForm()
    {
        $this->validate();

        $lastLetter = PensionThankyouLetterModel::updateOrCreate(['id' => $this->letterId], [
            'thanks_letter' => $this->thanks_letter,
        ]);
  
        session()->flash('message', 
            $this->letterId ? 'Thank You letter updated successfully.' : 'Thank You letter created successfully.');

        $this->letterId = $lastLetter->id;
    }
    
    public function render()
    {
        return view('livewire.pension-thankyou-letter');
    }
}
