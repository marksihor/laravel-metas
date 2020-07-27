<?php

namespace MarksIhor\LaravelMetas;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $guarded = ['id'];

    public function metable()
    {
        return $this->morphTo();
    }

    public function getValueAttribute($value)
    {
        return $this->isJson($value) ? json_decode($value, true) : $value;
    }

    public function setValueAttribute($value)
    {
        return is_array($value) ? json_encode($value) : $value;
    }

    protected function isJson($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE);
    }
}