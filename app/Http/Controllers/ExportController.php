<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener "barryvdh/laravel-dompdf"

class ExportController extends Controller
{
    // Solo usuarios autenticados
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Exportar reservas a Excel
    public function exportReservas()
    {
        $reservas = Reserva::where('user_id', Auth::id())->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reservas');

        // Cabeceras
        $sheet->setCellValue('A1', 'Nombre')
              ->setCellValue('B1', 'Apellido')
              ->setCellValue('C1', 'Fecha entrada')
              ->setCellValue('D1', 'Fecha salida')
              ->setCellValue('E1', 'Habitación')
              ->setCellValue('F1', 'Personas')
              ->setCellValue('G1', 'Comentarios');

        // Datos
        $row = 2;
        foreach ($reservas as $reserva) {
            $sheet->setCellValue('A'.$row, $reserva->nombre)
                  ->setCellValue('B'.$row, $reserva->apellido)
                  ->setCellValue('C'.$row, $reserva->fecha_entrada)
                  ->setCellValue('D'.$row, $reserva->fecha_salida)
                  ->setCellValue('E'.$row, $reserva->habitacion)
                  ->setCellValue('F'.$row, $reserva->personas)
                  ->setCellValue('G'.$row, $reserva->comentarios);
            $row++;
        }

        // Generar archivo Excel
        $writer = new Xlsx($spreadsheet);

        $filename = 'reservas.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // Exportar reservas a PDF
    public function exportPDF()
    {
        $reservas = Reserva::where('user_id', Auth::id())->get();

        // La vista para PDF debe estar en resources/views/pdf/reservas.blade.php
        $pdf = Pdf::loadView('pdf.reservas', compact('reservas'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('reservas.pdf');
    }
}