<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Retorna habitaciones disponibles según tipo
    public function getHabitaciones(Request $request)
    {
        $tipo = $request->query('tipo');

        // Ejemplo simple: normalmente aquí consultarías la DB
        $habitaciones = [
            1 => ['numero' => '101'], // Individual
            2 => ['numero' => '201'], // Doble
            3 => ['numero' => '301'], // Suite
        ];

        $data = $habitaciones[$tipo] ?? [];

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}