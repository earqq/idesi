<template lang='pug'>
  .create_client_content
    section.tabs_section
      .tabs_wrapper
        .tab(@click='tab = 2' :class='{selected: tab == 2}' v-if="evaluacion.fuente_ingreso!='TRANSPORTES' &&  evaluacion.fuente_ingreso!='TRANSPORTE BAJAJ'")
          span 2
          p NEGOCIO
        .tab(@click='tab = 2' :class='{selected: tab == 2}' v-else='')
          span 2
          p TRANSPORTE
        .tab(v-if='prestamo.cliente.tipo_cliente==1' @click=' (validateStep2) ? tab = 3 : tabError()' :class='{selected: tab == 3}')
          span 3
          p FAMILIARES
        .tab(@click='validateStep2 ? tab = 4 : tabError()' :class='{selected: tab == 4}')
          span 4
          p CENTRAL DE RIESGO
        .tab(@click='validateStep2 ? tab = 5 : tabError()' :class='{selected: tab ==5}')
          span 5
          p REFERENCIAS
        .tab(@click='validateStep2 ? tab = 6 : tabError()' :class='{selected: tab ==6}')
          span 6
          p COLATERAL
        .tab(@click='validateStep2 ? tab = 7 : tabError()' :class='{selected: tab ==7}')
          span 7
          p PROPUESTA 
    section.client_forms
      .client_forms_wrapper
        .form_step(v-show='tab == 2')
          .form_step_wrapper
            h3.title(v-if="evaluacion.fuente_ingreso!='TRANSPORTES' &&  evaluacion.fuente_ingreso!='TRANSPORTE BAJAJ'") Datos del Negocio
            h3.title(v-else='') Datos del Vehiculo
            .form_content
              .group_form(v-if="evaluacion.fuente_ingreso!='TRANSPORTES' &&  evaluacion.fuente_ingreso!='TRANSPORTE BAJAJ' ")
                .input_wrapper(:class='{require: !validateUbicacion}')
                  label Ubicacion del negocio
                  input(type='text' v-model='evaluacion.negocio.ubicacion')
                  .message Ingrese direcci&oacute;n del negocio
                .input_wrapper
                  label Antiguedad
                  select(v-model='evaluacion.negocio.antiguedad')
                    option(value='MENOS DE 1 AÑO') Menos de 1 a&ntilde;o
                    option(value='1 AÑO') 1 a&ntilde;o
                    option(value='2 AÑOS') 2 a&ntilde;os
                    option(value='3 AÑOS') 3 a&ntilde;os
                    option(value='4 AÑOS') 4 a&ntilde;os
                    option(value='5 AÑOS') 5 a&ntilde;os
                    option(value='6 MÁS DE 5 AÑOS') M&aacute;s de 5 a&ntilde;os
                .input_wrapper
                  label Local
                  select(v-model='evaluacion.negocio.local')
                    option(value='PROPIO') Propio
                    option(value='ALQUILADO') Alquilado
                    option(value='MODULO V. PUBLICO') M&oacute;dulo V. p&uacute;blica
                    option(value='FAMILIAR') Familiar
                    option(value='HIPOTECA/ANTICRISIS') HipoteaA/anticresis
                .input_wrapper
                  label Licencia de Funcionamiento
                  select(v-model='evaluacion.negocio.licencia_funcionamiento')
                    option(value='SI CUENTA') Si cuenta
                    option(value='NO CUENTA') No cuenta
                .input_wrapper
                  label Realizo mejoras en el local
                  select(v-model='evaluacion.negocio.mejoras_local')
                    option(value='1') Si realizo
                    option(value='0') No realizo
                .input_wrapper
                  label Horario de atenci&oacute;n entrada
                  input(type='time' v-model='evaluacion.negocio.horario_atencion_inicio')
                .input_wrapper
                  label Horario de atenci&oacute;n salida
                  input(type='time' v-model='evaluacion.negocio.horario_atencion_salida')
              .group_form(v-else='')
                .input_wrapper(:class='{require: !validateMarca}')
                  label Marca
                  input(type='text' v-model='evaluacion.vehiculo.marca')
                  .message Ingrese marca del vehiculo
                .input_wrapper(:class='{require: !validateModelo}')
                  label Modelo
                  input(type='text' v-model='evaluacion.vehiculo.modelo')
                  .message Ingrese modelo del vehiculo
                .input_wrapper
                  label A&ntilde;o fabricaci&oacute;n
                  select(v-model='evaluacion.vehiculo.año')
                    option(value='1995') 1995
                    option(value='1996') 1996
                    option(value='1997') 1997
                    option(value='1998') 1998
                    option(value='1999') 1999
                    option(value='2001') 2001
                    option(value='2002') 2002
                    option(value='2003') 2003
                    option(value='2004') 2004
                    option(value='2005') 2005
                    option(value='2006') 2006
                    option(value='2007') 2007
                    option(value='2008') 2008
                    option(value='2009') 2009
                    option(value='2010') 2010
                    option(value='2011') 2011
                    option(value='2012') 2012
                    option(value='2013') 2013
                    option(value='2014') 2014
                    option(value='2015') 2015
                    option(value='2016') 2016
                    option(value='2017') 2017
                    option(value='2018') 2018
                    option(value='2018') 2018
                    option(value='2019') 2019
                .input_wrapper(:class='{require: !validateServicio}')
                  label Tipo servicio que brinda
                  input(type='text' v-model='evaluacion.vehiculo.tipo_servicio_brinda')
                  .message ingrese tiempo de servicio
                .input_wrapper(:class='{require: !validateAntiguedad}')
                  label Antiguedad realizando el servicio
                  input(type='text' v-model='evaluacion.vehiculo.antiguedad_servicio')
                  .message Ingrese antiguedad de servicio
                .input_wrapper
                  label Permiso para brindar servicio
                  select(v-model='evaluacion.vehiculo.permiso_servicio')
                    option(value='SI CUENTA') Si cuenta
                    option(value='NO CUENTA') No cuenta
                .input_wrapper
                  label Horario trabajo inicio
                  input(type='time' v-model='evaluacion.vehiculo.horario_servicio_inicio')
                .input_wrapper
                  label Horario trabajo inicio
                  input(type='time' v-model='evaluacion.vehiculo.horario_servicio_fin')
          .form_buttons
            a.button_inline_primary.medium.prev(@click='prev(2)')
              i.material-icons-outlined navigate_before
              span ATRAS
            a.button_primary.medium.next(v-if='prestamo.cliente.tipo_cliente==1' @click='(validateStep2) ? next(2) : tabError()')
              span SIGUIENTE
              i.material-icons-outlined navigate_next
            a.button_primary.medium.next(v-else='' @click='( validateStep2) ? next(3) : tabError()')
              span SIGUIENTE
              i.material-icons-outlined navigate_next
        .form_step(v-show='tab == 3' v-if='prestamo.cliente.tipo_cliente==1')
          .form_step_wrapper
            h3.title Informaci&oacute;n Familiar
            .form_content
              .group_form
                .input_wrapper
                  label Tipo de vivienda
                  select(v-model='evaluacion.familiar.tipo_vivienda')
                    option(value='PROPIA CANCELADA') Propia Cancelada
                    option(value='PROPIA (HIPOTECA)') Propia (hipoteca)
                    option(value='DE LOS PADRES') De los padres
                    option(value='DE FAMILIARES') De familiares
                    option(value='ALQUILADA') Alquilada
                .input_wrapper
                  label Situacion familiar
                  select(v-model='evaluacion.familiar.situacion_familiar')
                    option(value='SOLTERO') Soltero
                    option(value='CASADO') Casado
                    option(value='CONVIVIENTE') Conviviente
                .input_wrapper
                  label Miembros de familia
                  input(type='number' v-model='evaluacion.familiar.miembros_familia' disabled='')
            .form_list
              .sub_step_wrapper(v-for='(hijo, index) in evaluacion.familiar.hijos' :key='index')
                h3.title
                  | Hijo {{index + 1}}
                .form_content
                  .group_form
                    .input_wrapper
                      label Estudia
                      select(v-model='hijo.estudia' @change='cambiarEstudio(index)')
                        option(value='0') No estudia
                        option(value='1') Si estudia
                    .input_wrapper
                      label Edad
                      input(type='text' v-model='hijo.edad' disabled='')
                    .input_wrapper
                      label Colegio
                      select(:disabled='hijo.estudia=="0"' v-model='hijo.colegio' @change='seleccionColegiosCosto(index)')
                        option(v-for='(colegio,index) in colegios' v-bind:value='colegio.nombre' :key='index') {{ colegio.nombre }}
                    .input_wrapper
                      label Grado
                      select(:disabled='hijo.estudia=="0"' v-model='hijo.grado' @change='seleccionColegiosCosto(index)')
                        option(value='INICIAL') INICIAL
                        option(value='PRIMARIA') PRIMARIA
                        option(value='SECUNDARIA') SECUNDARIA
                    .input_wrapper
                      label Costo
                      input(v-if='hijo.estudia' type='text' :value="'S/. '+hijo.costo" :disabled='hijo.estudia=="0"')
          .form_buttons
            a.button_inline_primary.medium.prev(@click='prev(3)')
              i.material-icons-outlined navigate_before
              span ATRAS
            a.button_primary.medium.next(@click='( validateStep2) ? next(3) : tabError()')
              span SIGUIENTE
              i.material-icons-outlined navigate_next
        .form_step(v-show='tab == 4')
          .form_step_wrapper
            .form_list.no_border
              .sub_step_wrapper(v-for='(entidad_financiera, index) in evaluacion.central_riesgo' :key='index')
                h3.title
                  | Entidad Financiera {{index + 1}} 
                  button.delete_section(v-if='index > 0' type='button' @click='clickRemoveFinanciera(index)')
                    i.material-icons-outlined delete
                .form_content
                  .group_form
                    .input_wrapper
                      label Entidad
                      v-select(label='nombre' :options='entidades' :reduce='entidades => entidades.nombre' v-model='entidad_financiera.entidad_financiera')
                        span(slot='no-options')
                          | No se encontro giro de negocio
                  .group_form
                    .input_box.no_label
                      .input_box_wrapper
                        .input_checkbox_wrapper
                          input(type='checkbox' :id="'checkbox'+index" v-model='entidad_financiera.capital')
                          label.box_content(:for="'checkbox'+index")
                            .box
                            span Capital de trabajo
                        .input_checkbox_wrapper
                          input(type='checkbox' :id="'checkbox2'+index" v-model='entidad_financiera.activo_f')
                          label.box_content(:for="'checkbox2'+index")
                            .box
                            span Activo Fijo
                        .input_checkbox_wrapper
                          input(type='checkbox' :id="'checkbox3'+index" v-model='entidad_financiera.consumo')
                          label.box_content(:for="'checkbox3'+index")
                            .box
                            span Consumo
                        .input_checkbox_wrapper
                          input(type='checkbox' :id="'checkbox4'+index" v-model='entidad_financiera.vehicular')
                          label.box_content(:for="'checkbox4'+index")
                            .box
                            span Vehicular
                        .input_checkbox_wrapper
                          input(type='checkbox' :id="'checkbox5'+index" v-model='entidad_financiera.hipoteca')
                          label.box_content(:for="'checkbox5'+index")
                            .box
                            span Hipotecario
                        .input_checkbox_wrapper
                          input(type='checkbox' :id="'checkbox6'+index" v-model='entidad_financiera.terceros')
                          label.box_content(:for="'checkbox6'+index")
                            .box
                            span Terceros
            button.add_section(type='button' @click='clickAddFinanciera')
              span  AGREGAR ENTIDAD FINANCIERA 
              i.material-icons-outlined add
          .form_step_wrapper.in_bottom
            h3.title Situacion de Entidades
            .form_content
              .group_form
                .input_wrapper
                  label Comentarios
                  textarea.form-control(v-model='evaluacion.comentario_central_riesgo')
          .form_buttons
            a.button_inline_primary.medium.prev(@click='prev(4)')
              i.material-icons-outlined navigate_before
              span ATRAS
            a.button_primary.medium.next(@click='( validateStep2) ? next(4) : tabError()')
              span SIGUIENTE
              i.material-icons-outlined navigate_next
        .form_step(v-show='tab == 5')
          .form_step_wrapper
            .form_list.no_border
              .sub_step_wrapper(v-for='(referencia, index) in evaluacion.referencias' :key='index')
                h3.title
                  | Referencia  {{index + 1}}
                  button.delete_section(v-if='index > 0' type='button' @click.prevent='clickRemoveReferencia(index)')
                    i.material-icons-outlined delete
                .form_content
                  .group_form
                    .input_wrapper
                      label Tipo de relaci&oacute;n
                      input(v-model='referencia.tipo_relacion' type='text' placeholder='Familiares, compañeros de trabajo, vecinos')
                    .input_wrapper
                      label Nombre
                      input(v-model='referencia.nombre' type='text')
                    .input_wrapper
                      label Telefono
                      input(v-model='referencia.telefono' type='text' v-mask='"#########"')
            button.add_section(type='button' @click='clickAddReferencia')
              span  AGREGAR REFERENCIA 
              i.material-icons-outlined add
          .form_buttons
            a.button_inline_primary.medium.prev(@click='prev(5)')
              i.material-icons-outlined navigate_before
              span ATRAS
            a.button_primary.medium.next(@click='( validateStep2) ? next(5) : tabError()')
              span SIGUIENTE
              i.material-icons-outlined navigate_next
        .form_step(v-show='tab == 6')
          .form_step_wrapper
            h3.title Colateral
            .form_content
              .group_form
                .input_wrapper
                  label Colateral
                  select(v-model='evaluacion.colateral')
                    option(value='AVAL CON CASA PROPIA') Aval con casa propia
                    option(value='AVAL CON CASA ALQUILADA') Aval con casa alquilada
                    option(value='GARANTIA LIQUIDA') Garantia liquida 
                    option(value='GARANTIA VEHICULAR') Garantia vehicular
                    option(value='GARANTIA INMOBILIARIA') Garantia inmobiliara
                    option(value='SIN COLATERAL') Sin colateral
              .group_form.all
                .input_wrapper
                  label Comentarios
                  textarea(v-model='evaluacion.comentario_colateral')  
          avales( v-on:update='updateAvales' v-if='evaluacion.colateral=="AVAL CON CASA PROPIA" || evaluacion.colateral=="AVAL CON CASA ALQUILADA"')
          garantias( v-on:update='updateGarantias' :tipo='evaluacion.colateral' v-if='evaluacion.colateral=="GARANTIA LIQUIDA" || evaluacion.colateral=="GARANTIA VEHICULAR" || evaluacion.colateral=="GARANTIA INMOBILIARIA" ')
          .form_buttons
            a.button_inline_primary.medium.prev(@click='prev(6)')
              i.material-icons-outlined navigate_before
              span ATRAS
            a.button_primary.medium.next(@click='( validateStep2) ? next(6) : tabError()')
              span SIGUIENTE
              i.material-icons-outlined navigate_next
        .form_step(v-show='tab == 7')    
          .form_step_wrapper     
            propuesta-analista( v-on:update='updatePropuestaAnalista')
          .form_buttons
            a.button_inline_primary.medium.prev(@click='prev(7)')
              i.material-icons-outlined navigate_before
              span ATRAS
            a.button_primary.medium.next(@click.prevent='( validateStep2) ? registrar() : tabError()' :class='{loading: loading}')
              .load_spinner
              span FINALIZAR
              i.material-icons-outlined check 

