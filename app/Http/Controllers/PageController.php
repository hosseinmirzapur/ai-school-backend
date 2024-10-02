<?php

namespace App\Http\Controllers;

use App\Services\PageService;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function __construct(private readonly PageService $service) {}

    /**
     * @return JsonResponse
     */
    public function home(): JsonResponse
    {
        /* Data needed:
         * profile: full-name, email, grade
         * notifications: title, text, seen
         * monthly marks chart data: student + school
         * marks per subjects chart data
         */
        $data = $this->service->home();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function sources(): JsonResponse
    {
        /* Data needed:
         * subjects
         */
        $data = $this->service->sources();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function weeklySchedule(): JsonResponse
    {
        /* Data needed:
         * daily schedule of the student containing:
         * - day
         * - subjects: title, duration
         */
        $data = $this->service->weeklySchedule();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function notifications(): JsonResponse
    {
        /*
         * Coming soon (send only status code 200)
         */
        $data = $this->service->notifications();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function settings(): JsonResponse
    {
        /*
         * Coming soon (send only status code 200)
         */
        $data = $this->service->settings();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function chat(): JsonResponse
    {
        /* Data needed:
         * daily chat history
         */
        $data = $this->service->chat();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function aboutUs(): JsonResponse
    {
        /* Data needed
         * markdown content for about us
         */
        $data = $this->service->aboutUs();
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     */
    public function contactUs(): JsonResponse
    {
        /* Data needed
         * contact-us data like email, phone number or address
         * a markdown for contact us page if needed
         */
        $data = $this->service->contactUs();
        return response()->json($data);
    }
}