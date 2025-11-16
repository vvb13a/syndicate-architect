<?php

namespace Syndicate\Architect\Stubs;


use Illuminate\Contracts\View\View;
use Syndicate\Architect\Contracts\Blueprint;
use Syndicate\Architect\Contracts\BlueprintKey;

class BlueprintStub implements Blueprint
{
    public function getSlug(): string
    {
        return 'syndicate-architect';
    }

    public function render(BlueprintKey $blueprintKey): View
    {
        // TODO: Implement render() method.
    }

    public function getFormSchema(): array
    {
        return [];
    }

    public function getParent(): ?Blueprint
    {
        return null;
    }

    public function getMiddleware(): array
    {
        return [];
    }
}
