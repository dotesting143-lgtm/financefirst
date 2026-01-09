<?php

namespace App\Livewire;

use Livewire\Component;

class GenerateThankyouPdf extends Component
{
    public $policyId;
    
	public function download()
    {
        // just to have Livewire call this from JS (we’ll call the route to get the PDF)
    }
    
    public function render()
    {
        return view('livewire.generate-thankyou-pdf');
    }
}
