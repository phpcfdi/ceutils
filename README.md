# `phpcfdi/ceutils`

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]

> Librería de PHP para trabajar con contabilidad electrónica.

:us: The documentation of this project is in spanish as this is the natural language for the intended audience.

## Acerca de

En México, las personas físicas o morales requieren generar su contabilidad electrónica.

Esta librería permite generar, sellar y validar los XMl para contabilidad electrónica.

## Instalación

Usa [composer](https://getcomposer.org/)

```shell
composer require phpcfdi/ceutils
```

## Ejemplo básico de uso BalanzaCreator13

```php
<?php

use PhpCfdi\CeUtils\BalanzaCreator13;
use PhpCfdi\Credentials\Credential;

$creator = new BalanzaCreator13([
    'Mes' => '01',
    'Anio' => '2021',
    'TipoEnvio' => 'N',
    'FechaModBal' => '2015-01-01',
]);

$fiel = Credential::openFiles(
    $this->filePath('fake-fiel/EKU9003173C9.cer'),
    $this->filePath('fake-fiel/EKU9003173C9.key'),
    trim($this->fileContents('fake-fiel/EKU9003173C9-password.txt'))
);

$creator->addSello($fiel);

$balanza = $creator->balanza();

$balanza->addCuenta([
    'NumCta' => '602.01.01',
    'SaldoIni' => '100.50',
    'Debe' => '40',
    'Haber' => '40',
    'SaldoFin' => '100.50'
]);

$balanza->addCuenta([
    'NumCta' => '602.01.02',
    'SaldoIni' => '200.00',
    'Debe' => '20',
    'Haber' => '20',
    'SaldoFin' => '200.00'
]);

$xml = $creator->asXml();
```

## Ejemplo básico de uso CatalogoCreator13

```php
<?php

use PhpCfdi\CeUtils\CatalogoCreator13;
use PhpCfdi\Credentials\Credential;

$creator = new CatalogoCreator13([
    'Mes' => '01',
    'Anio' => '2021',
    'TipoEnvio' => 'N',
    'FechaModBal' => '2015-01-01',
]);

/** @var Credential $fiel */

$creator->addSello($fiel);

$catalogo = $creator->catalogo();

$catalogo->addCuenta([
    'CodAgrup' => '602',
    'NumCta' => '602.01.01',
    'Desc' => 'Account description',
    'SubCtaDe' => '602.01',
    'Nivel' => '3',
    'Natur' => 'A'
]);

$catalogo->addCuenta([
    'CodAgrup' => '602',
    'NumCta' => '602.01.02',
    'Desc' => 'Account description',
    'SubCtaDe' => '602.01',
    'Nivel' => '3',
    'Natur' => 'A'
]);

$xml = $creator->asXml();
```

## Ejemplo básico de uso AuxiliarFoliosCreator13()

```php
<?php

use PhpCfdi\CeUtils\AuxiliarFoliosCreator13;
use PhpCfdi\Credentials\Credential;

$creator = new AuxiliarFoliosCreator13([
    'Mes' => '01',
    'Anio' => '2021',
    'TipoSolicitud' => 'AF',
    'NumTramite' => '123456',
]);

/** @var Credential $fiel */

$creator->addSello($fiel);

$reporteAuxiliarFolios = $creator->repAuxFol();

$detalleAuxiliarFolios = $reporteAuxiliarFolios->addDetalleAux([
    'NumUnIdenPol' => '194756',
    'Fecha' => '2021-03-25'
]);

$detalleAuxiliarFolios->addComprNal([
    'UUID_CFDI' => 'fake uuid',
    'MontoTotal' => '100',
    'RFC' => 'fake rfc',
    'MetPagoAux' => '',
    'Moneda' => 'MXN',
]);

$xml = $creator->asXml();
```

## Ejemplo básico de uso AuxiliarCuentasCreator13()

```php
<?php

use PhpCfdi\CeUtils\AuxiliarCuentasCreator13;
use PhpCfdi\Credentials\Credential;

$creator = new AuxiliarCuentasCreator13([
    'Mes' => '01',
    'Anio' => '2021',
    'TipoSolicitud' => 'AF',
    'NumTramite' => '123456',
]);

/** @var Credential $fiel */

$creator->addSello($fiel);

$auxiliarCuentas = $creator->auxiliarCuentas();

$cuenta = $auxiliarCuentas->addCuenta([
    'NumCta' => '602.01.01',
    'DesCta' => 'descripción',
    'SaldoIni' => '100.00',
    'SaldoFin' => '100.00'
]);

$cuenta->addDetalleAux([
    'Fecha' => '2021-03-25',
    'NumUnIdenPol' => '123456',
    'Concepto' => 'concepto 1',
    'Debe' => '50',
    'Haber' => '0'
]);

$xml = $creator->asXml();
```

## Ejemplo básico de uso PolizasCreator13()

```php
<?php

use PhpCfdi\CeUtils\PolizasCreator13;
use PhpCfdi\Credentials\Credential;

$creator = new PolizasCreator13([
    'Mes' => '01',
    'Anio' => '2021',
    'TipoSolicitud' => 'AF',
    'NumTramite' => '123456',
]);

/** @var Credential $fiel */

$creator->addSello($fiel);

$polizas = $creator->polizas();

$poliza = $polizas->addPoliza([
    'NumUnIdenPol' => '123456',
    'Fecha' => '2021-03-31',
    'Concepto' => 'Concepto póliza'
]);

$transaccion = $poliza->addTransaccion([
    'NumCta' => '123',
    'DesCta' => 'Descripción cuenta',
    'Concepto' => 'Concepto transacción',
    'Debe' => '100.00',
    'Haber' => '0.00',
]);

$transaccion->addCompNal([
    'UUID_CFDI' => 'adf9d1d2-574d-4781-8874-a9fb1e79930a',
    'RFC' => 'XAXX010101000',
    'MontoTotal' => '100.00',
    'Moneda' => 'MXN',
]);

$xml = $creator->asXml();
```

## Soporte

Puedes obtener soporte abriendo un ticker en Github.

Adicionalmente, esta librería pertenece a la comunidad [PhpCfdi](https://www.phpcfdi.com), así que puedes usar los
mismos canales de comunicación para obtener ayuda de algún miembro de la comunidad.

## Compatibilidad

Esta librería se mantendrá compatible con al menos la versión con
[soporte activo de PHP](https://www.php.net/supported-versions.php) más reciente.

También utilizamos [Versionado Semántico 2.0.0](docs/SEMVER.md) por lo que puedes usar esta librería
sin temor a romper tu aplicación.

## Contribuciones

Las contribuciones con bienvenidas. Por favor lee [CONTRIBUTING][] para más detalles
y recuerda revisar el archivo de tareas pendientes [TODO][] y el archivo [CHANGELOG][].

## Copyright and License

The `phpcfdi/ceutils` library is copyright © [PhpCfdi](https://www.phpcfdi.com)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.


[contributing]: https://github.com/phpcfdi/ceutils/blob/master/CONTRIBUTING.md
[changelog]: https://github.com/phpcfdi/ceutils/blob/master/docs/CHANGELOG.md
[todo]: https://github.com/phpcfdi/ceutils/blob/master/docs/TODO.md

[source]: https://github.com/phpcfdi/ceutils
[release]: https://github.com/phpcfdi/ceutils/releases
[license]: https://github.com/phpcfdi/ceutils/blob/master/LICENSE
[build]: https://github.com/phpcfdi/ceutils/actions/workflows/build.yml?query=branch:master
[quality]: https://scrutinizer-ci.com/g/phpcfdi/ceutils/
[coverage]: https://scrutinizer-ci.com/g/phpcfdi/ceutils/code-structure/master/code-coverage
[downloads]: https://packagist.org/packages/phpcfdi/ceutils

[badge-source]: http://img.shields.io/badge/source-phpcfdi/ceutils-blue?style=flat-square
[badge-release]: https://img.shields.io/github/release/phpcfdi/ceutils?style=flat-square
[badge-license]: https://img.shields.io/github/license/phpcfdi/ceutils?style=flat-square
[badge-build]: https://img.shields.io/github/workflow/status/phpcfdi/ceutils/build/master?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/phpcfdi/ceutils/master?style=flat-square
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/phpcfdi/ceutils/master?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/phpcfdi/ceutils?style=flat-square
