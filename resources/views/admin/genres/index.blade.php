@extends('admin.layouts.app')
@section('content')
    <div id="genres-section" class="content-section">
        <h2 class="text-2xl font-semibold mb-6">Genres Management</h2>

        <!-- Users Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg">
                        <i class="fas fa-genres"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Genres</p>
                        <p>{{$genreCount}}</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Genres</h3>
                <div class="flex space-x-2">
                    <div class="max-w-lg mx-auto">
                        <form method="GET" action="{{ route('genres.index') }}" class="flex">
                            <input
                                type="text"
                                name="search"
                                value=""
                                placeholder="Search genres..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 font-semibold">
                                Search
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('genres.create') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-plus mr-2"></i> Add Genre
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($genres as $genre)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">{{ $genre->name }}</div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('genres.edit',$genre->id) }}"
                                       class="text-blue-500 hover:text-blue-700 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No genres found.
                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div class="text-sm text-gray-500">
                        Showing 1 to 5 of 100 entries
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">Previous</button>
                        <button class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">1</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">2</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">3</button>
                        <button class="px-3 py-1 border border-gray-300 rounded-md text-sm">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
