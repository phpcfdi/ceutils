<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarCuentas13;

use CfdiUtils\Elements\Common\AbstractElement;

class AuxiliarCtas extends AbstractElement
{
    public function getElementName(): string
    {
        return 'AuxiliarCtas:AuxiliarCtas';
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:AuxiliarCtas' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarCtas',
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarCtas'
                . ' http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarCtas/AuxiliarCtas_1_3.xsd',
            'Version' => '1.3',
        ];
    }

    public function addCuenta(array $attributes = [], array $children = []): Cuenta
    {
        $element = new Cuenta($attributes, $children);
        $this->addChild($element);
        return $element;
    }

    public function multiCuenta(array ...$elementAttributes): self
    {
        foreach ($elementAttributes as $attributes) {
            $this->addCuenta($attributes);
        }
        return $this;
    }
}
