<?php

namespace App\Http\Resources\Permissions;

use App\Helpers\AmountHelper;
use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionIndexResource extends JsonResource
{
    public function toArray($request = null): array
    {
        return array_replace($this->resource->toArray(), [
            'created_at' => DateHelper::toDateString($this->created_at),
        ]);
    }
}
