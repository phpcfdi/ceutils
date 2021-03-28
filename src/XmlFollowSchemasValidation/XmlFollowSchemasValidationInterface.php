<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\XmlFollowSchemasValidation;

use CfdiUtils\XmlResolver\XmlResolver;

interface XmlFollowSchemasValidationInterface
{
    /**
     * Validade a XML against all its schemas optionally using a XmlResolver
     *
     * @param string $content
     * @param XmlResolver|null $resolver
     */
    public function validate(string $content, ?XmlResolver $resolver = null): void;
}
