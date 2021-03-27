<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Balanza13;

use CfdiUtils\Elements\Common\AbstractElement;

class Balanza extends AbstractElement
{
    public function getElementName(): string
    {
        return 'BCE:Balanza';
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:BCE' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion',
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion'
                . ' http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion/BalanzaComprobacion_1_3.xsd',
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
