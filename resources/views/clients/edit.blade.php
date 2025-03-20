<x-layout>
    <main class="min-h-screen bg-gray-100 flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Modifier le Client</h1>
            
           
            <form action="{{route('clients.update')}}" method="POST">
                @csrf
                
                
                <div class="mb-4">
                    <label for="client-name" class="block text-sm font-medium text-gray-700">Nom du Client</label>
                    <input type="hidden" value="{{$client->id}}" name="id" id="id">
                    <input type="text" id="client-name" name="name" value="{{$client->name}}"
                           class="w-full px-4 py-2 mt-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Nom du client">
                </div>
                
                
                <div class="flex justify-between items-center mt-6">
                    <a href="{{route('clients.index')}}" class="text-gray-600 hover:text-gray-800 font-semibold">Annuler</a>
                    <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </main>
    
</x-layout>