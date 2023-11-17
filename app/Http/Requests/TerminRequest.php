<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'termins_from' => 'required|date',
            'termins_number' => 'required|numeric',
            'number_of_nights' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
    return [
        'termins_from.required' => 'Полето за старт на термини е задолжително',
        'termins_number.required' => 'Полето за број на термини задолжително',
        'number_of_nights.required' => 'Полето за нокевања е задожително',
        'termins_from.date' => 'Терминот мора да биде во формат на дата',
        'termins_number.numeric' => 'Полето за број на термини мора да биде бројка',
        'number_of_nights.numeric' => 'Полето за број на нокевања мора да биде бројка',
    ];
    }
}
