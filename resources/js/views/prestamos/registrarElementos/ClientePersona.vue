<template lang='pug'>
  .form_step_wrapper
    h3.title Datos del Titular
    .form_content
      .group_form
        .input_wrapper
          label Documento 
          input(type='text' disabled v-model='cliente.documento')
        .input_wrapper
          label Nombres
          input(type='text' disabled v-model='cliente.persona.nombres')
        .input_wrapper
          label Apellidos
          input(type='text' disabled v-model='cliente.persona.apellidos')
        .input_wrapper
          label Fecha de nacimiento
          input(type='date' disabled v-model='cliente.persona.fecha_nacimiento')
        .input_wrapper
          label Estado Civil
          select(v-model='cliente.persona.estado_civil')
            option(value='SOLTERO') SOLTERO
            option(value='CASADO') CASADO
            option(value='CONVIVIENTE') CONVIVIENTE
            option(value='DIVORCIADO - SEPARADO') DIVORCIADO - SEPARADO
            option(value='VIUDO') VIUDO
        .input_wrapper(:class='{require: !validateOcupacion}')
          label Ocupación
          input(type='text' v-model='cliente.persona.ocupacion' maxlength='100')
          .message Se requiere esta información
        .input_wrapper
          label Teléfono
          input(type='text' v-model='cliente.telefono' maxlength='10')
        .input_wrapper(:class='{require: !validateCelular}')
          label Celular
          input(type='text' v-mask="'### ### ###'" v-model='cliente.celular')
          .message Se requiere esta información       
      span.separator
      .group_form
        .input_wrapper
          label Departamento dirección
          select(v-model='cliente.ubicacion_departamento' @change='filterProvincesTitularMe' dusk='departamentos_id')
            option(v-for='option in departamentos' :key='option.id' :value='option.id' :label='option.descripcion') &gt;
        .input_wrapper
          label Provincia dirección
          select(v-model='cliente.ubicacion_provincia' filterable='' @change='filterDistrictTitularMe' dusk='provincias_id')
            option(v-for='option in provincesTitular' :key='option.id' :value='option.id' :label='option.descripcion') &gt;
        .input_wrapper
          label Distrito dirección
          select(v-model='cliente.ubicacion_distrito' filterable='' dusk='distritos_id')
            option(v-for='option in districtsTitular' :key='option.id' :value='option.id' :label='option.descripcion') &gt;
        .input_wrapper(:class='{require: !validateDireccion}')
          label Dirección Declarada
          input(type='text' v-model='cliente.ubicacion_direccion_declarada')
          .message Se requiere esta información
        .input_wrapper
          label Dirección Reniec
          input(type='text' v-model='cliente.ubicacion_direccion_sistema' disabled='')
        .input_wrapper(:class='{require: !validateReferencia}')
          label Referencia
          input(type='text' v-model='cliente.ubicacion_referencia')
          .message Se requiere esta información
        .input_wrapper
          label Tipo Domicilio
          select(v-model='cliente.persona.tipo_domicilio')
            option(value='PROPIA') PROPIA
            option(value='PROPIA HIPOTECA') PROPIA HIPOTECA
            option(value='DE LOS PADRES') DE LOS PADRES
            option(value='DE LOS FAMILIARES') DE LOS FAMILIARES
            option(value='ALQUILADA') ALQUILADA
        .input_wrapper(:class='{require: !validateCentro}')
          label Centro Laboral
          input(type='text' v-model='cliente.persona.trabajo.empresa_razon_social')
          .message Se requiere esta información
        .input_wrapper(:class='{require: !validateDireccionLaboral}')
          label Dirección centro laboral 
          input(type='text' v-model='cliente.persona.trabajo.empresa_direccion')
          .message Se requiere esta información
    button.add_section.in_bottom(type='button' @click='cliente.tiene_conyuge=true' v-if='!cliente.tiene_conyuge')
      span AGREGAR CÓNYUGE O CONVIVIENTE
      i.material-icons-outlined add
    .form_list(v-if='cliente.tiene_conyuge')
      .form_step_wrapper.in_bottom
        h3.title
          | CÓNYUGE o Conviviente 
          button.delete_section(type='button' @click='cliente.tiene_conyuge=false')
            i.material-icons-outlined  delete 
        .form_content
          .group_form
            .input_wrapper(:class='{require: !validateDocumentoConyuge}')
              label Documento de Identidad
              input(type='text' v-model='cliente.persona.conyuge.documento' @keyup='datosCliente()' maxlength='15')
              .message número de documento inválido
            .input_wrapper(:class='{require: !validateNombreConyuge}')
              label Nombres y Apellidos 
              input(type='text' v-model='cliente.persona.conyuge.nombres')
            .input_wrapper(:class='{require: !validateNacimientoConyuge}')
              label Fecha de Nacimiento
              input(type='date' v-model='cliente.persona.conyuge.fecha_nacimiento')
            .input_wrapper
              label Estado Civil
              select(v-model='cliente.persona.conyuge.estado_civil')
                option(value='SOLTERO') SOLTERO
                option(value='CASADO') CASADO
                option(value='CONVIVIENTE') CONVIVIENTE
                option(value='DIVORCIADO - SEPARADO') DIVORCIADO - SEPARADO
                option(value='VIUDO') VIUDO
            .input_wrapper(:class='{require: !validateOcupacionConyuge}')
              label Ocupación
              input(type='text' v-model='cliente.persona.conyuge.ocupacion')
            .input_wrapper
              label Socio 
              select(v-model='cliente.persona.conyuge.socio')
                option(value='true') SI
                option(value='false') NO
            .input_wrapper(:class='{require: !validateCodigoConyuge}' v-if='cliente.persona.conyuge.socio')
              label Codigo
              input(type='text' v-model='cliente.persona.conyuge.codigo_socio' maxlength='10')
            .input_wrapper(:class='{require: !validateAporteConyuge}' v-if='cliente.persona.conyuge.socio')
              label Aporte 
              input(type='text' v-mask='"######"' v-model='cliente.persona.conyuge.aporte_socio')
            .input_wrapper
              label Telefono
              input(type='text' v-model='cliente.persona.conyuge.telefono' maxlength='11')
            .input_wrapper(:class='{require: !validateCelularConyuge}')
              label Celular
              input(type='text' v-mask="'### ### ###'" v-model='cliente.persona.conyuge.celular')
            .input_wrapper
              label ¿Trabaja?
              select(v-model='cliente.persona.conyuge.trabaja')
                option(value='true') SI
                option(value='false') NO
            .input_wrapper(:class='{require: !validateCentroConyuge}' v-if='cliente.persona.conyuge.trabaja')
              label Centro Laboral
              input(type='text' v-model='cliente.persona.conyuge.centro_laboral')
            .input_wrapper(:class='{require: !validateDireccionConyuge}' v-if='cliente.persona.conyuge.trabaja')
              label Dirección centro laboral
              input(type='text' v-model='cliente.persona.conyuge.direccion_centro_laboral')

          
