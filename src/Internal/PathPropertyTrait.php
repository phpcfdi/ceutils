<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Internal;

trait PathPropertyTrait
{
    /** @var string[] */
    private array $path;

    /** @return string[] */
    public function getPath(): array
    {
        return $this->path;
    }
}
