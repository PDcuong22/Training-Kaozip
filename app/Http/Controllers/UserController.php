<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $selected = ['viewer'];
        return view('users.create', compact('roles', 'selected'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'roles']);

        $user = User::create([
            'name'  => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
        ]);

        if (!empty($data['roles']) && is_array($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        return redirect()->route('users.edit', $user)->with('success', 'User created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // eager-load relations used in the view
        $user->load(['roles', 'posts']);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // load roles for select and user's current roles
        $user->load('roles');
        $roles = Role::pluck('name', 'id');
        $selected = $user->roles->pluck('id')->toArray();

        return view('users.edit', compact('user', 'roles', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->only(['name', 'email', 'roles']);

        $user->name  = $data['name']  ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->save();

        if ($request->has('roles')) {
            $roles = is_array($data['roles']) ? $data['roles'] : [];
            $user->roles()->sync($roles);
        }

        return redirect()->route('users.edit', $user)->with('success', 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
