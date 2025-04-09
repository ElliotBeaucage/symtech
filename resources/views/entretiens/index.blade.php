<x-layout :user="auth()->user()">

    <main class="min-h-screen bg-gray-100 py-10 px-6 flex flex-col lg:flex-row lg:justify-center">
        <!-- Sidebar Formulaire d'ajout de client -->
        <aside class="w-full max-w-xs p-6 bg-white rounded-lg shadow-lg mb-8 lg:mb-0 lg:mr-8">


            <form action="{{ route('entretien.create', ['buildings' => $buildings->id]) }}" method="GET">
                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-[#002b59] focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    Ajouter un entretien
                </button>
            </form>

            <div class="mt-6">
                <a href="{{ route('buildings.index', ['client' => $buildings->client_id]) }}"
                    class="w-full inline-block text-center px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002b59]">
                    Retour aux bâtiments
                </a>
            </div>
        </aside>


        <!-- Section de la liste de clients -->
        <div class="flex-1">
            <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center">
                Entretiens pour le bâtiment : {{ $buildings->adresse }}
            </h1>

            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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

                @forelse ($entretiens as $e)
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-500 mb-2">
                            Date : {{ $e->created_at->format('d/m/Y à H:i') }}
                        </p>

                        <ul class="grid grid-cols-2 gap-2 text-sm">
                            @foreach ($labels as $field => $label)
                                <li class="flex justify-between">
                                    <span class="text-gray-700">{{ $label }}</span>
                                    <span>{!! $e->$field ? '✅' : '❌' !!}</span>
                                </li>
                            @endforeach

                        </ul>
                        @if ($e->description)
                            <div class="mt-4">
                                <p class="text-sm font-semibold text-gray-700 mb-1">Description :</p>
                                <p class="text-sm text-gray-800">{{ $e->description }}</p>
                            </div>
                        @endif

                        <div class="mt-4">
                            <p class="text-sm text-gray-700 mb-1">Signature :</p>
                            <img src="{{ asset('storage/' . $e->image) }}" alt="Signature"
                                class="w-full h-auto border border-gray-300 rounded">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('entretiens.edit', $e->id) }}"
                                class="text-[#003E7E] hover:underline font-semibold">
                                Modifier
                            </a>
                            <a href="{{ route('entretien.pdf', $e->id) }}"
                                class="text-green-700 hover:underline font-semibold">
                                Télécharger PDF
                            </a>

                            <form action="{{ route('entretiens.destroy', $e->id) }}" method="POST"
                                onsubmit="return confirm('Supprimer cet entretien ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600 col-span-3">Aucun entretien trouvé pour ce bâtiment.</p>
                @endforelse
                {{-- === Section des photos physiques non liées (affichées ensemble) === --}}
                @if ($images->count())
                    <div class="mt-12 bg-gray-100 p-6 rounded-lg shadow-inner">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">
                            Photos des entretiens (non liées à une fiche)
                        </h2>

                        <p class="text-sm text-gray-600 text-center mb-6">
                            {{ $images->count() }} photo(s) enregistrée(s)
                        </p>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($images as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Photo entretien"
                                    class="w-full h-auto border border-gray-300 rounded">
                            @endforeach

                        </div>
                    </div>
                @endif

            </div>


        </div>
    </main>





</x-layout>
