<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string id
 * @property int album_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string name
 * @property string description
 * @property Carbon deleted_at
 * @property string img_path
 *
 */
class PhotoResource extends JsonResource
{
    protected const string TYPE = 'photos';

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
                'name' => $this->name,
                'album_id' => $this->album_id,
                'img_path' => $this->img_path,
            ],
            'links' => [
                'self' => route('photos.show', $this->id),
            ]
        ];
    }
}
