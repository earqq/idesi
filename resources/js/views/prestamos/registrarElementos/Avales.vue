<template lang="pug">
  .form_step_wrapper
    .form_list.no_border
      .sub_step_wrapper(v-for='(row, index) in prestamoAvales.avales' :key='index')
        h3.title
          | Aval {{index + 1}}
          button.delete_section(type='button' @click.prevent='clickRemoveAval(index)')
            i.material-icons-outlined delete
        .form_content
          .group_form
            .input_wrapper
              label Tipo
              select(v-model='row.tipo_persona')
                option(value='pn') Persona Natural
                option(value='pj') Persona Juridica
            .input_wrapper(v-if="row.tipo_persona=='pj'")
              label Ruc
              input(type='text' v-model='row.empresa_ruc' v-mask="'###########'" @keyup='ObtenerDatosAvalEmpresa(row.empresa_ruc,index)')
            .input_wrapper(v-if="row.tipo_persona=='pj'")
              label Razon Social
              input(type='text' maxlength='200' v-model='row.empresa_razon_social')
            .input_wrapper(v-if="row.tipo_persona=='pj'")
              label Direcci&oacute;n
              input(type='text' maxlength='200' v-model='row.empresa_direccion')
          span.separator
          .group_form
            .input_wrapper(:class='{require: !row.validate_documento, other: validateDocumentosSocios}')
              label Documento de Identidad
              input(type='text' v-model='row.documento' v-mask="'#########'" @change='datosAval(index)')
            .input_wrapper(:class='{require: !row.validate_nombres, other: validateNombresSocios}')
              label Nombres
              input(type='text' maxlength='50' v-model='row.nombres')
            .input_wrapper(:class='{require: !row.validate_apellidos, other: validateApellidosSocios}')
              label Apellidos
              input(type='text' maxlength='50' v-model='row.apellidos')
            .input_wrapper(:class='{require: !row.validate_fecha_nacimiento, other: validateFechasNacimientoSocios}')
              label Fecha de Nacimiento
              input(type='date' v-model='row.fecha_nacimiento')
            .input_wrapper
              label Estado Civil
              select(v-model='row.estado_civil')
                option(value='SOLTERO') SOLTERO
                option(value='CASADO') CASADO
                option(value='CONVIVIENTE') CONVIVIENTE
                option(value='DIVORCIADO - SEPARADO') DIVORCIADO - SEPARADO
                option(value='VIUDO') VIUDO
            .input_wrapper
              label Ocupaci&oacute;n
              input(type='text' maxlength='40' v-model='row.ocupacion')
            .input_wrapper
              label Centro Laboral
              input(type='text' maxlength='50' v-model='row.centro_laboral')
            .input_wrapper
              label Direcci&oacute;n centro laboral
              input(type='text' maxlength='100' v-model='row.direccion_centro_laboral')
          span.separator
          .group_form
            .input_wrapper
              label Socio
              select(v-model='row.socio')
                option(value='1') SI
                option(value='0') NO
            .input_wrapper(v-if="row.socio=='1'" :class='{require: !row.validate_codigo_socio, other: validateCodigosSociosAval}')
              label Codigo
              input(type='text' v-model='row.codigo_socio' maxlength='10')
            .input_wrapper(v-if="row.socio=='1'" :class='{require: !row.validate_aporte_socio , other: validateCodigosSociosAval}')
              label Aporte
              input(type='text' v-mask='"######"' v-model='row.aporte_socio')
            .input_wrapper
              label Tel&eacute;fono
              input(type='text' maxlength='10' v-model='row.telefono')
            .input_wrapper
              label Celular
              input(type='text' v-model='row.celular' v-mask="'### ### ###'")
            .input_wrapper
              label Direcci&oacute;n
              input(type='text' v-model='row.direccion' maxlength='100')
            .input_wrapper
              label Distrito
              input(type='text' v-model='row.distrito' maxlength='30')
    button.add_section(type='button' @click='clickAddAval' v-if='prestamoAvales.avales.length<=1')
      span AGREGAR AVAL
      i.material-icons-outlined add

