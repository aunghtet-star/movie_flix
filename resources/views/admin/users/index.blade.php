@extends('admin.layouts.app')
@section('content')
    <div id="users-section" class="content-section">
        <h2 class="text-2xl font-semibold mb-6">User Management</h2>

        <!-- Users Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Users</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_users']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 text-white p-3 rounded-lg">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">New Users (This Month)</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['new_users_this_month']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 text-white p-3 rounded-lg">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Active Users (Last 30 Days)</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['active_users']) }}</h3>
                    </div>
                </div>
            </div>
        </div>


        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Users</h3>
                <div class="flex space-x-2">
                    <form method="GET" action="{{ route('users.index') }}" class="relative">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search users..."
                               class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </form>
                    <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-plus mr-2"></i> Add User
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Joined
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gray-200"></div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('users.edit',$user->id) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
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
                                    No users found.
                                </td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div class="text-sm text-gray-500">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries
                        @if($search)
                            <span class="ml-2 text-blue-600">(filtered from {{ $stats['total_users'] }} total users)</span>
                        @endif
                    </div>

                    <!-- Laravel Pagination Links -->
                    <div class="flex space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($users->onFirstPage())
                            <span class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Previous</a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Next</a>
                        @else
                            <span class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
