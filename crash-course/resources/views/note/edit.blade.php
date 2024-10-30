<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-sm p-6 bg-gray-800 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-center text-white mb-6">Enter Notes</h2>
                <form method="POST" action="{{ route('note.update', $note->id) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Message Input -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-200 mb-1">Your message</label>
                        <textarea id="message" rows="4" name="note"
                            class="block w-full px-3 py-2 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('note') border-red-500 @enderror"
                            placeholder="Leave a comment...">{{ $note->note }}</textarea>

                        <!-- Error Message -->
                        @error('note')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" id="copy"
                            class="mr-2 text-blue-500 focus:ring-blue-400 focus:ring-2" checked />
                        <label for="copy" class="text-sm text-gray-300">Send me a copy of this message</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-black hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">Send</button>
                </form>

                <!-- Success Message -->
                @if (session('message'))
                    <div class="mt-4 bg-green-100 text-green-700 p-3 rounded-lg text-center">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
