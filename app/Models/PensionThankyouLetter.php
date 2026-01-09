<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PensionThankyouLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'thanks_letter',
    ];
}
