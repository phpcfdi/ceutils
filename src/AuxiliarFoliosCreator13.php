<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Nodes\NodeInterface;
use PhpCfdi\CeUtils\Definitions\AuxiliarFolios13Definition;
use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\RepAuxFol;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\AuxiliarFolios13MultiValidator;
use PhpCfdi\CeUtils\Validate\MultiValidator;

class AuxiliarFoliosCreator13 extends AbstractCreator
{
    private RepAuxFol $repAuxFol;

    /**
     * @param  array<string, string>  $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct();
        $this->repAuxFol = new RepAuxFol($attributes);
    }

    public function repAuxFol(): RepAuxFol
    {
        return $this->repAuxFol;
    }

    protected function getRootNode(): NodeInterface
    {
        return $this->repAuxFol();
    }

    protected function getXsltLocation(): string
    {
        return AuxiliarFolios13Definition::XSLT_LOCATION;
    }

    protected function createValidator(): MultiValidator
    {
        return new AuxiliarFolios13MultiValidator();
    }
}
