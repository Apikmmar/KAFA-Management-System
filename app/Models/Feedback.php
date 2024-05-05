<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // allow to input
    protected $filable = [
        'feedback_title',
        'feedback_description',
    ];
}
