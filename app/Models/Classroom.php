<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Action;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_name',
        'class_description',
    ];

    public function teacher() {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
    
    public function students() {
        return $this->hasMany(Student::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }
}
