<x-layout :user="auth()->user()">

    <main class="min-h-screen bg-gray-100 py-10 px-6 flex flex-col lg:flex-row lg:justify-center">
        <!-- Sidebar Formulaire d'ajout de client -->
        <aside class="w-full max-w-xs p-6 bg-white rounded-lg shadow-lg mb-8 lg:mb-0 lg:mr-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Ajouter une Machine</h2>
            <form action="{{ route('machines.store') }}" method="POST">
                @csrf
                <input type="hidden" name="buildings_id" id="buildings_id" value="{{ $buildings->id }}">
                <!-- Nom du client -->
                <div class="mb-4">
                    <input type="text" id="type" name="type"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                        placeholder="Type/Genre">
                    <input type="text" id="marque" name="marque" placeholder="Marque"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    <input type="text" id="Modele" name="modele" placeholder="Modèle"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    <input type="text" id="Serie" name="serie" placeholder="série"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    <input type="text" id="courroie" name="courroie" placeholder="Courroie"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    <input type="text" id="filtres" name="filtres" placeholder="Filtres"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    <input type="text" id="freon" name="freon" placeholder="Freon"
                        class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                </div>
                <!-- Bouton de soumission -->
                <button type="submit"
                    class="w-full px-4 py-2 text-white bg-[#003E7E] rounded hover:bg-[#003E7E] focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                    Ajouter
                </button>
            </form>
            <div class="mb-6 mt-6">
                <form method="GET" action="{{ route('machines.index', ['buildings' => $buildings->id]) }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]"
                        placeholder="Rechercher une machine...">
                    <button type="submit" class="mt-2 px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#003E7E]">
                        Rechercher
                    </button>
                </form>
                <a href="{{ route('buildings.index', ['client' => $buildings->client_id]) }}"
                    class=" px-4 py-2 bg-[#003E7E] text-white rounded hover:bg-[#003E7E]" style="position: relative; top: 30px;">retour</a>

        </aside>

        <!-- Section de la liste de clients -->
        <div class="flex-1">
            <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center"></h1>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($machines as $machine)
                    <div class="block p-6 bg-white rounded-lg shadow ">


                        <div class="flex gap-2">
                            <h4 class="font-bold">Type/Genre: </h4>
                            <p> {{ $machine->type }}</p>
                        </div>
                        <div class="flex gap-2">
                            <h4 class="font-bold">Marque:</h4>
                            <p>{{ $machine->marque }}</p>
                        </div>
                        <div class="flex gap-2">
                            <h4 class="font-bold">Modele:</h4>
                            <p>{{ $machine->modele }}</p>
                        </div>
                        <div class="flex gap-2">
                            <h4 class="font-bold">Serie:</h4>
                            <p>{{ $machine->serie }}</p>
                        </div>
                        <div class="flex gap-2">
                            <h4 class="font-bold">Courroie:</h4>
                            <p>{{ $machine->courroie }}</p>
                        </div>
                        <div class="flex gap-2">
                            <h4 class="font-bold">Filtre:</h4>
                            <p>{{ $machine->filtres }}</p>
                        </div>
                        <div class="flex gap-2">
                            <h4 class="font-bold">Freon:</h4>
                            <p>{{ $machine->freon }}</p>
                        </div>





                        <div class="mt-4 flex justify-between ">

                            <a href="{{ route('machines.edit', ['id' => $machine->id]) }}"
                                class="text-[#003E7E] hover:text-[#003E7E] font-semibold">
                                Modifier
                            </a>

                            <form action="{{ route('machines.destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $machine->id }}" name="id" id="id">
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
    </main>





</x-layout>
