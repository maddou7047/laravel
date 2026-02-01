<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keuzedeel;
use Illuminate\Http\Request;

class KeuzdeelController extends Controller
{
    //

    public function index()
    {
        $keuzedelen = Keuzedeel::all();
        return view('keuzedelen.index', compact('keuzedelen'));
    }

    public function create()
    {
        return view('keuzedelen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Code' => 'required|unique:keuzedelen,Code',
            'Name' => 'required|max:255',
            'Description' => 'required',
            'Periode' => 'required|integer|between:1,4',
            'MaxStudents' => 'nullable|integer|min:1',
        ], [
            'Code.required' => 'Keuzedeelcode is verplicht',
            'Code.unique' => 'Deze code bestaat al',
            'Name.required' => 'Naam is verplicht',
            'Description.required' => 'Beschrijving is verplicht',
            'Periode.required' => 'Periode is verplicht',
        ]);

        $validated['IsActive'] = $request->has('IsActive');
        $validated['MinStudents'] = 15;
        $validated['IsRepeatable'] = false;
        $validated['Content'] = $validated['Description'];

        Keuzedeel::create($validated);

        return redirect()->route('keuzedelen.index')
            ->with('success', 'Keuzedeel succesvol aangemaakt!');
    }

    public function show(Keuzedeel $keuzedeel)
    {
        return view('keuzedelen.show', compact('keuzedeel'));
    }

    public function update(Request $request, Keuzedeel $keuzedeel)
    {
        $validated = $request->validate([
            'Code' => 'required|max:50|unique:keuzedelen,Code,' . $keuzedeel->id,
            'Name' => 'required|max:255',
            'Description' => 'required',
            'Periode' => 'required|integer|between:1,4',
            'MaxStudents' => 'nullable|integer|min:1',
        ]);

        $validated['IsActive'] = $request->has('IsActive');

        $keuzedeel->update($validated);

        return redirect()->route('keuzedelen.show', $keuzedeel)
            ->with('success', 'Keuzedeel bijgewerkt!');
    }

    public function destroy(Keuzedeel $keuzedeel)
    {
        $keuzedeel->delete();

        return redirect()->route('keuzedelen.index')
            ->with('success', 'Keuzedeel verwijdered');
    }

    public function edit(Keuzedeel $keuzedeel)
    {
        return view('keuzedelen.edit', compact('keuzedeel'));
    }
}
