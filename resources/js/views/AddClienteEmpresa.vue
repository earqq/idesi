<template>
    <div class="create_client_content">

      <section class="tabs_section">
        <div class="tabs_wrapper">
          <div class="tab " @click="tab = 1" :class="{selected: tab == 1}" >
            <span>1</span> 
            <p>PERSONALES</p>
          </div>
          <div class="tab" @click="validateStep1 ? tab = 2 : tabError()" :class="{selected: tab == 2}" >
            <span>2</span>
            <p>LEGALES</p>
          </div>
           
          <div class="tab" @click="validateStep1 ? tab = 3 : tabError()" :class="{selected: tab == 3}"  >
            <span>3</span>
            <p>DIRECTORES</p>
          </div>

          <div class="tab" @click="validateStep1 ? tab = 4 : tabError()" :class="{selected: tab == 4}"  >
            <span>4</span>
            <p>ACCIONISTAS</p>
          </div>

          <div class="tab" @click="validateStep1 ? tab = 5 : tabError()" :class="{selected: tab == 5}" >
            <span>5</span>
            <p>OBLIGACIONES</p>
          </div>


          <div class="tab" @click="validateStep1 ? tab = 6 : tabError()" :class="{selected: tab == 6}" >
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
                
                  <div class="input_wrapper" :class="{require: !validateRuc}" >
                    <label>Ruc</label>
                    <input type="text"  v-model="cliente.documento" @keyup='getCompanyData(cliente.documento)' v-mask="'###########'"  />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateRazon}">
                    <label >Razon Social</label>
                    <input type="text" maxlength="200" v-model="cliente.empresa.razon_social" placeholder />
                  </div>

                  <div class="input_wrapper" >
                    <label>Nombre Comercial</label>
                    <input type="text" maxlength="200" v-model="cliente.empresa.nombre_comercial" placeholder />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateActividad}">
                    <label>Actividad Principal</label>
                    <input type="text" maxlength='200' v-model="cliente.empresa.actividad_principal" placeholder />
                  </div>

                  <div class="input_wrapper" :class="{require: !validatePartida}">
                    <label>Nro. de Partida Registral</label>
                    <input type="number" max='2' v-model="cliente.empresa.partida_registral"  />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateOficina}">
                    <label>Oficina Principal</label>
                    <input type="text" maxlength="100" v-model="cliente.empresa.oficina_principal" placeholder />
                  </div>

                  <div class="input_wrapper">
                    <label>Tipo negocio</label>
                    <select v-model="cliente.empresa.tipo_negocio">
                      <option value="E.I.R.L">E.I.R.L</option>
                      <option value="S.A.C">S.A.C</option>
                      <option value="S.A">S.A</option>
                      <option value="ASOCIADOS">ASOCIADOS</option>
                      <option value="OTROS">OTROS</option>
                    </select>
                  </div>

                  <div class="input_wrapper"  :class="{require: !validateDireccion}">
                      <label>Dirección</label>
                      <input type="text" maxlength="200"  v-model="cliente.ubicacion_direccion_declarada" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validatePais}">
                    <label>País</label>
                    <input type="text" v-model="cliente.pais" maxlength="20
                    " />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateDistrito}">
                    <label>Distrito</label>
                    <input type="text" v-model="cliente.ubicacion_distrito" maxlength="100" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateProvincia}">
                    <label>Provincia</label>
                    <input type="text" v-model="cliente.ubicacion_provincia" maxlength="100" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateDepartamento}">
                    <label>Departamento</label>
                    <input type="text" v-model="cliente.ubicacion_departamento" maxlength="100" />
                  </div>

                </div>

                <span class="separator"></span>

                <div class="group_form">

                  <div class="input_wrapper">
                      <label>Número</label>
                      <input type="number" v-model="cliente.ubicacion_numero"  maxlength="10" />
                  </div>

                  <div class="input_wrapper">
                      <label>Manzana</label>
                      <input type="text" v-model="cliente.ubicacion_manzana"  maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>Lote</label>
                      <input type="number" v-model="cliente.ubicacion_lote"  maxlength="10" />
                  </div>

                  <div class="input_wrapper">
                      <label>N° departamento</label>
                      <input type="number" v-model="cliente.ubicacion_nro_departamento"  maxlength="10" />
                  </div>

                  <div class="input_wrapper">
                      <label>Interior</label>
                      <input type="number" v-model="cliente.ubicacion_interior" maxlength="10"  />
                  </div>

                  <div class="input_wrapper">
                      <label>Piso</label>
                      <input type="number" v-model="cliente.ubicacion_piso"  maxlength="10" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateReferencia}">
                    <label>Referencia</label>
                    <input type="text" maxlength="100" v-model="cliente.ubicacion_referencia" />
                  </div>

                  <div class="input_wrapper">
                    <label>Teléfono</label>
                    <input type="text" maxlength="15" v-model="cliente.telefono" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateCelular}">
                    <label>Celular</label>
                    <input
                      type="text"
                      v-model="cliente.celular"
                      v-mask="'### ### ###'"
                      />
                  </div>

                  <div class="input_wrapper"> 
                    <label>Email</label>
                    <input type="text" maxlength="45" v-model="cliente.email" />
                  </div>

                </div>
              </div>

            </div>

            <div class="form_buttons all">
                <a class="button_primary medium next" @click="validateStep1 ? next(1) : tabError()">
                  <span> SIGUIENTE </span>
                  <i class="material-icons-outlined"> navigate_next </i>
                </a>
              </div>
          </div>

          <div  v-show="tab == 2" class="form_step">
            <div class="form_step_wrapper">
              <div class="form_list no_border" >
                <div class="sub_step_wrapper"   v-for="(r, index) in cliente.empresa.representantes" :key="index">
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
                        <input type="text" @keyup='getPersonData(r)'  v-model="r.documento" v-mask="'#########'" />
                      </div>

                      <div class="input_wrapper">
                        <label>Apellidos y Nombres</label>
                        <input type="text" maxlength="100" v-model="r.nombres"  />
                      </div>
                      <div class="input_wrapper">
                        <label>Cargo</label>
                        <input type="text" maxlength="20" v-model="r.cargo"  />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button"  @click="clickAddRepresentante"  class="add_section" >
                <span> AGREGAR REPRESENTANTE </span>
                <i class="material-icons-outlined">add</i>  
              </button>
            </div>
            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(2)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click="validateStep1 ? next(2) : tabError()">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div>

          </div>

          <div v-show="tab == 3" class="form_step">
            <div class="form_step_wrapper">
              <div class="form_list no_border" >
                <div class="sub_step_wrapper"  v-for="(d, index) in cliente.empresa.directores" :key="index">
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
                        <input type="text" @keyup='getPersonData(d)'  v-mask="'#########'" v-model="d.documento"/>
                      </div>
                      <div class="input_wrapper">
                        <label>Apellidos y Nombres</label>
                        <input type="text" maxlength="100" v-model="d.nombres"/>
                      </div>
                      <div class="input_wrapper">
                        <label>Cargo</label>
                        <input type="text" maxlength="20" v-model="d.cargo"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button type="button"  @click="clickAddDirector"  class="add_section" >
                <span> AGREGAR DIRECTOR </span>
                <i class="material-icons-outlined">add</i>  
              </button>
            </div>
            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(3)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click="validateStep1 ? next(3) : tabError()">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div>
          </div>

          <div v-show="tab == 4" class="form_step">
            <div class="form_step_wrapper">
              <div class="form_list no_border" >
                <div class="sub_step_wrapper" v-for="(a, index) in cliente.empresa.accionistas" :key="index">
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
                        <input type="text" @keyup='getPersonData(a)' maxlength="9" v-model="a.documento" v-mask="'########'"/>
                      </div>
                      <div class="input_wrapper">
                        <label> Apellidos y Nombres </label>
                        <input type="text" maxlength="100" v-model="a.nombres"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <button type="button"  @click="clickAddAccionista"  class="add_section" >
                <span> AGREGAR ACCIONISTA </span>
                <i class="material-icons-outlined">add</i>  
              </button>
            </div>

            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(4)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click="validateStep1 ? next(4) : tabError()">
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
                      v-model="cliente.asociativa.inscripcion" 
                      v-bind:precision="2"
                    ></vue-numeric>
                  </div>
                  <div class="input_wrapper">
                    <label>Aporte</label>
                    <vue-numeric  currency="S/. " separator="," v-model="cliente.asociativa.aporte"  v-bind:precision="2"></vue-numeric>
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
              <a class="button_primary medium next" @click="validateStep1 ? next(5) : tabError()">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div> 


          </div>

          <div  v-show="tab == 6" class="form_step" >
            <div class="form_step_wrapper">
              <h3 class="title">Declaración</h3>
              <div class="form_content">
                <div class="group_form">

                  <div class="input_wrapper all">
                    <label>Es sujeto a informar a la UIF Perú</label>
                      <select v-model="cliente.declaracion.uif" class="form-control">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                  </div>
                </div>
                <div class="group_form all">
                  <div class="input_wrapper">
                    <label>Observaciones</label>
                    <textarea class="form-control" v-model="cliente.declaracion.observaciones" cols="auto" rows="5"></textarea>
                  </div>
                </div>

              </div>
            </div>  

            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(6)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click.prevent="validateStep1 ? registrar() : tabError()" :class="{loading: loading}">
                <div class="load_spinner"></div>
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
 import { toastOptions } from '../constants.js'

