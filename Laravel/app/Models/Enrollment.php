<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    //
    protected $table = 'enrollments';

    protected $fillable = [
        'UserId',
        'KeuzdeelId',
        'Status',
        'EnrolledAt'
    ];

    protected $casts = [
        'EnrolledAt'=> 'dateTime',
    ];

    public function user(){
        return $this->belongsTo(User::class,'UserId');

    }

    public function Keuzedeel(){
        return $this->belongsTo(Keuzedeel::class, 'KeuzdeelId');
    }


}
