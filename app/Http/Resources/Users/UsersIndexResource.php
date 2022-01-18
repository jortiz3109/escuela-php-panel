<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersIndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return array_replace($this->resource->toArray(), [
            'url' => route('users.status.toggle', $this->resource),
            'enabled' => $this->resource->isEnabled(),
            'button_enabled' => true,
        ]);
    }
}
