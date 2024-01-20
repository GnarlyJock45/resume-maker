<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone_number', 'age', 'skills', 'courses', 'education'
    ];

    protected $casts = [
        'skills' => 'array',
        // ... other casts ...
    ];
}