export default {
mixins: [serviceNumber],
  components: {VueNumeric},   
  data() {
    return {
      resource: "clientes",
      clientes: [], 
      tipo_documento:"RUC",
      documento:"",
      cliente:{
        documento: "",
        codigo: "",
        tipo_cliente: 2,
        pais: "",
        ubicacion_departamento: "",
        ubicacion_provincia: "",
        ubicacion_distrito: "",
        ubicacion_direccion_declarada:"",
        ubicacion_referencia: "",
        ubicacion_numero:"",
        ubicacion_manzana:"",
        ubicacion_lote:"",
        ubicacion_nro_departamento:"",
        ubicacion_interior:"",
        ubicacion_piso:"",
        telefono:"",
        celular:"",
        email:"",
        empresa:{
          razon_social:"",
          nombre_comercial:"",
          actividad_principal:"",
          partida_registral:"",
          oficina_principal:"",
          tipo_negocio:"E.I.R.L",
          
          representantes:[],
          directores:[],
          accionistas:[],
        },
        asociativa:{
          inscripcion: 30,
          aporte:"",
        },
        declaracion:{
          uif: "0",
          estado: 2,
          observaciones: "",
        }
      },
      loading: false,
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
    computed: {
    
    validateRuc() {
      return this.cliente.documento.length>10;
    },
    validateRazon() {
      return this.cliente.empresa.razon_social.length>3;
    },
    validateActividad() {
      return this.cliente.empresa.actividad_principal.length>4;
    },
    validatePartida() {
      return this.cliente.empresa.partida_registral.length>3;
    },
    validateDireccion() {
      return this.cliente.ubicacion_direccion_declarada.length>3;
    },
    validatePais() {
      return this.cliente.pais.length>3
    },
    validateDistrito() {
      return this.cliente.ubicacion_distrito.length>3;
    },
    validateProvincia() {
      return this.cliente.ubicacion_provincia.length>3;
    },
    validateDepartamento() {
      return this.cliente.ubicacion_departamento.length>3;
    },
    validateReferencia() {
      return this.cliente.ubicacion_referencia.length>3;
    },
    validateCelular() {
      return this.cliente.celular.length>3;
    },
    validateOficina() {
      return this.cliente.empresa.oficina_principal.length>3;
    },

    validateStep1(){
      return  this.validateRuc &&
              this.validateRazon &&
              this.validateActividad &&
              this.validatePartida &&
              this.validateDireccion &&
              this.validatePais &&
              this.validateDistrito &&
              this.validateProvincia &&
              this.validateDepartamento &&
              this.validateReferencia &&
              this.validateCelular &&
              this.validateOficina
    },




  },
  mounted () {
    this.clickAddRepresentante()
    this.clickAddDirector()
    this.clickAddAccionista()
  },
  methods: {
      tabError(){
       this.$toast.error(
          "Rellene los datos necesarios",
          "Error",
          toastOptions.error
        )
    },
    getCompanyData(ruc){
      if(ruc.length==11){
          let me = this;
          axios
            .post("/consulta/doc", {
              documento: this.cliente.documento
            })
            .then(function(response) {          
              if(response.data){
                  me.cliente.empresa.razon_social=response.data.RAZON
                  me.cliente.empresa.nombre_comercial=response.data.NOMBRECOMERCIAL
                  me.cliente.empresa.ubicacion_direccion_declarada=response.data.DIRECCION
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
                person.nombres=response.data.nombres +' '+response.data.apellido_paterno  +' '+ response.data.apellido_materno
                console.log(response.data)
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
    resetForm() {
      this.initForm();
    },

    clickAddRepresentante() {
      this.cliente.empresa.representantes.push({
          nombres: "",
          documento:"",
          cargo:"",
      });
    },

    clickAddDirector() {
      this.cliente.empresa.directores.push({
          nombres: "",
          documento:"",
          cargo:"",
      });
    },
    clickAddAccionista() {
      this.cliente.empresa.accionistas.push({
          nombres: "",
          documento:"",
      });
    },

    clickRemoveRepresentante(index) {
      this.cliente.empresa.representantes.splice(index, 1);
    },

    clickRemoveDirector(index) {
      this.cliente.empresa.directores.splice(index, 1);
    },
    clickRemoveAccionista(index) {
      this.cliente.empresa.accionistas.splice(index, 1);
    },

    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/doc", {
          documento: this.cliente.documento
        }) 
        .then(function(response) { 
          me.cliente.nombres = response.data["nombres"];
          me.cliente.apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
        //   me.initForm();
        });
    },

    registrar() {
     
     this.loading=true
      axios
        .post(`/empresas`, this.cliente)
        .then(response => {
            this.loading=false
            if(response.data.success){ 
                this.$toast.success(
                    "La solicitud fue registrada",
                    "Exitoso",
                    toastOptions.success
                  )
              this.$router.push({ name: 'clientes'})
            }else{
                this.loading=false
                this.$toast.error(
                  "Ya existe el cliente",
                  "Error",
                  toastOptions.error
                )
            }
        })
        .catch( err=>{
          this.loading=false
          this.$toast.error(
            "Error en el registro",
            "Error",
            toastOptions.error
          )
          console.error
        }
        )
    }
  }
};
</script>
