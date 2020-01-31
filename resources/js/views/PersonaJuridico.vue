<template>
    <div class="create_client_content">

      <section class="tabs_section">
        <div class="tabs_wrapper">
          <div class="tab " @click="tab = 1" :class="{selected: tab == 1}">
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
          <div  v-show="tab == 1" class="form_step"  >

            <div class="form_step_wrapper">

              <h3 class="title">
                Datos Personales
              </h3>
              <div class="form_content">
                <div class="group_form">
                
                  <div class="input_wrapper" >
                    <label>Ruc</label>
                    <input type="text"  v-model="form.cliente.documento" @keyup='getCompanyData(form.cliente.documento)' v-mask="'###########'"  />
                  </div>

                  <div class="input_wrapper" >
                    <label >Razon Social</label>
                    <input type="text" :maxlength="200" v-model="form.juridico.razon_social" placeholder />
                  </div>

                  <div class="input_wrapper" >
                    <label>Nombre Comercial</label>
                    <input type="text" :maxlength="200" v-model="form.juridico.nombre_comercial" placeholder />
                  </div>

                  <div class="input_wrapper" >
                    <label>Actividad Principal</label>
                    <input type="text" maxlength='200' v-model="form.juridico.actividad_principal" placeholder />
                  </div>

                  <div class="input_wrapper" >
                    <label>Nro. de Partida Registral</label>
                    <input type="number" v-mask="'########'" v-model="form.juridico.partida_registral"  />
                  </div>

                  <div class="input_wrapper" >
                    <label>Oficina Principal</label>
                    <input type="text" :maxlength="100" v-model="form.juridico.oficina_principal" placeholder />
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

                  <div class="input_wrapper"  >
                      <label>Dirección</label>
                      <input type="text" :maxlength="200"  v-model="form.juridico.direccion" />
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
                      <label>N° departamento</label>
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

          <div  v-show="tab == 2" class="form_step">
            <div class="form_step_wrapper">
              <div class="form_list no_border" >
                <div class="sub_step_wrapper"   v-for="(r, index) in form.representante" :key="index">
                  <h3 class="title">
                    Representante {{index + 1}}
                    <button v-if="index > 0" class="delete_section" type="button"  @click.prevent="clickRemoveRepresentante(index)">
                      <i class="material-icons-outlined"> delete </i>
                    </button>
                  </h3>
                  <div class="form_content">
                    <div class="group_form">
                      <div class="input_wrapper">
                        <label>Doc. Identidad</label>
                        <input type="text" @keyup='getPersonData(r)'  v-model="r.documento" v-mask="'########'" />
                      </div>

                      <div class="input_wrapper">
                        <label>Apellidos y Nombres</label>
                        <input type="text" :maxlength="60" v-model="r.nombres"  />
                      </div>
                      <div class="input_wrapper">
                        <label>Cargo</label>
                        <input type="text" :maxlength="15" v-model="r.cargo"  />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button"  @click="clickAddRepresentante"  class="add_section" >
                <span> AGREGAR REPRESENTANTE </span>
                <i class="fas fa-plus"></i> 
              </button>
            </div>
            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(2)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click="next(2)">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div>

          </div>

          <div v-show="tab == 3" class="form_step">
            <div class="form_step_wrapper">
              <div class="form_list no_border" >
                <div class="sub_step_wrapper"  v-for="(d, index) in form.director" :key="index">
                  <h3 class="title">
                    Director {{index + 1}}
                    <button v-if="index != 0" class="delete_section" type="button"  @click.prevent="clickRemoveDirector(index)">
                      <i class="material-icons-outlined"> delete </i>
                    </button>
                  </h3>
                  <div class="form_content">
                    <div class="group_form">
                      <div class="input_wrapper">
                        <label>Doc. Identidad</label>
                        <input type="number" @keyup='getPersonData(d)'  :maxlength="8" v-model="d.documento"/>
                      </div>
                      <div class="input_wrapper">
                        <label>Apellidos y Nombres</label>
                        <input type="text" :maxlength="60" v-model="d.nombres"/>
                      </div>
                      <div class="input_wrapper">
                        <label>Cargo</label>
                        <input type="text" :maxlength="15" v-model="d.cargo"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button"  @click="clickAddDirector"  class="add_section" >
                <span> AGREGAR DIRECTOR </span>
                <i class="fas fa-plus"></i> 
              </button>
            </div>
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

          <div v-show="tab == 4" class="form_step">
            <div class="form_step_wrapper">
              <div class="form_list no_border" >
                <div class="sub_step_wrapper" v-for="(a, index) in form.accionista" :key="index">
                  <h3 class="title">
                    Accionista {{index + 1}}
                    <button v-if="index != 0" class="delete_section" type="button"  @click.prevent="clickRemoveAccionista(index)">
                      <i class="material-icons-outlined"> delete </i>
                    </button>
                  </h3>
                  <div class="form_content">
                    <div class="group_form">
                      <div class="input_wrapper">
                        <label> Doc. Identidad </label>
                        <input type="number" @keyup='getPersonData(a)'  :maxlength="8" v-model="a.documento"/>
                      </div>
                      <div class="input_wrapper">
                        <label> Apellidos y Nombres </label>
                        <input type="text" :maxlength="60" v-model="a.nombres"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="button"  @click="clickAddAccionista"  class="add_section" >
                <span> AGREGAR ACCIONISTA </span>
                <i class="fas fa-plus"></i> 
              </button>
            </div>

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

          <div  v-show="tab == 5" class="form_step"  >

            <div class="form_step_wrapper">
              <h3 class="title">Obligaciones</h3>
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

          <div  v-show="tab == 6" class="form_step" >
            <div class="form_step_wrapper">
              <h3 class="title">Dejaración</h3>
              <div class="form_content">
                <div class="group_form">

                  <div class="input_wrapper all">
                    <label>Es sujeto a informar a la UIF Perú</label>
                      <select v-model="form.declaracion.uif" class="form-control">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
                <div class="group_form all">
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
        </div>
      </div>
                
  </div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
import VueNumeric from 'vue-numeric'

export default {
mixins: [serviceNumber],
  components: {VueNumeric}, 
  data() {
    return {
      resource: "clientes",
      clientes: [], 
      tipo_persona:'PJ',  
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
      tab: 1
    };
  },
  async created() {
    await this.initForm();
  },
  mounted () {
    this.clickAddRepresentante()
    this.clickAddDirector()
    this.clickAddAccionista()
  },
  methods: {
    getCompanyData(ruc){
      if(ruc.length==11){
          let me = this;
          axios
            .post("/consulta/doc", {
              documento: this.form.cliente.documento
            })
            .then(function(response) {          
              if(response.data){
                  me.form.juridico.razon_social=response.data.RAZON
                  me.form.juridico.nombre_comercial=response.data.NOMBRECOMERCIAL
                  me.form.juridico.direccion=response.data.DIRECCION
              }
            })
            .catch(function(error) {
              console.log(error);
        });
      }
    },
    getPersonData(person){
      if(person.documento.length==8){
          let me = this;
          axios
            .post("/consulta/doc", {
              documento: person.documento
            })
            .then(function(response) {          
              if(response.data){
                person.nombres=response.data.nombres
              }
            })
            .catch(function(error) {
              console.log(error);
        });
      }
    },
    next(index) {
      window.scrollTo(0,0)
      this.tab = index + 1
    },
    prev(index) {
      window.scrollTo(0,0)
      this.tab = index - 1
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
        .post("/consulta/doc", {
          documento: this.form.documento
        }) 
        .then(function(response) { 
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

            this.$router.push({ name: 'clientes'})
            
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
