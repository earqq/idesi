<template lang="pug">
  .form_step_wrapper
    .form_list.no_border
      .sub_step_wrapper(v-for='(row, index) in prestamoGarantias.garantias' :key='index')
        h3.title
          | Garantia 
          //- button.delete_section(type='button' @click.prevent='clickRemoveGarantia(index)')
          //-   i.material-icons-outlined delete
        .form_content
          .group_form(v-if='tipo=="GARANTIA VEHICULAR"')
            .input_wrapper
              label Marca
              input(type='text' maxlength='50' v-model='row.marca')
              .message Información obligatoria
            .input_wrapper
              label Modelo
              input(type='text' maxlength='50' v-model='row.modelo')
              .message Información obligatoria
            .input_wrapper
              label Año fabricación
              input(type='date' maxlength='50' v-model='row.anio_fabricacion')
              .message Información obligatoria
            .input_wrapper
              label Placa
              input(type='text' maxlength='50' v-model='row.placa')
              .message Información obligatoria
            .input_wrapper
              label Partida Registral
              input(type='text' maxlength='50' v-model='row.partida_registral')
              .message Información obligatoria  
        .form_content
          .group_form(v-if='tipo=="GARANTIA INMOBILIARIA"')
            .input_wrapper
              label Terreno o Casa
              select(v-model='row.tipo_inmobiliaria')
                option(value='Terreno') Terreno
                option(value='Casa') Casa
            .input_wrapper
              label Dirección del bien
              input(type='text' maxlength='100' v-model='row.direccion_inmobiliaria')
              .message Información obligatoria
            .input_wrapper
              label Partida Registral
              input(type='date' maxlength='50' v-model='row.partida_registral')
              .message Información obligatoria      
        .form_content
          .group_form(v-if='tipo=="GARANTIA LIQUIDA"')
            .input_wrapper
              label Monto del ahorro o  deposio a plazo
              input(type='number' v-model='row.monto_ahorrado_liquido' maxlength='100' )         
    //- button.add_section(type='button' @click='clickAddGarantia' v-if='prestamoGarantias.garantias.length<=1')
    //-   span AGREGAR GARANTIA
    //-   i.material-icons-outlined add

</template>
<script>
export default {
  props:["tipo"],
  data(){
      return{
        prestamoGarantias:{
          garantias:[],
          validate:false,
        }
      }
  },
  computed:{
    validateInscripcion(){
      let response=true
      this.prestamoGarantias.garantias.map(item=>{
        item.validate_bien_garantia=false
        if(item.bien_garantia && item.bien_garantia.length>2)
          item.validate_bien_garantia=true
        else response=false
      })     
      return response
    },
  
    validateGarantias(){
      return this.validateInscripcion            
    },
  },
  mounted(){
    this.clickAddGarantia()
  },
  methods:{
    clickAddGarantia() {
      this.prestamoGarantias.garantias.push({
        marca: "",
        modelo: "",
        anio_fabricacion: "",
        placa: "",
        partida_registral: "",
        tipo_inmobiliaria: "",
        direccion_inmobiliaria: "",
        monto_ahorrado_liquido: "",
      });
    },
    clickRemoveGarantia(index) {
      this.prestamoGarantias.garantias.splice(index, 1);
    },
    
  },  
  watch: {
		prestamoGarantias: {
			handler (item) {	
        item.validate = this.validateGarantias
				this.$emit('update',item)
			},
			deep: true			
		},
	}
}
</script>