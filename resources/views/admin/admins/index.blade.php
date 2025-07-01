@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Admins Management</h1>
            <p class="text-gray-600">Manage admin accounts and permissions</p>
        </div>
        <a href="{{ route('admins.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-plus mr-2"></i>Add New Admin
        </a>
    </div>

    <!-- Admins Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($admins ?? [] as $admin)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="font-medium text-white text-sm">{{ substr($admin->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                                <div class="text-sm text-gray-500">Administrator</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $admin->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-circle text-green-400 mr-1" style="font-size: 6px;"></i>
                            Active
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $admin->created_at ? $admin->created_at->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admins.edit', $admin->id) }}"
                               class="text-indigo-600 hover:text-indigo-900 px-3 py-1 rounded border border-indigo-200 hover:bg-indigo-50 transition duration-200">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            @if($admin->id !== Auth::guard('admin')->id())
                            <button type="button"
                                    onclick="confirmDelete('{{ $admin->name }}', '{{ route('admins.destroy', $admin->id) }}', 'admin')"
                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded border border-red-200 hover:bg-red-50 transition duration-200">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                            @else
                            <span class="text-gray-400 px-3 py-1 rounded border border-gray-200 cursor-not-allowed">
                                <i class="fas fa-lock mr-1"></i>Protected
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-user-shield text-4xl text-gray-300 mb-4"></i>
                        <p>No admins found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
