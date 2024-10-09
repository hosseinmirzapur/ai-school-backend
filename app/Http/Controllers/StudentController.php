<?php

namespace App\Http\Controllers;


use App\Exceptions\CustomException;
use App\Http\Requests\LoginRequest;
use App\Models\Student;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{

    public function __construct(private readonly AuthService $service)
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $res = $this->service->login($data);
        return response()->json($res);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        /** @var Student $student */
        $student = request()->user();
        $student->tokens()->delete();
        return response()->json();
    }
}
