<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Catalogo13;

use CfdiUtils\Elements\Common\AbstractElement;

class Catalogo extends AbstractElement
{
    public function getElementName(): string
    {
        return 'catalogocuentas:Catalogo';
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:catalogocuentas' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/CatalogoCuentas',
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/CatalogoCuentas'
                . 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/CatalogoCuentas/CatalogoCuentas_1_3.xsd',
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
