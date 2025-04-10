<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:space-x-8">

                {{-- FORMULAIRE & RECHERCHE --}}
                <aside class="w-full lg:max-w-sm bg-white p-6 rounded-lg shadow mb-8 lg:mb-0">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ajouter un Bâtiment</h2>

                    <form action="{{ route('buildings.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        <div>
                            <label for="building-name" class="block text-sm font-medium text-gray-700">Nom du bâtiment (adresse)</label>
                            <input type="text" id="building-name" name="name" required
                                   placeholder="Nom du bâtiment"
                                   class="w-full px-4 py-2 mt-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                        </div>

                        <button type="submit"
                                class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-[#002e5f] transition focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                            Ajouter
                        </button>
                    </form>

                    <div class="mt-8 space-y-3">
                        <form method="GET" action="{{ route('buildings.index', ['client' => $client->id]) }}">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Rechercher un bâtiment..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                            <button type="submit"
                                    class="w-full mt-2 px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002e5f] transition">
                                Rechercher
                            </button>
                        </form>

                        <a href="{{ route('clients.index', ['id' => $client->id]) }}"
                           class="block text-center px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002e5f] transition mt-4">
                            Retour aux clients
                        </a>
                    </div>
                </aside>

                {{-- LISTE DES BÂTIMENTS --}}
                <section class="flex-1">
                    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Liste des Bâtiments de: {{$client->name}}</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($buildings as $building)
                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition h-40 flex flex-col justify-between">
                                <a href="{{ route('machines.index', ['buildings' => $building->id]) }}">
                                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $building->adresse }}</h2>
                                </a>

                                <div class="flex flex-wrap gap-2 mt-auto text-sm">
                                    <a href="{{ route('buildings.edit', ['id' => $building->id]) }}"
                                       class="text-[#003E7E] hover:underline font-medium whitespace-nowrap">
                                        Modifier
                                    </a>

                                    <form action="{{ route('buildings.destroy') }}" method="POST"
                                          onsubmit="return confirm('Supprimer ce bâtiment ?')">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $building->id }}">
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium whitespace-nowrap">
                                            Supprimer
                                        </button>
                                    </form>

                                    <a href="{{ route('entretien.index', ['buildings' => $building->id]) }}"
                                       class="text-[#003E7E] hover:underline font-medium whitespace-nowrap">
                                        Rapport d'entretien
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layout>
