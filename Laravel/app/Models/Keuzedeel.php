<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuzedeel extends Model
{
    //

    protected $table = 'keuzedeel';

    protected $filltable = [
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


    public function Enrollments(){
        return $this->hasMany(Enrollment::class,'KeuzedeelID');
    }

    public function IsFull(){
        $MaxStudents = $this->MaxStudents;
        $Count = $this->Enrollments()->count();
        return $Count >= $MaxStudents;
    }

     public function IsBelowMinimum()
    {
        $MinStudents = $this->MinStudents;
        $Count = $this->Enrollments()->count();
        return $Count < $MinStudents;
    }

    public function scopeActive($query)
    {
        return $query->where('IsActive', true);
    }

}
