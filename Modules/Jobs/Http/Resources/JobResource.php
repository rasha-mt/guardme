<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Modules\App\Http\Resources\CitiesResource;

class JobResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'address' => [
                'line1' => $this->metadata['address']['line1'],
                'line2' => $this->metadata['address']['line2'],
                'line3' => $this->metadata['address']['line3'],
                'city' => $this->metadata['address']['city'],
                'county' => $this->metadata['address']['county'],
                'coord' => [
                    'latitude' => $this->metadata['address']['coord']['latt'],
                    'longitude' => $this->metadata['address']['coord']['long']
                ],
            ],
            'postcode' => $this->postcode,
            'time' => [
                'start' => $this->time_start,
                'end' => $this->time_end
            ],
            'city' => new CitiesResource($this->city),
            'rating' => $this->rating,
            'wages' => $this->wages,
            'publishedOn' => [
                'date' => $this->created_at->format('Y-m-d H:i:s a'),
                'diff' => $this->created_at->diffForHumans()
            ],
        ];
    }
}
