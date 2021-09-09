<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Internal;

trait AssertPrefixPropertyTrait
{
    private string $assertPrefix;

    /** @var string[] */
    private array $path;

    public function getAssertCode(string $suffix): string
    {
        return $this->assertPrefix . $suffix;
    }
}
