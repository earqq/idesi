<template>
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 p-0">
        <div class="nav-tabs style-tab-menu">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item col-md-2">
              <a class="nav-link active text-center " id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true" >Datos Personales</a>
            </li>

            <li class="nav-item col-md-2">
              <a class="nav-link text-center" id="representantes-tab" data-toggle="tab" href="#representantes"  role="tab" aria-controls="representantes" aria-selected="false" >Representantes Legales</a>
            </li>
            <li class="nav-item col-md-2">
              <a class="nav-link text-center" id="director-tab"  data-toggle="tab" href="#director" role="tab" aria-controls="director" aria-selected="false" >Principales Directores</a>
            </li>
            <li class="nav-item col-md-2">
              <a  class="nav-link text-center" id="accionista-tab" data-toggle="tab"  href="#accionista"   role="tab" aria-controls="accionista" aria-selected="false" >Principales Accionistas</a>
            </li>
            <li class="nav-item col-md-2">
              <a class="nav-link text-center"  id="asociativa-tab"  data-toggle="tab"  href="#asociativa" role="tab" aria-controls="asociativa"  aria-selected="false" >Obligaciones asociativas</a>
            </li>
            <li class="nav-item col-md-2">
              <a  class="nav-link text-center" id="declaracion-tab"  data-toggle="tab"  href="#declaracion" role="tab" aria-controls="declaracion" aria-selected="false" >Declaracion</a>
            </li>
          </ul>
        </div>

        <div class="col-md-12 body-tabs">
          <div class="tab-content" id="myTabContent">
            <div  class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab"  >
              <div class="row">

                <div class="form-group col-md-3">
                  <label>Ruc</label>
                  <input type="number" class="form-control letter-5" v-model="form.cliente.documento" />
                </div>

                <div class="form-group col-md-3">
                  <label >Razon Social</label>
                  <input type="text" class="form-control" v-model="form.juridico.razon_social" placeholder />
                </div>

                <div class="form-group col-md-3">
                  <label>Nombre Comercial</label>
                  <input type="text" class="form-control" v-model="form.juridico.nombre_comercial" placeholder />
                </div>

                <div class="form-group col-md-3">
                  <label>Actividad Principal</label>
                  <input type="text" class="form-control" v-model="form.juridico.actividad_principal" placeholder />
                </div>
                <div class="form-group col-md-2">
                  <label>Nro. de Partida Registral</label>
                  <input type="number" class="form-control" v-model="form.juridico.partida_registral" placeholder />
                </div>
                <div class="form-group col-md-2">
                  <label>Oficina Principal</label>
                  <input type="text" class="form-control" v-model="form.juridico.oficina_principal" placeholder />
                </div>

                <div class="form-group col-md-2">
                  <label>P.N con negocio</label>
                  <select v-model="form.juridico.tipo_negocio" class="form-control">
                    <option value="0">SELECCIONE</option>
                    <option value="E.I.R.L">E.I.R.L</option>
                    <option value="S.A.C">S.A.C</option>
                    <option value="S.A">S.A</option>
                    <option value="ASOCIADOS">ASOCIADOS</option>
                    <option value="OTROS">OTROS</option>
                  </select>
                </div>

              <div class="form-group col-md-6">
                  <label>Dirección</label>
                  <input type="text" v-model="form.juridico.direccion" class="form-control" />
              </div>

              <div class="form-group col-md-2">
                    <label>Número</label>
                    <input type="text" v-model="form.juridico.numero" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label>Manzana</label>
                    <input type="text" v-model="form.juridico.manzana" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label>Lote</label>
                    <input type="text" v-model="form.juridico.lote" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label>Departamento</label>
                    <input type="text" v-model="form.juridico.pdto" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label>Interior</label>
                    <input type="text" v-model="form.juridico.int" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label>Piso</label>
                    <input type="text" v-model="form.juridico.piso" class="form-control" />
                </div>

                <div class="form-group col-md-3">
                    <label>Distrito</label>
                    <input type="text" v-model="form.cliente.distrito" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label>Provincia</label>
                    <input type="text" v-model="form.cliente.provincia" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label>Departamento</label>
                    <input type="text" v-model="form.cliente.departamento" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label>País</label>
                    <input type="text" v-model="form.cliente.pais" class="form-control" />
                </div>


                <div class="form-group col-md-3">
                    <label>Referencia</label>
                    <input type="text" v-model="form.juridico.referencia" class="form-control" />
                </div>
                <div class="form-group col-md-3">
                    <label>Teléfono</label>
                    <input type="text" v-model="form.juridico.telefono" class="form-control" />
                </div>

                <div class="form-group col-md-3">
                    <label>Celular</label>
                    <input
                      type="text"
                      v-model="form.juridico.celular"
                      class="form-control letter-5"
                      v-mask="{mask: '+51 999999999', greedy: true}"
                    />
                </div>

                <div class="form-group col-md-3"> 
                    <label>Email</label>
                    <input type="text" v-model="form.juridico.email" class="form-control" />
                </div>

              </div>

              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>
              
            <div class="tab-pane fade" id="representantes" role="tabpanel" aria-labelledby="representantes-tab">

              <div class="row">
                    <table class="table table-bordered table-striped table-sm">
                                  <thead>
                                      <tr>
                                          <th></th>
                                          <th>Apellidos y Nombres</th>
                                          <th>Dc. Identidad</th>
                                          <th>Cargo</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="(row, index) in form.representante" :key="index">
                                          <td>
                                              
                                              <template>
                                                  <button type="button" class="btn btn-danger btn-sm"  @click.prevent="clickRemoveRepresentante(index)">
                                                      <i class="fas fa-trash"></i>
                                                  </button>
                                              </template>
                                          </td>
                                          <td><input type="text" v-model="row.nombres" class="form-control" /></td>
                                          <td><input type="number" v-model="row.documento" class="form-control" /></td>
                                          <td><input type="text" v-model="row.cargo" class="form-control" /></td>
                                      </tr>                                
                                  </tbody>
                              </table>
                
                    <div class="col-md-12">
                        <button type="button"  @click.prevent="clickAddRepresentante"  class="btn btn-outline-dark more-option w-100" >
                          <i class="fas fa-plus"></i> Agregar Representante
                        </button>
                    </div>

                  <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                    <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                    <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
                  </div>
                </div>
            </div>

            <div class="tab-pane fade" id="director" role="tabpanel" aria-labelledby="director-tab">
              <div class="row">
                  <table class="table table-bordered table-striped table-sm">
                              <thead>
                                      <tr>
                                          <th></th>
                                          <th>Apellidos y Nombres</th>
                                          <th>Dc. Identidad</th>
                                          <th>Cargo</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="(row, index) in form.director" :key="index">
                                          <td>
                                              
                                              <template>
                                                  <button type="button" class="btn btn-danger btn-sm"  @click.prevent="clickRemoveDirector(index)">
                                                      <i class="fas fa-trash"></i>
                                                  </button>
                                              </template>
                                          </td>
                                          <td><input type="text" v-model="row.nombres" class="form-control" /></td>
                                          <td><input type="number" v-model="row.documento" class="form-control" /></td>
                                          <td><input type="text" v-model="row.cargo" class="form-control" /></td>
                                      </tr>                                
                                  </tbody>
                              </table>
                    <div class="col-md-12">
                        <button type="button"  @click.prevent="clickAddDirector"  class="btn btn-outline-dark more-option w-100" >
                          <i class="fas fa-plus"></i> Agregar Director
                        </button>
                    </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div class="tab-pane fade" id="accionista" role="tabpanel" aria-labelledby="accionista-tab">
              <div class="row">
                  <table class="table table-bordered table-striped table-sm">
                              <thead>
                                      <tr>
                                          <th></th>
                                          <th>Apellidos y Nombres</th>
                                          <th>Dc. Identidad</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="(row, index) in form.accionista" :key="index">
                                          <td>
                                              
                                              <template>
                                                  <button type="button" class="btn btn-danger btn-sm"  @click.prevent="clickRemoveAccionista(index)">
                                                      <i class="fas fa-trash"></i>
                                                  </button>
                                              </template>
                                          </td>
                                          <td><input type="text" v-model="row.nombres" class="form-control" /></td>
                                          <td><input type="number" v-model="row.documento" class="form-control" /></td>
                                      </tr>                                
                                  </tbody>
                              </table>
                    <div class="col-md-12">
                        <button type="button"  @click.prevent="clickAddAccionista"  class="btn btn-outline-dark more-option w-100" >
                          <i class="fas fa-plus"></i> Agregar Accionista
                        </button>
                    </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div class="tab-pane fade" id="asociativa"  role="tabpanel"  aria-labelledby="asociativa-tab"  >
              <div class="row">
                <div class="form-group col-md-3">
                    <label>Inscripcion </label>
                    <input type="number" class="form-control" v-model="form.asociativa.inscripcion" >
                </div>
                <div class="form-group col-md-3">
                    <label>Aporte </label>
                    <input type="number" class="form-control" v-model="form.asociativa.aporte" >
                </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div class="tab-pane fade" id="declaracion" role="tabpanel" aria-labelledby="declaracion-tab" >
              <div class="row">
                <div class="form-group col-md-12">
                    <label>Es sujeto a informar a la UIF Perú</label>
                    <select v-model="form.declaracion.uif" class="form-control">
                      <option value="0">SELECCIONE</option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                <div class="form-group col-md-12">
                    <label>Estado</label>
                    <select v-model="form.declaracion.estado" class="form-control">
                      <option value="0">SELECCIONE</option>
                      <option value="ADMITIDO">ADMITIDO</option>
                      <option value="RECHAZADO">RECHAZADO</option>
                    </select>
                  </div>
                <div class="form-group col-md-12">
                    <label>OBSERVACIONES</label>
                    <textarea class="form-control" v-model="form.declaracion.obervaciones" cols="auto" rows="5"></textarea>
                  </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange" @click.prevent="submit()">Regsitrar</a>
              </div>
            </div>

          </div>
        </div>
      </div>
                
  </div>
