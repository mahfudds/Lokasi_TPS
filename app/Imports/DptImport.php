<?php
namespace App\Imports;

use App\dpt;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Illuminate\Support\Str;

HeadingRowFormatter::default('none');

class DptImport implements ToModel, WithUpserts, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $id = md5($row['Kode_Kelurahan'] . $row['No_TPS']);

        return new dpt([
            'id' => $id,
            'Kecamatan' => $row['Kecamatan'],
            'Kelurahan' => $row['Kelurahan'],
            'Kode_Kelurahan' => (string) $row['Kode_Kelurahan'],
            'No_TPS' => $row['No_TPS'],
            'Latitude' => $row['Latitude'],
            'Longitude' => $row['Longitude'],
            'Jumlah_Pemilih' => $row['Jumlah_Pemilih'],
            'validasi' => $row['validasi'],
            'l' => $row['l'],
            'p' => $row['p'],
            'alamat' => $row['Alamat'],
        ]);
    }
    public function uniqueBy()
    {
        return 'id';
    }
}

