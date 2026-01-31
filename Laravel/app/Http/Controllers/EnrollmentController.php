<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\EnrollmentPeriod;
use App\Models\Keuzedeel;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    //
    public function Store(Request $request, Keuzedeel $keuzedeel)
    {
        $user = auth()->user();

        $activePeriod = EnrollmentPeriod::where('IsActive', true)
            ->where('StartDate', '<=', now())
            ->where('EndDate', '>=', now())
            ->first();

        if (!$activePeriod) {
            return back()->with('Error', 'Er is momenteel geen inscrhijven periode. Probeer later');
        }

        $existingEnrollment = Enrollment::where('UserId', $user->id)
            ->where('KeuzdeelId', $keuzedeel->id)
            ->exists();


        if ($existingEnrollment) {
            return back()->with('error', 'Je bent al ingescreven. Ga gewoon door');
        }

        if (!$keuzedeel->IsRepeatable) {
            $hasCompleted = $user->CompletedKeuzedelen()
                ->where('KeuzdeelCode', $keuzedeel->Code)
                ->exists();

            if ($hasCompleted) {
                return back()->with('error', 'Je hebt dit keuzedeel al afgerond en je kan niet nog een keer op nieuw doen.');
            }
        }

        $currentEnrollmentCount = $keuzedeel->Enrollments()->count();
        if ($currentEnrollmentCount >= $keuzedeel->MaxStudents) {
            return back()->with('error', 'Dit keuzedeel is al vol, kiez een andere alsteblief');
        }

        if (!$keuzedeel->IsActive) {
            return back()->with('error', 'Dit keuzedeel is niet actief');
        }


        Enrollment::create([
            'UserId' => $user->id,
            'KeuzdeelId' => $keuzedeel->id,
            'Status' => 'pending',
            'EnrolledAt' => now()
        ]);


        return back()->with('success', 'Je bent succesvol ingeschreven voor ' . $keuzedeel->Name . '!');
    }


    public function Destroy(Keuzedeel $keuzedeel)
    {
        $user = auth()->user();


        $enrollment = Enrollment::where('UserId', $user->id)
            ->where('KeuzdeelId', $keuzedeel->id)
            ->first();
        if (!$enrollment) {
            return back()->with('error', ' Je bent niet ingescreven voor dit keuzedeel');
        }

        $enrollment->delete();
        return back()->with('success', 'Je inschrijving is geannulered');
    }
}
