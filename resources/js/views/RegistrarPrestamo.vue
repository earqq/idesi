<template lang='pug'>
  .create_client_content
  section.tabs_section
    .tabs_wrapper
      .tab(@click='tab = 1' :class='[{selected: tab == 1}]')
        span 1
        p SOLICITUD
      .tab(@click='validateStep1 ? tab = 2 : tabError()' :class='{selected: tab == 2}')
        span 2
        p CLIENTE
      .tab(@click=' (validateStep1 && validateStep2) ? tab = 3: tabError()' :class='{selected: tab == 3}')
        span 3
        p AVAL
      .tab(@click='(validateStep1 && validateStep2) ? tab = 4 : tabError()' :class='{selected: tab == 4}')
        span 4
        p GARANTIA
      .tab(@click='(validateStep1 && validateStep2) ? tab = 5: tabError()' :class='{selected: tab ==5}')
        span 5
        p PROPUESTA
  section.client_forms
    .client_forms_wrapper
      .form_step(v-show='tab == 1')
        .form_step_wrapper
          h3.title Solicitud de Cr&eacute;dito
          .form_content
            .group_form
              .input_wrapper(:class='{require: !validateMonto}')
                label Monto
                input(type='text' v-mask='"######"' v-model='prestamo.monto_inicial')
                .message Monto de solicitud invalido
              .input_wrapper
                label Forma
                select(v-model='prestamo.forma_inicial')
                  option(value='DIARIO') DIARIO
                  option(value='SEMANAL') SEMANAL
                  option(value='QUINCENAL') QUINCENAL
                  option(value='MENSUAL') MENSUAL
              .input_wrapper
                label Cuotas
                input(type='number' v-model='prestamo.cuotas_inicial' maxlength='11')
              .input_wrapper(:class='{require: !validateDiponibilidad}')
                label Disponibilidad de pago
                input(type='text' v-model='prestamo.disponibilidad_pago_inicial' v-mask='"######"')
                .message La disponibilidad es invalida
              .input_wrapper(:class='{require: !validateFuenteIngreso}')
                label Fuente de ingreso  
                v-select(label='giro_negocio' :options='giros' :reduce='giros => giros.giro_negocio' v-model='cualitativa.principal.fuente_ingreso')
                  span(slot='no-options')
                    | No se encontro giro de negocio
                .message Se requiere esta informaci&oacute;n
              .input_wrapper
                label Destino del credito
                select(v-model='cualitativa.principal.destino_credito')
                  option(value='Capital de trabajo') Capital de trabajo
                  option(value='Activo Fijo') Activo Fijo
                  option(value='Consumo') Consumo
                  option(value='Vehiculo') Vehiculo
                  option(value='Hipotecario') Hipotecario
                  option(value='Mejoramiento de vivienda') Mejoramiento de vivienda
                  option(value='Compra de deuda') Compra de deuda
              .input_wrapper(:class='{require: !validateDestinoCredito}')
                label Descripcion destino
                p {{cualitativa.principal.destino_credito_descripcio}}
                textarea(v-model='cualitativa.principal.destino_credito_descripcion')
                .message Se requiere esta informaci&oacute;n
            .group_form.all
              .input_wrapper(:class='{require: !validateDestino}')
                label Destino de cr&eacute;dito (propuesta cliente)
                textarea(v-model='prestamo.destino_inicial')
                  .message Informaci&oacute;n de destino es corta
        .form_buttons.all
          a.button_primary.medium.next(@click=' validateStep1 ? next(1) : tabError()')
            span SIGUIENTE
            i.material-icons-outlined navigate_next
      .form_step(v-if='prestamo.cliente.tipo_cliente==1' v-show='tab == 2')
        .form_step_wrapper
          h3.title Datos del Titular
          .form_content
            .group_form
              .input_wrapper(:class='{require: !validateNombre}')
                label Nombres
                input(type='text' v-model='prestamo.cliente.persona.nombres')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateApellidos}')
                label Apellidos
                input(type='text' v-model='prestamo.cliente.persona.apellidos')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateDocumento}')
                label Documento
                input(type='text' v-model='prestamo.cliente.documento')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateNacimiento}')
                label Fecha de nacimiento
                input(type='date' v-model='prestamo.cliente.persona.fecha_nacimiento')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateCivil}')
                label Estado Civil
                select(v-model='prestamo.cliente.persona.estado_civil')
                  option(value='SOLTERO') SOLTERO
                  option(value='CASADO') CASADO
                  option(value='CONVIVIENTE') CONVIVIENTE
                  option(value='DIVORCIADO - SEPARADO') DIVORCIADO - SEPARADO
                  option(value='VIUDO') VIUDO
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateOcupacion}')
                label Ocupaci&oacute;n
                input(type='text' v-model='prestamo.cliente.persona.ocupacion' maxlength='100')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper
                label Tel&eacute;fono
                input(type='text' v-model='prestamo.cliente.telefono')
              .input_wrapper(:class='{require: !validateCelular}')
                label Celular
                input(type='text' v-mask="'### ### ###'" v-model='prestamo.cliente.celular')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateDireccion}')
                label Direcci&oacute;n Declarada
                input(type='text' v-model='prestamo.cliente.ubicacion_direccion_declarada')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper
                label Direcci&oacute;n Reniec
                input(type='text' v-model='prestamo.cliente.ubicacion_direccion_sistema' disabled='')
            span.separator
            .group_form
              .input_wrapper(:class='{require: !validateDepartamento}')
                label Departamento
                select(v-model='prestamo.cliente.ubicacion_departamento' @change='filterProvincesTitularMe' dusk='departamentos_id')
                  option(value='0') SELECCIONE
                  option(v-for='option in all_departments' :key='option.id' :value='option.id' :label='option.descripcion') &gt;
              .input_wrapper(:class='{require: !validateProvincia}')
                label Provincia
                select(v-model='prestamo.cliente.ubicacion_provincia' filterable='' @change='filterDistrictTitularMe' dusk='provincias_id')
                  option(value='0') SELECCIONE
                  option(v-for='option in provincesTitular' :key='option.id' :value='option.id' :label='option.descripcion') &gt;
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateDistrito}')
                label Distrito
                select(v-model='prestamo.cliente.ubicacion_distrito' filterable='' dusk='distritos_id')
                  option(value='0') SELECCIONE
                  option(v-for='option in districtsTitular' :key='option.id' :value='option.id' :label='option.descripcion') &gt;
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateReferencia}')
                label Referencia
                input(type='text' v-model='prestamo.cliente.ubicacion_referencia')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateDomicilio}')
                label Tipo Domicilio
                select(v-model='prestamo.cliente.persona.tipo_domicilio')
                  option(value='PROPIA') PROPIA
                  option(value='PROPIA HIPOTECA') PROPIA HIPOTECA
                  option(value='DE LOS PADRES') DE LOS PADRES
                  option(value='DE LOS FAMILIARES') DE LOS FAMILIARES
                  option(value='ALQUILADA') ALQUILADA
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateCentro}')
                label Centro Laboral
                input(type='text' v-model='prestamo.cliente.persona.trabajo.empresa_razon_social')
                .message Se requiere esta informaci&oacute;n
              .input_wrapper(:class='{require: !validateDireccionLaboral}')
                label Direcci&oacute;n centro laboral 
                input(type='text' v-model='prestamo.cliente.persona.trabajo.empresa_direccion')
                .message Se requiere esta informaci&oacute;n
        button.add_section.in_bottom(type='button' @click='clickAddconyuge' v-if='tools.tiene_conyuge==false')
          span AGREGAR C&Oacute;NYUGE O CONVIVIENTE
          i.material-icons-outlined add
        .form_list(v-if='tools.tiene_conyuge==true')
          .form_step_wrapper.in_bottom
            h3.title
              | C&Oacute;NYUGE o Conviviente 
              button.delete_section(type='button' @click='clickRemoveconyuge()')
                i.material-icons-outlined  delete 
            .form_content
              .group_form
                .input_wrapper(:class='{require: !validateDocumentoConyuge}')
                  label Documento de Identidad
                  input(type='text' v-model='prestamo.cliente.persona.conyuge.documento' @keyup='datosCliente()' maxlength='15')
                  .message n&uacute;mero de documento inv&aacute;lido
                .input_wrapper(:class='{require: !validateNombreConyuge}')
                  label Nombres y Apellidos
                  input(type='text' v-model='prestamo.cliente.persona.conyuge.nombres')
                .input_wrapper(:class='{require: !validateNacimientoConyuge}')
                  label Fecha de Nacimiento
                  input(type='date' v-model='prestamo.cliente.persona.conyuge.fecha_nacimiento')
                .input_wrapper
                  label Estado Civil
                  select(v-model='prestamo.cliente.persona.conyuge.estado_civil')
                    option(value='SOLTERO') SOLTERO
                    option(value='CASADO') CASADO
                    option(value='CONVIVIENTE') CONVIVIENTE
                    option(value='DIVORCIADO - SEPARADO') DIVORCIADO - SEPARADO
                    option(value='VIUDO') VIUDO
                .input_wrapper(:class='{require: !validateOcupacionConyuge}')
                  label Ocupaci&oacute;n
                  input(type='text' v-model='prestamo.cliente.persona.conyuge.ocupacion')
                .input_wrapper
                  label Socio 
                  select(v-model='prestamo.cliente.persona.conyuge.socio')
                    option(value='true') SI
                    option(value='false') NO
                .input_wrapper(:class='{require: !validateCodigoConyuge}' v-if='prestamo.cliente.persona.conyuge.socio')
                  label C&oacute;digo
                  input(type='text' v-model='prestamo.cliente.persona.conyuge.codigo_socio' maxlength='10')
                .input_wrapper(:class='{require: !validateAporteConyuge}' v-if='prestamo.cliente.persona.conyuge.socio')
                  label Aporte 
                  input(type='text' v-mask='"######"' v-model='prestamo.cliente.persona.conyuge.aporte_socio')
                .input_wrapper
                  label Tel&eacute;fono
                  input(type='text' v-model='prestamo.cliente.persona.conyuge.telefono' maxlength='11')
                .input_wrapper
                  label Celular
                  input(type='text' v-mask="'### ### ###'" v-model='prestamo.cliente.persona.conyuge.celular')
                .input_wrapper
                  label &iquest;Trabaja?
                  select(v-model='prestamo.cliente.persona.conyuge.trabaja')
                    option(value='true') SI
                    option(value='false') NO
                .input_wrapper(:class='{require: !validateCentroConyuge}' v-if='prestamo.cliente.persona.conyuge.trabaja')
                  label Centro Laboral
                  input(type='text' v-model='prestamo.cliente.persona.conyuge.centro_laboral')
                .input_wrapper(:class='{require: !validateDireccionConyuge}' v-if='prestamo.cliente.persona.conyuge.trabaja')
                  label Direcci&oacute;n centro laboral
                  input(type='text' v-model='prestamo.cliente.persona.conyuge.direccion_centro_laboral')
        .form_buttons
          a.button_inline_primary.medium.prev(@click='prev(2)')
            i.material-icons-outlined navigate_before
            span ATRAS
          a.button_primary.medium.next(@click=' (validateStep2 && validateStep1) ? next(2) : tabError()')
            span SIGUIENTE
            i.material-icons-outlined navigate_next
      .form_step(v-show='tab == 3')
        .form_step_wrapper
          .form_list.no_border
            .sub_step_wrapper(v-for='(row, index) in prestamo.avales' :key='index')
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
          button.add_section(type='button' @click='clickAddAval' v-if='prestamo.avales.length<=1')
            span AGREGAR AVAL
            i.material-icons-outlined add
        .form_buttons
          a.button_inline_primary.medium.prev(@click='prev(3)')
            i.material-icons-outlined navigate_before
            span ATRAS
          a.button_primary.medium.next(@click=' (validateStep2 && validateStep1 && validateStep3) ? next(3) : tabError()')
            span SIGUIENTE
            i.material-icons-outlined navigate_next
      .form_step(v-show='tab == 4')
        .form_step_wrapper
          .form_list.no_border
            .sub_step_wrapper(v-for='(row, index) in prestamo.garantias' :key='index')
              h3.title
                | Garantia {{index + 1}}
                button.delete_section(type='button' @click.prevent='clickRemoveGarantia(index)')
                  i.material-icons-outlined delete
              .form_content
                .group_form
                  .input_wrapper
                    label Bien en Garant&iacute;a
                    input(type='text' maxlength='50' v-model='row.bien_garantia')
                .group_form
                  .input_box.no_label
                    .input_box_wrapper
                      .input_checkbox_wrapper.radio
                        input(type='radio' :id="'radio'+index" :name="'garantiaType'+index" v-model='row.inscripcion' value='1')
                        label.box_content(:for="'radio'+index")
                          .box
                          span Inscripci&oacute;n
                      .input_checkbox_wrapper.radio
                        input(type='radio' :id="'radio2'+index" :name="'garantiaType'+index" v-model='row.declaracion_jurada' value='1')
                        label.box_content(:for="'radio2'+index")
                          .box
                          span Declaraci&oacute;n Jurada
          button.add_section(type='button' @click='clickAddGarantia' v-if='prestamo.garantias.length<=1')
            span AGREGAR GARANTIA
            i.material-icons-outlined add
        .form_buttons
          a.button_inline_primary.medium.prev(@click='prev(4)')
            i.material-icons-outlined navigate_before
            span ATRAS
          a.button_primary.medium.next(@click=' (validateStep2 && validateStep1) ? next(4) : tabError()')
            span SIGUIENTE
            i.material-icons-outlined navigate_next
      .form_step(v-show='tab == 5')
        .form_step_wrapper
          h3.title Propuesta de Analista
          .form_content
            .group_form
              .input_wrapper
                label Producto
                select(v-model='prestamo.producto' @change='meses_numero')
                  option(value='CREDIDIARIO') CREDIDIARIO
                  option(value='CREDISEMANA') CREDISEMANA
                  option(value='PYME') PYME
                  option(value='PYME ESPECIAL') PYME ESPECIAL
                  option(value='CONSUMO') CONSUMO
                  option(value='CONSUMO ESPECIAL') CONSUMO ESPECIAL
              .input_wrapper
                label Importe
                input(type='text' v-model='prestamo.importe' v-mask='"#####"')
              .input_wrapper
                label Cuotas
                input(type='text' v-model='prestamo.cuotas' v-mask='"#####"' @keyup='meses_numero')
              .input_wrapper
                label Meses
                input(type='text' v-model='prestamo.meses' disabled='')
              .input_wrapper
                label Cuota del sistema
                input(type='number' v-model='prestamo.cuota_sistema')
              .input_wrapper
                label Aporte a la fecha
                input(type='text' v-mask='"#####"' v-model='prestamo.aporte')
              .input_wrapper
                label Prob. Infocorp
                input(type='number' v-model='prestamo.probabilidad_infocorp')
            .group_form.all
              .input_wrapper
                label Comentarios
                textarea(type='text' v-model='prestamo.comentarios')
        .form_buttons
          a.button_inline_primary.medium.prev(@click='prev(5)')
            i.material-icons-outlined navigate_before
            span ATRAS
          a.button_primary.medium.next(@click.prevent=' (validateStep2 && validateStep1) ? registrar() : tabError()' :class='{loading: loading}')
            .load_spinner
            span FINALIZAR
            i.material-icons-outlined check

