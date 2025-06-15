@extends('admin.layouts.app')
@section('content')

    <!-- User Edit Form using HTML and Tailwind CSS -->
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="max-w-lg mx-auto mt-16 bg-white p-8 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <h2 class="text-2xl font-semibold mb-6 text-center">Edit User</h2>

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" id="name" name="name" required
                   value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email Field -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="email" name="email" required
                   value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Password Field (Optional) -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Password <span class="text-gray-400 text-xs">(leave blank to keep current password)</span></label>
            <input type="password" id="password" name="password"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-md transition-colors">
                Update
            </button>
        </div>
    </form>
@endsection
