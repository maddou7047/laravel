<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-6">Keuzedeel Bewerken</h1>

            <form method="POST" action="{{ route('keuzedelen.update', $keuzedeel) }}" class="bg-white p-6 rounded-lg shadow">
                @csrf
                @method('PUT')

                <!-- Copy all form fields from create.blade.php but add value="{{ $keuzedeel->Name }}" etc -->
                
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Bijwerken
                </button>
            </form>
        </div>
    </div>
</x-app-layout>