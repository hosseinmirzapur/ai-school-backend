<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, DailySchedule> $dailySchedules
 * @property-read int|null $daily_schedules_count
 * @property-read Collection<int, Teacher> $teachers
 * @property-read int|null $teachers_count
 * @property-read Collection<int, Lesson> $lessons
 * @property-read int|null $lessons_count
 * @method static Builder|Subject newModelQuery()
 * @method static Builder|Subject newQuery()
 * @method static Builder|Subject query()
 * @method static Builder|Subject whereCreatedAt($value)
 * @method static Builder|Subject whereId($value)
 * @method static Builder|Subject whereImage($value)
 * @method static Builder|Subject whereName($value)
 * @method static Builder|Subject whereSlug($value)
 * @method static Builder|Subject whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Subject extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function dailySchedules(): HasMany
    {
        return $this->hasMany(DailySchedule::class);
    }

    /**
     * @return HasMany
     */
    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }

    /**
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
