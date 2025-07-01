@extends('admin.layouts.app')
@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-semibold mb-6">Edit Movie</h2>
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin_movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Picture</label>
                <input type="file" name="picture" class="w-full border rounded px-3 py-2">
                @if($movie->picture)
                    <img src="{{ asset('storage/'.$movie->picture) }}" alt="Current Picture" class="w-24 mt-2 rounded">
                @endif
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" value="{{ old('title', $movie->title) }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Genre</label>
                <select name="genre_id" class="w-full border rounded px-3 py-2" required>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $movie->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Year</label>
                <input type="number" name="year" class="w-full border rounded px-3 py-2" value="{{ old('year', $movie->year) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Actor</label>
                <input type="text" name="actor" class="w-full border rounded px-3 py-2" value="{{ old('actor', $movie->actor) }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Actress</label>
                <input type="text" name="actress" class="w-full border rounded px-3 py-2" value="{{ old('actress', $movie->actress) }}" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('description', $movie->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Duration</label>
                <input type="text" name="long_time" class="w-full border rounded px-3 py-2" value="{{ old('long_time', $movie->long_time) }}"  required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Download Link</label>
                <input type="text" name="download_link" class="w-full border rounded px-3 py-2" value="{{ old('download_link', $movie->download_link) }}" required>
            </div>


            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Movie</button>
        </form>
    </div>
@endsection
