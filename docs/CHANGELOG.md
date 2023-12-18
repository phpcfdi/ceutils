## Acerca de SemVer

Usamos [Versionado Semántico 2.0.0](SEMVER.md) por lo que puedes usar esta librería sin temor a romper tu aplicación.

## Cambios no liberados en una versión

Pueden aparecer cambios no liberados que se integran a la rama principal, pero no ameritan una nueva liberación de versión,
aunque sí su incorporación en la rama principal de trabajo. Generalmente, se tratan de cambios en el desarrollo.

## Listado de cambios

### Versión 0.2.3 2023-12-18

Algunas clases de validadores no estaban marcadas como *finales*.
PHPStan detectó esto como un problema al utilizar el método estático `create(): self`.
Para más información consulta <https://github.com/phpstan/phpstan/issues/10286>.

Cambios en el entorno de desarrollo:

- Se actualiza el año de la licencia.
- Se corrige la insignia de construcción.
- Se actualizan los archivos de configuración de las herramientas de estilo de código.

### Versión 0.2.2 2022-09-28

Se actualizan las dependencias:

- `eclipxe/cfdiutils: ^2.15.1`.
- `eclipxe/xmlschemavalidator": "^3.0.2`.

Cambios en el entorno de desarrollo:

- Se actualizan las versiones de las herramientas de desarrollo.
- Se nombra correctamente el test `BaseUniquePolizaNumberTest`.

### Versión 0.2.1 2022-06-15

Esta liberación corrige el proceso de integración continua, modifica el código fuente del proyecto y
mejora el paquete redistribuible, aunque no contiene ningún cambio de funcionamiento.

Cambios al código público:

- Se actualiza la licencia a 2022.
- Se actualiza el código para seguir el estilo actualizado.
- Se permite la ejecución del plugin `ergebnis/composer-normalize`.
- Se ignora `.phive/` del paquete de distribución.

Cambios en entorno de desarrollo:

- Se actualizan las herramientas de desarrollo y el archivo de configuración de `php-cs-fixer`.
- Se agrega la revisión de compatiblidad de PHP 8.1.
- Se dividen los pasos de construcción completa en pequeños trabajos independientes.
- Se corrige el grupo de mantenedores del proyecto.
- Se ignora `tests/_files` de la detección lingüística del proyecto.

### Versión 0.2.0 2021-09-11

- Se adopta el proyecto de César Aquilera `@blacktrue` como parte de PhpCfdi.
- Se actualizan los archivos de proyecto y de desarrollo.
- Se hace la primera liberación pública.
