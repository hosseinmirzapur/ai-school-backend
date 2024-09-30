<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\HasApiTokens;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property string $password
 * @property int $school_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Classroom> $classrooms
 * @property-read int|null $classrooms_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read School $school
 * @property-read Collection<int, Subject> $subjects
 * @property-read int|null $subjects_count
 * @method static Builder|Teacher newModelQuery()
 * @method static Builder|Teacher newQuery()
 * @method static Builder|Teacher query()
 * @method static Builder|Teacher whereCreatedAt($value)
 * @method static Builder|Teacher whereId($value)
 * @method static Builder|Teacher whereMobile($value)
 * @method static Builder|Teacher whereName($value)
 * @method static Builder|Teacher wherePassword($value)
 * @method static Builder|Teacher whereSchoolId($value)
 * @method static Builder|Teacher whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Teacher extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
