<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    //
  

    protected $fillable = [
        'UserId',
        'KeuzdeelId',
        'Status',
        'EnrolledAt'
    ];

    public $timestamps = true;

    protected $casts = [
        'EnrolledAt'=> 'datetime',
    ];

    public function User(){
        return $this->belongsTo(User::class,'UserId');

    }

    public function Keuzedeel(){
        return $this->belongsTo(Keuzedeel::class, 'KeuzdeelId');
    }


}
