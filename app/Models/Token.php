<?php

namespace App\Models;

use App\Models\Scopes\HasId;
use App\Models\Scopes\HasIdentifier;

use App\Models\Relations\Token\HasUser;

use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Token
 *
 * @property int $id
 *
 * @property string $access_token
 * @property string $refresh_token
 *
 * @property int $user_id
 * @property string $user_ip
 * @property string $user_agent
 *
 * @property Carbon|null $used_at
 * @property Carbon|null $expired_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @method static Token|Builder findById(int $id)
 * @method static Token|Builder findByIdentifier(string $identifier, mixed $value)
 *
 * @mixin Model
 */
final class Token extends Model
{
    use HasId;
    use HasIdentifier;

    use HasUser;

    /**
     * @var string
     */
    protected $table = 'tokens';

    /**
     * @var array
     */
    protected $fillable = [
        'access_token',
        'refresh_token',
        'user_id',
        'user_ip',
        'user_agent',
        'used_at',
        'expired_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'int',
        'access_token' => 'string',
        'refresh_token' => 'string',
        'user_id' => 'int',
        'user_ip' => 'string',
        'user_agent' => 'string',
        'used_at' => 'datetime',
        'expired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
