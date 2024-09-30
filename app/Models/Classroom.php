<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $school_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DailySchedule|null $dailySchedule
 * @property-read Collection<int, Student> $students
 * @property-read int|null $students_count
 * @property-read Collection<int, Teacher> $teachers
 * @property-read int|null $teachers_count
 * @method static Builder|Classroom newModelQuery()
 * @method static Builder|Classroom newQuery()
 * @method static Builder|Classroom query()
 * @method static Builder|Classroom whereCreatedAt($value)
 * @method static Builder|Classroom whereId($value)
 * @method static Builder|Classroom whereName($value)
 * @method static Builder|Classroom whereSchoolId($value)
 * @method static Builder|Classroom whereSlug($value)
 * @method static Builder|Classroom whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Classroom extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * @return HasMany
     */
    public function dailySchedules(): HasMany
    {
        return $this->hasMany(DailySchedule::class);
    }
}
