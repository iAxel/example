<?php

namespace App\Models;

use App\Models\Scopes\HasId;
use App\Models\Scopes\HasEmail;

use App\Models\Traits\HasCUD;
use App\Models\Traits\HasDate;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Auth\Authenticatable;
use App\Models\Auth\Gate\Authorizable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * App\Models\User
 *
 * @property int $id
 *
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @mixin Model
 */
final class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasId;
    use HasEmail;

    use HasCUD;
    use HasDate;

    use HasFactory;

    use Authorizable;
    use Authenticatable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @param array $attributes
     *
     * @return Builder
     */
    public function filter(array $attributes): Builder
    {
        return $this->newQuery()
            ->when($attributes['search'] ?? null, function ($query, $search) {
                return $query
                    ->where('id', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            })
            ->when($attributes['name'] ?? null, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })
            ->when($attributes['email'] ?? null, function ($query, $email) {
                return $query->where('email', 'like', "%$email%");
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
