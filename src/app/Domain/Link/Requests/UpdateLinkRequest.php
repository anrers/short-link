<?php

namespace App\Domain\Link\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class UpdateLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id'       => [
                'integer',
                'min:1',
                Rule::exists('links')->where(function (Builder $query) {
                    $query->where('user_id', $this->user()->id);
                }),
            ],
            'name'     => ['required'],
            'original' => ['required', 'url'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}
