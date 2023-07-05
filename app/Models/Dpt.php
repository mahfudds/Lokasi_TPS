<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpt extends Model
{
    use HasFactory;
    protected $table ='dpt';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
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
    protected $guarded = ['id'];
}
