<x-layout :user="auth()->user()">
    <main class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:space-x-8">

                {{-- SIDEBAR : FORMULAIRE --}}
                <aside class="w-full lg:max-w-sm bg-white p-6 rounded-lg shadow mb-8 lg:mb-0">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ajouter une Machine</h2>

                    <form action="{{ route('machines.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="buildings_id" value="{{ $buildings->id }}">

                        <input type="text" id="nom" name="nom" placeholder="Nom de la machine"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <input type="text" id="type" name="type" placeholder="Type/Genre"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <input type="text" id="marque" name="marque" placeholder="Marque"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <input type="text" id="modele" name="modele" placeholder="Modèle"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <input type="text" id="serie" name="serie" placeholder="Série"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <input type="text" id="courroie" name="courroie" placeholder="Courroie"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <input type="text" id="filtres" name="filtres" placeholder="Filtres"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <input type="text" id="freon" name="freon" placeholder="Freon"
                               class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                        <textarea id="desc" name="desc" placeholder="Recommandation"
                                  class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E] h-24 resize-none"></textarea>

                        <button type="submit"
                                class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-[#002e5f] transition focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                            Ajouter
                        </button>
                    </form>

                    <div class="mt-8 space-y-3">
                        <form method="GET" action="{{ route('machines.index', ['buildings' => $buildings->id]) }}">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Rechercher une machine..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">

                            <button type="submit"
                                    class="w-full mt-2 px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002e5f] transition">
                                Rechercher
                            </button>
                        </form>

                        <a href="{{ route('buildings.index', ['client' => $buildings->client_id]) }}"
                           class="block text-center px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#002e5f] transition mt-4">
                            Retour aux bâtiments
                        </a>
                    </div>
                </aside>

                {{-- LISTE DES MACHINES --}}
                <section class="flex-1">
                    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Machines du bâtiment : {{$buildings->adresse}}</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($machines as $machine)
                            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition flex flex-col justify-between h-full">
                                <div class="space-y-2 text-sm text-gray-800">
                                    <p><span class="font-semibold">Nom:</span> {{ $machine->nom }}</p>
                                    <p><span class="font-semibold">Type/Genre:</span> {{ $machine->type }}</p>
                                    <p><span class="font-semibold">Marque:</span> {{ $machine->marque }}</p>
                                    <p><span class="font-semibold">Modèle:</span> {{ $machine->modele }}</p>
                                    <p><span class="font-semibold">Série:</span> {{ $machine->serie }}</p>
                                    <p><span class="font-semibold">Courroie:</span> {{ $machine->courroie }}</p>
                                    <p><span class="font-semibold">Filtres:</span> {{ $machine->filtres }}</p>
                                    <p><span class="font-semibold">Freon:</span> {{ $machine->freon }}</p>
                                    <p><span class="font-semibold">Recommandation:</span> {{ $machine->description }}</p>
                                </div>

                                <div class="flex flex-wrap gap-2 mt-4 text-sm">
                                    <a href="{{ route('machines.edit', ['id' => $machine->id]) }}"
                                       class="text-[#003E7E] hover:underline font-medium whitespace-nowrap">
                                        Modifier
                                    </a>

                                    <form action="{{ route('machines.destroy') }}" method="POST"
                                          onsubmit="return confirm('Supprimer cette machine ?')">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $machine->id }}">
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium whitespace-nowrap">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layout>
