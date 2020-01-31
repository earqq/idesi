<template >
    <div class="create_client_content">
      <section class="tabs_section">
        <div class="tabs_wrapper">
          <div class="tab"  @click="tab = 1" :class="[{complete : validateStep1 }, {selected: tab == 1}]" >
            <span>1</span>
            <p>PRINCIPALES</p>
          </div>
          <div class="tab" @click="tab = 2" :class="{selected: tab == 2}" v-if="evaluacion.principal.fuente_ingreso!='TRANSPORTES' &&  evaluacion.principal.fuente_ingreso!='TRANSPORTE BAJAJ'">
            <span>2</span>
            <p>NEGOCIO</p>
          </div>
          <div class="tab" @click="tab = 2" :class="{selected: tab == 2}" v-else>
            <span>2</span>
            <p>TRANSPORTE</p>
          </div>
          <div class="tab" @click="tab = 3" :class="{selected: tab == 3}">
            <span>3</span>
            <p>FAMILIARES</p>
          </div>
          <div class="tab" @click="tab = 4" :class="{selected: tab == 4}">
            <span>4</span>
            <p>CENTRAL DE RIESGO</p>
          </div>
          <div class="tab" @click="tab = 5" :class="{selected: tab ==5}">
            <span>5</span>
            <p>REFERENCIAS</p>
          </div>
          <div class="tab" @click="tab = 6" :class="{selected: tab ==6}">
            <span>6</span>
            <p>COLATERAL</p>
          </div>
        </div>
      </section>

       <section class="client_forms">
          <div class="client_forms_wrapper">
            <div v-show="tab == 1" class="form_step">
              <div class="form_step_wrapper">
                <h3 class="title">Datos Principales</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Fuente de ingreso</label>
                      <v-select
                        label="giro_negocio"
                        :options="giros"
                        :reduce="giros => giros.giro_negocio"
                        v-model="evaluacion.principal.fuente_ingreso">
                        <span slot="no-options">
                          No se encontro giro de negocio
                        </span>
                      </v-select>
                    </div>
                    <div class="input_wrapper">
                      <label>Destino del credito</label>
                      <select v-model="evaluacion.principal.destino_credito">
                            <option value="Capital de trabajo">Capital de trabajo</option>
                            <option value="Activo Fijo">Activo Fijo</option>
                            <option value="Consumo">Consumo</option>
                            <option value="Vehiculo">Vehiculo</option>
                            <option value="Hipotecario">Hipotecario</option>
                            <option value="Mejoramiento de vivienda">Mejoramiento de vivienda</option>
                            <option value="Compra de deuda">Compra de deuda</option>
                          </select>
                    </div>
                  </div>
                  <div class="group_form all">
                    <div class="input_wrapper">
                      <label>Descripcion destino</label>
                      <textarea  v-model="evaluacion.principal.destino_credito_descripcion"></textarea>
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

                <h3 class="title" v-if="evaluacion.principal.fuente_ingreso!='TRANSPORTES' &&  evaluacion.principal.fuente_ingreso!='TRANSPORTE BAJAJ'">Datos del Negocio</h3>
                <h3 class="title" v-else>Datos del Vehiculo</h3>
                <div class="form_content">

                  <div class="group_form"  v-if="evaluacion.principal.fuente_ingreso!='TRANSPORTES' &&  evaluacion.principal.fuente_ingreso!='TRANSPORTE BAJAJ' ">

                        <div class="input_wrapper">
                          <label>Ubicacion del negocio</label>
                          <input type="text" v-model="evaluacion.negocio.ubicacion"  />
                        </div>
                        
                        <div class="input_wrapper">
                          <label>Antiguedad</label>
                          <select v-model="evaluacion.negocio.antiguedad" >
                            <option value="MENOS DE 1 AÑO">Menos de 1 año</option>
                            <option value="1 AÑO">1 año</option>
                            <option value="2 AÑOS">2 años</option>
                            <option value="3 AÑOS">3 años</option>
                            <option value="4 AÑOS">4 años</option>
                            <option value="5 AÑOS">5 años</option>
                            <option value="6 MÁS DE 5 AÑOS">Más de 5 años</option>
                          </select>
                        </div>

                        <div class="input_wrapper">
                          <label>Local</label>
                          <select v-model="evaluacion.negocio.local" >
                            <option value="PROPIO">Propio</option>
                            <option value="ALQUILADO">Alquilado</option>
                            <option value="MODULO V. PUBLICO">Módulo V. pública</option>
                            <option value="FAMILIAR">Familiar</option>
                            <option value="HIPOTECA/ANTICRISIS">HipoteaA/anticresis</option>
                          </select>
                        </div>

                        <div class="input_wrapper">
                          <label>Licencia de Funcionamiento</label>
                          <select  v-model="evaluacion.negocio.licencia_funcionamiento" >
                            <option value="SI CUENTA">Si cuenta</option>
                            <option value="NO CUENTA">No cuenta</option>
                          </select>
                        </div>

                        <div class="input_wrapper">
                          <label>Realizo mejoras en el local</label>
                          <select v-model="evaluacion.negocio.mejoras_local" >
                            <option value="SI REALIZO">Si realizo</option>
                            <option value="NO REALIZO">No realizo</option>
                          </select>
                        </div>

                        <div class="input_wrapper">
                          <label>Horario de atención entrada</label>
                          <input type='time' v-model='evaluacion.negocio.horario_atencion_inicio' >
                        </div>

                        <div class="input_wrapper">
                          <label>Horario de atención salida</label>
                          <input type='time' v-model='evaluacion.negocio.horario_atencion_salida' >
                        </div>

                  </div>

                  <div class="group_form" v-else>

                        <div class="input_wrapper">
                          <label>Marca</label>
                          <input type="text" v-model="evaluacion.vehiculo.marca"  />
                        </div>
                        
                        <div class="input_wrapper">
                          <label>Modelo</label>
                          <input type="text" v-model="evaluacion.vehiculo.modelo"  />
                        </div>

                        <div class="input_wrapper">
                          <label>Año fabricación</label>
                          
                          <select v-model="evaluacion.vehiculo.año" >
                            <option value="1995">1995</option>
                            <option value="1996">1996</option>
                            <option value="1997">1997</option>
                            <option value="1998">1998</option>
                            <option value="1999">1999</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                          </select>
                        </div>

                        <div class="input_wrapper">
                          <label>Tipo servicio que brinda</label>
                          <input type="text" v-model="evaluacion.vehiculo.tipo_servicio_brinda"  />
                        </div>

                        <div class="input_wrapper">
                          <label>Antiguedad realizando el servicio</label>
                          <input type="text" v-model="evaluacion.vehiculo.antiguedad_servicio"  />
                        </div>

                        <div class="input_wrapper">
                          <label>Permiso para brindar servicio</label>
                          <select v-model="evaluacion.vehiculo.permiso_servicio" >
                            <option value="SI CUENTA">Si cuenta</option>
                            <option value="NO CUENTA">No cuenta</option>
                          </select>
                        </div>

                        <div class="input_wrapper">
                          <label>Horario trabajo inicio</label>
                          <input type='time' v-model="evaluacion.vehiculo.horario_servicio_inicio">
                        </div>

                        <div class="input_wrapper">
                          <label>Horario trabajo inicio</label>
                          <input type='time' v-model="evaluacion.vehiculo.horario_servicio_fin" >
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
                <h3 class="title">Información Familiar</h3>
                <div class="form_content">
                  <div class="group_form"  >
                    <div class="input_wrapper">
                      <label>Tipo de vivienda</label>
                      <select v-model="evaluacion.familiar.tipo_vivienda" >
                        <option value="PROPIA CANCELADA">Propia Cancelada</option>
                        <option value="PROPIA (HIPOTECA)">Propia (hipoteca)</option>
                        <option value="DE LOS PADRES">De los padres</option>
                        <option value="DE FAMILIARES">De familiares</option>
                        <option value="ALQUILADA">Alquilada</option>
                      </select>
                    </div>
                    
                    <div class="input_wrapper">
                      <label>Situacion familiar</label>
                      <select v-model="evaluacion.familiar.situacion_familiar" >
                        <option value="SOLTERO">Soltero</option>
                        <option value="CASADO">Casado</option>
                        <option value="CONVIVIENTE">Conviviente</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                      <label>Miembros de familia</label>
                      <input  type="number" v-model="evaluacion.familiar.miembros_familia"  disabled />
                    </div>
                  </div>
                </div>

                <div class="form_list" >
                    <div class="sub_step_wrapper" v-for="(hijo, index) in evaluacion.familiar.hijos" :key="index">
                      <h3 class="title">
                        Hijo {{index + 1}}
                      </h3>
                      <div class="form_content">
                        <div class="group_form">

                          <div class="input_wrapper">
                            <label>Edad</label>
                            <input type="text" v-model="hijo.edad" />
                          </div>

                          <div class="input_wrapper">
                            <label>Colegio</label>
                            <select
                              v-model="hijo.colegio"
                                @change="seleccionColegiosCosto(index)"
                              >
                                <option
                                  v-for="(colegio,index) in colegios"
                                  v-bind:value="colegio.nombre"
                                  :key="index"
                                >{{ colegio.nombre }}</option>
                              </select>
                          </div>

                          <div class="input_wrapper">
                            <label>Grado</label>
                            <select
                                v-model="hijo.grado"
                                @change="seleccionColegiosCosto(index)"
                              >
                                <option value="INICIAL">INICIAL</option>
                                <option value="PRIMARIA">PRIMARIA</option>
                                <option value="SECUNDARIA">SECUNDARIA</option>
                              </select>
                          </div>

                          <div class="input_wrapper">
                            <label>Costo</label>
                                <input
                                type="text"
                                :value="'S/. '+hijo.costo"
                                disabled
                              />
                          </div>

                        </div>
                      </div>
                    </div>
                </div>
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
                <div class="form_list no_border" >
                    <div class="sub_step_wrapper" v-for="(entidad_financiera, index) in evaluacion.central_riesgo" :key="index">
                      <h3 class="title">
                        Entidad Financiera {{index + 1}} 
                        <button
                            v-if="index > 0"
                            class="delete_section"
                            type="button"
                            @click="clickRemoveFinanciera(index)"
                            >
                            <i class="material-icons-outlined">delete</i>
                        </button> 
                      </h3>
                      <div class="form_content">
                        <div class="group_form">

                          <div class="input_wrapper">
                            <label>Entidad</label>
                            <v-select
                              label="nombre"
                              :options="entidades"
                              :reduce="entidades => entidades.nombre"
                              v-model="entidad_financiera.entidad_financiera">
                              <span slot="no-options">
                                No se encontro giro de negocio
                              </span>
                              </v-select> 
                          </div>
                        </div>

                        <div class="group_form">
                          <div class="input_box no_label ">
                            <div class="input_box_wrapper">
                              <div class="input_checkbox_wrapper" >
                                <input type="checkbox" :id="'checkbox'+index" v-model="entidad_financiera.capital" />
                                <label class="box_content" :for="'checkbox'+index">
                                  <div class="box">
                                  </div>
                                  <span>Capital de trabajo</span>
                                </label>
                              </div>
                              <div class="input_checkbox_wrapper" >
                                <input type="checkbox" :id="'checkbox2'+index" v-model="entidad_financiera.activo_f" />
                                <label class="box_content" :for="'checkbox2'+index">
                                  <div class="box">
                                  </div>
                                  <span>Activo Fijo</span>
                                </label>
                              </div>
                              <div class="input_checkbox_wrapper" >
                                <input type="checkbox" :id="'checkbox3'+index" v-model="entidad_financiera.consumo" />
                                <label class="box_content" :for="'checkbox3'+index">
                                  <div class="box">
                                  </div>
                                  <span>Consumo</span>
                                </label>
                              </div>
                              <div class="input_checkbox_wrapper" >
                                <input type="checkbox" :id="'checkbox4'+index" v-model="entidad_financiera.vehicular" />
                                <label class="box_content" :for="'checkbox4'+index">
                                  <div class="box">
                                  </div>
                                  <span>Vehicular</span>
                                </label>
                              </div>
                              <div class="input_checkbox_wrapper" >
                                <input type="checkbox" :id="'checkbox5'+index" v-model="entidad_financiera.hipoteca" />
                                <label class="box_content" :for="'checkbox5'+index">
                                  <div class="box">
                                  </div>
                                  <span>Hipotecario</span>
                                </label>
                              </div>
                              <div class="input_checkbox_wrapper" >
                                <input type="checkbox" :id="'checkbox6'+index" v-model="entidad_financiera.terceros" />
                                <label class="box_content" :for="'checkbox6'+index">
                                  <div class="box">
                                  </div>
                                  <span>Terceros</span>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>

                <button type="button"    class="add_section" @click="clickAddFinanciera" >
                  <span> AGREGAR ENTIDAD FINANCIERA </span>
                  <i class="material-icons-outlined">add</i>  
                </button>
              </div>
              
              <div class="form_step_wrapper in_bottom">
                <h3 class="title">Situacion de Entidades</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Comentarios</label>
                      <textarea class="form-control" v-model="evaluacion.comentario_central_riesgo"></textarea>
                    </div>
                  </div>
                </div>
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
                  <div class="form_list no_border">
                      <div class="sub_step_wrapper" v-for="(referencia, index) in evaluacion.referencias" :key="index">
                        <h3 class="title">
                          Referencia  {{index + 1}}
                          <button
                            v-if="index > 0"
                            class="delete_section"
                            type="button"
                            @click.prevent="clickRemoveReferencia(index)">
                            <i class="material-icons-outlined">delete</i>
                          </button>
                        </h3>
                        <div class="form_content">
                          <div class="group_form">

                            <div class="input_wrapper">
                              <label>Tipo de relación</label>
                              <input v-model="referencia.tipo_relacion" type="text" placeholder="Familiares, compañeros de trabajo, vecinos" />
                            </div>

                            <div class="input_wrapper">
                              <label>Nombre</label>
                              <input v-model="referencia.nombre" type="text" />
                            </div>
                            <div class="input_wrapper">
                              <label>Telefono</label>
                              <input v-model="referencia.telefono" type="text" />
                            </div>

                          </div>
                        </div>
                      </div>
                  </div>
                  <button type="button"    class="add_section"  @click="clickAddReferencia">
                    <span> AGREGAR REFERENCIA </span>
                    <i class="material-icons-outlined">add</i>  
                  </button>
                </div>

                <div class="form_buttons">
                  <a class="button_inline_primary medium prev" @click="prev(5)">
                    <i class="material-icons-outlined">navigate_before</i>
                    <span>ATRAS</span>
                  </a>
                  <a class="button_primary medium next" @click="next(5)">
                    <span>SIGUIENTE</span>
                    <i class="material-icons-outlined">navigate_next</i>
                  </a>
                </div>

            </div>

            <div v-show="tab == 6" class="form_step">
              <div class="form_step_wrapper">
                <h3 class="title">Colateral</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Colateral</label>
                      <select v-model="evaluacion.colateral">
                        <option value="AVAL CON CASA PROPIA">Aval con casa propia</option>
                        <option value="AVAL CON CASA ALQUILADA">Aval con casa alquilada</option>
                        <option value="GARANTIA LIQUIDA ">Garantia liquida </option>
                        <option value="GARANTIA VEHICULAR">Garantia vehicular</option>
                        <option value="HIPOTECA INMOBILIRARIA">Hipoteca inmobiliara</option>
                        <option value="SIN COLATERAL">Sin colateral</option>
                      </select>
                    </div>
                  </div>
                  <div class="group_form all">
                    <div class="input_wrapper">
                      <label>Comentarios</label>
                      <textarea v-model="evaluacion.comentario_colateral"> </textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form_buttons">
                <a class="button_inline_primary medium prev" @click="prev(6)">
                  <i class="material-icons-outlined">navigate_before</i>
                  <span>ATRAS</span>
                </a>
                <a class="button_primary medium next" @click.prevent="guardar()">
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
import vSelect from "vue-select";
import { serviceNumber } from "../mixins/functions";
 
