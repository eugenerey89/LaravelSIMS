<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code', 'name', 'units', 'description'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function scopeSearch($query, ?string $term)
    {
        return $term
            ? $query->where(fn ($q) => $q->where('code', 'like', "%$term%")->orWhere('name', 'like', "%$term%"))
            : $query;
    }
}
