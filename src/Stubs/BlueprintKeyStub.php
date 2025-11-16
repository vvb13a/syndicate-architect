<?php

namespace Syndicate\Architect\Stubs;

use Illuminate\Database\Eloquent\Model;
use Syndicate\Architect\Contracts\Blueprint as BlueprintContract;
use Syndicate\Architect\Contracts\BlueprintKey;
use Syndicate\Architect\Models\Blueprint;

enum BlueprintKeyStub: string implements BlueprintKey
{
    case Foo = 'foo';
    case Bar = 'bar';

    public function link(): string
    {
        return route(self::getId() . '.' . app()->currentLocale() . '.' . $this->value);
    }

    public static function getId(): string
    {
        return class_basename(self::class);
    }

    public function getBlueprint(): BlueprintContract
    {
        // TODO
    }

    public function getRecord(): ?Model
    {
        return Blueprint::blueprintKey($this)->first();
    }
}
