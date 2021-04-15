<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Catalogo13;

use CfdiUtils\Elements\Common\AbstractElement;
use PhpCfdi\CeUtils\Definitions\Catalogo13Definition;

class Catalogo extends AbstractElement
{
    public function getElementName(): string
    {
        return Catalogo13Definition::ELEMENT_NAME;
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:catalogocuentas' => Catalogo13Definition::NAMESPACE,
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => Catalogo13Definition::NAMESPACE . ' ' . Catalogo13Definition::XSD_LOCATION,
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
