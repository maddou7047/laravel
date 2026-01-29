@auth
    @if(auth()->user()->Role === 'student')
        <div class="mt-8 border-t pt-6">
            <h3 class="text-xl font-semibold mb-4">Inschrijving</h3>

            @php
                $isEnrolled = auth()->user()->Enrollments()
                    ->where('KeuzdeelId', $keuzedeel->id)
                    ->exists();
                
                $currentCount = $keuzedeel->Enrollments()->count();
                $isFull = $currentCount >= $keuzedeel->MaxStudents;
                $spotsLeft = $keuzedeel->MaxStudents - $currentCount;
            @endphp

            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-sm text-gray-600 mb-4">
                    <strong>Beschikbare plaatsen:</strong> {{ $spotsLeft }} / {{ $keuzedeel->MaxStudents }}
                </p>

                @if($isEnrolled)
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Ingeschreven
                        </span>

                        <form method="POST" action="{{ route('enrollments.destroy', $keuzedeel) }}" onsubmit="return confirm('Weet je zeker dat je je inschrijving wilt annuleren?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition">
                                Uitschrijven
                            </button>
                        </form>
                    </div>

                @elseif($isFull)
                    <div class="px-4 py-2 bg-red-100 text-red-700 rounded-lg border border-red-300">
                        <strong>Vol</strong> — Dit keuzedeel heeft het maximaal aantal studenten bereikt.
                    </div>

                @elseif(!$keuzedeel->IsActive)
                    <div class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-300">
                        <strong>Niet actief</strong> — Dit keuzedeel is momenteel niet beschikbaar.
                    </div>

                @else
                    <form method="POST" action="{{ route('enrollments.store', $keuzedeel) }}">
                        @csrf
                        <button type="submit" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition shadow-md hover:shadow-lg">
                            Inschrijven voor dit keuzedeel
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endif

    {{-- Admin Overview --}}
    @if(auth()->user()->Role === 'admin')
        <div class="mt-8 border-t pt-6">
            <h3 class="text-xl font-semibold mb-4">Inschrijvingsoverzicht (Admin)</h3>

            @php
                $enrollmentCount = $keuzedeel->Enrollments()->count();
            @endphp

            @if($enrollmentCount < $keuzedeel->MinStudents)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                    <strong>⚠️ Waarschuwing:</strong> Momenteel {{ $enrollmentCount }} ingeschreven, minimaal {{ $keuzedeel->MinStudents }} nodig.
                </div>
            @endif

            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="font-semibold mb-3">Ingeschreven studenten ({{ $enrollmentCount }}):</p>

                @if($keuzedeel->Enrollments->count() > 0)
                    <ul class="space-y-2">
                        @foreach($keuzedeel->Enrollments as $enrollment)
                            <li class="flex items-center justify-between p-2 bg-white rounded border">
                                <span>{{ $enrollment->User->name }}</span>
                                <span class="text-sm text-gray-500">
                                    Status: <strong>{{ $enrollment->Status }}</strong> | 
                                    Ingeschreven op: {{ $enrollment->EnrolledAt->format('d-m-Y H:i') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic">Nog geen studenten ingeschreven.</p>
                @endif
            </div>
        </div>
    @endif
@endauth