<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10 px-6 flex justify-center">
        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Modifier un entretien</h2>

            <form action="{{ route('entretiens.update', $entretien->id) }}" method="POST">
                @csrf
                @method('PUT')

                @php
                    $labels = [
                        'f1' => 'Fourniture et remplacement des filtres',
                        'v1' => 'Vérification, ajustement et remplacement des courroies',
                        'v2' => 'Vérification des poulies d’entraînement',
                        'v3' => 'Vérification des contrôles de protection du système',
                        'v4' => 'Vérification et lubrification des moteurs et roulements à billes',
                        'v5' => 'Nettoyage de la panne et du drain de condensation',
                    ];
                @endphp

                @foreach($labels as $field => $label)
                    <label class="flex items-center gap-2 mb-2 text-gray-700">
                        <input type="checkbox" name="{{ $field }}" value="1"
                               @checked($entretien->$field)
                               class="form-checkbox text-blue-600">
                        {{ $label }}
                    </label>
                @endforeach
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium">Description du travail</label>
                    <textarea name="description" id="description"
                              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                              rows="4">{{ old('description', $entretien->description ?? '') }}</textarea>
                </div>

                <div class="mt-6 flex justify-between">
                    <a href="{{ route('entretien.index', ['buildings' => $building->id]) }}"
                       class="text-gray-600 hover:underline">← Retour</a>

                    <button type="submit"
                            class="px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002b59]">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-layout>
