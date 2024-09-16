<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
        return [
            'no_kendaraan' => 'required|unique:vehicles,no_kendaraan',
            'jenis_kendaraan' => 'required',
            'kepemilikan' => 'required',
            'status' => 'required',
        ];
    }
}
