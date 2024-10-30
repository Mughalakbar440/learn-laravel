<x-app-layout>
    <div calss="container">
        <div class="flex justify-center mt-6">
            <div class="w-full max-w-3xl">
                <div class="bg-gray-500 rounded-lg shadow-lg overflow-hidden">
                    <div class="bg-indigo-500 p-4">
                        <h2 class="text-2xl font-semibold text-gray-100">Note #{{ $note->id }}</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-800 mb-4">{{ $note->note }}</p>
                        <p class="text-sm text-gray-400">Created at: {{ $note->created_at->format('F j, Y, g:i a') }}</p>
                    </div>
                    <div class="flex justify-between items-center bg-gray-100 p-4">
                        <a href="{{ route('note.index') }}"
                            class="bg-gray-500 text-white py-2 px-4 rounded mb-4 inline-block">
                            go back
                        </a>
                        <a href="{{ route('note.edit', $note->id) }}"
                            class="bg-gray-500 text-white py-2 px-4 rounded mb-4 inline-block">
                            Edit
                        </a>
                        <form action="{{ route('note.destroy', $note->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this note?');">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit">Delete</x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
