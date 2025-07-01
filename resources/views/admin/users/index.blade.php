@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Users Management</h1>
        <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-plus mr-2"></i>Add New User
        </a>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users ?? [] as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="font-medium text-gray-700">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="text-indigo-600 hover:text-indigo-900 px-3 py-1 rounded border border-indigo-200 hover:bg-indigo-50 transition duration-200">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <button type="button"
                                    onclick="confirmDelete('{{ $user->name }}', '{{ route('users.destroy', $user->id) }}', 'user')"
                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded border border-red-200 hover:bg-red-50 transition duration-200">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </div>
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

    <!-- Pagination -->
    @if(isset($users) && $users->hasPages())
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    @endif
</div>

<!-- Include Toast Notifications -->
@include('admin.components.toast')

<!-- Include Confirmation Modal -->
@include('components.confirmation-modal')

<!-- Add CSRF token for delete requests -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
