@extends('admin.layouts.app')

@section('content')
    <div id="dashboard-section" class="content-section">
        <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
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
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Users</p>
                        <h3 class="text-xl font-semibold">5,423</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 text-white p-3 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Views</p>
                        <h3 class="text-xl font-semibold">245K</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 text-white p-3 rounded-lg">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Revenue</p>
                        <h3 class="text-xl font-semibold">$12,345</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Recent Activity</h3>
            </div>
            <div class="p-4">
                <ul class="divide-y divide-gray-200">
                    <li class="py-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium">New user registered</p>
                                <p class="text-xs text-gray-500">2 minutes ago</p>
                            </div>
                        </div>
                    </li>
                    <li class="py-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-500">
                                <i class="fas fa-film"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium">New movie added: "The Matrix Resurrections"</p>
                                <p class="text-xs text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                    </li>
                    <li class="py-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-500">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium">New review for "Dune"</p>
                                <p class="text-xs text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                    </li>
                    <li class="py-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-500">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium">Server maintenance scheduled</p>
                                <p class="text-xs text-gray-500">5 hours ago</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Popular Movies -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Popular Movies</h3>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded"></div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Dune</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Sci-Fi</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">4.8/5</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">45.2K</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded"></div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">The Batman</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Action</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">4.7/5</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">42.8K</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-200 rounded"></div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Spider-Man: No Way Home</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Action</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">4.9/5</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">67.3K</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
