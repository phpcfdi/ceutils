<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Polizas13;

use CfdiUtils\Elements\Common\AbstractElement;
use PhpCfdi\CeUtils\Definitions\Polizas13Definition;

class Polizas extends AbstractElement
{
    public function getElementName(): string
    {
        return Polizas13Definition::ELEMENT_NAME;
    }

    public function getFixedAttributes(): array
    {
        return [
            'xmlns:PLZ' => Polizas13Definition::NAMESPACE,
            'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
            'xsi:schemaLocation' => Polizas13Definition::NAMESPACE . ' ' . Polizas13Definition::XSD_LOCATION,
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
