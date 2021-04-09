<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;

interface ValidatorInterface
{
    /**
     * Creates a new instance without arguments
     * It is expected to be hydrated later
     *
     * @return static
     */
    public static function create();

    /**
     * Run validations populating the asserts collection
     *
     * @param NodeInterface $root
     * @param Asserts $asserts
     */
    public function validate(NodeInterface $root, Asserts $asserts): void;
}
