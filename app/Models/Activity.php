<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'activity_name',
        'activity_description',
        'activity_starttime',
        'activity_endtime',
        'activity_date',
        'activity_remarks',
    ];
}
