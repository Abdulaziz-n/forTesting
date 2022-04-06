<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CvRequest extends FormRequest
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
            'position' => 'required|string',
            'name' => 'required|string',
            'date_of_birth' => 'required|string',
            'nationality' => 'required|string',
            'marital_status' => 'required|string',
            'city' => 'required|string',
            'district' => 'string',
            'street' => 'string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'stir' => 'required|string',
            'education' => 'required|string',
            'speciality' => 'required|string',
            'education_place' => 'required|string',
            'date_finished' => 'string',
            'enter_happy' => 'string',
            'additional_information' => 'string',
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,docx|max:2048',
        ];
    }
}
