<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Nodes\NodeInterface;
use PhpCfdi\CeUtils\Definitions\Polizas13Definition;
use PhpCfdi\CeUtils\Elements\Polizas13\Polizas;
use PhpCfdi\CeUtils\Validate\MultiValidator;
use PhpCfdi\CeUtils\Validate\Polizas13\Polizas13MultiValidator;

class PolizasCreator13 extends AbstractCreator
{
    private Polizas $polizas;

    /**
     * @param  array<string, string>  $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct();
        $this->polizas = new Polizas($attributes);
    }

    public function polizas(): Polizas
    {
        return $this->polizas;
    }

    protected function getRootNode(): NodeInterface
    {
        return $this->polizas();
    }

    protected function getXsltLocation(): string
    {
        return Polizas13Definition::XSLT_LOCATION;
    }

    protected function createValidator(): MultiValidator
    {
        return new Polizas13MultiValidator();
    }
}
