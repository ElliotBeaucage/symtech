<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4 flex justify-center">
            <div class="w-full max-w-xl bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Modifier un entretien</h2>

                <form action="{{ route('entretiens.update', $entretien->id) }}" method="POST" class="space-y-4">
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

                    <div class="space-y-2">
                        @foreach($labels as $field => $label)
                            <label class="flex items-center gap-3 text-sm text-gray-700">
                                <input type="checkbox" name="{{ $field }}" value="1"
                                       @checked($entretien->$field)
                                       class="form-checkbox text-[#003E7E] focus:ring-[#003E7E]">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description du travail
                        </label>
                        <textarea name="description" id="description"
                                  class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E] resize-none"
                                  rows="4">{{ old('description', $entretien->description ?? '') }}</textarea>
                    </div>

                    <div class="pt-4 flex justify-between items-center">
                        <a href="{{ route('entretien.index', ['buildings' => $building->id]) }}"
                           class="text-sm text-gray-600 hover:underline">
                            ← Retour
                        </a>

                        <button type="submit"
                                class="px-5 py-2 text-white bg-[#003E7E] rounded hover:bg-[#002b59] transition focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>
