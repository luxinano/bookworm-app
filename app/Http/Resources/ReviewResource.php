<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'book_id' => $this->book_id,
            'review_title' => $this->review_title,
            'review_details' => $this->review_details,
            'review_date' => $this->review_date,
            'rating_start' => $this->rating_start + 0,
        ];
    }
}
