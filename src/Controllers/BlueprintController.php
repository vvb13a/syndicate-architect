<?php

namespace Syndicate\Architect\Controllers;

use Illuminate\Contracts\View\View;
use Syndicate\Architect\Contracts\BlueprintKey;

class BlueprintController
{
    public function show(BlueprintKey $key): View
    {
        return $key->getBlueprint()->render($key);
    }
}
