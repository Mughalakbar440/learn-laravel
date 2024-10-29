<x-layout>
    <div class="row mt-6">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Note #{{ $note->id }}</h2>
                </div>
                <div class="card-body">
                    <p class="mb-4">{{ $note->note }}</p>
                    <p class="text-muted mb-0">Created at: {{ $note->created_at->format('F j, Y, g:i a') }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('note.edit', $note->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('note.destroy', $note->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this note?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
