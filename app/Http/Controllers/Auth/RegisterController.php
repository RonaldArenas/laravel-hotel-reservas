<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        User::create([
        'document_type_id' => $request->document_type_id,
        'document_number'  => $request->document_number,
        'name'             => $request->name,
        'lastname'         => $request->lastname,
        'phone'            => $request->phone,
        'email'            => $request->email,
        'rol_id'           => 2,
        'status'           => 1,
        'password'         => Hash::make($request->password),
    ]);

    return redirect()->route('login')
        ->with('success', 'Cuenta creada correctamente');
}
}