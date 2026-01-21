<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuzedeel extends Model
{
    //

    protected $table = 'keuzedelen';

    protected $fillable = [
        'Code',
        'Name',
        'Description',
        'Content',
        'MaxStudents',
        'MinStudents',
        'IsActive',
        'IsRepeatable',
        'Periode'
    ];


    protected $casts = [
        "IsActive" => 'boolean',
        'IsRepeatable' => 'boolean',
        'MaxStudents' => 'integer',
        'MinStudents' => 'integer',
        'Periode' => 'integer'
    ];


    public function Enrollments()
    {
        return $this->hasMany(Enrollment::class, 'KeuzdeelId');
    }

    public function IsFull()
    {
        return $this->Enrollments()->count() >= $this->MaxStudents;
    }

    public function IsBelowMinimum()
    {
        return $this->Enrollments()->count() < $this->MinStudents;
    }

    public function scopeActive($query)
    {
        return $query->where('IsActive', true);
    }
}
