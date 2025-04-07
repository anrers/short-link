<?php

namespace App\Domain\Link\Models;

use App\Domain\User\Models\User;
use App\Infrastructure\Abstracts\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable
        = [
            'name',
            'original',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
