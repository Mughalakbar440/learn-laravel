<x-app-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-6 text-white">Records</h1>
        <a class="bg-gray-500 text-white py-2 px-4 rounded mb-4 inline-block" href="{{ route('note.create') }}">Add
            Data</a>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($Notes as $note)
                <div class="bg-gray-800 text-white p-6 rounded-lg shadow-md">
                    <h5 class="text-xl font-semibold mb-2">Note #{{ $note['id'] }}</h5>
                    <p class="mb-4">
                        {{ Str::words($note['note'], 30) }}
                    </p>
                    <div class="flex justify-between">
                        <a href="{{ route('note.edit', $note['id']) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm">Edit</a>
                        <a href="{{ route('note.show', $note['id']) }}"
                            class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded text-sm">View</a>
                        <form action="{{ route('note.destroy', $note->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this note?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="mt-8 flex justify-center">
            {{ $Notes->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
