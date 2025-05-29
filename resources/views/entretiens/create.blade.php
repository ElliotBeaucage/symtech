<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10 px-6 flex justify-center">
        <div class="w-full max-w-xl bg-white p-6 rounded-lg shadow-lg space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">Ajouter un entretien</h2>

            {{-- Formulaire d'entretien --}}
            <form method="POST" action="{{ route('entretien.store') }}" onsubmit="saveSignature()" class="space-y-4"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="building_id" id="building_id" value="{{ $buildings }}">


                @php
                    $labels = [
                        'f1' => 'Fourniture et remplacement des filtres',
                        'v1' => 'Vérification, ajustement et remplacement des courroies',
                        'v2' => 'Vérification des poulies d’entraînement',
                        'v3' => 'Vérification des contrôles de protection du système',
                        'v4' => 'Vérification et lubrification des moteurs et roulements à billes',
                        'v5' => 'Nettoyage de la panne et du drain de condensation',
                        'v6' =>
                            'La mise en opération de l"umidificateur à l"automne et à l"arret de celle-ci au printemps (Selon température).',
                        'v7' => 'Vérification des serpentins sur les unités de condensation et d"évaporation.',
                        'v8' => 'Vérification du bon fonctionnement du système',
                    ];
                @endphp

                <div class="space-y-2">
                    @foreach ($labels as $field => $label)
                        <label class="flex items-center gap-3 text-sm text-gray-700">
                            <input type="checkbox" name="{{ $field }}" value="1"
                                class="form-checkbox text-[#003E7E] focus:ring-[#003E7E]"
                                {{ old($field) ? 'checked' : '' }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>


                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium">Description du travail</label>
                    <textarea name="description" id="description"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                        rows="4">{{ old('description', $entretien->description ?? '') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="images" class="block text-sm font-medium text-gray-700">Ajouter des photos</label>
                    <input type="file" name="images[]" multiple
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                </div>

                {{-- Signature --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Signature :</label>
                    <div class="border border-gray-300 rounded bg-white">
                        <canvas id="signature-pad" class="w-full h-52"></canvas>
                    </div>
                    <input type="hidden" name="signature" id="signature-data">
                    <div class="flex gap-4 mt-2">
                        <button type="button" onclick="clearSignature()"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Effacer</button>
                    </div>
                </div>

                {{-- Soumettre --}}
                <div class="text-right">
                    <button type="submit" class="px-6 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002b59]">
                        Ajouter l’entretien
                    </button>
                </div>
                <div class="text-left mt-4">
                    <a href="{{ route('entretien.index', ['buildings' => $buildings]) }}"
                        class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        ← Retour
                    </a>
                </div>

            </form>
        </div>
    </main>

    {{-- Signature Pad Script --}}
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);

        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }

        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        function clearSignature() {
            signaturePad.clear();
        }

        function saveSignature() {
            if (!signaturePad.isEmpty()) {
                const dataURL = signaturePad.toDataURL();
                document.getElementById('signature-data').value = dataURL;
            }
        }
    </script>
</x-layout>
