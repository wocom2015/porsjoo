<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Inquiry extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'url' => "/inquiry/details/" . $this->id . "/" . str_replace(" ", "-", $this->name),
            'provinceName' => $this->province->name,
            'categoryName' => $this->category->name,
            'closeDate' => ($this->close_date != '') ? jdate($this->close_date)->format('%A, %d %B %Y') : ''
        ];
    }
}
