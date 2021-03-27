<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarCuentas13;

use CfdiUtils\Elements\Common\AbstractElement;

class Cuenta extends AbstractElement
{
    public function getElementName(): string
    {
        return 'AuxiliarCtas:Cuenta';
    }

    public function addDetalleAux(array $attributes): DetalleAux
    {
        $cuenta = new DetalleAux($attributes);
        $this->addChild($cuenta);
        return $cuenta;
    }

    public function multiDetalleAux(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addDetalleAux($attributes);
        }
        return $this;
    }
}
