<x-layout :user="null">
    <main class="min-h-screen bg-gray-100 flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Modifier le Client</h1>

            <form action="{{ route('clients.update') }}" method="POST" class="space-y-6">
                @csrf

                <input type="hidden" name="id" id="id" value="{{ $client->id }}">

                <div>
                    <label for="client-name" class="block text-sm font-medium text-gray-700 mb-1">Nom du Client</label>
                    <input type="text" id="client-name" name="name" value="{{ $client->name }}"
                           placeholder="Nom du client"
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                </div>

                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('clients.index') }}"
                       class="text-gray-600 hover:text-gray-800 font-medium transition">Annuler</a>

                    <button type="submit"
                            class="px-6 py-2 text-white bg-[#003E7E] rounded hover:bg-[#002e5f] transition focus:outline-none focus:ring-2 focus:ring-[#003E7E]">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-layout>
