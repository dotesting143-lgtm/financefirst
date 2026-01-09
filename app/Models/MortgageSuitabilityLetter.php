<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MortgageSuitabilityLetter extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'mortsuit_letter',
    ];
}
