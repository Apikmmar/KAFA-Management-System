<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_type',
        'school_session',
        'approval_status',
        'exam_comment',
    ];

    public function result() {
        return $this->hasMany(Result::class);
    }
}
