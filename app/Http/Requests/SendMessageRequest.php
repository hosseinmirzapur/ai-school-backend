<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => [
                'nullable',
                'file',
                'max:10240',
                'mimetypes:application/pdf,image/*,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ],
            'voice' => 'nullable|mimetypes:audio/mpeg,audio/mp4,audio/x-wav,audio/webm|max:20480',
            'content' => 'required_if:voice,null'
        ];
    }
}
