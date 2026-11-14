<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_number', 'first_name', 'last_name', 'email', 'birthdate',
        'gender', 'phone', 'address', 'course', 'year_level',
    ];

    protected $casts = ['birthdate' => 'date'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'enrollments')->withPivot('school_year', 'semester', 'status', 'grade');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeSearch($query, ?string $term)
    {
        return $term
            ? $query->where(fn ($q) => $q->where('first_name', 'like', "%$term%")
                ->orWhere('last_name', 'like', "%$term%")
                ->orWhere('student_number', 'like', "%$term%")
                ->orWhere('email', 'like', "%$term%")
                ->orWhere('course', 'like', "%$term%"))
            : $query;
    }
}
