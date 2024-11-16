<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Dictation;
use App\Models\DictationSubmission;
use App\Models\Student;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DictationService
{
    /**
     * @param array $data
     * @param Dictation $dictation
     * @return array
     * @throws CustomException
     */
    public function submit(array $data, Dictation $dictation): array
    {
        /** @var Student $student */
        $student = request()->user();

        if (isset($data['image'])) {
            /** @var UploadedFile $file */
            $file = $data['image'];
            $now = now()->timestamp;
            $randomStr = Str::random(10);
            $filename = "$now.$randomStr.{$file->getClientOriginalExtension()}";
            try {
                Storage::putFileAs('/', $file, $filename);
            } catch(Exception $e) {
                throw new CustomException($e->getMessage(), 400);
            }

            $data['image'] = $filename;
        } else {
            $data['image'] = null;
        }

        DictationSubmission::create([
            'student_id' => $student->id,
            'dictation_id' => $dictation->id,
            'image' => $data['image'],
            'text' => $data['text'],
        ]);

        return [
            'dictation' => $dictation->load('submissions')
        ];
    }
}
