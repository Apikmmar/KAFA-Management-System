<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // allow to input
    protected $fillable = [
        'classroom_id',
        'activity_name',
        'activity_description',
        'activity_starttime',
        'activity_endtime',
        'activity_date',
        'activity_remarks',
    ];

    // many to one relationship with Classroom model
    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    // one to one relationship with Result model
    public function result() {
        return $this->hasOne(Result::class);
    }

    // many to one relationship with Subject model
    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
