<template lang='pug'>
    .form_step_wrapper
        h3.title Datos de la Empresa
        .form_content
            .group_form
                .input_wrapper
                    label Razón Social
                    input(type='text' maxlength='200' v-model='cliente.empresa.razon_social' disabled='')
                .input_wrapper
                    label Ruc
                    input(type='text' maxlength='11' v-model='cliente.documento' disabled='')
                .input_wrapper
                    label Nombre comercial
                    input(type='text' maxlength='50' v-model='cliente.empresa.nombre_comercial')
                .input_wrapper(:class='{require: !validateActividad}')
                    label Actividad
                    input(type='text' maxlength='200' v-model='cliente.empresa.actividad_principal')
                    .message Actividad de la empresa
                .input_wrapper(:class='{require: !validatePartida}')
                    label N&uacute;mero de partida
                    input(type='text' maxlength='8' v-model='cliente.empresa.partida_registral')
                    .message N&deg; de partida la empresa
                .input_wrapper
                    label Tel&eacute;fono
                    input(type='text' maxlength='10' v-model='cliente.telefono')
                .input_wrapper(:class='{require: !validateDireccionEmpresa}')
                    label Direcci&oacute;n
                    input(type='text' maxlength='200' v-model='cliente.ubicacion_direccion_declarada')
                    .message Direcci&oacute;n de la emrpesa
                .input_wrapper(:class='{require: !validateFechaConstitucion}')
                    label Fecha de constituci&oacute;n
                    input(type='date' v-model='cliente.empresa.fecha_constitucion')
                    .message Fecha de inicio de la empresa
                .input_wrapper(:class='{require: !validateEmail}')
                    label Email
                    input(maxlength='50' type='text' v-model='cliente.email')
                    .message Ingrese correo de la empresa
                span.separator
            .group_form
                .input_wrapper(:class='{require: !validateDocumentoRepresentante}')
                    label Documento de Identidad
                    input(type='text' v-model='cliente.empresa.representante.documento' @keyup='datosCliente()' v-mask="'########'")
                    .message Numero de documento del representante
                .input_wrapper(:class='{require: !validateNombres}')
                    label Nombres y Apellidos
                    input(type='text' maxlength='100' v-model='cliente.empresa.representante.nombres')
                    .message Nombre del representante
                .input_wrapper(:class='{require: !validateNacimiento}')
                    label Fecha de Nacimiento
                    input(type='date' v-model='cliente.empresa.representante.fecha_nacimiento')
                    .message Fecha de nacimiento del representante
                .input_wrapper(:class='{require: !validateCivil}')
                    label Estado Civil
                    select(v-model='cliente.empresa.representante.estado_civil')
                        option(value='SOLTERO') SOLTERO
                        option(value='CASADO') CASADO
                        option(value='CONVIVIENTE') CONVIVIENTE
                        option(value='DIVORCIADO - SEPARADO') DIVORCIADO - SEPARADO
                        option(value='VIUDO') VIUDO
                    .message Estado civil del representante
                .input_wrapper(:class='{require: !validateOcupacion}')
                    label Ocupaci&oacute;n
                    input(type='text' maxlength='50' v-model='cliente.empresa.representante.ocupacion')
                    .message Ingrese ocupacion del representante
                .input_wrapper
                    label Tel&eacute;fono
                    input(type='text' maxlength='10' v-model='cliente.empresa.representante.telefono')
                .input_wrapper(:class='{require: !validateCelular}')
                    label Celular
                    input(type='text' v-mask="'### ### ###'" v-model='cliente.empresa.representante.celular')
                    .message Ingrese n&uacute;mero de celular
                .input_wrapper(:class='{require: !validateDireccionRepresentante}')
                    label Direcci&oacute;n
                    input(type='text' maxlength='100' v-model='cliente.empresa.representante.ubicacion_direccion')
                    .message Ingrese su direcci&oacute;n
            .separator
            .group_form
                .input_wrapper(:class='{require: !validateDepartamento}')
                    label Departamento
                    input(type='text' v-model='cliente.empresa.representante.ubicacion_departamento')
                    .message Seleccione departamento
                .input_wrapper(:class='{require: !validateProvincia}')
                    label Provincia
                    input(type='text' v-model='cliente.empresa.representante.ubicacion_provincia')
                    .message Seleccione provincia
                .input_wrapper(:class='{require: !validateDistrito}')
                    label Distrito
                    input(type='text' v-model='cliente.empresa.representante.ubicacion_distrito')
                    .message Seleccione distrito
                .input_wrapper(:class='{require: !validateReferencia}')
                    label Referencia
                    input(type='text' maxlength='100' v-model='cliente.empresa.representante.ubicacion_referencia')
                    .message La referencia es invalido
                .input_wrapper(:class='{require: !validateTipoDomicilio}')
                    label Tipo Domicilio
                    select(v-model='cliente.empresa.representante.tipo_domicilio')
                        option(value='PROPIA') PROPIA
                        option(value='PROPIA HIPOTECA') PROPIA HIPOTECA
                        option(value='DE LOS PADRES') DE LOS PADRES
                        option(value='DE LOS FAMILIARES') DE LOS FAMILIARES
                        option(value='ALQUILADA') ALQUILADA
                    .message Tipo de vivienda invalido
                .input_wrapper(:class='{require: !validatePoderes}')
                    label Poderes (Asiento)
                    input(type='text' v-model='cliente.empresa.representante.poderes' v-mask="'####'")
                    .message Ingrese poderes
                .input_wrapper(:class='{require: !validateFechaCargo}')
                    label Fecha inicio (Cargo) 
                    input(type='date' v-model='cliente.empresa.representante.fecha_inicio')
                    .message Fecha incorrecta
