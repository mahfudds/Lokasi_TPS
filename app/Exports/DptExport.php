<?php

namespace App\Exports;

use App\Dpt;
use Auth;
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
        $user = Auth::user();
        $Kode_Kelurahan = $user->Kode_Kelurahan;
        $Kecamatan = $user->Kecamatan;

        if ($Kode_Kelurahan !== '' && $Kecamatan == '') {
            return Dpt::where('Kode_Kelurahan', $Kode_Kelurahan)->get();
        } elseif ($Kecamatan !== '') {
            return Dpt::where('Kecamatan', $Kecamatan)->get();
        } else {
            return Dpt::get();
        }
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            // 'id' => strval($row->id),
            'Kecamatan' => strval($row->Kecamatan),
            'Kelurahan' => strval($row->Kelurahan),
            'Kode_Kelurahan' =>$row->Kode_Kelurahan,
            'No_TPS' => strval($row->No_TPS),
            'alamat' => strval($row->alamat),
            'Latitude' =>$row->Latitude,
            'Longitude' =>$row->Longitude,
            'l' => strval($row->l),
            'p' => strval($row->p),
            'Jumlah_Pemilih' => strval($row->Jumlah_Pemilih),
            'validasi' => strval($row->validasi),
            // 'id_tabel' => strval($row->id_tabel),
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            // 'id',
            'Kecamatan',
            'Kelurahan',
            'Kode_Kelurahan',
            'No_TPS',
            'Alamat',
            'Latitude',
            'Longitude',
            'l',
            'p',
            'Jumlah_Pemilih',
            'validasi',
            // 'id_tabel',
        ];
    }
}
