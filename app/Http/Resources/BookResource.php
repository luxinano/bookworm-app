<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'book_title' => $this->book_title,
            'book_summary' => $this->book_summary,
            'book_price' => $this->book_price + 0,
            'book_cover_photo' => $this->book_cover_photo,

            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
            // 'discounts' => $this->availableDiscounts,
            // 'reviews' => $this->reviews,
            // 'sub_price' => $this->sub_price + 0,

            'final_price' => $this->final_price + 0,
            'avg_rate' => $this->avg_rate + 0,
            'counted_review' => $this->counted_review + 0,
            'star_list' => $this->stars_list + 0,
        ];
    }
}
