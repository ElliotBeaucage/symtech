<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10 px-6 flex justify-center">
        <div class="w-full max-w-xl bg-white p-6 rounded-lg shadow-lg space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">Ajouter un entretien</h2>

            {{-- Upload d'images
            <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <label class="block text-gray-700 font-medium">Photos associées :</label>
                <input type="file" name="images[]" multiple class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                <button type="submit" class="w-full bg-[#003E7E] text-white py-2 rounded hover:bg-[#002b59]">Ajouter les images</button>
            </form> --}}

            {{-- Formulaire d'entretien --}}
            <form method="POST" action="{{ route('entretien.store') }}" onsubmit="saveSignature()" class="space-y-4">
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
                    ];
                @endphp

                @foreach($labels as $name => $label)
                    <label class="flex items-center gap-2 text-gray-700">
                        <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1" class="form-checkbox text-blue-600">
                        {{ $label }}
                    </label>
                @endforeach
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium">Description du travail</label>
                    <textarea name="description" id="description"
                              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                              rows="4">{{ old('description', $entretien->description ?? '') }}</textarea>
                </div>

                {{-- Signature --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Signature :</label>
                    <div class="border border-gray-300 rounded bg-white">
                        <canvas id="signature-pad" class="w-full h-52"></canvas>
                    </div>
                    <input type="hidden" name="signature" id="signature-data">
                    <div class="flex gap-4 mt-2">
                        <button type="button" onclick="clearSignature()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Effacer</button>
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
