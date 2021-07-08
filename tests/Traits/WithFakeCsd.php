<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Traits;

use PhpCfdi\Credentials\Credential;

trait WithFakeCsd
{
    protected function buildCredential(): Credential
    {
        return Credential::openFiles(
            $this->filePath('fake-csd/EKU9003173C9.cer'),
            $this->filePath('fake-csd/EKU9003173C9.key'),
            trim($this->fileContents('fake-csd/EKU9003173C9-password.txt'))
        );
    }
}
