<?php

namespace App\Http\Requests\Parser;

use Illuminate\Foundation\Http\FormRequest;

class Url extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'url' => 'required|url|max:255',
        ];
    }
}
