@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Users Management</h1>
            <p class="text-orange-300">Manage system users</p>
        </div>
        <a href="{{ route('users.create') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200 shadow-lg">
            <i class="fas fa-user-plus mr-2"></i>Add New User
        </a>
    </div>

    <!-- Users Table -->
    <div class="bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 overflow-hidden">
        <table class="min-w-full divide-y divide-white/10">
            <thead class="bg-gradient-to-r from-orange-600/20 to-red-600/20 backdrop-blur-md">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-black/10 backdrop-blur-sm divide-y divide-white/10">
                @forelse($users ?? [] as $user)
                <tr class="hover:bg-white/5 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center shadow-lg">
                                <span class="font-bold text-white text-lg">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-white drop-shadow">{{ $user->name }}</div>
                                <div class="text-sm text-orange-300">User</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white drop-shadow">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white drop-shadow">
                        {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('users.edit', $user->id) }}"
                                class="bg-gradient-to-r from-blue-500/20 to-indigo-500/20 text-blue-300 hover:from-blue-500/30 hover:to-indigo-500/30 px-4 py-2 rounded-lg border border-blue-500/30 hover:border-blue-400/50 transition duration-200 backdrop-blur-sm">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>
                            <button type="button"
                                data-user-name="{{ $user->name }}"
                                data-delete-url="{{ route('users.destroy', $user->id) }}"
                                onclick="confirmDeleteUser(this)"
                                class="bg-gradient-to-r from-red-500/20 to-pink-500/20 text-red-300 hover:from-red-500/30 hover:to-pink-500/30 px-4 py-2 rounded-lg border border-red-500/30 hover:border-red-400/50 transition duration-200 backdrop-blur-sm">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-users text-6xl text-orange-300/30 mb-4"></i>
                            <p class="text-white/70 text-lg">No users found.</p>
                            <p class="text-orange-300/60 text-sm mt-2">Add new users to manage the system.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($users) && $users->hasPages())
    <div class="mt-6">
        <div class="bg-black/20 backdrop-blur-xl rounded-2xl border border-white/10 p-4">
            <div class="text-orange-300">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    function confirmDeleteUser(button) {
        const userName = button.dataset.userName;
        const deleteUrl = button.dataset.deleteUrl;

        if (typeof showConfirmation === 'function') {
            showConfirmation(
                'Delete User',
                `Are you sure you want to delete "${userName}"? This action cannot be undone.`,
                function() {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                },
                'Delete',
                'bg-red-600 hover:bg-red-700'
            );
        } else {
            if (confirm(`Are you sure you want to delete "${userName}"?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    }
</script>
@endsection