</template>
<script>
import { OBTENER_DEPARTAMENTOS, OBTENER_PROVINCIAS, OBTENER_DISTRITOS } from '../prestamos.js'
export default {
  props:["clienteBD"],
  data(){
    return{
      departamentos:[],
      provincias:[],
      distritos:[],
      provincesTitular: [],
      districtsTitular: [],
      cliente: {
        tiene_conyuge:false,
        ubicacion_departamento: "",
        ubicacion_provincia: "",
        ubicacion_distrito: "",
        ubicacion_direccion_declarada: "",
        ubicacion_referencia: "",
        documento:'',
        telefono: "",
        celular: "",
        persona: {
          nombres: "",
          apellidos: "",
          fecha_nacimiento: "",
          estado_civil: "SOLTERO",
          ocupacion: "",
          tipo_domicilio: "PROPIA",  
          conyuge: {
            documento: "",
            nombres: "",
            fecha_nacimiento: "",
            estado_civil: "SOLTERO",
            ocupacion: "",
            telefono: "",
            celular: "",
            trabaja: 1,
            centro_laboral: "",
            direccion_centro_laboral: "",
            socio: false,
            codigo_socio: "",
            aporte_socio: "",
          },
          trabajo:{
            empresa_direccion: "",
            empresa_razon_social: "",
          },   

        },
      },
    }
  },
  apollo:{
    departamentosBD:{
      query:OBTENER_DEPARTAMENTOS,              
      update(res){
        this.departamentos=res.departamentos
        
      }
    },
    provinciasBD:{
      query:OBTENER_PROVINCIAS,   
      update(res){
        this.provincias=res.provincias
      }           
    },
    distritosBD:{
      query:OBTENER_DISTRITOS,    
      update(res){
        this.distritos=res.distritos
        this.filterProvincesTitularMe()
      }          
    }
  },    
  methods:{
    filterProvincesTitularMe() {        
        this.provincesTitular = this.provincias.filter(f => {
          return f.departamento_id == this.cliente.ubicacion_departamento
        })
        if(this.provincesTitular[0])
        this.cliente.ubicacion_provincia=this.provincesTitular[0].id
        this.filterDistrictTitularMe()
    },
    
    filterDistrictTitularMe() {
      this.districtsTitular = this.distritos.filter(f => {
          return f.provincia_id == this.cliente.ubicacion_provincia
      })
      if(this.districtsTitular[0])
      this.cliente.ubicacion_distrito=this.districtsTitular[0].id

    },   
    datosCliente() {
      let me = this;
      if(this.cliente.persona.conyuge && this.cliente.persona.conyuge.documento.length>7){
        axios
        .post("/consulta/doc", {
          documento: this.cliente.persona.conyuge.documento
        })
        .then(function(response) { 
          if(response.data){
            me.cliente.persona.conyuge.nombres =
            response.data["nombres"] + " " + response.data["surnames"];
          }
        })
        .catch(function(error) {
          console.log(error);
        });
      }
    },
  },
  mounted(){
    // this.$set(this.cliente,'a',this.clienteBD)
    if(this.clienteBD.persona.conyuge.documento!='')
      this.cliente.tiene_conyuge=true 
    this.cliente=this.clienteBD    
    console.log(this.cliente)
  },
  computed:{    
    validateOcupacion(){
      return this.cliente.persona.ocupacion.length>4
    }
    ,
    validateCelular(){
      return  this.cliente.celular.length>8
    }
    ,
    validateDireccion(){
      return  this.cliente.ubicacion_direccion_declarada.length>5
    }
    ,     
    validateReferencia(){
      return this.cliente.ubicacion_referencia.length>5
    }
    ,
    validateDomicilio(){
      return this.cliente.persona.tipo_domicilio.length>5
    }
    ,
    validateCentro(){
      if(this.cliente.persona.trabajo){
        let centroTexto = this.cliente.persona.trabajo.empresa_razon_social || ""
        return centroTexto.length>5
      }
      else
        return true
    }
    ,
    validateDireccionLaboral(){
      if(this.cliente.persona.trabajo){
        let centroDireccion= this.cliente.persona.trabajo.empresa_direccion || ""
        return centroDireccion.length>6
      }
      else return true
    },
    validateDocumentoConyuge(){      
      if(this.cliente.persona.conyuge){
          return String(this.cliente.persona.conyuge.documento).length > 6
      }else{
        return true
      }
    },
    validateNombreConyuge(){
      if(this.cliente.persona.conyuge){
        return this.cliente.persona.conyuge.nombres.length>6
      }else{
        return true
      }   
    },
    validateNacimientoConyuge(){
      return this.cliente.persona.conyuge.fecha_nacimiento.length>6
    },
    validateOcupacionConyuge(){
      if(this.cliente.persona.conyuge && this.cliente.persona.conyuge.ocupacion)
        return this.cliente.persona.conyuge.ocupacion.length>6
      else true
    },

    validateCelularConyuge(){
      if(this.cliente.persona.conyuge && this.cliente.persona.conyuge.celular)
      return this.cliente.persona.conyuge.celular.length>6
      else true
    },
    validateCodigoConyuge(){
      if(this.cliente.persona.conyuge.socio){
        return this.cliente.persona.conyuge.codigo_socio.length>=3
      }
      else{
        return true
      }
    },
    validateAporteConyuge(){
      if(this.cliente.persona.conyuge.socio){
        return String(this.cliente.persona.conyuge.aporte_socio)>=1
      }
      else{
        return true
      }
    },      
      validateCentroConyuge(){
      if(this.cliente.persona.conyuge.trabaja){
        return this.cliente.persona.conyuge.centro_laboral.length>5
      }
      else{
        return true
      }
      
    },
    validateDireccionConyuge(){
      if(this.cliente.persona.conyuge.trabaja){
        return this.cliente.persona.conyuge.direccion_centro_laboral.length>5
      }
      else{
        return true
      }
      
    },

    validateClientePersona(){
      let validate=false
      let validateConyuge=true
      validate = this.validateOcupacion && 
            this.validateCelular && this.validateDireccion && 
            this.validateReferencia && this.validateDomicilio &&
            this.validateCentro && this.validateDireccionLaboral
      if(this.cliente.tiene_conyuge){   
        validateConyuge=
              this.validateDocumentoConyuge &&
              this.validateNombreConyuge &&
              this.validateNacimientoConyuge &&
              this.validateOcupacionConyuge &&
              this.validateCodigoConyuge &&
              this.validateAporteConyuge &&
              this.validateCelularConyuge &&
              this.validateCentroConyuge &&
              this.validateDireccionConyuge
      }     
      if(validate && validateConyuge) return true
      else return false
    }
  },
  watch: {
		cliente: {
			handler (item) {
        if(item.persona.estado_civil=='CASADO' || item.persona.estado_civil=='CONVIVIENTE')
          this.cliente.tiene_conyuge=true
        else this.cliente.tiene_conyuge=false
        item.validate = this.validateClientePersona
        this.$emit('update',item)
			},
			deep: true			
		},

	}
}
</script>