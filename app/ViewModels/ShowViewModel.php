<?php

namespace App\ViewModels;

use App\Http\Resources\Merchants\ShowResource;
use App\ViewModels\Concerns\HasModel;

abstract class ShowViewModel extends ViewModel
{
    use HasModel;

    public function toArray(): array
    {
        return [
                'buttons' => $this->buttons(),
                'texts' => $this->texts(),
                'fields' => $this->fields(),
            ] + $this->data();
    }

    protected function title(): string
    {
        return $this->model->name;
    }

    protected function data(): array
    {
        return ['model' => (new ShowResource($this->model))->toArray()];
    }
}
