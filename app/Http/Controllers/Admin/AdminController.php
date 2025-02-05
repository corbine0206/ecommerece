<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); 
    }

    // Admin dashboard
    public function index()
    {
        $users = User::all(); 
        return view('admin.dashboard', compact('users'));
        
    }

    public function users()
    {
        $users = User::all();  
        return view('admin.users', compact('users'));
    }

    // Show the edit user form
    public function edit($id)
    {
        $user = User::findOrFail($id); 
        return view('admin.edit-user', compact('user'));
    }

    // Update the user data
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    // Delete the user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->user()->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    public function promoteToAdmin($id)
    {
        $user = User::findOrFail($id);

        // Ensure the user is not already an admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.users')->with('error', 'User is already an admin.');
        }

        // Update the user's role to admin
        $user->update(['role' => 'admin']);

        return redirect()->route('admin.users')->with('success', 'User has been promoted to admin.');
    }
}
