<template >
  <div class="container-general">
    <header>
      <span @click="retornar()">
        <i class="fas fa-angle-left"></i>
      </span>
      <h1>Evaluacion Cuantitativa</h1>
    </header>

    <div class="row m-0 d-flex justify-content-center">
      <div class="col-md-12 p-0">
        <div class="nav-tabs style-tab-menu">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item col-md-2">
              <a
                class="nav-link active text-center"
                id="laboral-tab"
                data-toggle="tab"
                href="#laboral"
                role="tab"
                aria-controls="laboral"
                aria-selected="true"
              >Datos Titular</a>
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
              >Datos Conyuge</a>
            </li>
            <li class="nav-item col-md-2">
              <a
                class="nav-link text-center"
                id="hogar-tab"
                data-toggle="tab"
                href="#hogar"
                role="tab"
                aria-controls="hogar"
                aria-selected="false"
              >Datos Hogar</a>
            </li>           
          </ul>
        </div>

        <div class="col-md-12 body-tabs">
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="laboral"
              role="tabpanel"
              aria-labelledby="laboral-tab"
            >
              <div class="row">
                <div class="col-md-12 p-0">
                  <div class="card" style>
                    <div class="card-header">
                      <strong>Ingresos del negocio</strong>
                    </div>
                    <div class="card-body row">
                      <div class="form-group col-md-12">
                        <table class="table ingresos-table table-bordered table-striped table-sm">
                          <tr>
                            <td class="title-table">Concepto</td>
                            <td class="title-table">Lunes</td>
                            <td class="title-table">Martes</td>
                            <td class="title-table">Miercoles</td>
                            <td class="title-table">Jueves</td>
                            <td class="title-table">Viernes</td>
                            <td class="title-table">Sabado</td>
                            <td class="title-table">Domingo</td>
                            <td class="title-table">Subtotal</td>
                          </tr>
                          <tr
                            v-for="(val,index) in evaluacion.titular.ingresos_negocio"
                            v-bind:key="index"
                          >
                            <td>
                              <input  :disabled='index==0' type="text" class="form-control" v-model="val.concepto" />
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].lunes"
                                v-bind="money"
                                class="form-control"
                              ></money>
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].martes"
                                v-bind="money"
                                class="form-control"
                              ></money>
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].miercoles"
                                v-bind="money"
                                class="form-control"
                              ></money>
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].jueves"
                                v-bind="money"
                                class="form-control"
                              ></money>
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].viernes"
                                v-bind="money"
                                class="form-control"
                              ></money>
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].sabado"
                                v-bind="money"
                                class="form-control"
                              ></money>
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].domingo"
                                v-bind="money"
                                class="form-control"
                              ></money>
                            </td>
                            <td>
                              <money
                                :change="negocioIngresosSubtotal(index)"
                                v-model="evaluacion.titular.ingresos_negocio[index].subtotal"
                                v-bind="money"
                                class="form-control"
                              ></money>
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
                      <strong>Ingresos por 2da, 4ta y/o 5ta Categoria</strong>
                    </div>
                    <div class="card-body row">
                      <div class="form-group col-md-12">
                        <table class="table ingresos-table table-bordered table-striped table-sm">
                          <tr>
                            <td class="title-table">CONCEPTO</td>
                            <td class="title-table">MONTO MENSUAL</td>
                          </tr>
                          <tr
                            v-for="(ingreso,index) in evaluacion.titular.ingresos_por_categoria"
                            v-bind:key="index"
                          >
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.titular.ingresos_por_categoria[index].concepto"
                              />
                            </td>
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.titular.ingresos_por_categoria[index].mes"
                              />
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group col-md-4">
                  <label>Giro de negocio</label>
                  <v-select
                    label="giro_negocio"
                    :options="giros"
                    disabled
                    :reduce="giros => giros.giro_negocio"
                    placeholder="Giro negocio.."
                    v-model="evaluacion.titular.giro_negocio"
                  ></v-select>
                </div>

                <div class="form-group col-md-4">
                  <label>MARGEN COSTO</label>
                  <input type="text" v-model="evaluacion.titular.margen_costo" class="form-control" />
                </div>

                <div class="form-group col-md-4">
                  <label>VALOR INVENTARIO</label>

                  <input
                    type="text"
                    v-model="evaluacion.titular.valor_inventario"
                    class="form-control"
                  />
                </div>

                <div class="form-group col-md-6">
                  <label>GASTO FINANCIERO TITULAR</label>

                  <table class="table ingresos-table table-bordered table-striped table-sm">
                    <tr>
                      <td class="title-table">Entidad</td>
                      <td class="title-table">Saldo capital</td>
                      <td class="title-table">Cuota</td>
                    </tr>
                    <tr
                      v-for="(gasto,index) in evaluacion.titular.gasto_financiero"
                      v-bind:key="index"
                    >
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          disabled='disabled'
                          v-model="evaluacion.titular.gasto_financiero[index].entidad"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.titular.gasto_financiero[index].saldo_capital"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.titular.gasto_financiero[index].cuota"
                        />
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="form-group col-md-6">
                  <label>GASTO DEL NEGOCIO</label>
                  <table class="table ingresos-table table-bordered table-striped table-sm">
                    <tr>
                      <td class="title-table">Entidad</td>
                      <td class="title-table">Cuota</td>
                    </tr>
                    <tr
                      v-for="(gasto, index) in evaluacion.titular.gasto_negocio"
                      v-bind:key="index"
                    >
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          disabled='disabled'
                          v-model="evaluacion.titular.gasto_negocio[index].entidad"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.titular.gasto_negocio[index].pago"
                        />
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div
              class="tab-pane fade"
              id="declaracion"
              role="tabpanel"
              aria-labelledby="declaracion-tab"
            >
              <div class="row">
                <div class="form-group col-md-12">
                  <label>INGRESOS DEL CONYUGE O CONVIVIENTE (Si tuviese)</label>
                  <label>Ingresos del negocio (LLenar solo si el negocio es distinto al titular)</label>

                  <table class="table ingresos-table table-bordered table-striped table-sm">
                    <tr>
                      <td class="title-table">Concepto</td>
                      <td class="title-table">Lunes</td>
                      <td class="title-table">Martes</td>
                      <td class="title-table">Miercoles</td>
                      <td class="title-table">Jueves</td>
                      <td class="title-table">Viernes</td>
                      <td class="title-table">Sabado</td>
                      <td class="title-table">Domingo</td>
                      <td class="title-table">Subtotal</td>
                    </tr>
                    <tr
                      v-for="(ingreso,index) in evaluacion.conyuge.ingresos_negocio"
                      v-bind:key="index"
                    >
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].concepto"
                        />
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].lunes"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].martes"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].miercoles"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].jueves"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].viernes"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].sabado"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].domingo"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                      <td>
                        <money
                          :change="conyugeIngresosSubtotal(index)"
                          v-model="evaluacion.conyuge.ingresos_negocio[index].subtotal"
                          v-bind="money"
                          class="form-control"
                        ></money>
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="form-group col-md-12">
                  <label>Ingresos por 4tao 5ta Categoria</label>

                  <table class="table ingresos-table table-bordered table-striped table-sm">
                    <tr>
                      <td class="title-table">CONCEPTO</td>
                      <td class="title-table">MES</td>
                    </tr>
                    <tr
                      v-for="(ingresos,index) in evaluacion.conyuge.ingresos_por_categoria"
                      v-bind:key="index"
                    >
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.conyuge.ingresos_por_categoria[index].concepto"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.conyuge.ingresos_por_categoria[index].mes"
                        />
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="form-group col-md-4">
                  <label>GIRO DEL NEGOCIO</label>
                  <v-select
                    label="giro_negocio"
                    :options="giros"
                    :reduce="giros => giros.giro_negocio"
                    placeholder="Buscar Giro..."
                    v-model="evaluacion.conyuge.giro_negocio"
                  ></v-select>
                </div>

                <div class="form-group col-md-4">
                  <label>MARGEN COSTO</label>

                  <input
                    type="text"
                    class="form-control"
                    v-model="evaluacion.conyuge.margen_costo_conyuge"
                  />
                </div>

                <div class="form-group col-md-4">
                  <label>VALOR INVENTARIO</label>

                  <input
                    type="text"
                    class="form-control"
                    v-model="evaluacion.conyuge.valor_inventario_conyuge"
                  />
                </div>

                <div class="form-group col-md-6">
                  <label>GASTO FINANCIERO CONYUGE</label>
                  <table class="table ingresos-table table-bordered table-striped table-sm">
                    <tr>
                      <td class="title-table">Entidad</td>
                      <td class="title-table">Saldo capital</td>
                      <td class="title-table">Cuota</td>
                    </tr>
                    <tr
                      v-for="(gasto,index) in evaluacion.conyuge.gasto_financiero"
                      v-bind:key="index"
                    >
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.conyuge.gasto_financiero[index].entidad"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.conyuge.gasto_financiero[index].saldo_capital"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.conyuge.gasto_financiero[index].cuota"
                        />
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="form-group col-md-6">
                  <label>GASTO DEL NEGOCIO</label>
                  <table class="table ingresos-table table-bordered table-striped table-sm">
                    <tr>
                      <td class="title-table">Entidad</td>
                      <td class="title-table">Cuota</td>
                    </tr>
                    <tr
                      v-for="(gasto,index) in evaluacion.conyuge.gasto_negocio"
                      v-bind:key="index"
                    >
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          disabled='disabled'
                          v-model="evaluacion.conyuge.gasto_negocio[index].entidad"
                        />
                      </td>
                      <td>
                        <input
                          type="text"
                          class="form-control"
                          v-model="evaluacion.conyuge.gasto_negocio[index].pago"
                        />
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
                <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
                <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
              </div>
            </div>

            <div class="tab-pane fade" id="hogar" role="tabpanel" aria-labelledby="hogar-tab">
              <div class="row">
                <div class="col-md-12 p-0">
                  <div class="card" style>
                    <div class="card-header d-flex justify-content-between">
                      <strong>GIRO DEL NEGOCIO</strong>
                    </div>
                    <div class="card-body row">
                      <div class="form-group col-md-6">
                        <label>GASTOS SERVICIO DEL HOGAR</label>

                        <table class="table ingresos-table table-bordered table-striped table-sm">
                          <tr>
                            <td class="title-table">Concepto</td>
                            <td class="title-table">Pago</td>
                          </tr>
                          <tr v-for="(gasto,index) in evaluacion.gastos_hogar" v-bind:key="index">
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                disabled='disabled'
                                v-model="evaluacion.gastos_hogar[index].concepto"
                              />
                            </td>
                            <td>
                              <input
                                :disabled='index==5'
                                type="text"
                                class="form-control"
                                v-model="evaluacion.gastos_hogar[index].pago"
                              />
                            </td>
                          </tr>
                        </table>
                      </div>

                      <div class="form-group col-md-6">
                        <label>PROPIEDADES</label>

                        <table class="table ingresos-table table-bordered table-striped table-sm">
                          <tr>
                            <td class="title-table">Concepto</td>
                            <td class="title-table">Pago</td>
                          </tr>
                          <tr
                            v-for="(propiedades,index) in evaluacion.propiedades"
                            v-bind:key="index"
                          >
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.propiedades[index].concepto"
                              />
                            </td>
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.propiedades[index].valor_estimado"
                              />
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="form-group col-md-6">
                        <label>GASTO FINANCIERO PERSONAL DEL TITULAR</label>

                        <table class="table ingresos-table table-bordered table-striped table-sm">
                          <tr>
                            <td class="title-table">Entidad</td>
                            <td class="title-table">Saldo Capital</td>
                            <td class="title-table">Cuota</td>
                          </tr>
                          <tr
                            v-for="(gasto,index) in evaluacion.titular.gasto_financiero_personal"
                            v-bind:key="index"
                          >
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.titular.gasto_financiero_personal[index].entidad"
                              />
                            </td>
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.titular.gasto_financiero_personal[index].saldo_capital"
                              />
                            </td>
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.titular.gasto_financiero_personal[index].cuota"
                              />
                            </td>
                          </tr>
                        </table>
                      </div>

                      <div class="form-group col-md-6">
                        <label>GASTO FINANCIERO PERSONAL CONYUGE O CONVIVIENTE</label>

                        <table class="table ingresos-table table-bordered table-striped table-sm">
                          <tr>
                            <td class="title-table">Entidad</td>
                            <td class="title-table">Saldo Capital</td>
                            <td class="title-table">Cuota</td>
                          </tr>
                          <tr
                            v-for="(gasto,index) in evaluacion.conyuge.gasto_financiero_personal"
                            v-bind:key="index"
                          >
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.conyuge.gasto_financiero_personal[index].entidad"
                              />
                            </td>
                            <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.conyuge.gasto_financiero_personal[index].saldo_capital"
                              />
                            </td>
                             <td>
                              <input
                                type="text"
                                class="form-control"
                                v-model="evaluacion.conyuge.gasto_financiero_personal[index].cuota"
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
                <a
                  class="btn btn-orange"
                  @click.prevent="guardar()"
                  v-if="loading_submit=='0'"
                >Registrar</a>
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
      loading_submit: 0,
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "S/. ",
        suffix: "",
        precision: 0,
        masked: false
      },
      evaluacion: {
        prestamo_id: this.$route.params.prestamo,
        propuesta: {
          producto: "",
          monto: 1,
          numero_cuotas: 0,
          cuotas: 0
        },
        probabilidad_infocorp: 0,
        gastos_hogar: [
          {
            concepto: "LUZ",
            pago: 0
          },
          {
            concepto: "AGUA",
            pago: 0
          },
          {
            concepto: "TELEFONO FIJO",
            pago: 0
          },
          {
            concepto: "ALQUILER",
            pago: 0
          },
          {
            concepto: "ALIMENTACION Y TRANSPORTE",
            pago: 0
          },
          {
            concepto: "EDUCACION",
            pago: 0
          }
        ],
        propiedades: [
          {
            concepto: "",
            valor_estimado: 0
          },
          {
            concepto: "",
            valor_estimado: 0
          },
          {
            concepto: "",
            valor_estimado: 0
          },
          {
            concepto: "",
            valor_estimado: 0
          },
          {
            concepto: "",
            valor_estimado: 0
          },
          {
            concepto: "",
            valor_estimado: 0
          }
        ],
        titular: {
          ingresos_negocio: [
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            },
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            }
          ],

          ingresos_por_categoria: [
            {
              concepto: "",
              mes: ""
            },
            {
              concepto: "",
              mes: ""
            }
          ],
          gasto_financiero: [
            
          ],
          gasto_financiero_personal: [
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            }
          ],
          gasto_negocio: [
            {
              entidad: "ALQUILER",
              pago: 0
            },
            {
              entidad: "EMPLEADOS",
              pago: 0
            },
            {
              entidad: "IMPUESTOS",
              pago: 0
            },
            {
              entidad: "AGUA",
              pago: 0
            },
            {
              entidad: "LUZ",
              pago: 0
            }
          ],
          giro_negocio: "",
          margen_costo: 0,
          valor_inventario: 0
        },
        conyuge: {
          ingresos_negocio: [
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            },
            {
              concepto: "",
              lunes: 0,
              martes: 0,
              miercoles: 0,
              jueves: 0,
              viernes: 0,
              sabado: 0,
              domingo: 0
            }
          ],

          ingresos_por_categoria: [
            {
              concepto: "",
              mes: ""
            },
            {
              concepto: "",
              mes: ""
            }
          ],
          giro_negocio: "",
          margen_costo: "",
          valor_inventario: 0,
          gasto_financiero: [
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            }
          ],
          gasto_financiero_personal: [
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            },
            {
              entidad: "",
              saldo_capital: 0,
              cuota: 0
            }
          ],
          gasto_negocio: [
            {
              entidad: "ALQUILER",
              pago: 0
            },
            {
              entidad: "EMPLEADOS",
              pago: 0
            },
            {
              entidad: "IMPUESTOS",
              pago: 0
            },
            {
              entidad: "AGUA",
              pago: 0
            },
            {
              entidad: "LUZ",
              pago: 0
            }
          ]
        }
      }
    };
  },

  async mounted() {
    this.$http
      .get(`/evaluaciones/propuestaAnalista/` + this.$route.params.prestamo)
      .then(response => {
        this.evaluacion.propuesta.producto = response.data.producto;
        this.evaluacion.propuesta.monto = response.data.importe;
        this.evaluacion.propuesta.cuotas = response.data.cuotas;
        this.evaluacion.propuesta.plazo = response.data.plazo;
      });

    this.$http.get(`/evaluaciones/giro`).then(response => {
      this.giros = response.data;
    });

    this.$http
      .get(
        `/evaluaciones/datosCualitativas?prestamo=`+this.$route.params.prestamo
      )
      .then(response => {
        //Total de costo en educacion
        response.data.familiar.hijos.map(element=>{
          this.evaluacion.gastos_hogar[5].pago+=parseFloat(element.costo)
        })
        // entidades financieras
        response.data.central_riesgo.map(element=>{
          if(element.entidad_financiera){

            this.evaluacion.titular.gasto_financiero.push({
              entidad: element.entidad_financiera,
              saldo_capital: 0,
              cuota: 0
            })
          }
        })
        this.evaluacion.titular.ingresos_negocio[0].concepto=response.data.principal.fuente_ingreso
        this.evaluacion.titular.giro_negocio=response.data.principal.fuente_ingreso
      });
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
    negocioIngresosSubtotal(index) {
      this.evaluacion.titular.ingresos_negocio[index].subtotal =
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].lunes, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].martes, 2) +
        parseFloat(
          this.evaluacion.titular.ingresos_negocio[index].miercoles,
          2
        ) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].jueves, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].viernes, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].sabado, 2) +
        parseFloat(this.evaluacion.titular.ingresos_negocio[index].domingo, 2);
    },
    guardar() {
      axios.post("/evaluaciones/cuantitativa", this.evaluacion).then(res => {
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
    conyugeIngresosSubtotal(index) {
      this.evaluacion.conyuge.ingresos_negocio[index].subtotal =
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].lunes, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].martes, 2) +
        parseFloat(
          this.evaluacion.conyuge.ingresos_negocio[index].miercoles,
          2
        ) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].jueves, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].viernes, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].sabado, 2) +
        parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].domingo, 2);
    }
  }
};
</script>

<style lang="css" scoped>
.input-w {
  width: 100%;
}
.form-group label {
  margin-bottom: 0;
  color: #000000;
  font-weight: 500;
}

.card-header {
  padding: 0.2rem 1.25rem !important;
}
.card-body {
  padding: 10px 0px !important;
  margin: 0 !important;
}
.form-control {
  height: 27px !important;
  font-size: 14px !important;
}

.title-table {
  background: #dfdede;
  text-align: center;
  border: 1px solid #bababa;
}
</style>