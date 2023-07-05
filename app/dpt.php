<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dpt extends Model
{
    use HasFactory;
    protected $table ='dpt';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'Kecamatan',
        'Kelurahan',
        'Kode_Kelurahan',
        'No_TPS',
        'Latitude',
        'Longitude',
        'Jumlah_Pemilih',
        'validasi',
        'l',
        'p',
        'alamat',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
}
