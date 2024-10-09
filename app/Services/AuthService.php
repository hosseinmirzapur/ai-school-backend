<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param array $data
     * @return array
     * @throws CustomException
     */
    public function login(array $data): array
    {
        $username = $data['username'];
        $password = $data['password'];

        /** @var Student $student */
        $student = Student::where('username', $username)->firstOrFail();

        if (!Hash::check($password, $student->password)) {
            throw new CustomException('auth_error');
        }

        return [
            'student' => $student,
            'token' => $student->createToken($student->username)->plainTextToken,
        ];
    }
}
