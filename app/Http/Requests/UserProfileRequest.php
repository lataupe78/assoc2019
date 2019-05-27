<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
    		'name' => ['sometimes', 'required', 'min:3'],

    		'avatar_file' => ['nullable', 'image', 'dimensions:min_width=64,min_height=64'],

    		'birth' => [
    			'nullable',
    			'date_format:d/m/Y',
    			'before:'.date('Y-m-d')
    		],

    		'phone' => '',
    		'city' => '',
    		'postcode' => '',
    		'street_address' => '',

    		'password' => ['sometimes', 'string', 'min:8', 'confirmed'],

    	];
    }
}
