<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'parent_id',
        'student_name',
        'student_ic',
        'student_age',
        'student_gender',
        'student_verification',
    ];

    public function student() {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    public function result() {
        return $this->hasMany(Result::class);
    }
}