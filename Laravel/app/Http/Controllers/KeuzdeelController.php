<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keuzedeel;
use Illuminate\Http\Request;

class KeuzdeelController extends Controller
{
    //

    public function Index(){
        $Keuzedeel = Keuzedeel::where('IsActive',true) 
        ->withcount('Enrollments')
        ->orderBy('Name')
        ->get() 
        ;

        return view('keuzedelen.index',compact('keuzedelen'));
    }
}
