<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notice_title',
        'notice_text',
        'notice_poster',
        'notice_submission_date',
        'notice_status',
    ];

    public function notices() {
        return $this->belongsTo(User::class);
    }
}
