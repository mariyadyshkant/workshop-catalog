<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public const STATUSES = ['In programma', 'In aggiornamento', 'Cancellato'];
    public const DELIVERY_MODES = ['Online', 'In presenza', 'Misto'];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration_hours' => 'required|integer|min:1',
            'requirements' => 'required|string',
            'status' => ['required', Rule::in(self::STATUSES)],
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'language' => 'required|string|max:50',
            'delivery_mode' => ['required', Rule::in(self::DELIVERY_MODES)],
            // obbligatoria solo per i corsi in presenza
            'city' => ['nullable', 'string', 'max:255', 'required_if:delivery_mode,In presenza'],
            'available_spots' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }
}
