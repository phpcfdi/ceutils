<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Traits;

use PhpCfdi\Credentials\Credential;

trait WithFakeFiel
{
    protected function buildFiel(): Credential
    {
        return Credential::openFiles(
            $this->filePath('fake-fiel/EKU9003173C9.cer'),
            $this->filePath('fake-fiel/EKU9003173C9.key'),
            trim($this->fileContents('fake-fiel/EKU9003173C9-password.txt'))
        );
    }
}
