<?php

namespace App\Models;

use App\Models\Scopes\HasId;
use App\Models\Scopes\HasSlug;

use App\Models\Traits\HasDate;

use App\Models\Relations\Role\HasUsers;
use App\Models\Relations\Role\HasPermissions;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Role
 *
 * @property int $id
 *
 * @property string $name
 * @property string $slug
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read User[]|Collection $users
 * @property-read Permission[]|Collection $permissions
 *
 * @method static Role|Builder filter(array $attributes)
 * @method static Role|Builder findById(int $id)
 * @method static Role|Builder findBySlug(string $slug)
 *
 * @mixin Model
 */
final class Role extends Model
{
    use HasId;
    use HasSlug;

    use HasDate;

    use HasUsers;
    use HasPermissions;

    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'slug' => 'string',
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
