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
        'activity_id',
        'examination_id',
        'result_marks',
        'result_feedback',
        'result_grades',
        'result_status',
        'result_subject',
    ];

    public function studentresult() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function markbyteacher() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function examination() {
        return $this->belongsTo(Examination::class);
    }

    public function activity() {
        return $this->belongsTo(Activity::class);
    }
}
