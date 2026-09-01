<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'duration_hours' => $this->duration_hours,
            'requirements' => $this->requirements,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'language' => $this->language,
            'delivery_mode' => $this->delivery_mode,
            'image' => $this->image,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'level' => new LevelResource($this->whenLoaded('level')),
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
        ];
    }
}
