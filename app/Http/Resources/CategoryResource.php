<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string category_name
 * @property int user_id
 * @property Carbon deleted_at
 */
class CategoryResource extends JsonResource
{
    protected const string TYPE = 'categories';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'type' => static::TYPE,
            'attributes' => [
                'id' => $this->id,
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
                'category_name' => $this->category_name,
                'user_id' => $this->user_id,
            ],
            'links' => [
                'self' => route('categories.show', $this->id),
            ]
        ];
    }
}
