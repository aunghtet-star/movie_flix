@extends('admin.layouts.app')
@section('content')
    <div id="admin-section" class="content-section ">
        <h2 class="text-2xl font-semibold mb-6">Admin User Management</h2>

        <!-- Admin Users Table -->
        <div class="bg-white rounded-lg shadow " >
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Admin Users</h3>
                <a href="{{ route('admins.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                    <i class="fas fa-plus mr-2"></i> Add Admin
                </a>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            {{--                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>--}}
                            {{--                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>--}}
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($admins as $admin)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $admin->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $admin->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
{{--                                    <button class="text-blue-500 hover:text-blue-700 mr-3">--}}
{{--                                        <i class="fas fa-edit"></i>--}}
{{--                                    </button>--}}
                                    <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                            {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                            {{--                                <div class="text-sm text-gray-900">Super Admin</div>--}}
                            {{--                            </td>--}}
                            {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                            {{--                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">--}}
                            {{--                                                        Active--}}
                            {{--                                                    </span>--}}
                            {{--                            </td>--}}

                        {{--                        <tr>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                <div class="flex items-center">--}}
                        {{--                                    <div class="w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-white">--}}
                        {{--                                        <i class="fas fa-user"></i>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="ml-4">--}}
                        {{--                                        <div class="text-sm font-medium text-gray-900">Jane Smith</div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                <div class="text-sm text-gray-900">jane.smith@example.com</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                <div class="text-sm text-gray-900">Content Manager</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">--}}
                        {{--                                                        Active--}}
                        {{--                                                    </span>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
                        {{--                                <button class="text-blue-500 hover:text-blue-700 mr-3">--}}
                        {{--                                    <i class="fas fa-edit"></i>--}}
                        {{--                                </button>--}}
                        {{--                                <button class="text-red-500 hover:text-red-700">--}}
                        {{--                                    <i class="fas fa-trash"></i>--}}
                        {{--                                </button>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                <div class="flex items-center">--}}
                        {{--                                    <div class="w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-white">--}}
                        {{--                                        <i class="fas fa-user"></i>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="ml-4">--}}
                        {{--                                        <div class="text-sm font-medium text-gray-900">Robert Johnson</div>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                <div class="text-sm text-gray-900">robert.j@example.com</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                <div class="text-sm text-gray-900">Moderator</div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
                        {{--                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">--}}
                        {{--                                                        Pending--}}
                        {{--                                                    </span>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
                        {{--                                <button class="text-blue-500 hover:text-blue-700 mr-3">--}}
                        {{--                                    <i class="fas fa-edit"></i>--}}
                        {{--                                </button>--}}
                        {{--                                <button class="text-red-500 hover:text-red-700">--}}
                        {{--                                    <i class="fas fa-trash"></i>--}}
                        {{--                                </button>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