</template>

<script>
import DatePick from 'vue-date-pick';
import "vue-date-pick/dist/vueDatePick.css";
import { serviceNumber } from "../../../mixins/functions";

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
  components: { DatePick},
 props: ['tipo_persona'],
        
  data() {
    return {
      resource: "clientes",
      clientes: [],
      all_departments: [],
      all_provinces: [],
      all_districts: [],
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
      diaEs: diaConf
    };
  },
  async created() {
    
    //  await   this.$http.get(`/${this.resource}/datos/`).then(response => {
    //   this.all_departments = response.data.departments;
    //   this.all_provinces = response.data.provinces;
    //   this.all_districts = response.data.districts;
    // });

    await this.initForm();
  },
  methods: {

    next() {
      $(".nav-tabs .active")
        .parent()
        .next("li")
        .find("a")
        .trigger("click");
    },
    previous() {
      $(".nav-tabs .active")
        .parent()
        .prev("li")
        .find("a")
        .trigger("click");
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
          tipo_negocio:0,
          direccion:"",
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
          uif: 0,
          estado: 0,
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

      this.$http
        .post(`/${this.resource}/nuevo/juridico`, this.form)
        .then(response => {
          if (response.data.success) {
            this.resetForm();
            this.$toast.success(
              "El cliente fue creado",
              "Exitoso",
              this.notificationSystem.options.success
            );

            this.$parent.getRecords();
            this.$parent.tipo = true;
            
          } else {
            // this.resetForm();
            this.$toast.error(
              "El cliente ya existe!",
              "Error",
              this.notificationSystem.options.error
            );
          }
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
    }
  },
  mounted() {
    console.log("Component mounted.");
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
