<?php

namespace Syndicate\Architect\Contracts;

use Illuminate\Contracts\View\View;

interface Blueprint
{
    public function getSlug(): string;

    public function render(BlueprintKey $blueprintKey): View;

    public function getFormSchema(): array;

    public function getParent(): ?Blueprint;

    public function getMiddleware(): array;
}
