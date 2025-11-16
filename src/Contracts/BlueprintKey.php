<?php

namespace Syndicate\Architect\Contracts;

use BackedEnum;
use Illuminate\Database\Eloquent\Model;

interface BlueprintKey extends BackedEnum
{
    public static function getId(): string;

    public function link(): string;

    public function getBlueprint(): Blueprint;

    public function getRecord(): ?Model;
}
