<template >
  <div class="container-general">
    <header>
      <span @click="retornar()">
        <i class="fas fa-angle-left"></i>
      </span>
      <h1>Evaluacion Cualitativa</h1>
    </header>

    <div class="row m-0 p-3" style="background: white">
      <div class="col-md-12 p-0">
        <div class="card" style>
          <div class="card-header d-flex justify-content-between">
            <strong>Datos principales</strong>
          </div>
          <div class="card-body row">
            <div class="form-group col-md-4">
              <label>Fuente de ingreso</label>
              <v-select
                label="giro_negocio"
                :options="giros"
                :reduce="giros => giros.giro_negocio"
                placeholder="Buscar Giro..."
                v-model="evaluacion.principal.fuente_ingreso"
              ></v-select>
            </div>
            <div class="form-group col-md-4">
              <label>Destino del credito</label>
              <select v-model="evaluacion.principal.destino_credito" class="form-control">
                <option value="1">Capital de trabajo</option>
                <option value="2">Activo Fijo</option>
                <option value="3">Consumo</option>
                <option value="4">Vehiculo</option>
                <option value="5">Hipotecario</option>
                <option value="6">Mejoramiento de vivienda</option>
                <option value="7">Compra de deuda</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label>Descripcion destino</label>
              <input
                type="text"
                v-model="evaluacion.principal.destino_credito_descripcion"
                class="form-control"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 p-0">
        <div class="card" style>
          <div class="card-header d-flex justify-content-between">
            <strong>Datos del negocio</strong>
          </div>
          <div class="card-body row">
            <div class="col-md-12 row" v-if="evaluacion.principal.fuente_ingreso!='TRANSPORTES'">
              <div class="form-group col-md-4">
                <label>Ubicacion del negocio</label>
                <input type="text" v-model="evaluacion.negocio.ubicacion" class="form-control" />
              </div>

              <div class="form-group col-md-2">
                <label>Antiguedad</label>
                <select v-model="evaluacion.negocio.antiguedad" class="form-control">
                  <option value="0">Menos de 1 año</option>
                  <option value="1">1 año</option>
                  <option value="2">2 años</option>
                  <option value="3">3 años</option>
                  <option value="4">4 años</option>
                  <option value="5">5 años</option>
                  <option value="6">Más de 5 años</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label>Local</label>
                <select v-model="evaluacion.negocio.local" class="form-control">
                  <option value="1">Propio</option>
                  <option value="2">Alquilado</option>
                  <option value="3">Módulo V. pública</option>
                  <option value="4">Familiar</option>
                  <option value="5">Hipotec/anticresis</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label>Licencia de Funcionamiento</label>
                <select v-model="evaluacion.negocio.licencia_funcionamiento" class="form-control">
                  <option value="1">Si cuenta</option>
                  <option value="0">No cuenta</option>
                </select>
              </div>

              <div class="form-group col-md-2">
                <label>Realizo mejoras en el local</label>
                <select v-model="evaluacion.negocio.mejoras_local" class="form-control">
                  <option value="1">Si realizo</option>
                  <option value="0">No realizo</option>
                </select>
              </div>
            </div>

            <div class="col-md-12 row" v-else>
              <div class="col-md-12">
                <h4>Datos del vehiculo</h4>
              </div>

              <div class="form-group col-md-2">
                <label>Marca</label>
                <input type="text" v-model="evaluacion.vehiculo.marca" class="form-control" />
              </div>

              <div class="form-group col-md-2">
                <label>Modelo</label>
                <input type="text" v-model="evaluacion.vehiculo.modelo" class="form-control" />
              </div>

              <div class="form-group col-md-1">
                <label>Año fabricación</label>
                <select v-model="evaluacion.vehiculo.año" class="form-control">
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

              <div class="form-group col-md-2">
                <label>Tipo servicio que brinda</label>
                <input
                  type="text"
                  v-model="evaluacion.vehiculo.tipo_servicio_brinda"
                  class="form-control"
                />
              </div>

              <div class="form-group col-md-2">
                <label>Antiguedad realizando el servicio</label>
                <input
                  type="text"
                  v-model="evaluacion.vehiculo.antiguedad_servicio"
                  class="form-control"
                />
              </div>

              <div class="form-group col-md-2">
                <label>Permiso para brindar servicio</label>
                <select v-model="evaluacion.vehiculo.permiso_servicio" class="form-control">
                  <option value="1">Si cuenta</option>
                  <option value="0">No cuenta</option>
                </select>
              </div>

              <div class="form-group col-md-1">
                <label>Horario trabajo</label>
                <input
                  type="text"
                  v-model="evaluacion.vehiculo.horario_servicio"
                  class="form-control"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 p-0">
        <div class="card" style>
          <div class="card-header d-flex justify-content-between">
            <strong>Informacion Familiar</strong>
          </div>
          <div class="card-body row">
            <div class="form-group col-md-4">
              <label>Tipo de vivienda</label>
              <select v-model="evaluacion.familiar.tipo_vivienda" class="form-control">
                <option value="1">Propia Cancelada</option>
                <option value="2">Propia (hipoteca)</option>
                <option value="3">De los padres</option>
                <option value="4">De familiares</option>
                <option value="5">Alquilada</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label>Situacion familiar</label>
              <select v-model="evaluacion.familiar.situacion_familiar" class="form-control">
                <option value="1">Soltero</option>
                <option value="2">Casado</option>
                <option value="3">Conviviente</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label>Miembros de familia</label>
              <input
                type="number"
                v-model="evaluacion.familiar.miembros_familia"
                class="form-control"
                disabled
              />
            </div>

            <div class="form-group col-md-12" v-if="evaluacion.familiar.numero_hijos>0">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th style="width: 25%;">Edad</th>
                    <th style="width: 25%;">Grado</th>
                    <th style="width: 25%;">Colegio</th>
                    <th style="width: 25%;">Costo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(n, index) in evaluacion.familiar.numero_hijos" :key="index">
                       <td>
                          <input type="text"  class="form-control" v-model="evaluacion.familiar.hijos[index].edad" />
                        </td>
                        <td>
                          <select  v-model="evaluacion.familiar.hijos[index].grado" class="form-control" @change="seleccionColegios(index)">
                              <option value="0">SELECCIONE</option>
                              <option value="INICIAL">INICIAL</option>
                              <option value="PRIMARIA">PRIMARIA</option>
                              <option value="SECUNDARIA">SECUNDARIA</option>
                            </select>
                        </td>
                        <td>
                          <select  v-if="evaluacion.familiar.hijos[index].grado!='0'" v-model="evaluacion.familiar.hijos[index].colegio" class="form-control" @change="seleccionColegiosCosto(index)">
                              <option value="0">SELECCIONE</option>
                              <option v-for="colegio in colegios" v-bind:value="colegio.nombre" :key="colegio.id">
                                  {{ colegio.nombre }}
                                </option>
                          </select>
                     
                          <input type="text" class="form-control" disabled v-else>
                        </td>
                        <td>
                          <input type="text" class="form-control" :value="'S/. '+evaluacion.familiar.hijos[index].costo" disabled />
                        </td>
                  </tr>
                </tbody>
              </table>
            </div>

            
            <div class="form-group col-md-12" v-else>
                <p class="text-center">No registra hijos</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 p-0">
        <div class="card" style>
          <div class="card-header d-flex justify-content-between">
            <strong>COMENTARIOS (CENTRAL DE RIESGO)</strong>
          </div>
          <div class="card-body row">
            <div class="form-group col-md-12">
              <table class="table table-bordered table-striped table-sm">
                <tr>
                  <td>Entidad Financiera</td>
                  <td>Capital de Trabajo</td>
                  <td>Activo Fijo</td>
                  <td>Consumo Fijo</td>
                  <td>Vehicular</td>
                  <td>Hipotecario</td>
                  <td>Terceros</td>
                </tr>
                <tr>
                  <td>
                    <input
                      type="text"
                      class="form-control"
                      v-model="evaluacion.central_riesgo[1].entidad_financiera"
                    />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[1].capital" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[1].activo_f" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[1].consumo" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[1].vehicular" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[1].hipoteca" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[1].terceros" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
                      type="text"
                      class="form-control"
                      v-model="evaluacion.central_riesgo[2].entidad_financiera"
                    />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[2].capital" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[2].activo_f" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[2].consumo" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[2].vehicular" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[2].hipoteca" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[2].terceros" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
                      type="text"
                      class="form-control"
                      v-model="evaluacion.central_riesgo[3].entidad_financiera"
                    />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[3].capital" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[3].activo_f" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[3].consumo" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[3].vehicular" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[3].hipoteca" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[3].terceros" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input
                      type="text"
                      class="form-control"
                      v-model="evaluacion.central_riesgo[4].entidad_financiera"
                    />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[4].capital" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[4].activo_f" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[4].consumo" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[4].vehicular" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[4].hipoteca" />
                  </td>
                  <td>
                    <input type="checkbox" v-model="evaluacion.central_riesgo[4].terceros" />
                  </td>
                </tr>
              </table>
            </div>
            <div class="form-group col-md-12">
                <label for="">Comentarios</label>
                 <textarea class="form-control" v-model="evaluacion.comentario_colateral"></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 p-0">
        <div class="card" style>
          <div class="card-header d-flex justify-content-between">
            <strong>REFERENCIAS PERSONALES(Familiares, compañeros de trabajo, vecinos)</strong>
          </div>
          <div class="card-body row">
            <div class="form-group col-md-12">
              <table class="table table-bordered table-striped table-sm">
                <tr>
                  <td>Tipo de relación</td>
                  <td>Nombre</td>
                  <td>Telefono</td>
                </tr>
                <tr>
                  <td>
                    <input v-model="evaluacion.referencias[1].tipo_relacion" type="text" class="form-control" />
                  </td>
                  <td>
                    <input v-model="evaluacion.referencias[1].nombre" type="text" class="form-control" />
                  </td>
                  <td>
                    <input v-model="evaluacion.referencias[1].telefono" type="text" class="form-control" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input v-model="evaluacion.referencias[2].tipo_relacion" type="text" class="form-control" />
                  </td>
                  <td>
                    <input v-model="evaluacion.referencias[2].nombre" type="text" class="form-control" />
                  </td>
                  <td>
                    <input v-model="evaluacion.referencias[2].telefono" type="text" class="form-control" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input v-model="evaluacion.referencias[3].tipo_relacion" type="text" class="form-control" />
                  </td>
                  <td>
                    <input v-model="evaluacion.referencias[3].nombre" type="text" class="form-control" />
                  </td>
                  <td>
                    <input v-model="evaluacion.referencias[3].telefono" type="text" class="form-control" />
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 p-0">
        <div class="card" style>
          <div class="card-header d-flex justify-content-between">
            <strong>Colateral</strong>
          </div>
          <div class="card-body row">
               <div class="form-group col-md-12">
                 <label for="">Colateral</label>
                <select v-model="evaluacion.colateral" class="form-control">
                  <option value="1">Aval con casa propia</option>
                  <option value="2">Aval con casa alquilada</option>
                  <option value="3">Garantia liquida liquida</option>
                  <option value="4">Garantia vehicular</option>
                  <option value="5">Hipoteca inmobiliara</option>
                  <option value="0">Sin colateral</option>
                </select>
              </div>

              <div class="form-group col-md-12">
                <label for="">Comentarios</label>
                 <textarea class="form-control" v-model="evaluacion.comentario_colateral"></textarea>
              </div>

          </div>        
      
        </div>
      </div>

      <div class="form-group col-md-12 d-flex justify-content-center mt-3">
        <button @click="guardar()" class="btn btn-crecer w-25">Guardar</button>
      </div>

    </div>

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
      colegios: [],
      i:0,
      evaluacion: {
        prestamo_id: this.$route.params.prestamo,
        principal: {
          destino_credito_descripcion: "",
          destino_credito: 1,
          fuente_ingreso: ""
        },
        negocio: {
          ubicacion: "",
          antiguedad: "1",
          local: 1,
          licencia_funcionamiento: 1,
          horario_atencion: "",
          mejoras_local: 0
        },
        vehiculo: {
          marca: "",
          modelo: "",
          año: "",
          tipo_servicio_brinda: "",
          antiguedad_servicio: "",
          permiso_servicio: 1,
          horario_trabajo: ""
        },
        familiar: {
          numero_hijos: 0,
          tipo_vivienda: 1,
          situacion_familiar: 1,
          miembros_familia: 1,
          hijos: []
        },
        central_riesgo: {
          1: {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          2: {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          3: {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          4: {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          }
        },
        referencias: {
          1: {
            tipo_relacion: "",
            nombre: "",
            telefono: ""
          },
          2: {
            tipo_relacion: "",
            nombre: "",
            telefono: ""
          },
          3: {
            tipo_relacion: "",
            nombre: "",
            telefono: ""
          }
        },
        colateral: 0,
        comentario_colateral: ""
      }
    };
  },




  methods: {
        retornar() {
      this.backMixin_handleBack("");
    },
    ejemplo(){
          console.log("sdad")
    },
    guardar() {
      axios.post("/evaluaciones/cualitativa", this.evaluacion).then(res => {
        alert("guardado correctamente"); 
      });
    },
    seleccionColegios(index){
          this.colegios= []
          this.evaluacion.familiar.hijos[index].colegio='0'
          this.evaluacion.familiar.hijos[index].costo=''
          this.$http.get(`/evaluaciones/colegio?filtro=`+this.evaluacion.familiar.hijos[index].grado).then(response => {
              this.colegios = response.data;
          });
        // console.log(this.evaluacion.familiar.hijos[index].grado)
    },
    seleccionColegiosCosto(index){ 
          console.log("asdad")
          this.$http.get(`/evaluaciones/colegio/costo?grado=`+this.evaluacion.familiar.hijos[index].grado+`&colegio=`+this.evaluacion.familiar.hijos[index].colegio).then(response => {
          
          this.evaluacion.familiar.hijos[index].costo=response.data.costo
    });
        // console.log(this.evaluacion.familiar.hijos[index].grado)
    }
  },
  async mounted() { 
    this.$http.get(`/evaluaciones/giro`).then(response => {
      this.giros = response.data;
    });

    this.$http.get(`/evaluaciones/colegio`).then(response => {
      this.colegios = response.data;
    });
    
    this.$http
      .get(`/evaluaciones/numerohijos/` + this.$route.params.prestamo)
      .then(response => {
        this.evaluacion.familiar.numero_hijos =response.data.numero
        this.evaluacion.familiar.miembros_familia = this.evaluacion.familiar.numero_hijos
          for (this.i = 0; this.i < this.evaluacion.familiar.numero_hijos; this.i++) {
                this.evaluacion.familiar.hijos.push({
            edad: "",
            colegio:"0",
            grado:"0",
            costo:""
          });
      }
      });


  

  }
};
</script>