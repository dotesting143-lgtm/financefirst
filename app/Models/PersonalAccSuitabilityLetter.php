<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonalAccSuitabilityLetter extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'persaccsuit_letter',
    ];
}
