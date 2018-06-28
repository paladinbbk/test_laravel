<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class File extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'url' => 'required|url|max:255',
            'cost' => 'numeric',
        ];
    }
}
