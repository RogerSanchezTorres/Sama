<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'date' => 'nullable|date',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'date' => $validatedData['date'],
        ]);

        $defaultRole = Role::where('role', 'user')->first();
        $user->role()->associate($defaultRole);
        $user->save();

        // Envía el correo con los datos del usuario
        Mail::to('r.sanchez2dawnuria2022@gmail.com')->send(new UserRegistered($user));

        auth()->login($user);

        return redirect('/');
    }
}
