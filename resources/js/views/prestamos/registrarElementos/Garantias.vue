<template lang="pug">
  .form_step_wrapper
    .form_list.no_border
      .sub_step_wrapper(v-for='(row, index) in prestamoGarantias.garantias' :key='index')
        h3.title
          | Garantia {{index + 1}}
          button.delete_section(type='button' @click.prevent='clickRemoveGarantia(index)')
            i.material-icons-outlined delete
        .form_content
          .group_form
            .input_wrapper(:class='{require : !row.validate_bien_garantia, other: validateInscripcion}')
              label Bien en Garantía
              input(type='text' maxlength='50' v-model='row.bien_garantia')
              .message Información obligatoria
          .group_form
            .input_box.no_label
              .input_box_wrapper
                .input_checkbox_wrapper.radio
                  input(type='radio' :id="'radio'+index" :name="'garantiaType'+index" v-model='row.inscripcion' value='1')
                  label.box_content(:for="'radio'+index")
                    .box
                    span Inscripción
                .input_checkbox_wrapper.radio
                  input(type='radio' :id="'radio2'+index" :name="'garantiaType'+index" v-model='row.declaracion_jurada' value='1')
                  label.box_content(:for="'radio2'+index")
                    .box
                    span Declaración Jurada
    button.add_section(type='button' @click='clickAddGarantia' v-if='prestamoGarantias.garantias.length<=1')
      span AGREGAR GARANTIA
      i.material-icons-outlined add

</template>
<script>
export default {
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
  methods:{
    clickAddGarantia() {
      this.prestamoGarantias.garantias.push({
        inscripcion: "",
        declaracion_jurada:"",
        bien_garantia: "",
        tipo: ""
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