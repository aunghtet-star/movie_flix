<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|string|min:8',
            ]);

            Admin::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            return redirect()->route('admins.index')
                           ->with('success', 'Admin created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to create admin. Please try again.');
        }
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        try {
            $admin = Admin::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
                'password' => 'nullable|string|min:8',
            ]);

            $admin->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? bcrypt($validated['password']) : $admin->password,
            ]);

            return redirect()->route('admins.index')
                           ->with('success', 'Admin updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to update admin. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $adminName = $admin->name;
            $admin->delete();

            return redirect()->route('admins.index')
                           ->with('success', "Admin '{$adminName}' deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->route('admins.index')
                           ->with('error', 'Failed to delete admin. Please try again.');
        }
    }
}
