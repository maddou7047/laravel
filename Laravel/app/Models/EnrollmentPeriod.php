<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentPeriod extends Model
{
    //
    protected $fillable = [
        'Name',
        'StartDate',
        'EndDate',
        'IsActive'
    ];

    protected $casts = [
        'StartDate' => 'datetime',
        'EndDate' => 'datetime',
        'IsActive' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('IsActive', true);
    }

    public function IsOpen()
    {
        $now = now();
        return $this->IsActive
            && $now->greaterThanOrEqualTo($this->StartDate)
            && $now->lessThanOrEqualTo($this->EndDate);
    }
}
