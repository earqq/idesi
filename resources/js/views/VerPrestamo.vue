<template>
<div class="">
    <div class="create_client_content">
    <section class="tabs_section">
      <div class="tabs_wrapper">
        <div
          class="tab"
          @click="tab = 1"
          :class="[{complete : validateStep1 }, {selected: tab == 1}]"
        >
          <span>1</span>
          <p>SOLICITUD</p>
        </div>
        <div class="tab" @click="tab = 2" :class="{selected: tab == 2}">
          <span>2</span>
          <p>CLIENTE</p>
        </div>
        <div class="tab" @click="tab = 3" :class="{selected: tab == 3}">
          <span>3</span>
          <p>AVAL</p>
        </div>
        <div class="tab" @click="tab = 4" :class="{selected: tab == 4}">
          <span>4</span>
          <p>GARANTIA</p>
        </div>
        <div class="tab" @click="tab = 5" :class="{selected: tab ==5}">
          <span>5</span>
          <p>PROPUESTA DE ANALISTA</p>
        </div>
      </div>
    </section>

    <section class="client_forms">
      <div class="client_forms_wrapper">


        <transition name="slide-fade" mode="in-out">
          <div v-show="tab == 1" class="form_step">
            <div class="form_step_wrapper">
              <h3 class="title">Solicitud de Crédito</h3>
              <div class="form_content">
                <div class="group_form">
                  <div class="input_wrapper">
                    <label>Monto</label>
                    <vue-numeric  currency="S/. " separator="," v-model="form.monto_inicial"  v-bind:precision="2"></vue-numeric>
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
                    <select v-model="form.plazo_inicial" >
                      <option v-for="(index) in 36" :key="index" :value="index">{{index}}</option>
                    </select>
                  </div>
                  <div class="input_wrapper">
                    <label>Disponibilidad de pago</label>
                    <input type="text" v-model="form.disponibilidad_pago_inicial"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Destino de crèdito en propuesta cliente</label>
                    <input type="text" v-model="form.destino_inicial"  />
                  </div>
                </div>

                <span class="separator"></span>
                <span class="separator"></span>
              </div>
            </div>

            <div class="form_buttons">
              <a class="button_primary medium next" @click="next(1)">
                <span>SIGUIENTE</span>
                <i class="material-icons-outlined">navigate_next</i>
              </a>
            </div>
          </div>
        </transition>


        <transition name="slide-fade" mode="in-out">
          <div v-show="tab == 2" class="form_step">
            <div class="form_step_wrapper">
              <h3 class="title">Datos del Titular</h3>
              <div class="form_content">
                <div class="group_form">
                  <div class="input_wrapper">
                    <label>Nombres</label>
                    <input type="text"  v-model="form.natural.nombres" />
                  </div>
                  <div class="input_wrapper">
                    <label>Apellidos</label>
                    <input type="text"  v-model="form.natural.apellidos" />
                  </div>
                  <div class="input_wrapper">
                    <label>Documento</label>
                    <input type="text"  v-model="form.cliente.documento" />
                  </div>
                  <div class="input_wrapper">
                    <label>Fecha de nacimiento</label>
                    <input type="DATE"  v-model="form.natural.nacimiento" />
                  </div>
                  <div class="input_wrapper">
                    <label>Estado Civil</label>
                    <select v-model="form.natural.estado_civil" >
                      <option value="SOLTERO">SOLTERO</option>
                      <option value="CASADO">CASADO</option>
                      <option value="CONVIVIENTE">CONVIVIENTE</option>
                      <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                      <option value="VIUDO">VIUDO</option>
                    </select>
                  </div>
                  <div class="input_wrapper">
                    <label>Ocupación</label>
                    <input type="text" v-model="form.natural.ocupacion"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Teléfono</label>
                    <input type="text" v-model="form.natural.telefono"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Celular</label>
                    <input type="text" v-mask="'### ### ###'" v-model="form.natural.celular" />
                  </div>
                  <div class="input_wrapper">
                    <label>Dirección Consignado</label>
                   <input type="text" v-model="form.natural.direccion"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Dirección Reniec</label>
                    <input type="text" disabled />
                  </div>
                </div>

                <span class="separator"></span>

                <div class="group_form">
                  <div class="input_wrapper">
                    <label>Departamento</label>
                    <input  type="text" v-model="form.natural.domicilio_departamento" />
                  </div>
                  <div class="input_wrapper">
                    <label>Provincia</label>
                    <input type="text" v-model="form.natural.domicilio_provincia"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Distrito</label>
                    <input type="text" v-model="form.natural.domicilio_distrito"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Referencia</label>
                    <input type="text" v-model="form.natural.referencia"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Tipo Domicilio</label>
                    <select v-model="form.natural.tipo_domicilio" >
                      <option value="PROPIA">PROPIA</option>
                      <option value="PROPIA HIPOTECA">PROPIA HIPOTECA</option>
                      <option value="DE LOS PADRES">DE LOS PADRES</option>
                      <option value="DE LOS FAMILIARES">DE LOS FAMILIARES</option>
                      <option value="ALQUILADA">ALQUILADA</option>
                    </select>
                  </div>
                  <div class="input_wrapper">
                    <label>Centro Laboral</label>
                    <input type="text" v-model="form.natural.centro_laboral"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Dirección centro laboral</label>
                    <input type="text" v-model="form.natural.direccion_laboral"  />
                  </div>
                </div>

                <h3 class="title">Cònyuge o Conviviente</h3>
                <span class="separator"></span>

                <div class="group_form" v-if="form.conyugue.conyuge_tiene=='SI'">
                  <div class="input_wrapper">
                    <label>Documento de Identidad</label>
                    <input
                      type="text"
                      v-model="form.conyugue.documento_conyugue"
                      @change="datosCliente()"
                      v-mask="'########'"
                    />
                    <div class="message">número de documento inválido</div>
                  </div>
                  <div class="input_wrapper">
                    <label>Nombres y Apellidos</label>
                    <input type="text" v-model="form.conyugue.nombres_conyugue"  />
                  </div>
                  <div class="input_wrapper">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" v-model="form.conyugue.nacimiento_conyugue"/>
                  </div>
                  <div class="input_wrapper">
                    <label>Estado Civil</label>
                    <select v-model="form.conyugue.estado_civil_conyugue">
                      <option value="SOLTERO">SOLTERO</option>
                      <option value="CASADO">CASADO</option>
                      <option value="CONVIVIENTE">CONVIVIENTE</option>
                      <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                      <option value="VIUDO">VIUDO</option>
                    </select>
                  </div>
                  <div class="input_wrapper">
                    <label>Ocupación</label>
                    <input type="text" v-model="form.conyugue.ocupacion_conyugue" />
                  </div>
                  <div class="input_wrapper">
                    <label>Socio</label>
                    <select v-model="form.conyugue.socio_conyugue">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                  <div class="input_wrapper">
                    <label>Código</label>
                    <input type="text" v-model="form.conyugue.codigo_socio_conyugue"  v-if="form.conyugue.socio_conyugue=='SI'"/>
                    <input type="text"  disabled v-else>
                  </div>
                  <div class="input_wrapper">
                    <label>Aporte</label>
                    <vue-numeric currency="S/. " separator="," v-model="form.conyugue.aporte_socio_conyugue"  v-bind:precision="2" v-if="form.conyugue.socio_conyugue=='SI'"></vue-numeric>
                    <input type="text"  disabled v-else>
                  </div>
                  <div class="input_wrapper">
                    <label>Teléfono</label>
                    <input type="text" v-model="form.conyugue.telefono_conyugue" />
                  </div>
                  <div class="input_wrapper">
                    <label>Celular</label>
                    <input
                      type="text"
                      v-mask="'### ### ###'"
                      v-model="form.conyugue.celular_conyugue"
                    />
                  </div>
                  <div class="input_wrapper">
                    <label>Centro Laboral</label>
                    <input type="text" v-model="form.conyugue.centro_laboral_conyugue"/>
                  </div>
                  <div class="input_wrapper">
                    <label>Dirección centro laboral</label>
                    <input type="text" v-model="form.conyugue.direccion_laboral_conyugue" />
                  </div>
                </div>

                <button
                  type="button"
                  @click.prevent="clickAddConyuge"
                  class="add_section"
                  v-if="form.conyugue.conyuge_tiene=='NO'"
                >
                  <span>AGREGAR CONYUGE Ó CONVIVIENTE</span>
                  <i class="fas fa-plus"></i>
                </button>

                <button
                  type="button"
                  @click.prevent="clickRemoveConyuge"
                  class="add_section"
                  v-else
                >
                  <span>REMOVER CONYUGE Ó CONVIVIENTE</span>
                  <i class="fas fa-plus"></i>
                </button>
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
        </transition>


        <transition name="slide-fade" mode="in-out">
          <div v-show="tab == 3" class="form_step">
            <div class="form_step_wrapper">
              <h3 class="title">Datos de Aval</h3>

              <div class="form_list" :class="{list_round: form.avals.length > 0}">
                <div class="form_step_wrapper" v-for="(row, index) in form.avals" :key="index">
                  <h3 class="title">
                    Aval {{index + 1}}
                    <button
                      class="delete_section"
                      type="button"
                      @click.prevent="clickRemoveAval(index)"
                    >
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

              <button type="button" @click="clickAddAval" class="add_section">
                <span>AGREGAR AVAL</span>
                <i class="fas fa-plus"></i>
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
        </transition>


        <transition name="slide-fade" mode="in-out">
          <div v-show="tab == 4" class="form_step">
            <div class="form_step_wrapper">
              <h3 class="title">Datos de Garantia</h3>

              <div class="form_list" :class="{list_round: form.garantias.length > 0}">
                <div class="form_step_wrapper" v-for="(row, index) in form.garantias" :key="index">
                  <h3 class="title">
                    Garantia {{index + 1}}
                    <button
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

                      <div class="input_wrapper">
                        <label>Ins</label>
                        <label class="form-check-label">
                          <input
                            type="radio"
                            v-model="row.tipo"
                            class="form-check-input"
                            value="INS"
                          />
                        </label>
                      </div>

                      <div class="input_wrapper">
                        <label>D.J</label>
                        <label class="form-check-label">
                          <input
                            type="radio"
                            v-model="row.tipo"
                            class="form-check-input"
                            value="DJ"
                          />
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="button" @click="clickAddGarantia" class="add_section">
                <span>AGREGAR GARANTIA</span>
                <i class="fas fa-plus"></i>
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
        </transition>

        <transition name="slide-fade" mode="in-out">
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
                      class="form-control"
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

                <div class="separator"></div>
                <div class="group_form">
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
              <a class="button_primary medium next" @click.prevent="submit()">
                <span>FINALIZAR</span>
                <i class="material-icons-outlined">check</i>
              </a>
            </div>
          </div>
        </transition>

      </div>
    </section>
  </div>
