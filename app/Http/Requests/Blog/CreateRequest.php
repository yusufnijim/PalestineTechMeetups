<?php

namespace App\Http\Requests\Blog;

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
            'title'        => 'required|max:255',
            'permalink'    => 'required|unique:event,permalink,'.getSegmentFromEnd($this).',id',
            'body'         => 'required',
            'is_published' => 'bool',
        ];
    }
}
