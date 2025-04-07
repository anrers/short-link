<?php

namespace App\Domain\Link\Models;

use App\Domain\User\Models\User;
use App\Infrastructure\Abstracts\Models\BaseModel;
use Database\Factories\LinkFactory;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int         $id
 * @property string      $name
 * @property string      $code
 * @property string      $original
 * @property string      $partition
 * @property int         $user_id
 * @property int         $counts
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User   $user
 * @method static Builder<static>|Link newModelQuery()
 * @method static Builder<static>|Link newQuery()
 * @method static Builder<static>|Link query()
 * @method static Builder<static>|Link whereCode($value)
 * @method static Builder<static>|Link whereCounts($value)
 * @method static Builder<static>|Link whereCreatedAt($value)
 * @method static Builder<static>|Link whereId($value)
 * @method static Builder<static>|Link whereName($value)
 * @method static Builder<static>|Link whereOriginal($value)
 * @method static Builder<static>|Link wherePartition($value)
 * @method static Builder<static>|Link whereUpdatedAt($value)
 * @method static Builder<static>|Link whereUserId($value)
 * @mixin Eloquent
 */
class Link extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable
        = [
            'name',
            'original',
            'code',
            'user_id',
            'partition',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return LinkFactory::new();
    }
}
