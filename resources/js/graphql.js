import gql from 'graphql-tag'



export const OBTENER_CLIENTE= gql`
query obtenerClientes($id:Int){ 
    clientes(id:$id) {
        id
        tipo_documento
        documento
        tipo_cliente
        ubicacion_direccion_declarada
        celular
        estado
        persona{
            nombres
            apellidos
            fecha_nacimiento
            estado_civil
        },
        prestamos{
            aporte_analista
            cuota_sistema
            cuotas_analista
            producto_analista
            forma
            importe_analista
            estado
        }
    } 
}
`