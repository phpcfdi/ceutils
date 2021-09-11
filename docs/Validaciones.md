# Validaciones

## Catalogos

### Elemento `Catalogo`

- [X] `RFC`: Debería coincidir con el certificado.
- [X] `Sello`: Firma.
- [X] `noCertificado`: Coincida con el atributo `Certificado`.
- [X] `Certificado`: Sea un certificado en formato PEM de una sola línea.

## Balanza de comprobación

### Elemento `Balanza`

- [X] `RFC`: Debería coincidir con el certificado.
- [X] `Sello`: Firma.
- [X] `noCertificado`: Coincida con el atributo `Certificado`.
- [X] `Certificado`: Sea un certificado en formato PEM de una sola línea.
- [X] `FechaModBal`: requerido cuando `TipoEnvio = C`

### Elemento `Balanza/Ctas`

- [X] `SaldoFin`: Debe corresponder al valor del saldo inicial más el valor de deber menos el valor de haber.

## Pólizas del periodo

### Elemento `Polizas`

- [X] `RFC`: Debería coincidir con el certificado.
- [X] `Sello`: Firma.
- [X] `noCertificado`: Coincida con el atributo `Certificado`.
- [X] `Certificado`: Sea un certificado en formato PEM de una sola línea.
- [X] `NumOrden`: Requerido para `TipoSolicitud = AF|FC`.
- [X] `NumTramite`: Requerido para `TipoSolicitud = DE|CO`.

### Elemento `Polizas/Poliza`

- [ ] `NumUnIdenPol`: En un mes ordinario no debe repetirse un mismo número de póliza.

### Elemento `Polizas/Poliza/Transaccion/CompNal`

- [X] `RFC`: Debe ser un RFC válido, distinto del contribuyente que envía los datos.
- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

### Elemento `Polizas/Poliza/Transaccion/CompNalOtr`

- [ ] `RFC`: Debe ser un RFC válido, distinto del contribuyente que envía los datos.
- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

### Elemento `Polizas/Poliza/Transaccion/CompExt`

- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

### Elemento `Polizas/Poliza/Transaccion/Cheque`

- [ ] `RFC`: Debe ser un RFC válido, distinto del contribuyente que envía los datos.
- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

### Elemento `Polizas/Poliza/Transaccion/Transferencia`

- [ ] `RFC`: Debe ser un RFC válido, distinto del contribuyente que envía los datos.
- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

### Elemento `Polizas/Poliza/Transaccion/OtrMetodoPago`

- [ ] `RFC`: Debe ser un RFC válido, distinto del contribuyente que envía los datos.
- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

## Reporte de auxiliar de folios de comprobantes fiscales

### Elemento `RepAuxFol`

- [X] `RFC`: Debería coincidir con el certificado.
- [X] `Sello`: Firma.
- [X] `noCertificado`: Coincida con el atributo `Certificado`.
- [X] `Certificado`: Sea un certificado en formato PEM de una sola línea.
- [X] `NumOrden`: Requerido para `TipoSolicitud = AF|FC`.
- [X] `NumTramite`: Requerido para `TipoSolicitud = DE|CO`.

### Elemento `RepAuxFol/DetAuxFol`

- [ ] `NumUnIdenPol`: En un mes ordinario no debe repetirse un mismo número de póliza.

### Elemento `RepAuxFol/DetAuxFol/ComprNal`

- [ ] `RFC`: Debe ser un RFC válido, distinto del contribuyente que envía los datos.
- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

### Elemento `RepAuxFol/DetAuxFol/ComprNalOtr`

- [ ] `RFC`: Debe ser un RFC válido, distinto del contribuyente que envía los datos.
- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

### Elemento `RepAuxFol/DetAuxFol/ComprExt`

- [X] `Moneda`: Diferente de moneda nacional.
- [X] `TipCamb`: Requerido cuando la moneda esté definida.

## Reporte de Auxiliares de cuenta

### Elemento `AuxiliarCtas`

- [X] `RFC`: Debería coincidir con el certificado.
- [X] `Sello`: Firma.
- [X] `noCertificado`: Coincida con el atributo `Certificado`.
- [X] `Certificado`: Sea un certificado en formato PEM de una sola línea.
- [X] `NumOrden`: Requerido para `TipoSolicitud = AF|FC`.
- [X] `NumTramite`: Requerido para `TipoSolicitud = DE|CO`.

### Elemento `AuxiliarCtas/Cuenta/DetalleAux`

- [ ] `NumUnIdenPol`: En un mes ordinario no debe repetirse un mismo número de póliza.
