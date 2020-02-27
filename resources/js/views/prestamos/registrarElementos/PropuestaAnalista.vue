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
        .input_wrapper
          label Importe
          input(type='text' v-model='propuestaAnalista.importe' v-mask='"#####"')
        .input_wrapper
          label Cuotas
          input(type='text' v-model='propuestaAnalista.cuotas' v-mask='"#####"' @keyup='meses_numero')
        .input_wrapper
          label Meses
          input(type='text' v-model='propuestaAnalista.meses' disabled='')
        .input_wrapper
          label Cuota del sistema
          input(type='number' v-model='propuestaAnalista.cuota_sistema')
        .input_wrapper
          label Aporte a la fecha
          input(type='text' v-mask='"#####"' v-model='propuestaAnalista.aporte')
        .input_wrapper
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
        this.propuestaAnalista.meses = (Number(this.propuestaAnalista.cuotas) / 30).toFixed(2);
      } else if (this.propuestaAnalista.producto == "CREDISEMANA") {
        this.propuestaAnalista.meses = (Number(this.propuestaAnalista.cuotas) / 4).toFixed(2);
      } else {
        this.propuestaAnalista.meses = (Number(this.prestamo.cuotas) / 1).toFixed(2);
      }
    },
  }
}
</script>