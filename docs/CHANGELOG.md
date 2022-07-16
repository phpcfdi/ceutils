## Acerca de SemVer

Usamos [Versionado Semántico 2.0.0](SEMVER.md) por lo que puedes usar esta librería sin temor a romper tu aplicación.

## Cambios no liberados en una versión

Pueden aparecer cambios no liberados que se integran a la rama principal, pero no ameritan una nueva liberación de versión,
aunque sí su incorporación en la rama principal de trabajo. Generalmente, se tratan de cambios en el desarrollo.

## Listado de cambios

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

### Versión 0.2.0 2021-09-11

- Se adopta el proyecto de César Aquilera `@blacktrue` como parte de PhpCfdi.
- Se actualizan los archivos de proyecto y de desarrollo.
- Se hace la primera liberación pública.