</template>
<script>
export default {
  data(){
    return{
      prestamoAvales:{
        avales:[],
        validate:false
      }
    }
  },
  methods:{
    clickAddAval() { 
      this.prestamoAvales.avales.push({
        documento: "",
        nombres: "",
        apellidos: "",
        fecha_nacimiento: "",
        estado_civil: "SOLTERO",
        ocupacion: "",
        telefono: "",
        celular: "",
        direccion: "",
        distrito: "",
        centro_laboral: "",
        direccion_centro_laboral: "",
        socio: 0,
        codigo_socio: "",
        aporte_socio: "",
        validate_codigo_socio:false,
        validate_aporte_socio:false,
        validate_fecha_nacimiento:false,
        validate_documento:false,
        validate_nombres:false,
        validate_apellidos:false,
        tipo_persona: "pn",
        empresa_ruc:'',
        empresa_razon_social:'',
        empresa_direccion:''
      });
    },
    clickRemoveAval(index) {
      this.prestamoAvales.avales.splice(index, 1);
    },
    ObtenerDatosAvalEmpresa(ruc,index){
      if(ruc.length==11){
          let me = this;
          axios
            .post("/consulta/doc", {
              documento: ruc
            })
            .then(function(response) {          
              if(response.data){
                me.prestamoAvales.avales[index].empresa_razon_social=response.data.RAZON
                me.prestamoAvales.avales[index].empresa_direccion=response.data.DIRECCION
              }
            })
            .catch(function(error) {
              console.log(error);
        });
        console.log()
      }
    },
    datosAval(index) {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/doc", {
          documento: this.prestamoAvales.avales[index].documento
        })
        .then(function(response) { 
          me.prestamoAvales.avales[index].nombres = response.data["nombres"];
          me.prestamoAvales.avales[index].apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
    },
  },
  computed: {       
    validateCodigosSociosAval(){
      let response=true
      this.prestamoAvales.avales.map(item=>{
        if(item.socio=='1'){
          item.validate_codigo_socio=false
          item.validate_aporte_socio=false
          if(item.codigo_socio && item.codigo_socio.length>2)
            item.validate_codigo_socio=true
          else response=false
          if(item.aporte_socio>0)
            item.validate_aporte_socio=true  
          else response=false
        }
      })     
      return response
    },
    validateFechasNacimientoSocios(){
      let response=true
      this.prestamoAvales.avales.map(item=>{
        item.validate_fecha_nacimiento=false
        if(item.fecha_nacimiento && item.fecha_nacimiento.length>2)
          item.validate_fecha_nacimiento=true
        else response=false
      })     
      return response
    },
    validateDocumentosSocios(){
      let response=true
      this.prestamoAvales.avales.map(item=>{
        item.validate_documento=false
        if(item.documento && item.documento.length>2)
          item.validate_documento=true
        else response=false
      })     
      return response
    },
    validateNombresSocios(){
      let response=true
      this.prestamoAvales.avales.map(item=>{
        item.validate_nombres=false
        if(item.nombres && item.nombres.length>2)
          item.validate_nombres=true
        else response=false
      })     
      return response
    },
    validateApellidosSocios(){
      let response=true
      this.prestamoAvales.avales.map(item=>{
        item.validate_apellidos=false
        if(item.apellidos && item.apellidos.length>2)
          item.validate_apellidos=true
        else response=false
      })     
      return response
    },
  
    validateAvales(){
      return this.validateCodigosSociosAval &&
            this.validateFechasNacimientoSocios &&
            this.validateDocumentosSocios &&
            this.validateNombresSocios &&
            this.validateApellidosSocios
    },
  },
  watch: {
		prestamoAvales: {
			handler (item) {	
        item.validate = this.validateAvales
				this.$emit('update',item)
			},
			deep: true			
		},

	}
}
</script>