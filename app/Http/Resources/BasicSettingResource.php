<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BasicSettingResource extends JsonResource
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
            'title' => $this->title,
            'level' => $this->level,
            'name' => $this->translate('en')->name,
            'name_bn' => $this->translate('bn')->name,
            'address' => $this->address,
            'phone' => $this->phone
        ];
    }
}
