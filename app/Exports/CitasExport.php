<?php

namespace App\Exports;

use App\Models\Citas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitasExport implements FromCollection, WithHeadings
{
    /**
     * Devuelve la colección de citas.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Citas::all();
    }

    /**
     * Define los encabezados de las columnas.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Estatus',
            'Descripción',
            'Código',
            'Paciente ID',
            'Creado en',
            'Actualizado en',
        ];
    }
}
