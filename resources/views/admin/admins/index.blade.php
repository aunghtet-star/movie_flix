@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Admins Management</h1>
            <p class="text-orange-300">Manage admin accounts and permissions</p>
        </div>
        <a href="{{ route('admins.create') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200 shadow-lg">
            <i class="fas fa-user-plus mr-2"></i>Add New Admin
        </a>
    </div>

    <!-- Admins Table -->
    <div class="bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden">
        <table class="min-w-full divide-y divide-white/10">
            <thead class="bg-gradient-to-r from-orange-600/20 to-red-600/20 backdrop-blur-md">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-black/10 backdrop-blur-sm divide-y divide-white/10">
                @forelse($admins ?? [] as $admin)
                <tr class="hover:bg-white/5 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center shadow-lg">
                                <span class="font-bold text-white text-lg">{{ substr($admin->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-white drop-shadow">{{ $admin->name }}</div>
                                <div class="text-sm text-orange-300">Administrator</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white drop-shadow">
                        {{ $admin->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 border border-green-500/30">
                            <i class="fas fa-circle text-green-400 mr-2" style="font-size: 6px;"></i>
                            Active
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white drop-shadow">
                        {{ $admin->created_at ? $admin->created_at->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('admins.edit', $admin->id) }}"
                                class="bg-gradient-to-r from-blue-500/20 to-indigo-500/20 text-blue-300 hover:from-blue-500/30 hover:to-indigo-500/30 px-4 py-2 rounded-lg border border-blue-500/30 hover:border-blue-400/50 transition duration-200 backdrop-blur-sm">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>
                            @if($admin->id !== Auth::guard('admin')->id())
                            <button type="button"
                                onclick="confirmDelete('{{ $admin->name }}', '{{ route('admins.destroy', $admin->id) }}', 'admin')"
                                class="bg-gradient-to-r from-red-500/20 to-pink-500/20 text-red-300 hover:from-red-500/30 hover:to-pink-500/30 px-4 py-2 rounded-lg border border-red-500/30 hover:border-red-400/50 transition duration-200 backdrop-blur-sm">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                            @else
                            <span class="bg-gradient-to-r from-gray-500/20 to-gray-600/20 text-gray-400 px-4 py-2 rounded-lg border border-gray-500/30 cursor-not-allowed backdrop-blur-sm">
                                <i class="fas fa-lock mr-2"></i>Protected
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-user-shield text-6xl text-orange-300/30 mb-4"></i>
                            <p class="text-white/70 text-lg">No admins found.</p>
                            <p class="text-orange-300/60 text-sm mt-2">Add new administrators to manage the system.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection