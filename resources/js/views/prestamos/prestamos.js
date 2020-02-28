import gql from 'graphql-tag'



export const OBTENER_PRESTAMOS= gql`
query obtenerPrestamos($id:Int){ 
    prestamos(id:$id) {
        id
        monto_cliente
        cuotas_cliente
        disponibilidad_pago
        forma
        producto_analista
        importe_analista
        meses_analista
    } 
}
`
export const OBTENER_NEGOCIOS= gql`
query obtenerNegocios($id:Int){ 
    negocios(id:$id) {
        id
        giro_negocio
        margen_maximo
        costo_ventas
    } 
}
`
export const OBTENER_DEPARTAMENTOS= gql`
query obtenerDepartamentos($id:Int){ 
    departamentos(id:$id) {
        id
        descripcion
        activo
    } 
}
`
export const OBTENER_PROVINCIAS= gql`
query obtenerProvincias($id:Int){ 
    provincias(id:$id) {
        id
        departamento_id
        descripcion
        activo
    } 
}
`
export const OBTENER_DISTRITOS= gql`
query obtenerDistritos($id:Int){ 
    distritos(id:$id) {
        id
        provincia_id
        descripcion
        activo
    } 
}
`

export const OBTENER_CLIENTES= gql`
query obtenerClientes($id:Int){ 
    clientes(id:$id) {
        id
        tipo_documento
        documento
        codigo
        tipo_cliente
        pais
        ubicacion_departamento
        ubicacion_provincia
        ubicacion_distrito
        estado
        ubicacion_direccion_declarada
        ubicacion_referencia
        telefono
        celular
        email
        persona{
            nombres
            apellidos
            fecha_nacimiento
            estado_civil
            ocupacion
            tipo_domicilio
            centro_laboral
            direccion_laboral
            trabajo{
                estado_laboral
                tipo_trabajador
                especificacion
                empresa_razon_social
                ingreso_mensual
                cargo_ocupacion
                fecha_ingreso
                empresa_giro_negocio                
            }
        }
        empresa{
            razon_social
            partida_registral
            nombre_comercial
            actividad_principal
            oficina_principal
            tipo_negocio
            fecha_constitucion
            representante{
                nombres
                documento
                fecha_nacimiento
                estado_civil
                ocupacion
                telefono
                celular
                ubicacion_direccion
                ubicacion_departamento
                ubicacion_provincia
                ubicacion_distrito
                ubicacion_referencia
                tipo_domicilio
                cargo
                fecha_inicio
            }
        }
    } 
}
`

export const REGISTRAR_PRESTAMO= gql`
mutation registrarPrestamo(
    $id:Int
    $monto_cliente:Float
    $forma:String
    $cuotas_cliente:Int
    $disponibilidad_pago:Float
    $cualitativa:CualitativaInput
    $cliente:ClienteInput
    $userID:Int
    $estado:Int
    ){ 
    prestamos(
        id:$id
        user_id:$userID
        monto_cliente:$monto_cliente
        forma:$forma
        cuotas_cliente:$cuotas_cliente
        disponibilidad_pago:$disponibilidad_pago
        cualitativa:$cualitativa
        cliente:$cliente
        estado:$estado
        ) {
        id
        monto_cliente
        forma
        cuotas_cliente
    } 
}
`