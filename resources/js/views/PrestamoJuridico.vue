<template>
  <div class="create_client_content">
    <section class="tabs_section">
      <div class="tabs_wrapper">
        <div
          class="tab"
          @click="tab = 1"
          :class="{selected: tab == 1}"
        >
          <span>1</span>
          <p>SOLICITUD</p>
        </div>
        <div class="tab" @click="tab = 2" :class="{selected: tab == 2}" v-if="validateStep1">
          <span>2</span>
          <p>EMPRESA</p>
        </div>
        <div class="tab" v-else>
          <span>2</span>
          <p>EMPRESA</p>
        </div>

        <div class="tab" @click="tab = 3" :class="{selected: tab == 3}" v-if="validateStep1 && validateStep2">
          <span>3</span>
          <p>AVAL</p>
        </div>
        <div class="tab" v-else>
          <span>3</span>
          <p>AVAL</p>
        </div>

        <div class="tab" @click="tab = 4" :class="{selected: tab == 4}" v-if="validateStep1 && validateStep2">
          <span>4</span>
          <p>GARANTIA</p>
        </div>

        <div class="tab" v-else>
          <span>4</span>
          <p>GARANTIA</p>
        </div>


        <div class="tab" @click="tab = 5" :class="{selected: tab ==5}" v-if="validateStep1 && validateStep2">
          <span>5</span>
          <p>PROPUESTA</p>
        </div>

        <div class="tab" v-else>
          <span>5</span>
          <p>PROPUESTA</p>
        </div>

      </div>
    </section>
    <section class="client_forms">
      <div class="client_forms_wrapper">
        <div v-show="tab == 1" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Solicitud de Crédito</h3>
            <div class="form_content">
              <div class="group_form">
                <div class="input_wrapper" :class="{require: !validateMonto}">
                  <label>Monto</label>
                  <vue-numeric  currency="S/. " separator="," v-model="form.monto_inicial" v-bind:precision="2"></vue-numeric>
                  <div class="message">Monto de solicitud invalido</div>
                </div>
                <div class="input_wrapper">
                  <label>Forma</label>
                  <select v-model="form.forma_inicial" >
                    <option value="DIARIO">DIARIO</option>
                    <option value="SEMANAL">SEMANAL</option>
                    <option value="QUINCENAL">QUINCENAL</option>
                    <option value="MENSUAL">MENSUAL</option>
                  </select>
                </div>
                <div class="input_wrapper">
                  <label>Plazo</label>
                  <input type="number" v-model="form.plazo_inicial"  />
                </div>
                <div class="input_wrapper" :class="{require: !validateDiponibilidad}">
                  <label>Disponibilidad de pago</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="form.disponibilidad_pago_inicial" 
                    v-bind:precision="2"
                  ></vue-numeric>  
                  <div class="message">La disponibilidad es invalida</div>
                </div>
              </div>
              <div class="group_form all">
                <div class="input_wrapper" :class="{require: !validateDestino}">
                  <label>Destino de crédito (propuesta cliente)</label>
                  <textarea v-model="form.destino_inicial"  />
                  <div class="message">Información de destino es corta</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons all">
            <a class="button_primary medium next" @click="next(1)" v-if="validateStep1">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
            <a class="button_primary medium next" v-else>
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 2" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Datos de la Empresa</h3>
            <div class="form_content">

              <div class="group_form">

                <div class="input_wrapper">
                  <label>Razón Social</label>
                  <input type="text"  v-model="form.juridico.razon_social"  disabled/>
                </div>

                <div class="input_wrapper">
                  <label>Ruc</label>
                  <input type="text"  v-model="form.cliente.documento" disabled/>
                </div>

                <div class="input_wrapper">
                  <label>Nombre comercial</label>
                  <input type="text"  v-model="form.juridico.nombre_comercial"  />
                </div>

                <div class="input_wrapper" :class="{require: !validateActividad}">
                  <label>Actividad</label>
                  <input type="text"  v-model="form.juridico.actividad_principal" />
                  <div class="message">Actividad de la empresa</div>
                </div>

                <div class="input_wrapper" :class="{require: !validatePartida}">
                  <label>Número de partida</label>
                  <input type="text" v-model="form.juridico.partida_registral"  />
                  <div class="message">N° de partida la empresa</div>
                </div>
                <div class="input_wrapper">
                  <label>Teléfono</label>
                  <input type="text" v-model="form.juridico.telefono"  />
                </div>
                <div class="input_wrapper" :class="{require: !validateDireccionEmpresa}">
                  <label>Dirección</label>
                  <input type="text" v-model="form.juridico.direccion"  />
                  <div class="message">Dirección de la emrpesa</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateFechaConstitucion}">
                  <label>Fecha de constitución</label>
                  <input type="date" v-model="form.juridico.fecha_constitucion"  />
                  <div class="message">Fecha de inicio de la empresa</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateEmail}">
                  <label>Email</label>
                  <input type="text" v-model="form.juridico.email"  />
                  <div class="message">Ingrese correo de la empresa</div>
                </div>
              </div>

              <span class="separator"></span>

              <div class="group_form">

                <div class="input_wrapper" :class="{require: !validateDocumentoRepresentante}">
                  <label>Documento de Identidad</label>
                  <input
                    type="text"
                    v-model="form.representante.documento_representante"
                    @keyup="datosCliente()"
                    v-mask="'########'"
                  />
                  <div class="message">número de documento inválido</div>
                  <div class="message">Numero de documento del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateNombres}">
                  <label>Nombres y Apellidos</label>
                  <input type="text" v-model="form.representante.nombres_representante" />
                  <div class="message">Nombre del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateNacimiento}">
                  <label>Fecha de Nacimiento</label>
                  <input type="date" v-model="form.representante.nacimiento_representante" />
                  <div class="message">Fecha de nacimiento del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateCivil}">
                  <label>Estado Civil</label>
                  <select v-model="form.representante.estado_civil_representante">
                    <option value="SOLTERO">SOLTERO</option>
                    <option value="CASADO">CASADO</option>
                    <option value="CONVIVIENTE">CONVIVIENTE</option>
                    <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                    <option value="VIUDO">VIUDO</option>
                  </select>
                  <div class="message">Estado civil del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateOcupacion}">
                  <label>Ocupación</label>
                  <input type="text" v-model="form.representante.ocupacion_representante" />
                  <div class="message">Ingrese ocupacion del representante</div>
                </div>


                <div class="input_wrapper" >
                  <label>Teléfono</label>
                  <input type="text" v-model="form.representante.telefono_representante" />
                </div>

                <div class="input_wrapper" :class="{require: !validateCelular}">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-mask="'### ### ###'"
                    v-model="form.representante.celular_representante"
                  />
                  <div class="message">Ingrese número de celular</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateDireccionRepresetante}">
                  <label>Dirección</label>
                  <input type="text" v-model="form.representante.direccion_representante" />
                  <div class="message">Ingrese su dirección</div>
                </div>
              </div>
              <div class="separator"></div>

              <div class="group_form">


                <div class="input_wrapper" :class="{require: !validateDepartamento}">
                  <label>Departamento</label>
                  <input type="text" v-model="form.representante.departamento_representante" />
                  <div class="message">Seleccione departamento</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateProvincia}">
                  <label>Provincia</label>
                  <input type="text" v-model="form.representante.provincia_representante" />
                  <div class="message">Seleccione provincia</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateDistrito}">
                  <label>Distrito</label>
                  <input type="text" v-model="form.representante.distrito_representante" />
                  <div class="message">Seleccione distrito</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateReferencia}">
                  <label>Referencia</label>
                    <input type="text" v-model="form.representante.referencia_representante" />
                    <div class="message">La referencia es invalido</div>
                </div>


                <div class="input_wrapper" :class="{require: !validateTipoDomicilio}">
                  <label>Tipo Domicilio</label>
                  <select v-model="form.representante.tipo_domicilio_representante">
                    <option value="PROPIA">PROPIA</option>
                    <option value="PROPIA HIPOTECA">PROPIA HIPOTECA</option>
                    <option value="DE LOS PADRES">DE LOS PADRES</option>
                    <option value="DE LOS FAMILIARES">DE LOS FAMILIARES</option>
                    <option value="ALQUILADA">ALQUILADA</option>
                  </select>
                  <div class="message">Tipo de vivienda invalido</div>
                </div>

                <div class="input_wrapper" :class="{require: !validatePoderes}">
                  <label>Poderes (Asiento)</label>
                    <input type="text" v-model="form.representante.poderes_representante" />
                    <div class="message">Ingrese poderes</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateFechaCargo}">
                  <label>Fecha inicio (Cargo) </label>
                  <input type="date" v-model="form.representante.fecha_inicio_representante"/>
                  <div class="message">Fecha incorrecta</div>
                </div>
              </div>
          
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(2)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(2)"  v-if="validateStep1 && validateStep2">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
            <a class="button_primary medium next"  v-else>
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 3" class="form_step">
          <div class="form_step_wrapper">
            <div class="form_list no_border" >
              <div class="sub_step_wrapper " v-for="(row, index) in form.avals" :key="index">
                <h3 class="title">
                  Aval {{index + 1}}
                  <button
                    v-if="index > 0"
                    class="delete_section"
                    type="button"
                    @click.prevent="clickRemoveAval(index)">
                    <i class="material-icons-outlined">delete</i>
                  </button>
                </h3>
                <div class="form_content">

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Tipo Persona</label>
                      <select v-model="row.tipo_persona">
                        <option value="pn">Persona Natural</option>
                        <option value="pj">Persona Juridica</option>
                      </select>
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Ruc</label>
                      <input
                        type="text"
                        v-model="row.empresa_ruc"
                        v-mask="'###########'"
                      />
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Razon Social</label>
                      <input
                        type="text"
                        v-model="row.empresa_razon_social"
                      />
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Dirección</label>
                      <input
                        type="text"
                        v-model="row.empresa_direccion" 
                      />
                    </div>

                  </div>

                  <span class="separator"></span>

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Documento de Identidad</label>
                      <input
                        type="text"
                        v-model="row.documento"
                        v-mask="'########'"
                        @change="datosAval(row)"
                      />
                    </div>
                    <div class="input_wrapper">
                      <label>Nombres</label>
                      <input type="text" v-model="row.nombres" />
                    </div>
                    <div class="input_wrapper">
                      <label>Apellidos</label>
                      <input type="text" v-model="row.apellidos" />
                    </div>
                    <div class="input_wrapper">
                      <label>Fecha de Nacimiento</label>
                      <input type="date" v-model="row.nacimiento" />
                    </div>
                    <div class="input_wrapper">
                      <label>Estado Civil</label>
                      <select v-model="row.estado_civil">
                        <option value="SOLTERO">SOLTERO</option>
                        <option value="CASADO">CASADO</option>
                        <option value="CONVIVIENTE">CONVIVIENTE</option>
                        <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                        <option value="VIUDO">VIUDO</option>
                      </select>
                    </div>
                    <div class="input_wrapper">
                      <label>Ocupación</label>
                      <input type="text" v-model="row.ocupacion" />
                    </div>
                    <div class="input_wrapper">
                      <label>Teléfono</label>
                      <input type="text" v-model="row.telefono" />
                    </div>
                    <div class="input_wrapper">
                      <label>Socio</label>
                      <select v-model="row.socio">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                    <div class="input_wrapper">
                      <label>Codigo</label>
                      <input type="text" v-model="row.codigo_socio" v-if="row.socio=='SI'" />
                      <input type="text" v-else disabled />
                    </div>
                    <div class="input_wrapper">
                      <label>Aporte</label>
                      <vue-numeric
                        currency="S/. "
                        separator=","
                        v-model="row.aporte_socio"
                        v-bind:precision="2"
                        v-if="row.socio=='SI'"
                      ></vue-numeric>
                      <input type="text" v-else disabled />
                    </div>
                    <div class="input_wrapper">
                      <label>Celular</label>
                      <input type="text" v-model="row.celular" v-mask="'### ### ###'" />
                    </div>
                    <div class="input_wrapper">
                      <label>Dirección</label>
                      <input type="text" v-model="row.direccion" />
                    </div>
                    <div class="input_wrapper">
                      <label>Distrito</label>
                      <input type="text" v-model="row.distrito" />
                    </div>
                    <div class="input_wrapper">
                      <label>Centro Laboral</label>
                      <input type="text" v-model="row.centro_laboral" />
                    </div>
                    <div class="input_wrapper">
                      <label>Dirección centro laboral</label>
                      <input type="text" v-model="row.direccion_laboral" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" @click="clickAddAval" class="add_section">
              <span>AGREGAR AVAL</span>
              <i class="material-icons-outlined">add</i> 
            </button>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(3)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(3)">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 4" class="form_step">
          <div class="form_step_wrapper">
            <div class="form_list no_border">
              <div class="sub_step_wrapper " v-for="(row, index) in form.garantias" :key="index">
                <h3 class="title">
                  Garantia {{index + 1}}
                  <button
                    v-if="index > 0"
                    class="delete_section"
                    type="button"
                    @click.prevent="clickRemoveGarantia(index)"
                  >
                    <i class="material-icons-outlined">delete</i>
                  </button>
                </h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Bien en Garantía</label>
                      <input type="text" v-model="row.bien_garantia" />
                    </div>
                  </div>
                  <div class="group_form">
                    <div class="input_box no_label">
                      <div class="input_box_wrapper">
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio'+index" :name="'garantiaType'+index" v-model="row.tipo" :value="'INS'" />
                          <label class="box_content" :for="'radio'+index">
                            <div class="box">
                            </div>
                            <span>Inscripción</span>
                          </label>
                        </div>
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio2'+index" :name="'garantiaType'+index" v-model="row.tipo" :value="'DJ'" />
                          <label class="box_content" :for="'radio2'+index">
                            <div class="box">
                            </div>
                            <span>Declaración Jurada</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" @click="clickAddGarantia" class="add_section">
              <span>AGREGAR GARANTIA</span>
              <i class="material-icons-outlined">add</i> 
            </button>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(4)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(4)">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 5" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Propuesta de Analista</h3>
            <div class="form_content">
              <div class="group_form">
                <div class="input_wrapper">
                  <label>Producto</label>
                  <select v-model="form.producto" @change="meses_numero">
                    <option value="CREDIDIARIO">CREDIDIARIO</option>
                    <option value="CREDISEMANA">CREDISEMANA</option>
                    <option value="PYME">PYME</option>
                    <option value="PYME ESPECIAL">PYME ESPECIAL</option>
                    <option value="CONSUMO">CONSUMO</option>
                    <option value="CONSUMO ESPECIAL">CONSUMO ESPECIAL</option>
                  </select>
                </div>
                <div class="input_wrapper">
                  <label>Importe</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="form.importe"
                    v-bind:precision="2"
                  ></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Plazo</label>
                  <input
                    type="number"
                    v-model="form.plazo"
                    :min="1"
                    :max="48"
                    @keyup="meses_numero"
                  />
                </div>
                <div class="input_wrapper">
                  <label>Meses</label>
                  <input type="text" v-model="form.meses" disabled />
                </div>
                <div class="input_wrapper">
                  <label>Cuota del sistema</label>
                  <vue-numeric v-model="form.cuotas" v-bind:precision="1"></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Aporte</label>
                  <vue-numeric
                    
                    currency="S/. "
                    separator=","
                    v-model="form.aporte"
                    v-bind:precision="2"
                  ></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Prob. Infocorp</label>
                  <vue-numeric v-model="form.probabilidad_infocorp" v-bind:precision="1"></vue-numeric>
                </div>
              </div>

              <div class="group_form all">
                <div class="input_wrapper">
                  <label>Comentarios</label>
                  <textarea type="text" v-model="form.comentarios"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(5)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click.prevent="submit()" :class="{loading: loading}">
              <div class="load_spinner"></div>
              <span>FINALIZAR</span>
              <i class="material-icons-outlined">check</i>
            </a>
          </div>
        </div>
      </div>
    </section>

  </div>

