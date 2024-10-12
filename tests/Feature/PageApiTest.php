<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

    }

    /**
     * @return void
     */
    public function test_home_page(): void
    {
        $response = $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/home');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'profile', 'notifications', 'monthlyMarks'
        ]);
    }

    /**
     * @return void
     */
    public function test_sources_page(): void
    {
        $response = $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )->get('/api/pages/sources');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'sources' => [
                '*' => ['name', 'slug', 'image']
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_lessons_page(): void
    {
        /** @var Subject $subject */
        $subject = Subject::all()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/$subject->slug")
            ->assertStatus(200)
            ->assertJsonStructure([
                'lessons' => [
                    '*' => ['name', 'slug']
                ]
            ]);

    }

    /**
     * @return void
     */
    public function test_sliders_page(): void
    {
        /** @var Lesson $lesson */
        $lesson = Lesson::whereHas('sliders')->get()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/lessons/$lesson->slug/sliders")
            ->assertStatus(200)
            ->assertJsonStructure([
                'sliders' => [
                    '*' => ['image', 'order']
                ]
            ]);


    }

    /**
     * @return void
     */
    public function test_videos_page(): void
    {
        /** @var lesson $lesson */
        $lesson = Lesson::whereHas('videos')->get()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/lessons/$lesson->slug/videos")
            ->assertStatus(200)
            ->assertJsonStructure([
                'videos' => [
                    '*' => ['title', 'description', 'thumbnail', 'file']
                ]
            ]);
    }

    /**
     * @return void
     */
    public function test_flashcards_page(): void
    {
        /** @var Lesson $lesson */
        $lesson = Lesson::whereHas('flashcards')->get()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/sources/lessons/$lesson->slug/flashcards")
            ->assertStatus(200)
            ->assertJsonStructure([
                'flashcards' => [
                    '*' => ['question', 'answer', 'image']
                ]
            ]);
    }

    /**
     * @return void
     */
    public function test_weekly_schedule_page(): void
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/weekly-schedule')
            ->assertStatus(200)
            ->assertJsonStructure([
                'schedule' => [
                    '*' => [
                        'sat', 'sun', 'mon', 'tue', 'wed', 'thu'
                    ]
                ]
            ]);
    }

    /**
     * @return void
     */
    public function test_notifications_page(): void
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/notifications')
            ->assertStatus(200)
            ->assertJsonStructure([
                'notifications' // only check if the key exists
            ]);
    }

    /**
     * @return void
     */
    public function test_settings_page(): void
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/settings')
            ->assertStatus(200)
            ->assertJsonStructure([
                'settings' // only check if the key exists
            ]);
    }

    /**
     * @return void
     */
    public function test_chat_page(): void
    {
        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get('/api/pages/chat/history')
            ->assertStatus(200)
            ->assertJsonStructure([
                'chats' => [
                    '*' => [
                        'identifier', 'type', 'score', 'active'
                    ]
                ]
            ]);
    }

    /**
     * @return void
     */
    public function test_chat_messages_are_loaded(): void
    {
        /** @var Chat $chat */
        $chat = Chat::all()->random();

        $this->actingAs(
            Student::factory()->create(),
            'api-student'
        )
            ->get("/api/pages/chat/$chat->identifier")
            ->assertStatus(200)
            ->assertJsonStructure([
                'messages' => [
                    '*' => [
                        'role', 'content', 'has_file', 'has_voice', 'chat_id'
                    ]
                ]
            ]);
    }

    /**
     * @return void
     */
    public function test_about_us_page(): void
    {
        $this->get('/api/pages/about-us')
            ->assertStatus(200)
            ->assertJsonStructure([
                'aboutUs'
            ]);
    }

    /**
     * @return void
     */
    public function test_contact_us_page(): void
    {
        $this->get('/api/pages/contact-us')
            ->assertStatus(200)
            ->assertJsonStructure([
                'contactUs'
            ]);
    }
}
