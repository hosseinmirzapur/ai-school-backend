<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;


/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $active
 * @property int $school_id
 * @property int $role_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read School $school
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static Builder|Admin newModelQuery()
 * @method static Builder|Admin newQuery()
 * @method static Builder|Admin query()
 * @method static Builder|Admin whereActive($value)
 * @method static Builder|Admin whereCreatedAt($value)
 * @method static Builder|Admin whereEmail($value)
 * @method static Builder|Admin whereId($value)
 * @method static Builder|Admin whereName($value)
 * @method static Builder|Admin wherePassword($value)
 * @method static Builder|Admin whereRoleId($value)
 * @method static Builder|Admin whereSchoolId($value)
 * @method static Builder|Admin whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

}
