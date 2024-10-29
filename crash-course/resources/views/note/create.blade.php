<x-layout>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div style="width: 26rem;">
            <h2 class="text-center mb-4">Enter Notes</h2>
            <form method="POST" action="{{ route('note.store') }}">
                @csrf

                <!-- Message input -->
                <div class="mb-4">
                    <label for="form4Example3" class="form-label">Message</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" id="form4Example3" rows="4" name="note"></textarea>

                    <!-- Error message -->
                    @error('note')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form4Example4" checked />
                    <label class="form-check-label" for="form4Example4">
                        Send me a copy of this message
                    </label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary w-100">Send</button>
            </form>

            <!-- Success message -->
            @if (session('message'))
                <div class="alert alert-success mt-4">{{ session('message') }}</div>
            @endif
        </div>
    </div>
</x-layout>
