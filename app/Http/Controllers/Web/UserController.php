<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
            'status' => 'nullable|in:Pending,Verified,Cancel',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        if (empty($validated['status'])) {
            $validated['status'] = 'Pending';
        }
        if ($validated['status'] === 'Verified') {
            $validated['email_verified_at'] = now();
        }

        User::create($validated);
        
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'status' => 'nullable|in:Pending,Verified,Cancel',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = bcrypt($request->password);
        }

        if (isset($validated['status'])) {
            if ($validated['status'] === 'Verified' && !$user->email_verified_at) {
                $user->email_verified_at = now();
            } elseif ($validated['status'] !== 'Verified') {
                $user->email_verified_at = null;
            }
        }

        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function updateStatus(Request $request, User $user)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Verified,Cancel',
        ]);

        $status = $validated['status'];
        $user->status = $status;

        if ($status === 'Verified') {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', "Status for {$user->name} updated to {$status} successfully.");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
