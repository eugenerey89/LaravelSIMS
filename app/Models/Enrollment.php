<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    public const STATUSES = ['Enrolled', 'Completed', 'Dropped'];
    public const SEMESTERS = ['1st', '2nd', 'Summer'];

    protected $fillable = ['student_id', 'subject_id', 'school_year', 'semester', 'status', 'grade'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
