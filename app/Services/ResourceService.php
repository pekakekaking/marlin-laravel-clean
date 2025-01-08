<?php

namespace App\Services;

class ResourceService
{
    /**
     * Create a new class instance.
     */
    public function collectAll(string $model, $relation = null)
    {
        $ResourceName = $this->getResourceName($model);
        $query = ('App\\Models\\'.$model)::query();
        if (isset($relation)) {
            $query->with($relation);
        }
        $collection = $ResourceName::collection($query->get())->resolve();

        return $collection;

    }

    public function collectOne(object $item, $relation = null)
    {
        $ResourceName = $this->getResourceName(class_basename($item));
        if (isset($relation)) {
            $result = $ResourceName::make($item->load($relation))->resolve();
        } else {
            $result = $ResourceName::make($item)->resolve();
        }

        return $result;
    }

    protected function getResourceName(string $model)
    {
        return 'App\\Http\\Resources\\'.$model.'Resource';
    }
}
