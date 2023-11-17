<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'rating' => 'required',
            'accommodation_type' => 'required',
            'location_id' => 'required',
            'images' => 'required',
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Полето за име е задолжително',
        'description.required' => 'Полето за опис е задолжително',
        'rating.required' => 'Полето со рејтинг е задолжително',
        'accommodation_type.required' => 'Полето за тип на сместување е задолжително',
        'location_id.required' => 'Локацијата е задолжителна',
        'images.required' => 'Слики се задолжителни',
    ];
}
}
