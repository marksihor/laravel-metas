<?php

namespace MarksIhor\LaravelMetas;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SetMetaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;
    private $key;
    private $value;
    private $additionalCredentials;

    public function __construct($model, string $key, $value, ?array $additionalCredentials = [])
    {
        $this->model = $model;
        $this->key = $key;
        $this->value = $value;
        $this->additionalCredentials = $additionalCredentials;
    }

    public function handle()
    {
        $this->model->setMeta($this->key, $this->value, $this->additionalCredentials);
    }
}
