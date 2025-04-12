<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10 px-4">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Images de la machine : {{ $machine->nom }}</h1>

            {{-- 🔙 Bouton retour --}}
            <div class="mb-6">
                <a href="{{ route('machines.index', ['buildings' => $machine->building_id]) }}"
                   class="inline-block px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002b59] transition">
                    ← Retour à la liste des machines
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
            @endif

            {{-- Formulaire d'ajout --}}
            <form method="POST" action="{{ route('machines.images.store', $machine->id) }}" enctype="multipart/form-data" class="mb-6">
                @csrf
                <label class="block mb-2 text-sm font-medium text-gray-700">Ajouter des images</label>
                <input type="file" name="images[]" multiple
                       class="w-full border border-gray-300 rounded px-3 py-2 mb-3">
                <button type="submit"
                        class="px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002b59]">
                    Ajouter
                </button>
            </form>

            {{-- Affichage des images avec zoom fullscreen --}}
            <div
                x-data="{ open: false, imageUrl: '' }"
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"
            >
                @forelse ($machine->images as $img)
                    <div class="relative border rounded overflow-hidden cursor-pointer"
                         @click="open = true; imageUrl = '{{ asset('storage/' . $img->image_path) }}'">
                        <img src="{{ asset('storage/' . $img->image_path) }}"
                             class="w-full h-32 object-cover rounded transition hover:scale-105 duration-200">

                        {{-- Bouton de suppression --}}
                        <form action="{{ route('machines.images.destroy', $img->id) }}" method="POST" class="absolute top-1 right-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 font-bold text-xs bg-white rounded px-1 hover:text-red-800">
                                ✕
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-600 col-span-full">Aucune image disponible.</p>
                @endforelse

                {{-- MODAL FULLSCREEN --}}
                <div x-show="open"
                     x-transition
                     @click.away="open = false"
                     class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center">
                    <div class="max-w-4xl w-full p-4">
                        <img :src="imageUrl" class="mx-auto rounded-lg shadow-lg max-h-[90vh]">
                        <button @click="open = false"
                                class="mt-4 block mx-auto px-4 py-2 bg-white text-black rounded hover:bg-gray-200">
                            Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
