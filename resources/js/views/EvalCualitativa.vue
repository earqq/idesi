<template >
  <div class="container-general">
    <header>
      <span @click="retornar()">
        <i class="fas fa-angle-left"></i>
      </span>
      <h1>Evaluacion Cualitativa</h1>
    </header>

    <div class="row m-0 d-flex justify-content-center">
      <div class="col-md-12 p-0">
        <div class="nav-tabs style-tab-menu">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item col-md-2">
              <a
                class="nav-link active text-center"
                id="personal-tab"
                data-toggle="tab"
                href="#personal"
                role="tab"
                aria-controls="personal"
                aria-selected="true"
              >Datos Principales</a>
            </li>

            <li class="nav-item col-md-2">
              <a
                class="nav-link text-center"
                id="laboral-tab"
                data-toggle="tab"
                href="#laboral"
                role="tab"
                aria-controls="laboral"
                aria-selected="false"
                v-if="evaluacion.principal.fuente_ingreso!='TRANSPORTES' &&  evaluacion.principal.fuente_ingreso!='TRANSPORTE BAJAJ' "
              >Datos Negocio</a> 
              <a
                class="nav-link text-center"
                id="laboral-tab"
                data-toggle="tab"
                href="#laboral"
                role="tab"
                aria-controls="laboral"
                aria-selected="false"
                v-else
              >Datos Vehiculo</a>
            </li>
            <li class="nav-item col-md-2">
              <a
                class="nav-link text-center"
                id="familiar-tab"
                data-toggle="tab"
                href="#familiar"
                role="tab"
                aria-controls="familiar"
                aria-selected="false"
              >Datos Familiares</a>
            </li>
            <li class="nav-item col-md-2">
              <a
                class="nav-link text-center"
                id="adicional-tab"
                data-toggle="tab"
                href="#adicional"
                role="tab"
                aria-controls="adicional"
                aria-selected="false"
              >Central de Riesgo</a>
            </li>
            <li class="nav-item col-md-2">
              <a
                class="nav-link text-center"
                id="asociativa-tab"
                data-toggle="tab"
                href="#asociativa"
                role="tab"
                aria-controls="asociativa"
                aria-selected="false"
              >Referencias</a>
            </li>
            <li class="nav-item col-md-2">
              <a
                class="nav-link text-center"
                id="declaracion-tab"
                data-toggle="tab"
                href="#declaracion"
                role="tab"
                aria-controls="declaracion"
                aria-selected="false"
              >Colateral</a>
            </li>
          </ul>
        </div>

        <div class="col-md-12 body-tabs">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab" >
              <div class="row">
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
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div class="tab-pane fade" id="laboral" role="tabpanel" aria-labelledby="laboral-tab">
              <div class="row">
                <div class="col-md-12 p-0">
                  <div class="card" style>
                    <div class="card-header d-flex justify-content-between">
                      <strong v-if="evaluacion.principal.fuente_ingreso!='TRANSPORTES' &&  evaluacion.principal.fuente_ingreso!='TRANSPORTE BAJAJ'">Datos del negocio</strong>
                      <strong v-else>Datos del Vehiculo</strong>
                    </div>
                    <div class="card-body row">
                      <div
                        class="col-md-12 row"
                        v-if="evaluacion.principal.fuente_ingreso!='TRANSPORTES' &&  evaluacion.principal.fuente_ingreso!='TRANSPORTE BAJAJ' "
                      >
                        <div class="form-group col-md-4">
                          <label>Ubicacion del negocio</label>
                          <input
                            type="text"
                            v-model="evaluacion.negocio.ubicacion"
                            class="form-control"
                          />
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
                          <select
                            v-model="evaluacion.negocio.licencia_funcionamiento"
                            class="form-control"
                          >
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
                        <div class="form-group col-md-2">
                          <label>Horario de atención entrada</label>
                          <input type='time' v-model='evaluacion.negocio.horario_atencion_inicio' class='form-control'>
                        </div>
                        <div class="form-group col-md-2">
                          <label>Horario de atención salida</label>
                          <input type='time' v-model='evaluacion.negocio.horario_atencion_salida' class='form-control'>
                        </div>
                      </div>
                      
                      <div class="col-md-12 row" v-else>
                        <div class="form-group col-md-2">
                          <label>Marca</label>
                          <input
                            type="text"
                            v-model="evaluacion.vehiculo.marca"
                            class="form-control"
                          />
                        </div>

                        <div class="form-group col-md-2">
                          <label>Modelo</label>
                          <input
                            type="text"
                            v-model="evaluacion.vehiculo.modelo"
                            class="form-control"
                          />
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
                          <select
                            v-model="evaluacion.vehiculo.permiso_servicio"
                            class="form-control"
                          >
                            <option value="1">Si cuenta</option>
                            <option value="0">No cuenta</option>
                          </select>
                        </div>

                        <div class="form-group col-md-1">
                          <label>Horario trabajo inicio</label>
                          <input
                            type="time"
                            v-model="evaluacion.vehiculo.horario_servicio_inicio"
                            class="form-control"
                          />
                        </div>

                        <div class="form-group col-md-1">
                          <label>Horario trabajo fin</label>
                          <input
                            type="time"
                            v-model="evaluacion.vehiculo.horario_servicio_fin"
                            class="form-control"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div class="tab-pane fade" id="familiar" role="tabpanel" aria-labelledby="familiar-tab">
              <div class="row">
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
                        <select
                          v-model="evaluacion.familiar.situacion_familiar"
                          class="form-control"
                        >
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
                                <input
                                  type="text"
                                  class="form-control"
                                  v-model="evaluacion.familiar.hijos[index].edad"
                                />
                              </td>
                              <td>
                                <select
                                  v-model="evaluacion.familiar.hijos[index].grado"
                                  class="form-control"
                                  @change="seleccionColegios(index)"
                                >
                                  <option value="INICIAL">INICIAL</option>
                                  <option value="PRIMARIA">PRIMARIA</option>
                                  <option value="SECUNDARIA">SECUNDARIA</option>
                                </select>
                              </td>
                              <td>
                                <select
                                  v-if="evaluacion.familiar.hijos[index].grado!='0'"
                                  v-model="evaluacion.familiar.hijos[index].colegio"
                                  class="form-control"
                                  @change="seleccionColegiosCosto(index)"
                                >
                                  <option
                                    v-for="colegio in colegios"
                                    v-bind:value="colegio.nombre"
                                    :key="colegio.id"
                                  >{{ colegio.nombre }}</option>
                                </select>

                                <input type="text" class="form-control" disabled v-else />
                              </td>
                              <td>
                                <input
                                  type="text"
                                  class="form-control"
                                  :value="'S/. '+evaluacion.familiar.hijos[index].costo"
                                  disabled
                                />
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
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div  class="tab-pane fade" id="adicional" role="tabpanel" aria-labelledby="adicional-tab" >
              <div class="row">
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
                            <td>Consumo</td>
                            <td>Vehicular</td>
                            <td>Hipotecario</td>
                            <td>Terceros</td>
                          </tr>
                          <tr v-for='(entidad_financiera,index) in evaluacion.central_riesgo' :key="index">
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="entidad_financiera.entidad_financiera"
                              />
                            </td>
                            <td>
                              <input type="checkbox" v-model="entidad_financiera.capital" />
                            </td>
                            <td>
                              <input
                                type="checkbox"
                                v-model="entidad_financiera.activo_f"
                              />
                            </td>
                            <td>
                              <input type="checkbox" v-model="entidad_financiera.consumo" />
                            </td>
                            <td>
                              <input
                                type="checkbox"
                                v-model="entidad_financiera.vehicular"
                              />
                            </td>
                            <td>
                              <input
                                type="checkbox"
                                v-model="entidad_financiera.hipoteca"
                              />
                            </td>
                            <td>
                              <input
                                type="checkbox"
                                v-model="entidad_financiera.terceros"
                              />
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="form-group col-md-12">
                        <label for>Comentarios</label>
                        <textarea class="form-control" v-model="evaluacion.comentario_central_riesgo"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div  class="tab-pane fade" id="asociativa"  role="tabpanel" aria-labelledby="asociativa-tab" >
              <div class="row">
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
                                      <input
                                        v-model="evaluacion.referencias[1].tipo_relacion"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[1].nombre"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[1].telefono"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[2].tipo_relacion"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[2].nombre"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[2].telefono"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[3].tipo_relacion"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[3].nombre"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                    <td>
                                      <input
                                        v-model="evaluacion.referencias[3].telefono"
                                        type="text"
                                        class="form-control"
                                      />
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div  class="tab-pane fade" id="declaracion" role="tabpanel"  aria-labelledby="declaracion-tab" >
              <div class="row">
                    <div class="col-md-12 p-0">
                        <div class="card" style>
                          <div class="card-header d-flex justify-content-between">
                            <strong>Colateral</strong>
                          </div>
                          <div class="card-body row">
                            <div class="form-group col-md-12">
                              <label for>Colateral</label>
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
                              <label for>Comentarios</label>
                              <textarea class="form-control" v-model="evaluacion.comentario_colateral"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a
                  class="btn btn-orange"
                  @click.prevent="guardar()"
                  v-if="loading_submit=='0'"
                >Regsitrar</a>
                <div class="container-load-register" v-else>
                  <svg
                    aria-hidden="true"
                    focusable="false"
                    data-prefix="fas"
                    data-icon="spinner"
                    role="img"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                    class="svg-inline--fa fa-spinner fa-w-16 fa-spin fa-lg"
                  >
                    <path
                      fill="currentColor"
                      d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"
                      class
                    />
                  </svg>
                  <span class="fw6 f4 ml3">Registrando</span>
                </div>
              </div>
            </div>
          </div>
        </div>
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
          destino_credito: 1,
          fuente_ingreso: ""
        },
        negocio: {
          ubicacion: "",
          antiguedad: "1",
          local: 1,
          licencia_funcionamiento: 1,
          horario_atencion_entrada: "",
          horario_atencion_salida: "",
          mejoras_local: 0
        },
        vehiculo: {
          marca: "",
          modelo: "",
          año: "",
          tipo_servicio_brinda: "",
          antiguedad_servicio: "",
          permiso_servicio: 1,
          horario_servicio_inicio: "",
          horario_servicio_fin: ""
        },
        familiar: {
          numero_hijos: 0,
          tipo_vivienda: 1,
          situacion_familiar: 1,
          miembros_familia: 1,
          hijos: []
        },
        comentario_central_riesgo:'',
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
          },
          5: {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          6: {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          7: {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          8: {
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
    ejemplo() {
      console.log("sdad");
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
        this.retornar()
      });
    },
    retornar() {
      this.backMixin_handleBack();
    },
    seleccionColegios(index) {
      this.colegios = [];
      this.evaluacion.familiar.hijos[index].colegio = "0";
      this.evaluacion.familiar.hijos[index].costo = "";
      this.$http
        .get(
          `/evaluaciones/colegio?filtro=` +
            this.evaluacion.familiar.hijos[index].grado
        )
        .then(response => {
          this.colegios = response.data;
        });
      // console.log(this.evaluacion.familiar.hijos[index].grado)
    },
    seleccionColegiosCosto(index) {
      console.log("asdad");
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

    this.$http.get(`/evaluaciones/colegio`).then(response => {
      this.colegios = response.data;
    });

    this.$http
      .get(`/evaluaciones/numerohijos/` + this.$route.params.prestamo)
      .then(response => {
        this.evaluacion.familiar.numero_hijos = response.data.numero;
        this.evaluacion.familiar.miembros_familia = this.evaluacion.familiar.numero_hijos;
        for (
          this.i = 0;
          this.i < this.evaluacion.familiar.numero_hijos;
          this.i++
        ) {
          this.evaluacion.familiar.hijos.push({
            edad: "",
            colegio: "0",
            grado: "0",
            costo: ""
          });
        }
      });
  }
};
</script> 