</template>

<script>
import { serviceNumber } from "../mixins/functions"; 
import VueNumeric from 'vue-numeric'
 import { toastOptions } from '../constants.js'

export default {
  mixins: [serviceNumber],
  components: {VueNumeric },
  data() {
    return {
      resource: "clientes",
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      districts: [],
      loading: false,
      errors: {},
      form: {
        idprestamo: -1,
        garantias: [],
        avals: [],
        cliente: {
          departamento: "",
          provincia: "",
          distrito: "",
          documento: this.$route.params.dni
        },
        juridico: {
          razon_social: "",
          nombre_comercial: "",
          actividad_principal: "",
          partida_registral: "0",
          telefono: "",
          direccion: "",
          email:"",
          nacimiento:"",
          fecha_constitucion:""
        },
        representante: {
          nombres_representante: "",
          documento_representante: "",
          nacimiento_representante: "",
          estado_civil_representante: "0",
          ocupacion_representante: "",
          telefono_representante: "",
          celular_representante: "",
          direccion_representante:"",
          distrito_representante:"",
          provincia_representante:"",
          departamento_representante:"",
          referencia_representante:"",
          tipo_domicilio_representante:"",
          poderes_representante:"",
          fecha_inicio_representante:"",
        },
        monto_inicial: "",
        plazo_inicial: "5",
        disponibilidad_pago_inicial: "",
        destino_inicial: "",
        forma_inicial: "DIARIO",
        producto: "CREDIDIARIO",
        forma: "DIARIO",
        meses: 0,
        importe: 0,
        aporte: 0,
        plazo: 5,
        coutas: 0,
        tasa: 0.0,
        comentarios: "",
        estado: "PENDIENTE"
      },
      tab: 1
    };
  },
    computed: {
    validateMonto() {
      return String(this.form.monto_inicial).length > 1
    },
    validateDiponibilidad() {
      return String(this.form.disponibilidad_pago_inicial).length > 1
    },
    validateDestino() {
      return this.form.destino_inicial.length > 6
    },
    validateStep1() {
      return this.validateMonto && this.validateDiponibilidad && this.validateDestino;
    },


    validateActividad() {
      return this.form.juridico.actividad_principal.length > 4
    },
    validatePartida() {
      return this.form.juridico.partida_registral.length > 3
    },
    validateDireccionEmpresa() {
      return this.form.juridico.direccion.length > 6
    },
    validateFechaConstitucion() {
      return this.form.juridico.fecha_constitucion.length > 4
    },
    validateEmail() {
      return this.form.juridico.email.length > 6
    },
    validateDocumentoRepresentante() {
      return this.form.representante.documento_representante >= 8
    },
    validateNombres() {
      return this.form.representante.nombres_representante.length > 6
    },
    validateNacimiento() {
      return this.form.representante.nacimiento_representante.length > 4
    },
    validateCivil() {
      return this.form.representante.estado_civil_representante.length > 4
    },
    validateOcupacion() {
      return this.form.representante.ocupacion_representante.length > 4
    },
    validateCelular() {
      return this.form.representante.celular_representante.length > 10
    },
    validateDireccionRepresetante() {
      return this.form.representante.direccion_representante.length > 6
    },
    validateDepartamento() {
      return this.form.representante.departamento_representante.length > 4
    },
    validateProvincia() {
      return this.form.representante.provincia_representante.length > 4
    },
    validateDistrito() {
      return this.form.representante.distrito_representante.length > 4
    },
    validateReferencia() {
      return this.form.representante.referencia_representante.length > 4
    },
    validateTipoDomicilio() {
      return this.form.representante.tipo_domicilio_representante.length > 4
    },
    validatePoderes() {
      return this.form.representante.poderes_representante.length > 3
    },
    validateFechaCargo() {
      return this.form.representante.fecha_inicio_representante.length > 4
    },
    validateStep2(){
      return  this.validateActividad &&
              this.validatePartida &&
              this.validateDireccionEmpresa &&
              this.validateFechaConstitucion &&
              this.validateEmail &&
              this.validateDocumentoRepresentante &&
              this.validateNombres &&
              this.validateNacimiento &&
              this.validateCivil &&
              this.validateOcupacion &&
              this.validateCelular &&
              this.validateDireccionRepresetante &&
              this.validateDepartamento &&
              this.validateProvincia &&
              this.validateDistrito &&
              this.validateReferencia &&
              this.validateTipoDomicilio &&
              this.validatePoderes &&
              this.validateFechaCargo
    }
  },
  created() {
    // this.initForm()
    this.clickAddAval()
    this.clickAddGarantia()

    this.$http.get(`/${this.resource}/datos/`).then(response => {
      this.all_departments = response.data.departments;
      this.all_provinces = response.data.provinces;
      this.all_districts = response.data.districts;
    });

    this.$http
      .get(`/${this.resource}/datos/prestamo/juridico/` + this.$route.params.dni)
      .then(response => {
        this.form.cliente.departamento = response.data["cliente"]["departamento"];
        this.form.cliente.provincia = response.data["cliente"]["provincia"];
        this.form.cliente.distrito = response.data["cliente"]["distrito"];
 
         this.form.juridico.razon_social =  response.data["juridico"]["razon_social"];
         this.form.juridico.nombre_comercial = response.data["juridico"]["nombre_comercial"];
         this.form.juridico.actividad_principal =  response.data["juridico"]["actividad_principal"];
         this.form.juridico.partida_registral =  response.data["juridico"]["partida_registral"];
         this.form.juridico.telefono = response.data["juridico"]["telefono"];
         this.form.juridico.direccion = response.data["juridico"]["direccion"];
        //  this.form.juridico.nacimiento = response.data["juridico"]["nacimiento"];
         this.form.juridico.email = response.data["juridico"]["email"];


         this.form.representante.nombres_representante = response.data["juridico"]["nombres_representante"] || ""
         this.form.representante.documento_representante = response.data["juridico"]["documento_representante"] || ""
         this.form.representante.nacimiento_representante =  response.data["juridico"]["nacimiento_representante"] || ""
         this.form.representante.estado_civil_representante = response.data["juridico"]["estado_civil_representante"] || ""
         this.form.representante.ocupacion_representante =  response.data["juridico"]["ocupacion_representante"] || ""
         this.form.representante.telefono_representante =  response.data["juridico"]["telefono_representante"] || ""
         this.form.representante.celular_representante =  response.data["juridico"]["celular_representante"] || ""
         this.form.representante.direccion_representante =  response.data["juridico"]["direccion_representante"] || ""
         this.form.representante.distrito_representante =  response.data["juridico"]["distrito_representante"] || ""
         this.form.representante.departamento_representante =  response.data["juridico"]["departamento_representante"] || ""
         this.form.representante.referencia_representante =  response.data["juridico"]["referencia_representante"] || ""
         this.form.representante.tipo_domicilio_representante =  response.data["juridico"]["tipo_domicilio_representante"] || ""
         this.form.representante.poderes_representante =  response.data["juridico"]["poderes_representante"] || ""
         this.form.representante.fecha_inicio_representante =  response.data["juridico"]["fecha_inicio_representante"] || ""
        


        
      }); 
  },

  methods: {
    next(index) {
        this.tab = index + 1;
    },
    prev(index) {
        this.tab = index - 1;
    },
    clickAddconyuge(){
      this.form.conyugue.conyuge_tiene=1
    },
    clickRemoveconyuge(){
      this.form.conyugue.conyuge_tiene=0
    },
    clickAddAval() {
      // this.contador_aval++;
      this.form.avals.push({
        documento: "",
        nombres: "",
        apellidos: "",
        nacimiento: "",
        estado_civil: "SOLTERO",
        ocupacion: "",
        telefono: "",
        celular: "",
        direccion: "",
        distrito: "",
        centro_laboral: "",
        direccion_laboral: "",
        socio: "NO",
        codigo_socio: "",
        aporte_socio: "",
        tipo_persona: "pn",
        empresa_ruc:'',
        empresa_razon_social:'',
        empresa_direccion:''
      });
    },
        meses_numero(){

        if(this.form.producto=='CREDIDIARIO'){ 
          this.form.meses = (Number(this.form.plazo)/30).toFixed(2)
        }
        else if(this.form.producto=='CREDISEMANA'){
          this.form.meses = (Number(this.form.plazo)/4).toFixed(2)
        }
        else{
          this.form.meses = (Number(this.form.plazo)/1).toFixed(2)
        }

    },
    clickRemoveAval(index) {
      this.form.avals.splice(index, 1);
    },
    clickAddGarantia() {
      // this.contador_garantia++;
      this.form.garantias.push({
        bien_garantia: "",
        tipo: ""
      });
    },
    clickRemoveGarantia(index) {
      this.form.garantias.splice(index, 1);
    },
    clearForm() {
      // this.initForm();
    },
    // initForm() {
    //   this.errors = {};
    //   this.form = {

    //   };
    // },
    datosCliente() {
      let me = this;
      if(this.form.representante.documento_representante.length==8){
        axios
        .post("/consulta/doc", {
          documento: this.form.representante.documento_representante
        })
        .then(function(response) { 
          if(response.data){
            me.form.representante.nombres_representante = response.data.name
          }

        })
        .catch(function(error) {
          console.log(error);
        });
      }
    },
    datosAval(row) {
      if(row.documento.length==8){

        let me = this;
        // me.loader = "true";
        axios
        .post("/consulta/doc", {
          documento: row.documento
        })
        .then(function(response) { 
          row.nombres = response.data["nombres"];
          row.apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
      }
    },
    submit() {
 
      this.loading = true
      this.$http
        .post(`/${this.resource}/prestamo/juridico`, this.form)
        .then(response => { 
                this.loading= false
            if(response.data.success){
                this.$toast.success(
                    "El prestamo fue creado",
                    "Exitoso",
                    toastOptions.success
                  )
                  this.$router.push({ name: 'perfil', params: { documento: this.$route.params.dni, persona: 'PJ' }})
            }else{
                this.$toast.error(
                  "No se pudo crear prestamo",
                  "Error",
                  toastOptions.error
                )
            }
        })
        .then(() => { 
        });
    },
 
  },
  mounted() {

    if(this.form.producto=='CREDIDIARIO'){

      this.form.meses = (Number(this.form.plazo)/30).toFixed(2)
    }
    else if(this.form.producto=='CREDISEMANA'){
      this.form.meses = (Number(this.form.plazo)/4).toFixed(2)
    }
    else if(this.form.producto=='MENSUAL'){
      this.form.meses = Number(this.form.plazo)/1 
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
