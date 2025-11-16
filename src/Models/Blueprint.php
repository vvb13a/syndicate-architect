<?php

namespace Syndicate\Architect\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Syndicate\Architect\Casts\BlueprintKeyCast;
use Syndicate\Architect\Contracts\Blueprint as BlueprintContract;
use Syndicate\Architect\Contracts\BlueprintKey;

abstract class Blueprint extends Model
{
    use SoftDeletes;

    protected $table = 'blueprints';

    protected $guarded = [
        'id'
    ];

    public function blueprint(): ?BlueprintContract
    {
        return $this->key->getBlueprint();
    }

    public function scopeType($query, string $enumClass)
    {
        return $query->where('type', $enumClass::getId());
    }

    public function scopeBlueprintKey($query, BlueprintKey $key)
    {
        return $query
            ->where('key', $key->value)
            ->where('type', $key::getId());
    }

    public function link(): string
    {
        return $this->key->link();
    }

    protected function casts(): array
    {
        return [
            'key' => BlueprintKeyCast::class,
        ];
    }
}
