<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'user_id',
        'result_marks',
        'result_feedback',
        'result_grades',
        'result_status',
        'result_subject',
    ];
}
