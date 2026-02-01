<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Nieuw Keuzedeel</h1>
                <a href="{{ route('keuzedelen.index') }}" class="text-blue-600 hover:underline">← Terug naar overzicht</a>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <p class="font-semibold mb-1">Er zijn fouten opgetreden:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('keuzedelen.store') }}" class="bg-white p-6 rounded-lg shadow">
                @csrf

                <!-- Code -->
                <div class="mb-5">
                    <label for="Code" class="block text-gray-700 font-semibold mb-2">Keuzedeelcode *</label>
                    <input type="text"
                           id="Code"
                           name="Code"
                           value="{{ old('Code') }}"
                           placeholder="Bijv. 25604K0060"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('Code') ? 'border-red-500' : 'border-gray-300' }}">
                    @error('Code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div class="mb-5">
                    <label for="Name" class="block text-gray-700 font-semibold mb-2">Naam *</label>
                    <input type="text"
                           id="Name"
                           name="Name"
                           value="{{ old('Name') }}"
                           placeholder="Naam van het keuzedeel"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('Name') ? 'border-red-500' : 'border-gray-300' }}">
                    @error('Name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <label for="Description" class="block text-gray-700 font-semibold mb-2">Beschrijving *</label>
                    <textarea id="Description"
                              name="Description"
                              rows="4"
                              placeholder="Beschrijf het keuzedeel"
                              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('Description') ? 'border-red-500' : 'border-gray-300' }}">{{ old('Description') }}</textarea>
                    @error('Description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Periode -->
                <div class="mb-5">
                    <label for="Periode" class="block text-gray-700 font-semibold mb-2">Periode *</label>
                    <select id="Periode"
                            name="Periode"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $errors->has('Periode') ? 'border-red-500' : 'border-gray-300' }}">
                        <option value="">— Selecteer periode —</option>
                        <option value="1" {{ old('Periode') == 1 ? 'selected' : '' }}>Periode 1</option>
                        <option value="2" {{ old('Periode') == 2 ? 'selected' : '' }}>Periode 2</option>
                        <option value="3" {{ old('Periode') == 3 ? 'selected' : '' }}>Periode 3</option>
                        <option value="4" {{ old('Periode') == 4 ? 'selected' : '' }}>Periode 4</option>
                    </select>
                    @error('Periode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- MaxStudents -->
                <div class="mb-5">
                    <label for="MaxStudents" class="block text-gray-700 font-semibold mb-2">Maximaal aantal studenten</label>
                    <input type="number"
                           id="MaxStudents"
                           name="MaxStudents"
                           value="{{ old('MaxStudents', 30) }}"
                           min="1"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 border-gray-300">
                </div>

                <!-- IsActive -->
                <div class="mb-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox"
                               name="IsActive"
                               value="1"
                               {{ old('IsActive') ? 'checked' : 'checked' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                        <span class="ml-2 text-gray-700 font-semibold">Actief</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-4 border-t">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                        Aanmaken
                    </button>
                    <a href="{{ route('keuzedelen.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                        Annuleren
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>