</template>
<script>
import vSelect from "vue-select";
import { serviceNumber } from "../mixins/functions";
import { toastOptions } from '../constants.js'
import Avales from './prestamos/registrarElementos/Avales';
import Garantias from './prestamos/registrarElementos/Garantias';
import PropuestaAnalista from './prestamos/registrarElementos/PropuestaAnalista';
export default {
  mixins: [serviceNumber], 
  components: {
    vSelect,
    Avales,
    Garantias,
    PropuestaAnalista
  },
  data() {
    return {
      giros: [],
      entidades: [],
      tab: 2, 
      colegios: [],
      prestamo:{
        cliente:{
          tipo_cliente:1
        }
      },
      loading:false,
      evaluacion: { 
        propuestaAnalista:{},
        avales:[],
        garantias:[],
        prestamo_id: this.$route.params.prestamo,     
        fuente_ingresos:"",
        destino_credito:"",
        destino_credito_descripcion:"",   
        negocio: {
          ubicacion: "",
          antiguedad: "1 AÑO",
          local: "PROPIO",
          licencia_funcionamiento: "SI CUENTA",
          horario_atencion_inicio: "00:00",
          horario_atencion_salida: "00:00",
          mejoras_local: "1"
        },
        vehiculo: {
          marca: "",
          modelo: "",
          año: "2010",
          tipo_servicio_brinda: "",
          antiguedad_servicio: "",
          permiso_servicio: "SI CUENTA",
          horario_servicio_inicio: "00:00",
          horario_servicio_fin: "00:00"
        },
        familiar: {
          numero_hijos: 0,
          tipo_vivienda: "PROPIA CANCELADA",
          situacion_familiar: "SOLTERO",
          miembros_familia: 0,
          hijos: []
        },
        comentario_central_riesgo:'',
        central_riesgo: [
          {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          }
        ],
        referencias: [
          {
            tipo_relacion: "",
            nombre: "",
            telefono: ""
          },
          {
            tipo_relacion: "",
            nombre: "",
            telefono: ""
          }
        ],
        colateral: "SIN COLATERAL",
        comentario_colateral: ""
      }
    };
  },
  computed: {
    
    validateUbicacion() {
      return this.evaluacion.negocio.ubicacion.length > 3
    },

    validateMarca() {
      return this.evaluacion.vehiculo.marca.length > 3
    },

    validateModelo() {
      return this.evaluacion.vehiculo.modelo.length > 3
    },

    validateServicio() {
      return this.evaluacion.vehiculo.tipo_servicio_brinda.length > 3
    },

    validateAntiguedad() {
      return this.evaluacion.vehiculo.antiguedad_servicio.length > 3
    },

    validateStep2(){
      if(this.evaluacion.fuente_ingreso!='TRANSPORTES' &&  this.evaluacion.fuente_ingreso!='TRANSPORTE BAJAJ'){
         return this.validateUbicacion
      }else{
          return  this.validateMarca &&
                  this.validateModelo &&
                  this.validateServicio &&
                  this.validateAntiguedad
      }
     
    },



    
  },
  methods: {
    updateGarantias(val){
      this.evaluacion.garantias=val.garantias
    },
    updateAvales(val){
      this.evaluacion.avales=val.avales
    },
    updatePropuestaAnalista(val){
      this.evaluacion.propuestaAnalista=val 
    },
        tabError(){
       this.$toast.error(
          "Rellene los datos necesarios",
          "Error",
          toastOptions.error
        )
    },
    cambiarEstudio(index){
        this.evaluacion.familiar.hijos[index].costo = 0;
    },
    next(index) {
      window.scrollTo(0,0)
      this.tab = index + 1
    },
    prev(index) {
      window.scrollTo(0,0)
      this.tab = index - 1
    }, 

    clickAddFinanciera() { 
      this.evaluacion.central_riesgo.push({
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
      });
    },
    clickRemoveFinanciera(index) {
      this.evaluacion.central_riesgo.splice(index, 1);
    },
    clickAddReferencia() { 
      this.evaluacion.referencias.push({
            tipo_relacion: "",
            nombre: "",
            telefono: ""
      });
    },
    clickRemoveReferencia(index) {
      this.evaluacion.referencias.splice(index, 1);
    },
    registrar() {
      this.loading=true
      console.log(this.evaluacion)
      axios.post("/analisis/cualitativa", this.evaluacion)
      .then(response => {
          this.loading = false
          this.$toast.success(
            "La Evaluacion fue realizada",
              "Exitoso",
              toastOptions.success
            )
          this.$router.push({ name: 'perfil', params: { id: this.prestamo.cliente.id}})       
      }).catch(err=>{
          this.loading = false
          this.$toast.error(
            "Error Evaluación",
            "Error",
            toastOptions.error
          )
      });
    }, 
    seleccionColegiosCosto(index) {
      this.$http 
        .get(
          `/extras/colegio/costo?grado=` +
            this.evaluacion.familiar.hijos[index].grado +
            `&colegio=` + 
            this.evaluacion.familiar.hijos[index].colegio
        )
        .then(response => {
          console.log("si viene")
          console.log(response)
          this.evaluacion.familiar.hijos[index].costo = response.data.costo;
        });
      // console.log(this.evaluacion.familiar.hijos[index].grado)
    },
    obtenerEdad(Edad) {
    var today = new Date();
    var birthDate = new Date(Edad);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age = age - 1;
    }

    return age;
}

  },
  async mounted() {
    this.$http.get(`/prestamos/`+this.$route.params.prestamoID).then(response => {
      this.prestamo=response.data
      console.log(this.prestamo)
      this.evaluacion.destino_credito_descripcion=response.data.cualitativa_analisis.destino_credito_descripcion || ''
      this.evaluacion.destino_credito=response.data.cualitativa_analisis.destino_credito || ''
      this.evaluacion.fuente_ingresos=response.data.cualitativa_analisis.fuente_ingresos || ''
      this.evaluacion.prestamo_id=this.prestamo.id
      if(response.data.cliente.persona && response.data.cliente.persona.hijos.length>0){
          this.evaluacion.familiar.numero_hijos = response.data.cliente.persona.hijos.length
          this.evaluacion.familiar.miembros_familia = this.evaluacion.familiar.numero_hijos;
          response.data.cliente.persona.hijos.map((hijo,index)=>{
            this.evaluacion.familiar.hijos.push({
              edad: this.obtenerEdad(hijo.fecha_nacimiento),
              colegio: "PRINCIPITO",
              grado: "INICIAL",
              costo: 0,
              estudia: 1

            });
            this.seleccionColegiosCosto(index)
          })
        }
    });
    this.$http.get(`/extras/giro`).then(response => {
      this.giros = response.data;
    });
    this.$http.get(`/extras/entidades`).then(response => {
      this.entidades = response.data;
    });
    this.$http.get(`/extras/colegio`).then(response => {
      this.colegios=[]
      response.data.map(colegio=>{
        let found = this.colegios.find(element => element.nombre == colegio.nombre)
        if(found==undefined){
          this.colegios.push({
            nombre: colegio.nombre,
            nivel: colegio.nivel,
            costo: colegio.costo
          })
        }
      })
    }); 
  }
};
</script>  