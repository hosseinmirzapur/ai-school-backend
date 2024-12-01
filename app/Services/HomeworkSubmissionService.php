<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Student;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Storage;

class HomeworkSubmissionService
{
    /**
     * @param Homework $homework
     * @param array $data
     * @return void
     * @throws CustomException
     */
    public function submitHomework(Homework $homework, array $data): void
    {
        /** @var Student $student */
        $student = auth()->user();

        // only save homework submission once
        $exists = HomeworkSubmission::query()
            ->where('homework_id', $homework->id)
            ->where('student_id', $student->id)
            ->exists();
        if ($exists) {
            throw new CustomException('exists_err');
        }

        // save the submission_file
        $path = '/homework';
        /** @var UploadedFile $file */
        $file = $data['submission_file'];
        $filename = Str::random(10) . now() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($path, $file, $filename);

        // save to db
        $student->homeworkSubmissions()->create([
            'homework_id' => $homework->id,
            'submission_file' => "$path/$filename",
            'submitted_at' => now(),
        ]);
    }
}