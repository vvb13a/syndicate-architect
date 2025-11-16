<?php

namespace Syndicate\Architect\Services;

use Syndicate\Architect\Contracts\Blueprint;

class ArchitectService
{
    public function getPath(Blueprint $blueprint): string
    {
        $parent = $blueprint->getParent();

        if ($parent === null) {
            return trim($blueprint->getSlug(), '/');
        }

        $path = $this->getPath($parent);
        $slug = trim($blueprint->getSlug(), '/');

        return trim("{$path}/{$slug}", '/');
    }
}
