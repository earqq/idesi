<template>
    <div class="create_client_content">

      <section class="tabs_section">
        <div class="tabs_wrapper">
          <div class="tab " @click="tab = 1" :class="[{complete : validateStep1 },{selected: tab == 1}]">
            <span>1</span> 
            <p>PERSONALES</p>
          </div>
          <div class="tab" @click="tab = 2" :class="{selected: tab == 2}">
            <span>2</span>
            <p>LEGALES</p>
          </div>
          <div class="tab" @click="tab = 3" :class="{selected: tab == 3}">
            <span>3</span>
            <p>DIRECTORES</p>
          </div>
          <div class="tab" @click="tab = 4" :class="{selected: tab == 4}">
            <span>4</span>
            <p>ACCIONISTAS</p>
          </div>
          <div class="tab" @click="tab = 5" :class="{selected: tab == 5}">
            <span>5</span>
            <p>OBLIGACIONES</p>
          </div>
          <div class="tab" @click="tab = 6" :class="{selected: tab == 6}">
            <span>6</span>
            <p>DECLARACIÓN</p>
          </div>
        </div>
      </section>

      <div class="client_forms">

        <div class="client_forms_wrapper">
          
          <transition name="slide-fade" mode="in-out">
            <div  v-show="tab == 1" class="form_step"  >

              <div class="form_step_wrapper">

                <h3 class="title">
                  Datos Personales
                </h3>
                <div class="form_content">
                  <div class="group_form">
                  
                    <div class="input_wrapper" :class="{require: !validateRuc}">
                      <label>Ruc</label>
                      <input type="text"  v-model="form.cliente.documento"  v-mask="'###########'"  />
                      <div class="message">Ruc no valido</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateRazon}">
                      <label >Razon Social</label>
                      <input type="text" :maxlength="45" v-model="form.juridico.razon_social" placeholder />
                      <div class="message">razón social muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateComercial}">
                      <label>Nombre Comercial</label>
                      <input type="text" :maxlength="45" v-model="form.juridico.nombre_comercial" placeholder />
                      <div class="message">nombre comercial muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateActividad}">
                      <label>Actividad Principal</label>
                      <input type="text" :maxlength="30" v-model="form.juridico.actividad_principal" placeholder />
                      <div class="message">actividad muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validatePartida}">
                      <label>Nro. de Partida Registral</label>
                      <input type="number" v-model="form.juridico.partida_registral" placeholder />
                      <div class="message">partida registral muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateOficina}">
                      <label>Oficina Principal</label>
                      <input type="text" :maxlength="11" v-model="form.juridico.oficina_principal" placeholder />
                      <div class="message">nombre de oficina muy corto</div>
                    </div>

                    <div class="input_wrapper">
                      <label>P.N con negocio</label>
                      <select v-model="form.juridico.tipo_negocio">
                        <option value="E.I.R.L">E.I.R.L</option>
                        <option value="S.A.C">S.A.C</option>
                        <option value="S.A">S.A</option>
                        <option value="ASOCIADOS">ASOCIADOS</option>
                        <option value="OTROS">OTROS</option>
                      </select>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateDireccion}">
                        <label>Dirección</label>
                        <input type="text" :maxlength="45"  v-model="form.juridico.direccion" />
                        <div class="message">dirección muy corto</div>
                    </div>

                    <div class="input_wrapper">
                      <label>País</label>
                      <input type="text" v-model="form.cliente.pais" :maxlength="15" />
                    </div>

                    <div class="input_wrapper">
                      <label>Distrito</label>
                      <input type="text" v-model="form.cliente.distrito" :maxlength="45" />
                    </div>

                    <div class="input_wrapper">
                      <label>Provincia</label>
                      <input type="text" v-model="form.cliente.provincia" :maxlength="45" />
                    </div>

                    <div class="input_wrapper">
                      <label>Departamento</label>
                      <input type="text" v-model="form.cliente.departamento" :maxlength="45" />
                    </div>

                  </div>

                  <span class="separator"></span>

                  <div class="group_form">

                    <div class="input_wrapper">
                        <label>Número</label>
                        <input type="text" v-model="form.juridico.numero"  :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Manzana</label>
                        <input type="text" v-model="form.juridico.manzana"  :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Lote</label>
                        <input type="text" v-model="form.juridico.lote"  :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Departamento</label>
                        <input type="text" v-model="form.juridico.pdto"  :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Interior</label>
                        <input type="text" v-model="form.juridico.int" :maxlength="5"  />
                    </div>

                    <div class="input_wrapper">
                        <label>Piso</label>
                        <input type="text" v-model="form.juridico.piso"  :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                      <label>Referencia</label>
                      <input type="text" :maxlength="45" v-model="form.juridico.referencia" />
                    </div>

                    <div class="input_wrapper">
                      <label>Teléfono</label>
                      <input type="text" :maxlength="15" v-model="form.juridico.telefono" />
                    </div>

                    <div class="input_wrapper">
                      <label>Celular</label>
                      <input
                        type="text"
                        v-model="form.juridico.celular"
                        v-mask="'### ### ###'"
                        />
                    </div>

                    <div class="input_wrapper"> 
                      <label>Email</label>
                      <input type="text" :maxlength="45" v-model="form.juridico.email" />
                    </div>

                  </div>
                </div>

              </div>

              <div class="form_buttons">
                  <a class="button_primary medium next" @click="next(1)">
                    <span> SIGUIENTE </span>
                    <i class="material-icons-outlined"> navigate_next </i>
                  </a>
                </div>
            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div  v-show="tab == 2" class="form_step">
              <div class="form_list" :class="{list_round: form.representante.length > 0}">
                <div class="form_step_wrapper"   v-for="(row, index) in form.representante" :key="index">
                  <h3 class="title">
                    Representante {{index + 1}}
                    <button  class="delete_section" type="button"  @click.prevent="clickRemoveRepresentante(index)">
                      <i class="material-icons-outlined"> delete </i>
                    </button>
                  </h3>
                  <div class="form_content">
                    <div class="group_form">
                      <div class="input_wrapper">
                        <label>Cargo</label>
                        <input type="text" :maxlength="15" v-model="row.cargo"  />
                      </div>

                      <div class="input_wrapper">
                        <label>Doc. Identidad</label>
                        <input type="text"   v-model="row.documento" v-mask="'########'" />
                      </div>

                      <div class="input_wrapper">
                        <label>Apellidos y Nombres</label>
                        <input type="text" :maxlength="60" v-model="row.nombres"  />
                      </div>
                      
                      

                      
                    </div>
                  </div>
                </div>
              </div>

              <button type="button"  @click="clickAddRepresentante"  class="add_section" >
                <span> AGREGAR REPRESENTANTE </span>
                <i class="fas fa-plus"></i> 
              </button>

              <div class="form_buttons">
                <a class="button_inline_primary medium prev" @click="prev(3)">
                  <i class="material-icons-outlined"> navigate_before </i>
                  <span> ATRAS </span>
                </a>
                <a class="button_primary medium next" @click="next(3)">
                  <span> SIGUIENTE </span>
                  <i class="material-icons-outlined"> navigate_next </i>
                </a>
              </div>

            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 3" class="form_step">

                <div class="form_list" :class="{list_round: form.director.length > 0}">
                      <div class="form_step_wrapper"   v-for="(row, index) in form.director" :key="index">
                        <h3 class="title">
                          Director {{index + 1}}
                          <button  class="delete_section" type="button"  @click.prevent="clickRemoveDirector(index)">
                            <i class="material-icons-outlined"> delete </i>
                          </button>
                        </h3>
                        <div class="form_content">
                          <div class="group_form">

                            <div class="input_wrapper">
                              <label>Cargo</label>
                              <input type="text" :maxlength="15" v-model="row.cargo"  />
                            </div>

                            <div class="input_wrapper">
                              <label>Doc. Identidad</label>
                              <input type="text"  v-model="row.documento" v-mask="'########'" />
                            </div>

                            <div class="input_wrapper">
                              <label>Apellidos y Nombres</label>
                              <input type="text" :maxlength="60" v-model="row.nombres"  />
                            </div>
                            
                     
                            

                          </div>
                        </div>
                      </div>
                    </div>

                    <button type="button"  @click="clickAddDirector"  class="add_section" >
                      <span> AGREGAR DIRECTOR </span>
                      <i class="fas fa-plus"></i> 
                    </button>

                    <div class="form_buttons">
                      <a class="button_inline_primary medium prev" @click="prev(3)">
                        <i class="material-icons-outlined"> navigate_before </i>
                        <span> ATRAS </span>
                      </a>
                      <a class="button_primary medium next" @click="next(3)">
                        <span> SIGUIENTE </span>
                        <i class="material-icons-outlined"> navigate_next </i>
                      </a>
                    </div>
            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 4" class="form_step">

              <div class="form_list" :class="{list_round: form.accionista.length > 0}">
                      <div class="form_step_wrapper"   v-for="(row, index) in form.accionista" :key="index">
                        <h3 class="title">
                          Director {{index + 1}}
                          <button  class="delete_section" type="button"  @click.prevent="clickRemoveAccionista(index)">
                            <i class="material-icons-outlined"> delete </i>
                          </button>
                        </h3>
                        <div class="form_content">
                          <div class="group_form">

                            <div class="input_wrapper">
                              <label>Doc. Identidad</label>
                              <input type="text"  v-model="row.documento" v-mask="'########'" />
                            </div>

                            <div class="input_wrapper">
                              <label>Apellidos y Nombres</label>
                              <input type="text" :maxlength="60" v-model="row.nombres"  />
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <button type="button"  @click="clickAddAccionista"  class="add_section" >
                      <span> AGREGAR ACCIONISTA </span>
                      <i class="fas fa-plus"></i> 
                    </button>

                    <div class="form_buttons">
                      <a class="button_inline_primary medium prev" @click="prev(4)">
                        <i class="material-icons-outlined"> navigate_before </i>
                        <span> ATRAS </span>
                      </a>
                      <a class="button_primary medium next" @click="next(4)">
                        <span> SIGUIENTE </span>
                        <i class="material-icons-outlined"> navigate_next </i>
                      </a>
                    </div> 

            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div  v-show="tab == 5" class="form_step"  >

            <div class="form_step_wrapper">
              <h3 class="title">Oblicaciones</h3>
              <div class="form_content">
                <div class="group_form">
                  <div class="input_wrapper">
                    <label>Inscripcion</label>
                    <vue-numeric
                      currency="S/. "
                      separator=","
                      v-model="form.asociativa.inscripcion" 
                      v-bind:precision="2"
                    ></vue-numeric>
                  </div>
                  <div class="input_wrapper">
                    <label>Aporte</label>
                    <vue-numeric  currency="S/. " separator="," v-model="form.asociativa.aporte"  v-bind:precision="2"></vue-numeric>
                  </div>
                </div>
                <span class="separator"></span>
              </div>
            </div>  

            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(5)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click="next(5)">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div> 


            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div  v-show="tab == 6" class="form_step" >
              <div class="form_step_wrapper">
              <h3 class="title">Dejaración</h3>
              <div class="form_content">
                  <div class="group_form">

                    <div class="input_wrapper">
                      <label>Es sujeto a informar a la UIF Perú</label>
                       <select v-model="form.declaracion.uif" class="form-control">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                      <label>Estado</label>
                      <select v-model="form.declaracion.estado" class="form-control">
                        <option value="ADMITIDO">ADMITIDO</option>
                        <option value="RECHAZADO">RECHAZADO</option>
                      </select>
                    </div>
                  </div>
                  <span class="separator"></span>

                  <div class="group_form">
                     <div class="input_wrapper">
                      <label>Observaciones</label>
                      <textarea class="form-control" v-model="form.declaracion.observaciones" cols="auto" rows="5"></textarea>
                    </div>
                  </div>

                </div>
              </div>  

            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(6)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click.prevent="submit()">
                <span> FINALIZAR </span>
                <i class="material-icons-outlined">check</i>
              </a>
            </div> 

            </div>
          </transition>

        </div>
      </div>
                
  </div>
