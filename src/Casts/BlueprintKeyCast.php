<?php

namespace Syndicate\Architect\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Syndicate\Architect\Contracts\BlueprintKey;
use Syndicate\Architect\Services\ArchitectService;

class BlueprintKeyCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): BlueprintKey
    {
        return $attributes['fqn']::from($attributes['key']);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return $value instanceof BlueprintKey ? $value->value : $value;
    }
}
