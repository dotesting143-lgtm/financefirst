<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentStorage extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'filename', 'uploaded_by', 'client_id', 'download_link'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'uploaded_by');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id');
    }

}
