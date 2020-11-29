<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $items = User::all();
        return view('pages.staf.index', [
            'items' => $items
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.staf.edit', [
            'user' => $user
        ]);
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'username' => $request->get('username'), 
            'nip' => $request->get('nip'), 
            'roles' => $request->get('roles')
        ]);

        return redirect()->route('data-staf.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->update($id);
    }

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
}
