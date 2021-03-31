<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Polizas13;

use CfdiUtils\Elements\Common\AbstractElement;

class Polizas extends AbstractElement
{
    public function getElementName(): string
    {
        return 'PLZ:Polizas';
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:PLZ' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/PolizasPeriodo',
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/PolizasPeriodo'
                . ' http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/PolizasPeriodo/PolizasPeriodo_1_3.xsd',
            'Version' => '1.3',
        ];
    }

    public function addPoliza(array $attributes): Poliza
    {
        $poliza = new Poliza($attributes);
        $this->addChild($poliza);
        return $poliza;
    }

    public function multiPoliza(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addPoliza($attributes);
        }
        return $this;
    }
}