</template>

<script>
import { serviceNumber } from "../mixins/functions";
import { toastOptions } from '../constants.js'

export default {
  mixins: [serviceNumber],
  data() {
    return {
      resource: "clientes",
      tab: 1,
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provincesTitular: [],
      districtsTitular: [],
      errors: {},
      tools:{
        tiene_conyuge:false,      
      },
      cualitativa: {
        prestamo_id: this.$route.params.prestamo,
        principal: {
          destino_credito_descripcion: "",
          destino_credito: "Capital de trabajo",
          fuente_ingreso: ""
        },
        negocio: {
          ubicacion: "",
          antiguedad: "1 AÑO",
          local: "PROPIO",
          licencia_funcionamiento: "SI CUENTA",
          horario_atencion_inicio: "00:00",
          horario_atencion_salida: "00:00",
          mejoras_local: "SI REALIZO"
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
      },
      prestamo: {
        id: this.$route.params.prestamoID, 
        garantias: [],
        avales: [],
        cliente: {
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
        monto_inicial: "",
        cuotas_inicial: "5",
        disponibilidad_pago_inicial: "",
        destino_inicial: "",
        forma_inicial: "DIARIO",
        producto: "CREDIDIARIO",
        forma: "DIARIO",
        meses: 0,
        importe: 0,
        aporte: 0,
        cuotas: 0,
        cuota_sistema:0,
        tasa: 0.0,
        comentarios: "",
        estado: 1
      },
      contador_aval: 0,
      loading: false,
      contador_garantia: 0, 
      notificationSystem: {
        options: {
          success: {
            position: "topRight"
          },
          error: {
            position: "topRight"
          }
        }
      }
    };
  },
  computed: {   
    validateMonto() {
      return String(this.prestamo.monto_inicial).length > 1
    },
    validateDiponibilidad() {
      return String(this.prestamo.disponibilidad_pago_inicial).length > 1
    },
    validateDestino() {
      return this.prestamo.destino_inicial.length > 6
    },
    validateStep1() {
      return this.validateMonto && this.validateDiponibilidad && this.validateDestino;
    },
    validateNombre(){
      return this.prestamo.cliente.persona.nombres.length>2;
    }
    ,
    validateApellidos(){
      return this.prestamo.cliente.persona.apellidos.length>5;
    }
    ,
    validateDocumento(){
      return this.prestamo.cliente.documento.length>=8
    }
    ,
    validateNacimiento(){
      return this.prestamo.cliente.persona.fecha_nacimiento.length>4
    }
    ,
    validateCivil(){
      return this.prestamo.cliente.persona.estado_civil.length>3
    }
    ,
    validateOcupacion(){
      return this.prestamo.cliente.persona.ocupacion.length>4
    }
    ,
    validateCelular(){
      return  this.prestamo.cliente.celular.length>9
    }
    ,
    validateDireccion(){
      return  this.prestamo.cliente.ubicacion_direccion_declarada.length>5
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
      return this.prestamo.cliente.ubicacion_referencia.length>5
    }
    ,
    validateDomicilio(){
      return this.prestamo.cliente.persona.tipo_domicilio.length>5
    }
    ,
    validateCentro(){
      
      if(this.prestamo.cliente.persona.trabajo)
      {
        return this.prestamo.cliente.persona.trabajo.empresa_razon_social.length>5
      }
      else{
        return true
      }
    }
    ,
    validateDireccionLaboral(){
      if(this.prestamo.cliente.persona.trabajo)
      return this.prestamo.cliente.persona.trabajo.empresa_direccion.length>6
      else return true
    },


     validateDocumentoConyuge(){
       if(this.prestamo.cliente.persona.conyuge){
          return String(this.prestamo.cliente.persona.conyuge.documento).length > 6
       }else{
         return true
       }
    },

     validateNombreConyuge(){
       if(this.prestamo.cliente.persona.conyuge){
         return this.prestamo.cliente.persona.conyuge.nombres.length>6
       }else{
         return true
       }   
    },

     validateNacimientoConyuge(){
      return this.prestamo.cliente.persona.conyuge.fecha_nacimiento.length>6
    },

     validateOcupacionConyuge(){
      if(this.prestamo.cliente.persona.conyuge && this.prestamo.cliente.persona.conyuge.ocupacion)
        return this.prestamo.cliente.persona.conyuge.ocupacion.length>6
      else true
    },


    validateCodigoConyuge(){
      if(this.prestamo.cliente.persona.conyuge.socio=='1'){
        return this.prestamo.cliente.persona.conyuge.codigo_socio.length>=3
      }
      else{
        return true
      }
    },
    validateAporteConyuge(){
      if(this.prestamo.cliente.persona.conyuge.socio=='1'){
        return String(this.prestamo.cliente.persona.conyuge.aporte_socio)>=1
      }
      else{
        return true
      }
    },
    validateCodigosSociosAval(){
      let response=true
      this.prestamo.avales.map(item=>{
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
      this.prestamo.avales.map(item=>{
        item.validate_fecha_nacimiento=false
        if(item.fecha_nacimiento && item.fecha_nacimiento.length>2)
          item.validate_fecha_nacimiento=true
        else response=false
      })     
      return response
    },
    validateDocumentosSocios(){
      let response=true
      this.prestamo.avales.map(item=>{
        item.validate_documento=false
        if(item.documento && item.documento.length>2)
          item.validate_documento=true
        else response=false
      })     
      return response
    },
    validateNombresSocios(){
      let response=true
      this.prestamo.avales.map(item=>{
        item.validate_nombres=false
        if(item.nombres && item.nombres.length>2)
          item.validate_nombres=true
        else response=false
      })     
      return response
    },
    validateApellidosSocios(){
      let response=true
      this.prestamo.avales.map(item=>{
        item.validate_apellidos=false
        if(item.apellidos && item.apellidos.length>2)
          item.validate_apellidos=true
        else response=false
      })     
      return response
    },
    validateCentroConyuge(){
      if(this.prestamo.cliente.persona.conyuge.trabaja=='1'){
        return this.prestamo.cliente.persona.conyuge.centro_laboral.length>5
      }
      else{
        return true
      }
      
    },

    validateDireccionConyuge(){
       if(this.prestamo.cliente.persona.conyuge.trabaja=='1'){
        return this.prestamo.cliente.persona.conyuge.direccion_centro_laboral.length>5
      }
      else{
        return true
      }
      
    },

    validateStep3(){
      return this.validateCodigosSociosAval &&
            this.validateFechasNacimientoSocios &&
            this.validateDocumentosSocios &&
            this.validateNombresSocios &&
            this.validateApellidosSocios
    },
    validateStep2(){
    
      if(this.tools.tiene_conyuge){

          return this.validateNombre && this.validateApellidos && 
             this.validateDocumento && this.validateNacimiento &&
             this.validateCivil && this.validateOcupacion && 
             this.validateCelular && this.validateDireccion && 
             this.validateDepartamento && this.validateProvincia &&
             this.validateDistrito && this.validateReferencia && 
             this.validateDomicilio && this.validateCentro && 
             this.validateDireccionLaboral &&
              this.validateDocumentoConyuge &&
              this.validateNombreConyuge &&
              this.validateNacimientoConyuge &&
              this.validateOcupacionConyuge &&
              this.validateCodigoConyuge &&
              this.validateAporteConyuge &&
              this.validateCentroConyuge &&
              this.validateDireccionConyuge

      }
      else{
        return this.validateNombre && this.validateApellidos && 
             this.validateDocumento && this.validateNacimiento &&
             this.validateCivil && this.validateOcupacion && 
             this.validateCelular && this.validateDireccion && 
             this.validateDepartamento && this.validateProvincia &&
             this.validateDistrito && this.validateReferencia && 
             this.validateDomicilio && this.validateCentro && 
             this.validateDireccionLaboral
      }

    }


  },
  async created() { 
    await this.obtenerDatosCliente()
      if(this.$route.params.prestamoID!='0')
          this.obtenerDatosPrestamo()
    // this.clickAddAval()
    // this.clickAddGarantia()

  
  },

  methods: {    
    obtenerDatosCliente(){ 
      this.$http
      .get(`/clientes/` + this.$route.params.clienteID)
      .then(response => {  
        this.prestamo.cliente=response.data
        console.log("asdadsad")
        console.log(this.prestamo.cliente.celular)

        if(!this.prestamo.cliente.persona.trabajo){
          this.prestamo.cliente.persona.trabajo={
              empresa_ruc:"",
              empresa_direccion: "",
              empresa_razon_social: "",
            }
        }

        if(this.prestamo.cliente.persona.conyuge){
          this.tools.tiene_conyuge=true
          this.prestamo.cliente.persona.conyuge={
              documento: this.prestamo.cliente.persona.conyuge.documento || "",
              nombres: this.prestamo.cliente.persona.conyuge.nombres || "",
              fecha_nacimiento: this.prestamo.cliente.persona.conyuge.fecha_nacimiento || "",
              estado_civil: this.prestamo.cliente.persona.conyuge.estado_civil || "",
              ocupacion: this.prestamo.cliente.persona.conyuge.ocupacion || "",
              telefono: this.prestamo.cliente.persona.conyuge.telefono || "",
              celular: this.prestamo.cliente.persona.conyuge.celular || "",
              trabaja: this.prestamo.cliente.persona.conyuge.trabaja,
              centro_laboral: this.prestamo.cliente.persona.conyuge.centro_laboral || "",
              direccion_centro_laboral: this.prestamo.cliente.persona.conyuge.direccion_centro_laboral || "",
              socio: this.prestamo.cliente.persona.conyuge.socio,
              codigo_socio: this.prestamo.cliente.persona.conyuge.codigo_socio || "",
              aporte_socio: this.prestamo.cliente.persona.conyuge.aporte_socio || "",
          }
        }else{
          this.tools.tiene_conyuge=false
        }    

      });
    },
    obtenerDatosPrestamo(){
      this.$http
      .get(`clientes/datos/prestamo/` + this.$route.params.prestamoID)
      .then(response => {  
              this.prestamo.monto_inicial= response.data.monto_inicial || ""
              this.prestamo.cuotas_inicial= response.data.cuotas_inicial  || "5"
              this.prestamo.disponibilidad_pago_inicial= response.data.disponibilidad_pago_inicial  || ""
              this.prestamo.destino_inicial= response.data.destino_inicial  || "" 
              this.prestamo.forma_inicial= response.data.forma_inicial  || "DIARIO"
              this.prestamo.producto =  response.data.producto  || ""
              this.prestamo.forma= response.data.forma   || ""
              this.prestamo.importe= response.data.importe  || ""
              this.prestamo.meses= response.data.meses  || ""
              this.prestamo.aporte= response.data.aporte  || ""
              this.prestamo.cuota_sistema= response.data.cuota_sistema  || ""
              this.prestamo.cuotas= response.data.cuotas  || ""
              this.prestamo.tasa= response.data.tasa   || ""
              this.prestamo.comentarios= response.data.comentarios  || "" 
              this.prestamo.producto_final= response.data.producto_final  || ""
              this.prestamo.forma_final= response.data.forma_final || "" 
              this.prestamo.aporte_final= response.data.aporte_final  || ""
              this.prestamo.importe_final= response.data.importe_final || ""  
              this.prestamo.plazo_final= response.data.plazo_final  || "" 
              this.prestamo.cuota_final= response.data.cuota_final  || "" 
              this.prestamo.tasa_final= response.data.tasa_final || ""            
              if(response.data.avales){
                response.data.avales.map(item=>{
                  item.validate_codigo_socio=true
                  item.validate_aporte_socio=true
                  item.validate_fecha_nacimiento=true
                  item.validate_documento=true
                  item.validate_nombres=true
                  item.validate_apellidos=true
                  if(item.socio)
                    item.socio='1'
                  else 
                    item.socio='0'
                  this.prestamo.avales.push(item)                  
                })
              }

              if(response.data.garantias){
                this.prestamo.garantias = response.data.garantias
              }
              
              
      });
    },
    tabError(){
       this.$toast.error(
          "Rellene los datos necesarios",
          "Error",
          toastOptions.error
        )
    },
    filterProvincesTitularMe() {
          // this.prestamo.cliente.persona.domicilio_provincia= '0'
          // this.prestamo.cliente.persona.domicilio_distrito= '0'

          this.provincesTitular = this.all_provinces.filter(f => {
              return f.departamento_id == this.prestamo.cliente.ubicacion_departamento
          })

          for (let index = 0; index < this.provincesTitular.length; index++) {
            if(this.prestamo.cliente.ubicacion_provincia==this.provincesTitular[index].id){
              this.prestamo.cliente.ubicacion_provincia=this.provincesTitular[index].id
            }
          }
          // this.prestamo.cliente.ubicacion_provincia=this.provincesTitular[0].id
          this.filterDistrictTitularMe()
      },
    filterDistrictTitularMe() {
        // this.prestamo.cliente.domicilio_distrito= '0'
        this.districtsTitular = this.all_districts.filter(f => {
            return f.provincia_id == this.prestamo.cliente.ubicacion_provincia
        })        

         for (let index = 0; index < this.districtsTitular.length; index++) {
            if(this.prestamo.cliente.ubicacion_distrito==this.districtsTitular[index].id){
              this.prestamo.cliente.ubicacion_distrito=this.districtsTitular[index].id
            }
          }
        // this.prestamo.cliente.ubicacion_distrito=this.districtsTitular[0].id

    },
    next(index) {
      window.scrollTo(0,0)
      this.tab = index + 1
    },
    prev(index) {
      window.scrollTo(0,0)
      this.tab = index - 1
    },
    clickAddconyuge() {
      this.prestamo.cliente.persona.conyuge={
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
      }
      this.tools.tiene_conyuge=true
    },
    clickRemoveconyuge() {      
      this.tools.tiene_conyuge=false
      this.prestamo.cliente.persona.documento=''  
    },
    clickAddAval() { 
      this.prestamo.avales.push({
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
      this.prestamo.avales.splice(index, 1);
    },
    clickAddGarantia() {
      this.prestamo.garantias.push({
        inscripcion: "",
        declaracion_jurada:"",
        bien_garantia: "",
        tipo: ""
      });
    },
    clickRemoveGarantia(index) {
      this.prestamo.garantias.splice(index, 1);
    },
  
    datosCliente() {
      let me = this;
      // me.loader = "true";
      if(this.prestamo.cliente.persona.conyuge.documento.length>7){
        axios
        .post("/consulta/doc", {
          documento: this.prestamo.cliente.persona.conyuge.documento
        })
        .then(function(response) { 
          if(response.data)
          me.prestamo.cliente.persona.conyuge.nombres =
            response.data["nombres"] + " " + response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
      }
    },
    meses_numero() {
      console.log("si viene");
      if (this.prestamo.producto == "CREDIDIARIO") { 
        this.prestamo.meses = (Number(this.prestamo.cuotas) / 30).toFixed(2);
      } else if (this.prestamo.producto == "CREDISEMANA") {
        this.prestamo.meses = (Number(this.prestamo.cuotas) / 4).toFixed(2);
      } else {
        this.prestamo.meses = (Number(this.prestamo.cuotas) / 1).toFixed(2);
      }
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
                  
                 me.prestamo.avales[index].empresa_razon_social=response.data.RAZON
                 me.prestamo.avales[index].empresa_direccion=response.data.DIRECCION
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
          documento: this.prestamo.avales[index].documento
        })
        .then(function(response) { 
          me.prestamo.avales[index].nombres = response.data["nombres"];
          me.prestamo.avales[index].apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
    },
    registrar() {
        this.loading= true
      this.$http
        .post(`/prestamos`, this.prestamo)
        .then(response => {

            this.loading = false
            if(response.data.success){
                this.$toast.success(
                    "El prestamo fue creado",
                    "Exitoso",
                    toastOptions.success
                  )
              this.$router.push({ name: 'perfil', params: { id: this.$route.params.clienteID}})
            }else{
                this.$toast.error(
                  "No se pudo crear prestamo",
                  "Error",
                  toastOptions.error
                )
            }

        })

        .catch(err=>{
          this.loading=false
          this.$toast.error(
            "Error en el registro",
            "Error",
            toastOptions.error
          )
        });
    },
    retornar() {
      this.backMixin_handleBack("/perfil/" + this.prestamo.cliente.documento);
    }
  },
  async mounted() {

    await this.$http.get(`/ubigeo`).then(response => {
        this.all_departments = response.data.departments;
        this.all_provinces = response.data.provinces;
        this.all_districts = response.data.districts; 
        
    });

     this.filterProvincesTitularMe()
     this.filterDistrictTitularMe()

    if (this.prestamo.producto == "CREDIDIARIO") {
      this.prestamo.meses = (Number(this.prestamo.cuotas) / 30).toFixed(2);
    } else if (this.prestamo.producto == "CREDISEMANA") {
      this.prestamo.meses = (Number(this.prestamo.cuotas) / 4).toFixed(2);
    } else if (this.prestamo.producto == "MENSUAL") {
      this.prestamo.meses = Number(this.prestamo.cuotas) / 1;
    }
  }
};
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