</template>
<script>
import { OBTENER_CLIENTES  } from '../prestamos.js'
export default {
    props:['clienteID'],
    data(){
        return{
            cliente:{
                ubicacion_departamento: "",
                ubicacion_provincia: "",
                ubicacion_distrito: "",
                ubicacion_direccion_declarada: "",
                ubicacion_referencia: "",
                documento:'',
                telefono: "",
                celular: "",
                empresa:{
                    razon_social:"",
                    representante:{
                        documento:"",
                        fecha_nacimiento:"",
                        estado_civil:"",
                        ocupacion:""
                    }
                }
            }
        }
    },
    apollo:{
        obtenercliente:{
            query: OBTENER_CLIENTES,
            variables(){
                return{
                    id:this.clienteID
                }
            },
            update(res){
                this.$apollo.queries.obtenercliente.skip=true
                console.log(res)
                this.cliente =res.clientes[0]
            },
        }
    },
    computed:{
        validateDocumento(){
            return this.cliente.documento.length>=8
        }
        ,
        validateNacimiento(){
            if(this.cliente.empresa.representante.fecha_nacimiento)
            return this.cliente.empresa.representante.fecha_nacimiento.length>4
            else return true
        }
        ,
        validateCivil(){
            if(this.cliente.empresa.representante.estado_civil)
                return this.cliente.empresa.representante.estado_civil.length>5
        }
        ,
        validateOcupacion(){
            if(this.cliente.empresa.representante.ocupacion)
            return this.cliente.empresa.representante.ocupacion.length>4
        }
        ,
        validateCelular(){
            return  this.cliente.celular.length>9
        }
        ,
        validateDireccion(){
            return  this.cliente.ubicacion_direccion_declarada.length>5 
        },
        validateClienteEmpresa(){
            return this.validateNombres && this.validateDocumento && this.validateNacimiento &&
                this.validateCivil && this.validateOcupacion && 
                this.validateCelular && this.validateDireccion && 
                this.validateDepartamento && this.validateProvincia &&
                this.validateDistrito && this.validateReferencia
        },
            validateActividad(){
            return true
        },
        validatePartida(){
        return true
        },
        validateNombres(){
        return true
        },  
        validateDireccionEmpresa(){
        return true
        },
        validateDireccionRepresentante(){
        return true
        },
        validateTipoDomicilio(){
        return true
        },
        validatePoderes(){
        return true
        },
        validateFechaConstitucion(){
        return true
        },
        validateFechaCargo(){
        return true
        },
        validateEmail(){
        return true
        },
        validateDocumentoRepresentante(){
        return true
        },
        validateDocumento(){
        return this.cliente.documento.length>=8
        }
        ,
        validateNacimiento(){
        if(this.cliente.empresa.representante.fecha_nacimiento)
        return this.cliente.empresa.representante.fecha_nacimiento.length>4
        else return true
        }
        ,
        validateCivil(){
        
        if(this.cliente.empresa.representante.estado_civil)
            return this.cliente.empresa.representante.estado_civil.length>5
        }
        ,
        validateOcupacion(){
        if(this.cliente.empresa.representante.ocupacion)
        return this.cliente.empresa.representante.ocupacion.length>4
        }
        ,
        validateCelular(){
        return  this.cliente.celular.length>9
        }
        ,
        validateDireccion(){
        return  this.cliente.ubicacion_direccion_declarada.length>5
        }
        ,
        validateDepartamento(){
        return true
        }
        ,
        validateProvincia(){
        return true
        }
        ,
        validateDistrito(){
        return true
        }
        ,
        validateReferencia(){
        return this.cliente.ubicacion_referencia.length>5
        }
        ,
        validateCentro(){
        if(this.cliente.empresa.trabajo)
        return this.cliente.empresa.trabajo.empresa_razon_social.length>5
        else return true
        }
        ,
        validateDireccionLaboral(){
        if(this.cliente.empresa.trabajo)
        return this.cliente.empresa.trabajo.empresa_direccion.length>6
        else return true
        },
    },
    watch: {
		cliente: {
			handler (item) {
                let res={
                    cliente:{},
                    validate:false
                }
                res.cliente=this.cliente
                res.validate = this.validateClienteEmpresa
                this.$emit('update',res)
            },
            deep: true			
		},

	}
}
</script>
<style lang="scss">
.vdpWithInput {
  width: 100%;
}
.vdpWithInput > input {
  font-size: 16px;
  display: block;
  width: 100%;
  box-sizing: border-box;
  -webkit-appearance: none;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0.1em 0.3em;
  padding: 5px 40px 6px 15px;
  border-radius: 4px;
  background: white;
  border-width: 1px;
  border-style: solid;
  border-color: rgb(224, 224, 224);
  border-image: initial;
  outline: 0px;
}
</style>