<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('keuzedelen.index') }}" class="inline-flex items-center text-sm text-blue-600 hover:underline mb-6">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Terug naar overzicht
            </a>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-white">{{ $keuzedeel->Name }}</h1>
                            <p class="text-blue-200 text-sm mt-1">Code: {{ $keuzedeel->Code }}</p>
                        </div>
                        @if($keuzedeel->IsActive)
                            <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">Actief</span>
                        @else
                            <span class="px-3 py-1 bg-gray-400 text-white text-xs font-semibold rounded-full">Inactief</span>
                        @endif
                    </div>
                </div>

                <div class="p-8">

                    <p class="text-gray-600 text-base leading-relaxed mb-2">{{ $keuzedeel->Description }}</p>
                    @if($keuzedeel->Content && $keuzedeel->Content !== $keuzedeel->Description)
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $keuzedeel->Content }}</p>
                    @endif

                    @php
                        $currentCount = $keuzedeel->Enrollments()->count();
                        $spotsLeft = $keuzedeel->MaxStudents - $currentCount;
                        $fillPercent = $keuzedeel->MaxStudents > 0
                            ? min(100, (int)(($currentCount / $keuzedeel->MaxStudents) * 100))
                            : 0;
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Periode</p>
                            <p class="text-lg font-semibold text-gray-800 mt-1">Periode {{ $keuzedeel->Periode }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Ingeschreven</p>
                            <p class="text-lg font-semibold text-gray-800 mt-1">{{ $currentCount }} / {{ $keuzedeel->MaxStudents }}</p>
                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                <div class="h-2 rounded-full {{ $fillPercent >= 100 ? 'bg-red-500' : ($fillPercent >= 70 ? 'bg-yellow-500' : 'bg-blue-500') }}"
                                     style="width: {{ $fillPercent }}%"></div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Beschikbaar</p>
                            <p class="text-lg font-semibold mt-1 {{ $spotsLeft <= 0 ? 'text-red-600' : ($spotsLeft <= 5 ? 'text-yellow-600' : 'text-green-600') }}">
                                {{ $spotsLeft <= 0 ? 'Vol' : $spotsLeft . ' plaatsen' }}
                            </p>
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->Role === 'student')
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Inschrijving</h3>

                                @php
                                    $isEnrolled = auth()->user()->Enrollments()
                                        ->where('KeuzdeelId', $keuzedeel->id)
                                        ->exists();
                                    $isFull = $currentCount >= $keuzedeel->MaxStudents;
                                @endphp

                                @if($isEnrolled)
                                    <div class="flex items-center justify-between bg-green-50 border border-green-200 rounded-lg p-4">
                                        <span class="inline-flex items-center text-green-700 font-semibold">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Je bent ingeschreven
                                        </span>
                                        <form method="POST" action="{{ route('enrollments.destroy', $keuzedeel) }}"
                                              onsubmit="return confirm('Weet je zeker dat je je inschrijving wilt annuleren?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition">
                                                Uitschrijven
                                            </button>
                                        </form>
                                    </div>

                                @elseif($isFull)
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                        <p class="text-red-700 font-medium">Dit keuzedeel is vol.</p>
                                        <p class="text-red-500 text-sm mt-1">Het maximaal aantal studenten is bereikt. Kies een ander keuzedeel.</p>
                                    </div>

                                @elseif(!$keuzedeel->IsActive)
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                        <p class="text-yellow-700 font-medium">Dit keuzedeel is niet actief.</p>
                                        <p class="text-yellow-600 text-sm mt-1">Inschrijvingen zijn momenteel niet mogelijk.</p>
                                    </div>

                                @else
                                    <form method="POST" action="{{ route('enrollments.store', $keuzedeel) }}">
                                        @csrf
                                        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition shadow-sm hover:shadow-md">
                                            Inschrijven voor dit keuzedeel
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif

                        @if(auth()->user()->Role === 'admin')
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">Inschrijvingsoverzicht</h3>
                                    <div class="flex gap-2">
                                        <a href="{{ route('keuzedelen.edit', $keuzedeel) }}" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Bewerken</a>
                                        <form method="POST" action="{{ route('keuzedelen.destroy', $keuzedeel) }}"
                                              onsubmit="return confirm('Verwijder dit keuzedeel permanent? Dit kan niet ongedaan worden gemaakt.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-sm bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">Verwijderen</button>
                                        </form>
                                    </div>
                                </div>

                                @if($currentCount < $keuzedeel->MinStudents)
                                    <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-r-lg mb-4">
                                        <p class="font-medium">⚠️ Onder minimum</p>
                                        <p class="text-sm mt-1">{{ $currentCount }} ingeschreven, minimaal {{ $keuzedeel->MinStudents }} nodig om door te gaan.</p>
                                    </div>
                                @endif

                                @if($keuzedeel->Enrollments->count() > 0)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                                        <table class="w-full text-sm">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Student</th>
                                                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Status</th>
                                                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Ingeschreven op</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100">
                                                @foreach($keuzedeel->Enrollments as $enrollment)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-4 py-3 text-gray-800 font-medium">{{ $enrollment->User->name }}</td>
                                                        <td class="px-4 py-3">
                                                            <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                                                {{ ucfirst($enrollment->Status) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 text-gray-500">{{ $enrollment->EnrolledAt->format('d-m-Y H:i') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                                        <p class="text-gray-500 italic">Nog geen studenten ingeschreven.</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>
</x-app-layout>