<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
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
        return response()->json();
    }

    /**
     * @return JsonResponse
     */
    public function sources(): JsonResponse
    {
        /* Data needed:
         * subjects
         */
        return response()->json();
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
        return response()->json();
    }

    /**
     * @return JsonResponse
     */
    public function notifications(): JsonResponse
    {
        /*
         * Coming soon (send only status code 200)
         */
        return response()->json();
    }

    /**
     * @return JsonResponse
     */
    public function settings(): JsonResponse
    {
        /*
         * Coming soon (send only status code 200)
         */
        return response()->json();
    }
}
