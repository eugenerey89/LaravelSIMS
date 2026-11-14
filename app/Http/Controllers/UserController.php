<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->q, fn ($q, $t) => $q->where(fn ($w) => $w
                ->where('name', 'like', "%$t%")->orWhere('email', 'like', "%$t%")))
            ->orderBy('name')->paginate(10)->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create($data);
        return redirect()->route('users.index')->with('success', 'User added.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);   // keep the current password
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        if ($user->is(auth()->user())) {
            return back()->with('success', "You can't delete your own account while signed in.");
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
