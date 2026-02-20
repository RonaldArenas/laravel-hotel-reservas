<?php

namespace App\Exports;

use App\Models\Reserva;
use PHPExcel;
use PHPExcel_IOFactory;

class ReservasExport
{
    public static function exportar()
    {
        $reservas = Reserva::all();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('Reservas');

        // Encabezados
        $objPHPExcel->getActiveSheet()
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Nombre')
            ->setCellValue('C1', 'Apellido')
            ->setCellValue('D1', 'Fecha Entrada')
            ->setCellValue('E1', 'Fecha Salida')
            ->setCellValue('F1', 'Habitación')
            ->setCellValue('G1', 'Personas')
            ->setCellValue('H1', 'Comentarios');

        $fila = 2;
        foreach ($reservas as $reserva) {
            $objPHPExcel->getActiveSheet()
                ->setCellValue('A'.$fila, $reserva->id)
                ->setCellValue('B'.$fila, $reserva->nombre)
                ->setCellValue('C'.$fila, $reserva->apellido)
                ->setCellValue('D'.$fila, $reserva->fecha_entrada)
                ->setCellValue('E'.$fila, $reserva->fecha_salida)
                ->setCellValue('F'.$fila, $reserva->habitacion)
                ->setCellValue('G'.$fila, $reserva->personas)
                ->setCellValue('H'.$fila, $reserva->comentarios);
            $fila++;
        }

        // Crear archivo Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="reservas.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
}