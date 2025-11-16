<?php

namespace Syndicate\Architect\Facades;

use Illuminate\Support\Facades\Facade;
use Syndicate\Architect\Services\ArchitectService;

/**
 * @mixin ArchitectService
 */
class Architect extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ArchitectService::class;
    }
}