export default {
  mixins: [serviceNumber],
  components: {
    vSelect
  },
  data() {
    return {
      giros: [],
      entidades: [],
      tab: 1,
      notificationSystem: {
        options: {
          success: {
            position: "topRight"
          },
          error: {
            position: "topRight"
          }
        }
      },
      colegios: [],
      i: 0,
      loading_submit:0,
      evaluacion: {
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
          miembros_familia: 1,
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
  methods: {
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
    guardar() {
      this.loading_submit=1
      axios.post("/evaluaciones/cualitativa", this.evaluacion).then(res => {
        this.loading_submit=0
        this.$toast.success(
            "La evaluación fue realizada",
            "Exitoso",
            this.notificationSystem.options.success
          ) 
            this.$router.push({ name: 'perfil', params: { documento: this.$route.params.documento, persona: this.$route.params.persona}})
      });
    }, 
    seleccionColegiosCosto(index) {
      this.$http
        .get(
          `/evaluaciones/colegio/costo?grado=` +
            this.evaluacion.familiar.hijos[index].grado +
            `&colegio=` +
            this.evaluacion.familiar.hijos[index].colegio
        )
        .then(response => {
          this.evaluacion.familiar.hijos[index].costo = response.data.costo;
        });
      // console.log(this.evaluacion.familiar.hijos[index].grado)
    }
  },
  async mounted() {
 
    this.$http.get(`/evaluaciones/giro`).then(response => {
      this.giros = response.data;
    });
    this.$http.get(`/evaluaciones/prestamos/detalle/`+this.$route.params.prestamo).then(response => {
      this.evaluacion.principal.destino_credito_descripcion=response.data.prestamo.destino_inicial
    });
    this.$http.get(`/evaluaciones/entidades`).then(response => {
      this.entidades = response.data;
    });

    this.$http.get(`/evaluaciones/colegio`).then(response => {
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

    this.$http 
      .get(`/evaluaciones/numerohijos/` + this.$route.params.prestamo)
      .then(response => {
        if(response.data){

          this.evaluacion.familiar.numero_hijos = response.data.numero;
          this.evaluacion.familiar.miembros_familia = this.evaluacion.familiar.numero_hijos;
          for (
            this.i = 0;
            this.i < this.evaluacion.familiar.numero_hijos;
            this.i++
          ) {
            this.evaluacion.familiar.hijos.push({
              edad: "",
              colegio: "PRINCIPITO",
              grado: "INICIAL",
              costo: 0
            });
            this.seleccionColegiosCosto(this.i)
          }
        }
      });
  }
};
</script>  