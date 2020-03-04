import gql from 'graphql-tag'

export const OBTENER_CLIENTE= gql`
query obtenerClientes($id:Int,
        $search: String, 
        ){ 
    clientes(id:$id, 
        search:$search, 
        ) 
        {
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
        empresa{
            razon_social
            partida_registral
        }
        prestamos{
            id
            aporte_analista
            cualitativa
            cuantitativa
            cuota_sistema
            cuotas_analista
            producto_analista
            forma
            monto_cliente
            cuotas_cliente
            importe_analista
            estado
        }
    } 
}
`