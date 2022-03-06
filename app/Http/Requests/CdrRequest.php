<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CdrRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'rate' => 'required|array',
            'rate.energy' => 'required|numeric|min:0',
            'rate.time' => 'required|numeric|min:0',
            'rate.transaction' => 'required|numeric|min:0',
            'cdr' => 'required|array',
            'cdr.meterStart' => 'required|int|min:0',
            'cdr.timestampStart' => 'required|date',
            'cdr.meterStop' => 'required|int|min:0|numeric|gt:cdr.meterStart',
            'cdr.timestampStop' => 'required|date|after_or_equal:cdr.timestampStart',
        ];
    }
}
