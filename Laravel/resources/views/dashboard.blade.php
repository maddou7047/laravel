<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Gather data once --}}
            @php
                $user = auth()->user();
                $enrollments = $user->Enrollments()->with('Keuzedeel')->get();
                $completed = $user->CompletedKeuzedelen()->get();
                $availableCount = \App\Models\Keuzedeel::where('IsActive', true)->count();
            @endphp

            {{-- Stat cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <p class="text-sm text-gray-500 uppercase tracking-wide">Actieve Inschrijvingen</p>
                    <p class="text-4xl font-bold text-blue-600 mt-2">{{ $enrollments->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <p class="text-sm text-gray-500 uppercase tracking-wide">Voltooide Keuzedelen</p>
                    <p class="text-4xl font-bold text-green-600 mt-2">{{ $completed->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <p class="text-sm text-gray-500 uppercase tracking-wide">Beschikbaar</p>
                    <p class="text-4xl font-bold text-gray-700 mt-2">{{ $availableCount }}</p>
                </div>
            </div>

            {{-- Current enrollments --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-8">
                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Mijn Inschrijvingen</h3>
                    <a href="{{ route('keuzedelen.index') }}" class="text-sm text-blue-600 hover:underline">Bekijk alle keuzedelen →</a>
                </div>

                @if($enrollments->isEmpty())
                    <div class="p-6 text-center text-gray-400">
                        <p>Je bent nog niet ingeschreven voor een keuzedeel.</p>
                        <a href="{{ route('keuzedelen.index') }}" class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                            Zoek een keuzedeel
                        </a>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($enrollments as $enrollment)
                            <div class="flex items-center justify-between p-4 px-6 hover:bg-gray-50">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $enrollment->Keuzedeel->Name }}</p>
                                    <p class="text-sm text-gray-500">
                                        Code: {{ $enrollment->Keuzedeel->Code }} · Periode {{ $enrollment->Keuzedeel->Periode }} · Ingeschreven op {{ $enrollment->EnrolledAt->format('d-m-Y') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('keuzedelen.show', $enrollment->Keuzedeel) }}" class="text-sm text-blue-600 hover:underline">Details</a>
                                    <form method="POST" action="{{ route('enrollments.destroy', $enrollment->Keuzedeel) }}"
                                          onsubmit="return confirm('Weet je zeker dat je je inschrijving voor {{ $enrollment->Keuzedeel->Name }} wilt annuleren?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-700">Uitschrijven</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Completed keuzedelen --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">Voltooide Keuzedelen</h3>
                    <p class="text-sm text-gray-500 mt-1">Uit het schoolsysteem geïmporteerd</p>
                </div>

                @if($completed->isEmpty())
                    <div class="p-6 text-center text-gray-400">
                        <p>Nog geen voltooide keuzedelen geregistreerd.</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($completed as $item)
                            <div class="flex items-center justify-between p-4 px-6">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $item->KeuzdeelCode }}</p>
                                    <p class="text-sm text-gray-500">Voltooid op {{ $item->CompletedAt->format('d-m-Y') }}</p>
                                </div>
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Afgerond</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>