<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Internal;

use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;

final class AssertsStatus
{
    public static function fromPrefix(Asserts $asserts, string $code): Status
    {
        $processor = new self();
        return $processor->statusFromPrefix($asserts, $code);
    }

    public function statusFromPrefix(Asserts $asserts, string $code): Status
    {
        $asserts = $this->subAsserts($asserts, $code);

        if ($asserts->hasErrors()) {
            return Status::error();
        }

        if (0 === count($asserts)) {
            return Status::none();
        }

        return Status::ok();
    }

    public function subAsserts(Asserts $asserts, string $code): Asserts
    {
        $subCode = $code . '-';
        $codeLength = strlen($subCode);
        $subAsserts = new Asserts();
        foreach ($asserts as $assert) {
            if ($subCode === substr($assert->getCode(), 0, $codeLength)) {
                $subAsserts->add($assert);
            }
        }
        return $subAsserts;
    }
}
