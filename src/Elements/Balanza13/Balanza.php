<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Balanza13;

use CfdiUtils\Elements\Common\AbstractElement;
use PhpCfdi\CeUtils\Definitions\Balanza13Definition;

class Balanza extends AbstractElement
{
    public function getElementName(): string
    {
        return Balanza13Definition::ELEMENT_NAME;
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:BCE' => Balanza13Definition::NAMESPACE,
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => Balanza13Definition::NAMESPACE . ' ' . Balanza13Definition::XSD_LOCATION,
            'Version' => '1.3',
        ];
    }

    public function addCuenta(array $attributes): Cuenta
    {
        $cuenta = new Cuenta($attributes);
        $this->addChild($cuenta);
        return $cuenta;
    }

    public function multiCuenta(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addCuenta($attributes);
        }
        return $this;
    }
}
