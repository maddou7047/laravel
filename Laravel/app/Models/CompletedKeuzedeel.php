<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompletedKeuzedeel extends Model
{
    //

    protected $table = 'completed_keuzedelen';


    protected $fillable = [
        'UserId',
        'KeuzdeelCode',
        'CompletedAt',
        'ImportedAt',
    ];


    protected $casts = [
        'CompletedAt'=>'dateTime',
        'ImportedAt'=>'dateTime'
    ];

    public function User(){
        return $this->belongsTo(User::class,'UserId');
    }
}
