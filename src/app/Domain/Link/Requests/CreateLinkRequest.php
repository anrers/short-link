<?php

namespace App\Domain\Link\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required'],
            'original' => ['required', 'url'],
        ];
    }
}
