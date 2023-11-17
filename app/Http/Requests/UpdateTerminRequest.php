<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTerminRequest extends FormRequest
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
            'date_from' => 'required|date',
            'date_until' => 'required|date',
            'price_per_night' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'date_from.required' => 'Полето за почеток на термин е празно',
            'date_until.required' => 'Полето за крај на термин е празно',
            'price_per_night.required' => 'Полето за цена е празно',
            'date_from.date' => 'Полето за почеток на термин мора да биде валидна дата',
            'date_until.date' => 'Полето за крај на термин мора да биде валидна дата',
            'numeric.price_per_night' => 'Полето за цена мора да биде број'
        ];
    }
}
