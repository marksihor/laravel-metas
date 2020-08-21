<?php

namespace MarksIhor\LaravelMetas;

use MarksIhor\LaravelMetas\Meta;

trait Metable
{
    public function metas()
    {
        return $this->morphMany('MarksIhor\LaravelMetas\Meta', 'metable');
    }

    public function getMetas(?array $additionalCredentials = []): array
    {
        $result = [];
        $metas = Meta::where(array_merge(
            ['metable_id' => $this->id, 'metable_type' => $this->getMorphClass()],
            $additionalCredentials
        ))->get(['key', 'value']);

        foreach ($metas as $meta) $result[$meta->key] = $meta->value;

        return $result;
    }

    public function setMeta(string $key, $value, ?array $additionalCredentials = [])
    {
        return Meta::updateOrCreate(
            array_merge(
                ['metable_id' => $this->id, 'metable_type' => $this->getMorphClass(), 'key' => $key],
                $additionalCredentials
            ),
            ['value' => $value]
        );
    }

    public function getMeta(string $key, ?array $additionalCredentials = [])
    {
        $meta = Meta::where(array_merge(
            ['metable_id' => $this->id, 'metable_type' => $this->getMorphClass(), 'key' => $key],
            $additionalCredentials
        ))->first('value');

        return $meta ? $meta->value : null;
    }

    public function unsetMeta(string $key, ?array $additionalCredentials = [])
    {
        Meta::where(array_merge(
            ['metable_id' => $this->id, 'metable_type' => $this->getMorphClass(), 'key' => $key],
            $additionalCredentials
        ))->delete();
    }
}