</div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
import VueNumeric from 'vue-numeric'

const mesConf = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo", 
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
];
const diaConf = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
export default {
  mixins: [serviceNumber],
  components: { DatePick ,VueNumeric},
  data() {
    return {
      resource: "clientes",
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      districts: [],
      errors: {},
      tab: 1,
      loading_submit: 0,
      form: {},
      contador_aval: 0,
      contador_garantia: 0,
      mesEs: mesConf,
      diaEs: diaConf,
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
    validateName() {
      // return this.form.natural.nombres.length > 2
    },
    validateLastname() {
      // return this.form.natural.apellidos.length > 2
    },
    validateDoc() {
      let result = false;
      // if (this.form.cliente.tipo_documento == 'DNI') result = this.form.cliente.documento.length == 8
      // else if (this.form.cliente.tipo_documento == 'CE') result = this.form.cliente.documento.length == 11
      return result;
    },
    validateStep1() {
      return this.validateDoc && this.validateName && this.validateLastname;
    }
  },
  created() {
    this.initForm();

    this.$http.get(`/${this.resource}/datos/`).then(response => {
      this.all_departments = response.data.departments;
      this.all_provinces = response.data.provinces;
      this.all_districts = response.data.districts;
    });

    this.$http
      .get(`/${this.resource}/prestamo/ver/` + this.$route.params.prestamo)
      .then(response => {
        console.log(response.data['prestamo']);

        this.form.cliente.departamento = response.data["cliente"]["departamento"];
        this.form.cliente.provincia = response.data["cliente"]["provincia"];
        this.form.cliente.distrito = response.data["cliente"]["distrito"];
        this.form.cliente.documento = response.data["cliente"]["documento"];
        this.form.natural.estado_civil = response.data["natural"]["estado_civil"];
        this.form.natural.ocupacion = response.data["natural"]["ocupacion"];
        this.form.natural.domicilio_distrito = response.data["natural"]["domicilio_distrito"];
        this.form.natural.domicilio_provincia = response.data["natural"]["domicilio_provincia"];
        this.form.natural.domicilio_departamento = response.data["natural"]["domicilio_departamento"];
        this.form.natural.telefono = response.data["natural"]["telefono"];
        this.form.natural.celular = response.data["natural"]["celular"];
        this.form.natural.nombres = response.data["natural"]["nombres"];
        this.form.natural.apellidos = response.data["natural"]["apellidos"];
        this.form.natural.nacimiento = response.data["natural"]["nacimiento"];
        this.form.natural.direccion = response.data["natural"]["direccion_cliente"];
        this.form.natural.referencia = response.data["natural"]["referencia"];
        this.form.natural.tipo_domicilio = response.data["natural"]["tipo_domicilio"];
        this.form.natural.centro_laboral = response.data["natural"]["centro_laboral"];
        this.form.natural.direccion_laboral = response.data["natural"]["direccion_laboral"];

        if (response.data["tiene_conyuge"]=='SI') {
          this.form.conyugue.documento_conyugue = response.data["conyugue"]["documento"];
          this.form.conyugue.nombres_conyugue =  response.data["conyugue"]["nombres"];
          this.form.conyugue.nacimiento_conyugue =  response.data["conyugue"]["nacimiento"];
          this.form.conyugue.estado_civil_conyugue =  response.data["conyugue"]["estado_civil"];
          this.form.conyugue.ocupacion_conyugue = response.data["conyugue"]["ocupacion"];
          this.form.conyugue.telefono_conyugue = response.data["conyugue"]["telefono"];
          this.form.conyugue.celular_conyugue = response.data["conyugue"]["celular"];
          this.form.conyugue.centro_laboral_conyugue = response.data["conyugue"]["centro_laboral"];
          this.form.conyugue.direccion_laboral_conyugue = response.data["conyugue"]["direccion"];
          this.form.conyugue.socio_conyugue = response.data["conyugue"]["socio"];
          this.form.conyugue.codigo_socio_conyugue = response.data["conyugue"]["codigo_socio"];
          this.form.conyugue.aporte_socio_conyugue = response.data["conyugue"]["aporte_socio"];
          this.form.conyugue.conyuge_tiene='SI';
        }else{
          this.form.conyugue.conyuge_tiene='NO';
        }

        this.form.monto_inicial=response.data['prestamo']['monto_inicial'];
        this.form.plazo_inicial=response.data['prestamo']['plazo_inicial'];
        this.form.disponibilidad_pago_inicial=response.data['prestamo']['disponibilidad_pago_inicial'];
        this.form.destino_inicial=response.data['prestamo']['destino_inicial'];
        this.form.forma_inicial=response.data['prestamo']['forma_inicial'];
        this.form.producto= response.data['prestamo']['producto'];
        this.form.forma=response.data['prestamo']['forma'];
        this.form.meses=response.data['prestamo']['meses'];
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
    next(index) {
       this.tab = index + 1;
    },
    prev(index) {
       this.tab = index - 1;
    },
    clickAddConyuge(){
      this.form.conyugue.conyuge_tiene='SI'
    },
    clickRemoveConyuge(){
      this.form.conyugue.conyuge_tiene='NO'
    },
    clickAddAval() {
      // this.contador_aval++;
      this.form.avals.push({
        documento: "",
        nombres: "",
        apellidos: "",
        nacimiento: "",
        estado_civil: "0",
        ocupacion: "",
        telefono: "",
        celular: "",
        direccion: "",
        distrito: "",
        centro_laboral: "",
        direccion_laboral: "",
        socio: 0,
        codigo_socio: "",
        aporte_socio: "",
        tipo_persona: 0
      });
    },
    meses_numero(){

        if(this.form.producto=='CREDIDIARIO'){
          console.log('diario')
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
        natural: {
          nombres: "",
          apellidos: "",
          nacimiento: "",
          estado_civil: "0",
          ocupacion: "",
          telefono: "",
          celular: "",
          direccion: "",
          referencia: "",
          tipo_domicilio: "",
          centro_laboral: "",
          direccion_laboral: "",
          domicilio_departamento: "",
          domicilio_provincia: "",
          domicilio_distrito: ""
        },
        conyugue: {
          documento_conyugue: "",
          nombres_conyugue: "",
          nacimiento_conyugue: "",
          estado_civil_conyugue: "0",
          ocupacion_conyugue: "",
          telefono_conyugue: "",
          celular_conyugue: "",
          centro_laboral_conyugue: "",
          direccion_laboral_conyugue: "",
          socio_conyugue: 0,
          codigo_socio_conyugue: "",
          aporte_socio_conyugue: "",
          conyuge_tiene: 0,
        },
        monto_inicial: "",
        plazo_inicial: "0",
        disponibilidad_pago_inicial: "",
        destino_inicial: "",
        forma_inicial: "0",
        producto: 0,
        forma: "0",
        meses: 0,
        importe: 0,
        aporte: 0,
        plazo: 0,
        coutas: 0,
        tasa: 0.0,
        comentarios: "",
        estado: "PENDIENTE",
      };
    },
    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.conyugue.documento_conyugue
        })
        .then(function(response) {
          console.log(response.data);
          me.form.conyugue.nombres_conyugue = response.data["nombres"] +' '+ response.data["surnames"];

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
        .post("/consulta/dni", {
          documento: this.form.avals[index].documento
        })
        .then(function(response) {
          console.log(response.data);
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
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }
      this.loading_submit=1;

      this.$http
        .post(`/${this.resource}/prestamo`, this.form)
        .then(response => {
          this.$toast.success(
            "El prestamo fue actualizado",
            "Exitoso",
            this.notificationSystem.options.success
          );
        this.loading_submit=0;
        this.retornar();
        })
        // .catch(error => {
        //   if (error.response.status === 422) {
        //     this.errors = error.response.data;
        //   } else {
        //     this.$message.error(error.response.data.message);
        //   }
        // })
        .then(() => {
          // this.loading_submit = false;
        });
    },
    retornar() {
      this.backMixin_handleBack('/perfil/'+this.form.cliente.documento );
    }
  },
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
