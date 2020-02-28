<template lang='pug'>
  .form_step_wrapper
    h3.title Solicitud de Cr&eacute;dito
    .form_content
      .group_form
        .input_wrapper(:class='{require: !validateMonto}')
          label Monto
          input(type='text' v-mask='"######"' v-model='propuestaCliente.monto_cliente')
          .message Monto de solicitud invalido
        .input_wrapper
          label Forma
          select(v-model='propuestaCliente.forma')
            option(value='DIARIO') DIARIO
            option(value='SEMANAL') SEMANAL
            option(value='QUINCENAL') QUINCENAL
            option(value='MENSUAL') MENSUAL
        .input_wrapper(:class='{require: !validateCuotas}')
          label Cuotas
          input(type='number' v-model='propuestaCliente.cuotas_cliente' maxlength='11')
        .input_wrapper(:class='{require: !validateDisponibilidad}')
          label Disponibilidad de pago
          input(type='text' v-model='propuestaCliente.disponibilidad_pago' v-mask='"######"')
          .message La disponibilidad es invalida
        .input_wrapper(:class='{require: !validateFuenteIngreso}')
          label Fuente de ingreso  
          v-select(label='giro_negocio' :options='negocios' :reduce='negocios => negocios.giro_negocio' v-model='propuestaCliente.fuente_ingresos')
            span(slot='no-options')
              | No se encontro giro de negocio
          .message Se requiere esta informaci&oacute;n
        .input_wrapper
          label Destino del credito
          select(v-model='propuestaCliente.destino_credito')
            option(value='Capital de trabajo') Capital de trabajo
            option(value='Activo Fijo') Activo Fijo
            option(value='Consumo') Consumo
            option(value='Vehiculo') Vehiculo
            option(value='Hipotecario') Hipotecario
            option(value='Mejoramiento de vivienda') Mejoramiento de vivienda
            option(value='Compra de deuda') Compra de deuda
      .group_form.all
        .input_wrapper(:class='{require: !validateDestino}')
          label Destino de cr&eacute;dito (propuesta cliente)
          textarea(v-model='propuestaCliente.destino_credito_descripcion')
            .message Informaci&oacute;n de destino es corta

</template>
<script>
import vSelect from "vue-select";
import { OBTENER_NEGOCIOS } from '../prestamos.js'
export default {
    components: {
      vSelect
    },
    data(){
      return{
        propuestaCliente:{
          monto_cliente:0,
          forma:'DIARIO',
          cuotas_cliente:0,
          disponibilidad_pago:0,
          fuente_ingresos:'',
          destino_credito:"Capital de trabajo",
          destino_credito_descripcion:'',
          validate:false
        },              
      }
    },
    apollo:{
      negocios:{
        query: OBTENER_NEGOCIOS
      }
    },
    computed: {   
    validateMonto() {
      return String(this.propuestaCliente.monto_cliente).length > 1
    },
    validateCuotas() {
      return this.propuestaCliente.cuotas_cliente > 0
    },
    validateDisponibilidad() {
      return String(this.propuestaCliente.disponibilidad_pago).length > 1
    },
    validateDestino() {
      return this.propuestaCliente.destino_credito_descripcion.length > 6
    },
    validateFuenteIngreso() {
      return  this.propuestaCliente.fuente_ingresos.length > 4
    },
    validatePropuestaCliente() {
      let validate = false
      if( this.validateMonto && 
          this.validateCuotas &&
          this.validateDisponibilidad &&
          this.validateDestino &&
          this.validateFuenteIngreso
      ) 
      validate = true
      return validate
    },
  },
  watch: {
		propuestaCliente: {
			handler (item) {		
        item.validate = this.validatePropuestaCliente
				this.$emit('update',item)
			},
			deep: true			
		},

	}
}
</script>