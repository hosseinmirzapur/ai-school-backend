<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\SubmitHomeworkRequest;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Services\HomeworkSubmissionService;
use Illuminate\Http\JsonResponse;

class HomeworkSubmissionController extends Controller
{
    public function __construct(private readonly HomeworkSubmissionService $service)
    {

    }

    /**
     * @param SubmitHomeworkRequest $request
     * @param Homework $homework
     * @return JsonResponse
     * @throws CustomException
     */
    public function store(SubmitHomeworkRequest $request, Homework $homework): JsonResponse
    {
        $data = $request->validated();
        $this->service->submitHomework($homework, $data);
        return response()->json();
    }

    /**
     * @param HomeworkSubmission $submission
     * @return JsonResponse
     */
    public function destroy(HomeworkSubmission $submission): JsonResponse
    {
        $submission->delete();
        return response()->json();
    }
}
