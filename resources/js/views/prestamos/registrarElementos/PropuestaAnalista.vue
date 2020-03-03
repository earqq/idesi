<template lang="pug">
  .form_step_wrapper
    h3.title Propuesta de Analista
    .form_content
      .group_form
        .input_wrapper
          label Producto
          select(v-model='propuestaAnalista.producto_analista' @change='meses_numero')
            option(value='CREDIDIARIO') CREDIDIARIO
            option(value='CREDISEMANA') CREDISEMANA
            option(value='PYME') PYME
            option(value='PYME ESPECIAL') PYME ESPECIAL
            option(value='CONSUMO') CONSUMO
            option(value='CONSUMO ESPECIAL') CONSUMO ESPECIAL
        .input_wrapper(:class='{require: !validateImporte}')
          label Importe
          input(type='text' v-model='propuestaAnalista.importe_analista' v-mask='"#####"')
        .input_wrapper(:class='{require: !validateCuotas}')
          label Cuotas
          input(type='text' v-model='propuestaAnalista.cuotas_analista' v-mask='"#####"' @keyup='meses_numero')
        .input_wrapper
          label Meses
          input(type='text' v-model='propuestaAnalista.meses_analista' disabled='')
        .input_wrapper(:class='{require: !validateCuotaSistema}')
          label Cuota del sistema
          input(type='number' v-model='propuestaAnalista.cuota_sistema')
        .input_wrapper(:class='{require: !validateAporte}')
          label Aporte a la fecha
          input(type='text' v-mask='"#####"' v-model='propuestaAnalista.aporte_analista')
        .input_wrapper(:class='{require: !validateInfocorp}')
          label Prob. Infocorp
          input(type='number' v-model='propuestaAnalista.probabilidad_infocorp')
      .group_form.all
        .input_wrapper
          label Comentarios
          textarea(type='text' v-model='propuestaAnalista.comentarios')

</template>
<script>
export default {
  data(){
    return{
      propuestaAnalista:{
        producto_analista: "CREDIDIARIO",
        meses_analista: 0,
        importe_analista: 0,
        aporte_analista: 0,
        cuotas_analista: 0,
      }
    }
  },
  methods:{
    meses_numero() {
      if (this.propuestaAnalista.producto_analista == "CREDIDIARIO") { 
        this.propuestaAnalista.meses_analista = (Number(this.propuestaAnalista.cuotas_analista) / 30).toFixed(2);
      } else if (this.propuestaAnalista.producto == "CREDISEMANA") {
        this.propuestaAnalista.meses_analista = (Number(this.propuestaAnalista.cuotas_analista) / 4).toFixed(2);
      } else {
        this.propuestaAnalista.meses_analista = (Number(this.prestamo.cuotas_analista) / 1).toFixed(2);
      }
    },
  },
  computed:{
    validateImporte(){
      return parseFloat(this.propuestaAnalista.importe_analista)>0
    },
    validateCuotas(){
      return parseFloat(this.propuestaAnalista.cuotas_analista)>0
    },
    validateCuotaSistema(){
      return parseFloat(this.propuestaAnalista.cuota_sistema)>0
    },
    validateAporte(){
      return parseFloat(this.propuestaAnalista.aporte_analista)>0
    },
    validateInfocorp(){
      return parseFloat(this.propuestaAnalista.probabilidad_infocorp)>0
    },
    validatePropuestaAnalista(){
      return this.validateImporte && this.validateCuotas &&
              this.validateCuotaSistema && this.validateAporte &&
              this.validateInfocorp
    }
  },
  watch: {
		propuestaAnalista: {
			handler (item) {		
        let res={
          propuestaAnalista:item,
          validate: this.validatePropuestaAnalista
        }
				this.$emit('update',res)
			},
			deep: true			
		},

	}
}
</script>