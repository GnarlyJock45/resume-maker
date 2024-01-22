<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone_number', 'age', 'skills', 'courses', 'education','work_experience','job_title',
    ];

    protected $casts = [
        'skills' => 'array',
        'courses' => 'array',
        'education' => 'array',
        'work_experience' => 'array',
        // ... other casts ...
    ];
}
