<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
        [
			'id' => 'required',
			'Kecamatan' => 'required',
			'Kelurahan' => 'required',
			'Kode_Kelurahan' => 'required',
			'No_TPS' => 'required',
			'Latitude' => 'required',
			'Longitude' => 'required',
			'Jumlah_Pemilih' => 'required',
			'validasi' => 'required',
        ];
    }
}
