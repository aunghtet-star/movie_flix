<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get search query if exists
        $search = $request->get('search');

        // Build query with search functionality
        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Get users with pagination
        $users = $query->latest()->paginate(10)->appends($request->query());

        // Get user statistics
        $stats = [
            'total_users' => User::count(),
            'new_users_this_month' => User::whereMonth('created_at', now()->month)
                                         ->whereYear('created_at', now()->year)
                                         ->count(),
            'active_users' => User::whereDate('updated_at', '>=', now()->subDays(30))->count(),
        ];

        return view('admin.users.index', compact('users', 'stats', 'search'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            return redirect()->route('users.index')
                           ->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to create user. Please try again.');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
            ]);

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
            ]);

            return redirect()->route('users.index')
                           ->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to update user. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $userName = $user->name;
            $user->delete();

            return redirect()->route('users.index')
                           ->with('success', "User '{$userName}' deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                           ->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
