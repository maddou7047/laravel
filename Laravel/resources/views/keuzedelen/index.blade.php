<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Keuzedelen</h1>
                
                @auth
                    @if(auth()->user()->Role === 'admin')
                        <a href="{{ route('keuzedelen.create') }}" 
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            + Nieuw Keuzedeel
                        </a>
                    @endif
                @endauth
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($keuzedelen as $keuzedeel)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-xl font-bold">{{ $keuzedeel->Name }}</h2>
                            
                            @if($keuzedeel->IsActive)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Actief</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded">Inactief</span>
                            @endif
                        </div>

                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($keuzedeel->Description, 100) }}</p>

                        <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                            <span>Periode {{ $keuzedeel->Periode }}</span>
                            <span>{{ $keuzedeel->Enrollments()->count() }} / {{ $keuzedeel->MaxStudents }}</span>
                        </div>

                        <a href="{{ route('keuzedelen.show', $keuzedeel) }}" 
                           class="block text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Bekijk Details
                        </a>
                    </div>
                @endforeach
            </div>

            @if($keuzedelen->isEmpty())
                <div class="text-center py-12 text-gray-500">
                    <p class="text-xl">Geen keuzedelen beschikbaar</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>