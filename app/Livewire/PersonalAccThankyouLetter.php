<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PersonalAccThankyouLetter as PersonalAccThankyouLetterModel;

class PersonalAccThankyouLetter extends Component
{
    public $thanks_letter, $letterId;
    public $letterContent = '';
    protected $rules = [
        'thanks_letter' => 'required|string',
    ];

    public function mount()
    {
        $lastLetter = PersonalAccThankyouLetterModel::latest()->first();

        if ($lastLetter) {
            $this->thanks_letter = $lastLetter->thanks_letter;
            $this->letterId = $lastLetter->id;
        }
    }

    public function submitForm()
    {
        $this->validate();

        $lastLetter = PersonalAccThankyouLetterModel::updateOrCreate(['id' => $this->letterId], [
            'thanks_letter' => $this->thanks_letter,
        ]);
  
        session()->flash('message', 
            $this->letterId ? 'Thank You letter updated successfully.' : 'Thank You letter created successfully.');

        $this->letterId = $lastLetter->id;
    }
    
    public function render()
    {
        return view('livewire.personal-acc-thankyou-letter');
    }
}
