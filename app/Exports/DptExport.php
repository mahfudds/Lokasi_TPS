<?php

namespace App\Exports;

use App\Dpt;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DptExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return Dpt::all();
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            'id' => strval($row->id),
            'Kecamatan' => strval($row->Kecamatan),
            'Kelurahan' => strval($row->Kelurahan),
            'Kode_Kelurahan' => "'".strval($row->Kode_Kelurahan),
            'No_TPS' => strval($row->No_TPS),
            'Latitude' => "'".strval($row->Latitude),
            'Longitude' => "'".strval($row->Longitude),
            'Jumlah_Pemilih' => strval($row->Jumlah_Pemilih),
            'validasi' => strval($row->validasi),
            'id_tabel' => strval($row->id_tabel),
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'Kecamatan',
            'Kelurahan',
            'Kode_Kelurahan',
            'No_TPS',
            'Latitude',
            'Longitude',
            'Jumlah_Pemilih',
            'validasi',
            'id_tabel',
        ];
    }
}
