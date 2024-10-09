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
 * @property int $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Admin> $admins
 * @property-read int|null $admins_count
 * @property-read Collection<int, Classroom> $classrooms
 * @property-read int|null $classrooms_count
 * @property-read Collection<int, Student> $students
 * @property-read int|null $students_count
 * @property-read Collection<int, Teacher> $teachers
 * @property-read int|null $teachers_count
 * @method static Builder|School newModelQuery()
 * @method static Builder|School newQuery()
 * @method static Builder|School query()
 * @method static Builder|School whereActive($value)
 * @method static Builder|School whereCreatedAt($value)
 * @method static Builder|School whereId($value)
 * @method static Builder|School whereName($value)
 * @method static Builder|School whereSlug($value)
 * @method static Builder|School whereUpdatedAt($value)
 * @mixin Eloquent
 */
class School extends Model
{
    use HasFactory;

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
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * @return HasMany
     */
    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * @return HasMany
     */
    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }

}
