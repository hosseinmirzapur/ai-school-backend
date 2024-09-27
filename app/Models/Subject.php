<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
