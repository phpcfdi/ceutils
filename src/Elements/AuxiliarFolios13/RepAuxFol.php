<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarFolios13;

use CfdiUtils\Elements\Common\AbstractElement;

class RepAuxFol extends AbstractElement
{
    public function getElementName(): string
    {
        return 'RepAux:RepAuxFol';
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:RepAux' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarFolios',
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarFolios'
                . ' http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarFolios/AuxiliarFolios_1_3.xsd',
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
