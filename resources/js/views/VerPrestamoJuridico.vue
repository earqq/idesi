<template>
  <div class="">
      <div class="create_client_content">
    <section class="tabs_section">
      <div class="tabs_wrapper">
        <div
          class="tab"
          @click="tab = 1;saving()"
          :class="{selected: tab == 1}"
        >
          <span>1</span>
          <p>SOLICITUD</p>
        </div>
        <div class="tab" @click="tab = 2;saving()" :class="{selected: tab == 2}">
          <span>2</span>
          <p>EMPRESA</p>
        </div>
        <div class="tab" @click="tab = 3;saving()" :class="{selected: tab == 3}">
          <span>3</span>
          <p>AVAL</p>
        </div>
        <div class="tab" @click="tab = 4;saving()" :class="{selected: tab == 4}">
          <span>4</span>
          <p>GARANTIA</p>
        </div>
        <div class="tab" @click="tab = 5;saving()" :class="{selected: tab ==5}">
          <span>5</span>
          <p>PROPUESTA DE ANALISTA</p>
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
                <div class="input_wrapper">
                  <label>Monto</label>
                  <vue-numeric  currency="S/. " separator="," v-model="form.monto_inicial" v-bind:precision="2"></vue-numeric>
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
                  <label>Cuotas</label>
                  <input type="number" v-model="form.cuotas_inicial"  />
                </div>
                <div class="input_wrapper">
                  <label>Disponibilidad de pago</label>
                  <input type="text" v-model="form.disponibilidad_pago_inicial"  />
                </div>
              </div>
              <div class="group_form all">
                <div class="input_wrapper">
                  <label>Destino de crédito (propuesta cliente)</label>
                  <textarea v-model="form.destino_inicial"  />
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_primary medium next" @click="next(1)">
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
                  <input type="text"  v-model="form.juridico.razon_social" />
                </div>

                <div class="input_wrapper">
                  <label>Ruc</label>
                  <input type="text"  v-model="form.cliente.documento" />
                </div>

                <div class="input_wrapper">
                  <label>Nombre comercial</label>
                  <input type="text"  v-model="form.juridico.nombre_comercial" />
                </div>

                <div class="input_wrapper">
                  <label>Actividad</label>
                  <input type="text"  v-model="form.juridico.actividad_principal" />
                </div>

                <div class="input_wrapper">
                  <label>Número de partida</label>
                  <input type="text" v-model="form.juridico.partida_registral"  />
                </div>
                <div class="input_wrapper">
                  <label>Teléfono</label>
                  <input type="text" v-model="form.juridico.telefono"  />
                </div>
                <div class="input_wrapper">
                  <label>Dirección</label>
                  <input type="text" v-model="form.juridico.direccion"  />
                </div>
                <div class="input_wrapper">
                  <label>Fecha de constitución</label>
                  <input type="date" v-model="form.juridico.fecha_constitucion"  />
                </div>
                <div class="input_wrapper">
                  <label>Email</label>
                  <input type="text" v-model="form.juridico.email"  />
                </div>
              </div>

              <span class="separator"></span>

              <div class="group_form">

                <div class="input_wrapper">
                  <label>Documento de Identidad</label>
                  <input
                    type="text"
                    v-model="form.representante.documento_representante"
                    @change="datosCliente()"
                    v-mask="'########'"
                  />
                  <div class="message">número de documento inválido</div>
                </div>

                <div class="input_wrapper">
                  <label>Nombres y Apellidos</label>
                  <input type="text" v-model="form.representante.nombres_representante" />
                </div>

                <div class="input_wrapper">
                  <label>Fecha de Nacimiento</label>
                  <input type="date" v-model="form.representante.nacimiento_representante" />
                </div>

                <div class="input_wrapper">
                  <label>Estado Civil</label>
                  <select v-model="form.representante.estado_civil_representante">
                    <option value="SOLTERO">SOLTERO</option>
                    <option value="CASADO">CASADO</option>
                    <option value="CONVIVIENTE">CONVIVIENTE</option>
                    <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                    <option value="VIUDO">VIUDO</option>
                  </select>
                </div>

                <div class="input_wrapper">
                  <label>Ocupación</label>
                  <input type="text" v-model="form.representante.ocupacion_representante" />
                </div>


                <div class="input_wrapper">
                  <label>Teléfono</label>
                  <input type="text" v-model="form.representante.telefono_representante" />
                </div>

                <div class="input_wrapper">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-mask="'### ### ###'"
                    v-model="form.representante.celular_representante"
                  />
                </div>

                <div class="input_wrapper">
                  <label>Dirección</label>
                  <input type="text" v-model="form.representante.direccion_representante" />
                </div>
              </div>
              <div class="separator"></div>

              <div class="group_form">


                <div class="input_wrapper">
                  <label>Departamento</label>
                  <input type="text" v-model="form.representante.departamento_representante" />
                </div>

                <div class="input_wrapper">
                  <label>Provincia</label>
                  <input type="text" v-model="form.representante.provincia_representante" />
                </div>

                <div class="input_wrapper">
                  <label>Distrito</label>
                  <input type="text" v-model="form.representante.distrito_representante" />
                </div>

                <div class="input_wrapper">
                  <label>Referencia</label>
                    <input type="text" v-model="form.representante.referencia_representante" />
                </div>


                <div class="input_wrapper">
                  <label>Tipo Domicilio</label>
                  <select v-model="form.representante.tipo_domicilio_representante">
                    <option value="PROPIO">PROPIO</option>
                    <option value="ALQUILADO">ALQUILADO</option>
                  </select>
                </div>

                <div class="input_wrapper">
                  <label>Poderes (Asiento)</label>
                    <input type="text" v-model="form.representante.poderes_representante"  v-mask="'####'"/>
                </div>

                <div class="input_wrapper">
                  <label>Fecha inicio (Cargo) </label>
                  <input type="date" v-model="form.representante.fecha_inicio_representante"/>
                </div>
              </div>
          
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(2)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(2)">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 3" class="form_step">
          <div class="form_step_wrapper">
            <div class="form_list no_border" >
              <div class="sub_step_wrapper" v-for="(row, index) in form.avals" :key="index">
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

                  <span class="separator" ></span>

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Documento de Identidad</label>
                      <input
                        type="text"
                        v-model="row.documento"
                        v-mask="'########'"
                        @change="datosAval(index)"
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

            <button type="button" @click="clickAddAval" class="add_section" v-if="form.avals.length<=1">
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
              <div class="sub_step_wrapper" v-for="(row, index) in form.garantias" :key="index">
                <h3 class="title">
                  Garantia {{index + 1}}
                  <button
                    v-if="index > 0"
                    class="delete_section"
                    type="button"
                    @click.prevent="clickRemoveGarantia(index)">
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

            <button type="button" @click="clickAddGarantia" class="add_section"  v-if="form.garantias.length<=1">
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
            <h3 class="title">Declaración</h3>
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
                <div class="input_wrapper" :class="{require: !validateImporte}">
                  <label>Importe</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="form.importe"
                    v-bind:precision="2"
                  ></vue-numeric>
                  <div class="message">Ingrese importe</div>
                </div>
                <div class="input_wrapper" :class="{require: !validatePlazo}">
                  <label>Cuotas</label>
                  <input
                    type="number"
                    v-model="form.plazo"
                    :min="1"
                    :max="48"
                    @keyup="meses_numero"
                  />
                  <div class="message">Ingrese cuota</div>
                </div>
                <div class="input_wrapper">
                  <label>Meses</label>
                  <input type="text" v-model="form.meses" disabled />
                </div>
                <div class="input_wrapper" :class="{require: !validateCuota}">
                  <label>Cuota del sistema</label>
                  <vue-numeric v-model="form.cuotas" v-bind:precision="1"></vue-numeric>
                  <div class="message">Ingrese cuotas del sistema</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateAporte}">
                  <label>Aporte</label>
                  <vue-numeric
                    
                    currency="S/. "
                    separator=","
                    v-model="form.aporte"
                    v-bind:precision="2"
                  ></vue-numeric>
                  <div class="message">Ingrese aporte</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateInfo}">
                  <label>Prob. Infocorp</label>
                  <vue-numeric v-model="form.probabilidad_infocorp" v-bind:precision="1"></vue-numeric>
                  <div class="message">Se requiere este campo</div>
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
            <a class="button_primary medium next" @click.prevent=" validateStep2 ? submit() : tabError()" :class="{loading: loading}">
              <div class="load_spinner"></div>
              <span>FINALIZAR</span>
              <i class="material-icons-outlined">check</i>
            </a>
          </div>
        </div>
      </div>
    </section>

  </div>

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
      tab: 1,
      loading:0,
      errors: {},
      form: {},
    };
  },
      computed: {
            // validateMonto() {
            //   return String(this.form.monto_inicial).length > 1
            // },
            // validateDiponibilidad() {
            //   return String(this.form.disponibilidad_pago_inicial).length > 1
            // },
            // validateDestino() {
            //   return this.form.destino_inicial.length > 6
            // },
            // validateStep1() {
            //   return this.validateMonto && this.validateDiponibilidad && this.validateDestino;
            // },

          validateImporte() {
              return String(this.form.importe).length > 0 && this.form.importe !=0
            },
            validatePlazo() {
              return String(this.form.plazo).length > 0 && this.form.plazo != 0 
            },
            validateAporte() {
              return String(this.form.aporte).length > 0 && this.form.aporte !=0
            },
            validateInfo() {
              return String(this.form.probabilidad_infocorp).length >= 1
            },
            validateCuota() {
              return String(this.form.cuotas).length>=1 && this.form.cuotas !=0
            },
            validateStep2() {
              return this.validateImporte && this.validatePlazo && this.validateAporte && this.validateInfo && this.validateCuota;
            }
  },
  created() {
    this.initForm();

  console.log(this.$route.params)
    this.$http.get(`/${this.resource}/datos/`).then(response => {
      this.all_departments = response.data.departments;
      this.all_provinces = response.data.provinces;
      this.all_districts = response.data.districts;
    });

    this.$http
      .get(`/${this.resource}/prestamo/ver/juridico/` + this.$route.params.prestamo)
      .then(response => { 

        this.form.cliente.departamento = response.data["cliente"]["departamento"];
        this.form.cliente.provincia = response.data["cliente"]["provincia"];
        this.form.cliente.distrito = response.data["cliente"]["distrito"];
        this.form.cliente.documento = response.data["cliente"]["documento"];
 
         this.form.juridico.razon_social =  response.data["juridico"]["razon_social"];
         this.form.juridico.nombre_comercial = response.data["juridico"]["nombre_comercial"];
         this.form.juridico.actividad_principal =  response.data["juridico"]["actividad_principal"];
         this.form.juridico.partida_registral =  response.data["juridico"]["partida_registral"];
         this.form.juridico.telefono = response.data["juridico"]["telefono"];
         this.form.juridico.direccion = response.data["juridico"]["direccion"];
         this.form.juridico.fecha_constitucion = response.data["juridico"]["fecha_constitucion"];
         this.form.juridico.email = response.data["juridico"]["email"];

         this.form.representante.nombres_representante = response.data["juridico"]["nombres_representante"];
         this.form.representante.documento_representante = response.data["juridico"]["documento_representante"];
         this.form.representante.nacimiento_representante =  response.data["juridico"]["nacimiento_representante"];
         this.form.representante.estado_civil_representante = response.data["juridico"]["estado_civil_representante"];
         this.form.representante.ocupacion_representante =  response.data["juridico"]["ocupacion_representante"];
         this.form.representante.telefono_representante =  response.data["juridico"]["telefono_representante"];
         this.form.representante.celular_representante =  response.data["juridico"]["celular_representante"];
         this.form.representante.direccion_representante =  response.data["juridico"]["direccion_representante"];
         this.form.representante.distrito_representante =  response.data["juridico"]["distrito_representante"];
         this.form.representante.departamento_representante =  response.data["juridico"]["departamento_representante"];
         this.form.representante.provincia_representante =  response.data["juridico"]["provincia_representante"];
         this.form.representante.referencia_representante =  response.data["juridico"]["referencia_representante"];
         this.form.representante.tipo_domicilio_representante =  response.data["juridico"]["tipo_domicilio_representante"];
         this.form.representante.poderes_representante =  response.data["juridico"]["poderes_representante"];
         this.form.representante.fecha_inicio_representante =  response.data["juridico"]["fecha_inicio_representante"];
        
        this.form.monto_inicial=response.data['prestamo']['monto_inicial'];
        this.form.cuotas_inicial=response.data['prestamo']['cuotas_inicial'];
        this.form.disponibilidad_pago_inicial=response.data['prestamo']['disponibilidad_pago_inicial'];
        this.form.destino_inicial=response.data['prestamo']['destino_inicial'];
        this.form.forma_inicial=response.data['prestamo']['forma_inicial'];
        this.form.meses=response.data['prestamo']['meses'];
        this.form.producto= response.data['prestamo']['producto'];
        this.form.forma=response.data['prestamo']['forma'];
        this.form.importe= response.data['prestamo']['importe'];
        this.form.aporte= response.data['prestamo']['aporte'];
        this.form.plazo= response.data['prestamo']['plazo'];
        this.form.cuotas= response.data['prestamo']['cuotas'];
        this.form.tasa= response.data['prestamo']['tasa'];
        this.form.comentarios=response.data['prestamo']['comentarios'];
        
        this.form.avals = response.data.avals;
        this.form.garantias = response.data.garantias;

        
      });
  },

  methods: {
      tabError(){
       this.$toast.error(
          "Rellene los datos necesarios",
          "Error",
          toastOptions.error
        )
    },
    next(index) {
        this.tab = index + 1;
        this.saving()
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
    clickAddAval() { 
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
        socio: 'NO',
        codigo_socio: "",
        aporte_socio: "",
        tipo_persona: "pn",
        empresa_ruc:'',
        empresa_razon_social:'',
        empresa_direccion:''
      });
    },
    clickRemoveAval(index) {
      this.form.avals.splice(index, 1);
    },
    numero_meses(){
       if(this.form.producto=='CREDIDIARIO'){ 
          this.form.meses = (Number(this.form.plazo)/30).toFixed(2)
        }
        else if(this.form.producto=='CREDISEMANA'){
          this.form.meses = (Number(this.form.plazo)/4).toFixed(2)
        }
        else {
          this.form.meses = (Number(this.form.plazo)/1).toFixed(2)
        }
    },
    clickAddGarantia() { 
      this.form.garantias.push({
        bien_garantia: "",
        tipo: ""
      });
    },
    clickRemoveGarantia(index) {
      this.form.garantias.splice(index, 1);
    },
    clearForm() {
      this.initForm();
    },
    initForm() {
      this.errors = {};
      this.form = {
        idprestamo: this.$route.params.prestamo,
        garantias: [],
        avals: [],
        cliente: {
          departamento: "",
          provincia: "",
          distrito: "",
          documento: ""
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
        cuotas_inicial: "0",
        disponibilidad_pago_inicial: "",
        destino_inicial: "",
        forma_inicial: "0",
        producto: 0,
        forma: "0",
        meses: 0,
        importe: 0,
        aporte: 0,
        plazo: 0,
        probabilidad_infocorp:'',
        coutas: 0,
        tasa: 0.0,
        comentarios: "",
        estado: "PENDIENTE"
      };
    },
    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/doc", {
        //   documento: this.form.conyugue.documento_conyugue
        })
        .then(function(response) { 
        //   me.form.conyugue.nombres_conyugue = response.data["nombres"];
        //   me.form.conyugue.apellidos_conyugue = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
    },
    datosAval(index) {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/doc", {
          documento: this.form.avals[index].documento
        })
        .then(function(response) { 
          me.form.avals[index].nombres = response.data["nombres"];
          me.form.avals[index].apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
    },
    submit() {
      
      this.loading = true
      this.$http
        .post(`/${this.resource}/prestamo/juridico`, this.form)
        .then(response => {

            this.loading = false
            if(response.data.success){
                this.$toast.success(
                    "El prestamo fue editado",
                    "Exitoso",
                    toastOptions.success
                  ) 
                 this.$router.push({ name: 'perfil', params: { documento: this.$route.params.dni, persona: 'PJ' }})
            }else{
                this.$toast.error(
                  "Error al editar el prestamo",
                  "Error",
                  toastOptions.error
                )
            }
         
        })
       
        .then(() => {
          // this.loading_submit = false;
        });
    },
    saving() {
      this.$http
        .post(`/${this.resource}/prestamo/juridico`, this.form)
        .then(response => {
        }) 
        .then(() => {
        });
    }
  } 
};
</script>
 