<?php

namespace App\Models;

use App\Models\Scopes\HasId;
use App\Models\Scopes\HasSlug;

use App\Models\Traits\HasDate;

use App\Models\Relations\Permission\HasRoles;
use App\Models\Relations\Permission\HasPolicy;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Permission
 *
 * @property int $id
 *
 * @property string $name
 * @property string $slug
 *
 * @property int $policy_id
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Policy $policy
 * @property-read Role[]|Collection $roles
 *
 * @method static Policy|Builder filter(array $attributes)
 * @method static Policy|Builder findById(int $id)
 * @method static Policy|Builder findBySlug(string $slug)
 *
 * @mixin Model
 */
final class Permission extends Model
{
    use HasId;
    use HasSlug;

    use HasDate;

    use HasRoles;
    use HasPolicy;

    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'permissions';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'policy_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'slug' => 'string',
        'policy_id' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @param Builder $query
     * @param array $attributes
     *
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $attributes): Builder
    {
        return $query
            ->when($attributes['search'] ?? null, function ($query, $search) {
                return $query
                    ->where('id', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('slug', 'like', "%$search%");
            })
            ->when($attributes['name'] ?? null, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })
            ->when($attributes['slug'] ?? null, function ($query, $slug) {
                return $query->where('slug', 'like', "%$slug%");
            })
            ->when($attributes['policy_id'] ?? null, function ($query, $policy_id) {
                return $query->where('policy_id', '=', $policy_id);
            })
            ->when($attributes['date'] ?? null, function ($query, $date) {
                return $query->whereBetween('created_at', [
                    $this->getDate($date['from']),
                    $this->getDate($date['to']),
                ]);
            })
            ->when($attributes['sort'] ?? null, function ($query, $sort) {
                return $query->orderBy($sort['by'], $sort['type']);
            });
    }
}
