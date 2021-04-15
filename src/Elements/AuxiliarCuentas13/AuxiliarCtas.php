<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarCuentas13;

use CfdiUtils\Elements\Common\AbstractElement;
use PhpCfdi\CeUtils\Definitions\AuxiliarCuentas13Definition;

class AuxiliarCtas extends AbstractElement
{
    public function getElementName(): string
    {
        return AuxiliarCuentas13Definition::ELEMENT_NAME;
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:AuxiliarCtas' => AuxiliarCuentas13Definition::NAMESPACE,
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => AuxiliarCuentas13Definition::NAMESPACE
                . ' ' . AuxiliarCuentas13Definition::XSD_LOCATION,
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
