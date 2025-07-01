@extends('admin.layouts.app')
@section('content')
    <div id="movies-section" class="content-section">
        <h2 class="text-2xl font-semibold mb-6">Movie Management</h2>

        <!-- Movies Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg">
                        <i class="fas fa-film"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Movies</p>
                        <h3 class="text-xl font-semibold">1,254</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 text-white p-3 rounded-lg">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">New Movies (This Month)</p>
                        <h3 class="text-xl font-semibold">42</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 text-white p-3 rounded-lg">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Avg. Rating</p>
                        <h3 class="text-xl font-semibold">4.2/5</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 text-white p-3 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Views</p>
                        <h3 class="text-xl font-semibold">245K</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Movies Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Movies</h3>
                <div class="flex space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Search movies..."
                               class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <a href="{{route('admin_movies.create')}}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-plus mr-2"></i> Add Movie
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Movie
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Genre
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Year
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rating
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Views
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($movies as $movie)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img alt="photo" src="{{ asset('storage/'.$movie->picture) }}"
                                             class="w-10 h-14 bg-gray-200 rounded">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{$movie->title}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="bg-red-600 text-white px-2 py-1 rounded-full text-xs">{{ $movie->genre ? $movie->genre->name : " action" }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$movie->year}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $movie->ratings }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $movie->views }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                    <a href="{{route('admin_movies.show',$movie->id)}}" class="text-blue-500 hover:text-blue-700 mr-3">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <a href="{{route('admin_movies.edit',$movie->id)}}" class="text-blue-500 hover:text-blue-700 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{route('admin_movies.destroy',$movie->id)}}" method="POST" class="inline-block">
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
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No movies found</td>
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
