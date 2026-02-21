<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReservaConfirmadaMail;
use Illuminate\Support\Facades\Mail;

class ReservaController extends Controller
{
    public function __construct()
    {
        // Exige que el usuario esté logueado
        $this->middleware('auth');
    }

    // Mostrar dashboard con reservas
    public function index()
    {
        $reservas = Reserva::where('user_id', Auth::id())->get();
        return view('dashboard', compact('reservas'));
    }

    // Guardar reserva
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string|max:255',
            'apellido'=>'required|string|max:255',
            'fecha_entrada'=>'required|date',
            'fecha_salida'=>'required|date|after_or_equal:fecha_entrada',
            'habitacion'=>'required|string|max:255',
            'personas'=>'required|integer|min:1|max:6',
            'comentarios'=>'nullable|string',
        ]);

        $reserva = Reserva::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_salida' => $request->fecha_salida,
            'habitacion' => $request->habitacion,
            'personas' => $request->personas,
            'comentarios' => $request->comentarios,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

            // ✅ NUEVO: enviar correo
            Mail::to(Auth::user()->email)
                 ->send(new ReservaConfirmadaMail($reserva));
        
            // ✅ NUEVO: mensaje en dashboard
            return back()->with(
                'reserva_success',
                'Reserva registrada y correo enviado con éxito'
            );

        
    }

    // Mostrar formulario de edición
public function edit(Reserva $reserva)
{
    // Opcional: verificar que el usuario sea dueño
    if($reserva->user_id != Auth::id()) {
        abort(403);
    }
    return view('edit-reserva', compact('reserva'));
}

// Guardar cambios
public function update(Request $request, Reserva $reserva)
{
    if($reserva->user_id != Auth::id()) abort(403);

    $request->validate([
        'nombre'=>'required|string|max:255',
        'apellido'=>'required|string|max:255',
        'fecha_entrada'=>'required|date',
        'fecha_salida'=>'required|date|after_or_equal:fecha_entrada',
        'habitacion'=>'required|string|max:255',
        'personas'=>'required|integer|min:1|max:6',
        'comentarios'=>'nullable|string',
    ]);

    $reserva->update([
        'nombre'=>$request->nombre,
        'apellido'=>$request->apellido,
        'fecha_entrada'=>$request->fecha_entrada,
        'fecha_salida'=>$request->fecha_salida,
        'habitacion'=>$request->habitacion,
        'personas'=>$request->personas,
        'comentarios'=>$request->comentarios,
        'updated_by'=>Auth::id(),
    ]);

    return redirect()->route('dashboard')->with('reserva_msg', ['type'=>'success','text'=>'Reserva actualizada correctamente']);
}

// Eliminar reserva
public function destroy(Reserva $reserva)
{
    if($reserva->user_id != Auth::id()) abort(403);

    $reserva->delete();

    return redirect()->route('dashboard')->with('reserva_msg', ['type'=>'success','text'=>'Reserva eliminada correctamente']);
}



}