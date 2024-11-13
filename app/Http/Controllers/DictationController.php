<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\SubmitDictationRequest;
use App\Models\Dictation;
use App\Services\DictationService;
use Illuminate\Http\JsonResponse;

class DictationController extends Controller
{
    public function __construct(private readonly DictationService $service)
    {
    }

    /**
     * @param SubmitDictationRequest $request
     * @param Dictation $dictation
     * @return JsonResponse
     * @throws CustomException
     */
    public function submit(SubmitDictationRequest $request, Dictation $dictation): JsonResponse
    {
        $data = $request->validated();

        $result = $this->service->submit($data, $dictation);

        return response()->json($result);
    }
}
