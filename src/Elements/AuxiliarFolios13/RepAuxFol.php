<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarFolios13;

use CfdiUtils\Elements\Common\AbstractElement;
use PhpCfdi\CeUtils\Definitions\AuxiliarFolios13Definition;

class RepAuxFol extends AbstractElement
{
    public function getElementName(): string
    {
        return AuxiliarFolios13Definition::ELEMENT_NAME;
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:RepAux' => AuxiliarFolios13Definition::NAMESPACE,
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => AuxiliarFolios13Definition::NAMESPACE
                . ' ' . AuxiliarFolios13Definition::XSD_LOCATION,
            'Version' => '1.3',
        ];
    }

    public function addDetalleAux(array $attributes = [], array $children = []): DetAuxFol
    {
        $element = new DetAuxFol($attributes, $children);
        $this->addChild($element);
        return $element;
    }

    public function multiDetalleAux(array ...$elementAttributes): self
    {
        foreach ($elementAttributes as $attributes) {
            $this->addDetalleAux($attributes);
        }
        return $this;
    }
}