</template>

<script>
import DatePick from 'vue-date-pick';
import "vue-date-pick/dist/vueDatePick.css";
import { serviceNumber } from "../mixins/functions";
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
  components: { DatePick,VueNumeric}, 
  data() {
    return {
      resource: "clientes",
      clientes: [],
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      tipo_persona:'PJ',
      loading_submit:'0',
      provinces: [],
      districts: [],
      form: {},
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
      mesEs: mesConf,
      diaEs: diaConf,
      tab: 1
    };
  },
  async created() {
    await this.initForm();
  },
  computed: {

    validateRuc () {
      return this.form.cliente.documento.length == 11
    },
    validateRazon () {
      return this.form.juridico.razon_social.length > 6
    }, 
    validateComercial () {
      return this.form.juridico.nombre_comercial.length > 6
    },  
    validateActividad () {
      return this.form.juridico.actividad_principal.length > 6
    }, 
    validatePartida () {
      return this.form.juridico.partida_registral.length > 2
    }, 
    validateOficina () {
      return this.form.juridico.oficina_principal.length > 4
    }, 
    validateDireccion () {
      return this.form.juridico.direccion.length > 6
    }, 

    validateStep1 () {
      return this.validateRuc && this.validateRazon && this.validateComercial && this.validateActividad && this.validatePartida && this.validateOficina && this.validateDireccion
    }



  },
  mounted () {
    this.clickAddRepresentante()
    this.clickAddDirector()
    this.clickAddAccionista()
  },
  methods: {

    next(index) {
      this.tab = index + 1;
    },
    prev(index) {
     this.tab = index - 1;
    },

    initForm() {
      this.form = {
        cliente:{
          tipo_documento: 0,
          documento: "",
          codigo: "",
          tipo_cliente: this.tipo_persona,
          pais: "",
          departamento: "",
          provincia: "",
          distrito: "",
          numero_registro: "",
          agencia: ""
        },
        juridico:{
          razon_social:"",
          nombre_comercial:"",
          actividad_principal:"",
          partida_registral:"",
          oficina_principal:"",
          tipo_negocio:"E.I.R.L",
          direccion:"",
          referencia: "",
          numero:"",
          manzana:"",
          lote:"",
          pdto:"",
          int:"",
          piso:"",
          telefono:"",
          celular:"",
          email:"",
        },
        representante:[],
        director:[],
        accionista:[],
        asociativa:{
          inscripcion: "",
          aporte:"",
        },
        declaracion:{
          uif: "NO",
          estado: "ADMITIDO",
          observaciones: "",
        },
      };
    },
    resetForm() {
      this.initForm();
    },

    clickAddRepresentante() {
      this.form.representante.push({
          nombres: "",
          documento:"",
          cargo:"",
      });
    },

    clickAddDirector() {
      this.form.director.push({
          nombres: "",
          documento:"",
          cargo:"",
      });
    },
    clickAddAccionista() {
      this.form.accionista.push({
          nombres: "",
          documento:"",
      });
    },

    clickRemoveRepresentante(index) {
      this.form.representante.splice(index, 1);
    },

    clickRemoveDirector(index) {
      this.form.director.splice(index, 1);
    },
    clickRemoveAccionista(index) {
      this.form.accionista.splice(index, 1);
    },

    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.documento
        }) 
        .then(function(response) {
          console.log(response.data);
          me.form.nombres = response.data["nombres"];
          me.form.apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
        //   me.initForm();
        });
    },

    submit() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }
      this.loading_submit=1;
      axios
        .post(`/${this.resource}/nuevo/juridico`, this.form)
        .then(response => {
          if (response.data.success) { 
            this.resetForm();
            this.$toast.success(
              "La solicitud fue admitida",
              "Exitoso",
              this.notificationSystem.options.success
            );
            this.loading_submit=0;
            
          } else {
            // this.resetForm();
            this.$toast.error(
              "El cliente ya existe!",
              "Error",
              this.notificationSystem.options.error
            );
          }
        })
        .catch(console.error)
    }
  }
};
</script>

<style lang="scss" scoped>
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
