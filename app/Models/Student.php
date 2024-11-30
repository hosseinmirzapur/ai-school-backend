<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 *
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $mobile
 * @property string|null $email
 * @property string $username
 * @property string $password
 * @property string|null $gender
 * @property string|null $dob
 * @property int $classroom_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Chat> $chats
 * @property-read int|null $chats_count
 * @property-read Classroom $classroom
 * @property-read Collection<int, Message> $messages
 * @property-read int|null $messages_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static StudentFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class Student extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $hidden = ['password'];

    /**
     * @return BelongsTo
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    /**
     * @return HasMany
     */
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return HasMany
     */
    public function homeworkSubmissions(): HasMany
    {
        return $this->hasMany(HomeworkSubmission::class);
    }

    /**
     * @return HasMany
     */
    public function quizSubmissions(): HasMany
    {
        return $this->hasMany(QuizSubmission::class);
    }

    /**
     * @param array<int, int> $years
     * @return Collection
     */
    public function marksForChart(array $years): Collection
    {
        return $this->chats()
            ->where('active', false)
            ->where('type', 'quiz')
            ->select([
                'MONTH(created_at) as month',
                'AVG(scores) as avg_mark',
                'COUNT(*) as total_chats',
            ])
            ->whereBetween('created_at', $years)
            ->groupBy('student_id', 'month')
            ->orderBy('student_id')
            ->orderBy('month')
            ->get();
    }

    /**
     * @return Collection
     */
    public function marksPerSubject(): Collection
    {
        return $this->chats()
            ->whereNotNull('subject_id')
            ->where('active', false)
            ->where('type', 'quiz')
            ->select([
                'AVG(scores) as avg_mark',
                'COUNT(*) as total_chats',
            ])
            ->join('subjects', 'subjects.id', '=', 'chats.subject_id')
            ->groupBy('subject_id')
            ->get();
    }

    /**
     * @return Chat|Model
     */
    public function newQuiz(): Chat|Model
    {
        return $this->chats()->create([
            'type' => 'quiz',
            'identifier' => Str::uuid()
        ]);
    }

    /**
     * @return Chat|Model
     */
    public function newCasual(): Chat|Model
    {
        return $this->chats()->create([
            'type' => 'casual',
            'identifier' => Str::uuid()
        ]);
    }

}
