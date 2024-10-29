<x-layout>
    <h1>Records</h1>
    <a class="btn btn-secondary mb-4" href="{{ route('note.create') }}">Add Data</a>
    <div class="row">
        @if ($success)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ $success }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @foreach ($Notes as $note)
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <h5 class="card-title">Note #{{ $note['id'] }}</h5>
                        <p class="card-text">
                            {{ Str::words($note['note'], 30) }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('note.edit', $note['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('note.show', $note['id']) }}" class="btn btn-success btn-sm">View</a>

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
        @endforeach
        <div class="d-flex justify-content-center mt-4">
            {{ $Notes->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-layout>
