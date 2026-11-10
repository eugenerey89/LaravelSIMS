<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table = 'student';
    protected $fillable = [
        'first_name',
        'middle_initial',
        'last_name',
        'email',
        'phone',
        'course',
        'year',
    ];
}
