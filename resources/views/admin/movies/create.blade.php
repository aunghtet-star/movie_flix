@extends('admin.layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-8 bg-white shadow-md rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-6">Add New Movie</h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin_movies.store') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="picture" class="block text-sm font-medium text-gray-700">Picture File</label>
                <input type="file" id="picture" name="picture"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       required accept="image/*" onchange="previewImage(event)">
                <div id="preview-container" class="mt-3">
                    <img id="preview-image" src="#" alt="Preview" class="hidden w-40 h-auto rounded shadow" />
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       required>
            </div>

            <div>
                <label for="actor" class="block text-sm font-medium text-gray-700">Actor</label>
                <input type="text" id="actor" name="actor" value="{{ old('actor') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       required>
            </div>

            <div>
                <label for="actress" class="block text-sm font-medium text-gray-700">Actress</label>
                <input type="text" id="actress" name="actress" value="{{ old('actress') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       required>
            </div>

            <div>
                <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                <select id="genre_id" name="genre_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                        required>
                    <option value="">-- Select Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description"
                          class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                          rows="3">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" id="year" name="year" value="{{ old('year') }}"
                       min="1900" max="{{ date('Y') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       required>
            </div>

            <div>
                <label for="long_time" class="block text-sm font-medium text-gray-700">Duration</label>
                <input type="text" id="long_time" name="long_time" value="{{ old('long_time') }}"
                       class="html-duration-picker mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       required>
            </div>

            <div>
                <label for="download_link" class="block text-sm font-medium text-gray-700">Download Link</label>
                <input type="text" id="download_link" name="download_link" value="{{ old('download_link') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow">
                    Create Movie
                </button>
                <a href="{{ route('movies.index') }}"
                   class="text-blue-600 hover:underline ml-4">Cancel</a>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/html-duration-picker@latest/dist/html-duration-picker.min.js"></script>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview-image');
            const container = document.getElementById('preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "#";
                preview.classList.add('hidden');
            }
        }
    </script>
@endsection
