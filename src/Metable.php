<?php

namespace MarksIhor\LaravelMetas;

use MarksIhor\LaravelMetas\Meta;

trait Metable
{
    public function metas()
    {
        return $this->morphMany('App\Models\Meta', 'metable');
    }

    public function getMetas(): array
    {
        $result = [];
        $metas = Meta::where([
            'metable_id' => $this->id, 'metable_type' => $this->getMorphClass()
        ])->get(['key', 'value']);

        foreach ($metas as $meta) $result[$meta->key] = $meta->value;

        return $result;
    }

    public function setMeta(string $key, $value)
    {
        return Meta::updateOrCreate(
            ['metable_id' => $this->id, 'metable_type' => $this->getMorphClass(), 'key' => $key],
            ['value' => $value]
        );
    }

    public function getMeta(string $key)
    {
        $meta = Meta::where([
            'metable_id' => $this->id, 'metable_type' => $this->getMorphClass(), 'key' => $key
        ])->first('value');

        return $meta ? $meta->value : null;
    }

    public function unsetMeta(string $key)
    {
        Meta::where([
            'metable_id' => $this->id, 'metable_type' => $this->getMorphClass(), 'key' => $key
        ])->delete();
    }
}