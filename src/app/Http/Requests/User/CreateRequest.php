<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class CreateRequest extends Request
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
            'first_name' => 'required|max:255',
            'email' => 'required|max:255|unique:user,email,' . getSegmentFromEnd($this) . ',id',
            'last_name' => 'max:255',
            'arabic_full_name' => 'required|max:255',
            'location' => 'max:255',
            'phone_number' => 'numeric|digits_between:8,12',
            'profession' => 'max:255',
            'profession_location' => 'max:255',
            'gender' => '',
            'image' => 'image'
        ];
    }
}
