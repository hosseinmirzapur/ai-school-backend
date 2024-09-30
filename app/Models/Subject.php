<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, DailySchedule> $dailySchedules
 * @property-read int|null $daily_schedules_count
 * @property-read Collection<int, Teacher> $teachers
 * @property-read int|null $teachers_count
 * @method static Builder|Subject newModelQuery()
 * @method static Builder|Subject newQuery()
 * @method static Builder|Subject query()
 * @method static Builder|Subject whereCreatedAt($value)
 * @method static Builder|Subject whereId($value)
 * @method static Builder|Subject whereName($value)
 * @method static Builder|Subject whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Subject extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function dailySchedules(): BelongsToMany
    {
        return $this->belongsToMany(DailySchedule::class);
    }

    /**
     * @return BelongsToMany
     */
    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class);
    }
}
