<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuitabilityLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'suit_letter',
    ];
}
