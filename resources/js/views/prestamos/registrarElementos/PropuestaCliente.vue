<template>
    <div class="form_step_wrapper">
            <h3 class="title">Solicitud de Crédito</h3>
            <div class="form_content">
              <div class="group_form">
                <div class="input_wrapper" :class="{require: !validateMonto}">
                  <label>Monto</label> 
                  <input type='text'
                    v-mask='"######"'
                    v-model="propuestaCliente.monto_cliente"
                  >
                  <div class="message">Monto de solicitud invalido</div>
                </div>
                <div class="input_wrapper">
                  <label>Forma</label>
                  <select v-model="propuestaCliente.forma">
                    <option value="DIARIO">DIARIO</option>
                    <option value="SEMANAL">SEMANAL</option>
                    <option value="QUINCENAL">QUINCENAL</option>
                    <option value="MENSUAL">MENSUAL</option>
                  </select>
                </div>
                <div class="input_wrapper" :class="{require: !validateCuotas}">
                  <label>Cuotas</label>
                  <input type="number" v-model="propuestaCliente.cuotas_cliente" maxlength=11  />
                </div>
                <div class="input_wrapper" :class="{require: !validateDisponibilidad}">
                  <label>Disponibilidad de pago</label>
                  <input
                    type='text'                    
                    v-model="propuestaCliente.disponibilidad_pago"
                    v-mask='"######"'
                  >
                  <div class="message">La disponibilidad es invalida</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateFuenteIngreso}">
                  <label>Fuente de ingreso  </label> 
                  <v-select
                    label="giro_negocio"
                    :options="negocios"
                    :reduce="negocios => negocios.giro_negocio"
                    v-model="propuestaCliente.fuente_ingreso"
                    >
                    <span slot="no-options">
                      No se encontro giro de negocio
                    </span>
                  </v-select>
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper">
                  <label>Destino del credito</label>
                  <select v-model="propuestaCliente.destino_credito">
                        <option value="Capital de trabajo">Capital de trabajo</option>
                        <option value="Activo Fijo">Activo Fijo</option>
                        <option value="Consumo">Consumo</option>
                        <option value="Vehiculo">Vehiculo</option>
                        <option value="Hipotecario">Hipotecario</option>
                        <option value="Mejoramiento de vivienda">Mejoramiento de vivienda</option>
                        <option value="Compra de deuda">Compra de deuda</option>
                      </select>
                </div>                
              </div>
              <div class="group_form all">
                <div class="input_wrapper" :class="{require: !validateDestino}">
                  <label>Destino de crédito (propuesta cliente)</label>
                  <textarea  v-model="propuestaCliente.destino_credito_descripcion"  />
                  <div class="message">Información de destino es corta</div>
                </div>
              </div>
            </div>
          </div>

</template>
<script>
import vSelect from "vue-select";
import { OBTENER_NEGOCIOS } from '../prestamos.js'
export default {
    components: {
      vSelect
    },
    props:["cliente"],
    data(){
      return{
        propuestaCliente:{
          monto_cliente:0,
          forma:'DIARIO',
          cuotas_cliente:0,
          disponibilidad_pago:0,
          fuente_ingreso:'',
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
      return  this.propuestaCliente.fuente_ingreso.length > 4
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