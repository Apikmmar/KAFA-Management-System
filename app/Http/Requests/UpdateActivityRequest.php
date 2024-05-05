<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

class UpdateActivityRequest extends FormRequest
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
     * Rules is the format that apply for the update activity request
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'activity_name' => 'required|string|max:30',
            'activity_description' => 'required|string|max:100',
            'activity_date' =>'required|date|after_or_equal:' . Date::today()->format('d-m-Y'),
            'activity_starttime' => 'required|date_format:H:i|after_or_equal:14:00',
            'activity_endtime' => 'required|date_format:H:i|before_or_equal:18:00',
            'activity_remarks' => 'required|string|max:30',
        ];
    }
}
