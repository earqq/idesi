<template>
  <div class="evaluation_content">
    <div class="evaluation_detail">
      <section class="tab_inline">
        <div class="tab" @click="tab = 1; show_slide=false" :class=" {selected: tab == 1}">
          <p>DETALLE</p>
        </div>
        <div
          class="tab"
          @click="tab = 2; show_slide=false"
          :class="{selected: tab == 2}"
          v-if="prestamo.cuantitativa == '1' && prestamo.cualitativa=='1'"
        >
          <p>ANÁLISIS</p>
        </div>
        <div
          v-if="prestamo.estado==2 && ($store.state.currentUser.nivel==3 || $store.state.currentUser.nivel==2) && !evaluado"
          class="tab slide_mobile"
          :class="{selected: tab == 3}"
          @click="tab = 3; show_slide = true"
        >
          <p>EVALUAR</p>
        </div>
      </section>
      <div class="evaluation_detail_wrapper">
        <div class="create_client_content">
          <section class="client_forms">
            <div class="client_forms_wrapper">
              <div v-show="tab == 1" class="form_step">
                <div class="form_step_wrapper">
                  <button type="button" @click="cargarPdf()" class="add_section download">
                    <span>DESCARGAR EXPEDIENTE DE PRESTAMO</span>
                    <i class="material-icons-outlined">download</i>
                  </button>
                </div>
                <div class="form_step_wrapper in_bottom">
                  <h3 class="title">Propuesta del Analista</h3>

                  <div class="detail_content">
                    <li>
                      <strong>Producto</strong>
                      <p>{{prestamo.producto_analista || '-- --'}}</p>
                    </li>
                    <li>
                      <strong>Importe</strong>
                      <p>S/. {{prestamo.importe_analista || '0.00'}}</p>
                    </li>
                    <li>
                      <strong>Cuotas</strong>
                      <p>{{prestamo.cuotas_analista || '0'}}</p>
                    </li>
                    <li>
                      <strong>Cuota del Sistema</strong>
                      <p>{{prestamo.cuota_sistema || '0'}}</p>
                    </li>
                    <li>
                      <strong>Aporte</strong>
                      <p>S/. {{prestamo.aporte_analista || '0.00'}}</p>
                    </li>
                    <li>
                      <strong>Comentarios</strong>
                      <p>{{prestamo.comentarios || 'SIN COMENTARIOS'}}</p>
                    </li>
                  </div>
                </div>

                <div class="form_step_wrapper in_bottom">
                  <h3 class="title">Evaluaciones</h3>

                  <div class="empty_message_evaluation" v-if="prestamo.evaluaciones.length == 0">
                    <img src="img/empty.svg" />
                    <h1>Sin Evaluaciones</h1>
                    <p>Todavia no se han relizado evaluaciones a este prestamo</p>
                  </div>

                  <div class="table_wrapper" v-else>
                    <table class="table_evaluation no_hover">
                      <thead>
                        <tr>
                          <th>Evaluador</th>
                          <th>Comentarios</th>
                          <th>Fecha</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="evaluacion in prestamo.evaluaciones"
                          :key="evaluacion.id"
                          :class="{final_result: $store.state.currentUser.nivel == 2}"
                        >
                          <td class="client" v-text="evaluacion.evaluador.name"></td>
                          <td
                            class="observation"
                            v-text="evaluacion.detalle ? evaluacion.detalle : '-- -- -- --'"
                          ></td>
                          <td class="date">{{evaluacion.created_at | moment("D [de] MMMM, YYYY")}}</td>
                          <td class="state">
                            <span :class="stateEvaluation(evaluacion.estado)"></span>
                            {{estados[evaluacion.estado]}}
                            <strong v-show="$store.state.currentUser.nivel == 2">( Decisión )</strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="form_step_wrapper in_bottom" v-if="prestamo.estado!=2">
                  <h3 class="title">Decisión Final</h3>
                  <div class="detail_content">
                    <li>
                      <strong>Producto</strong>
                      <p>{{prestamo.producto_final}}</p>
                    </li>
                    <li>
                      <strong>Aporte</strong>
                      <p>S/. {{prestamo.aporte_final}}</p>
                    </li>
                    <li>
                      <strong>Importe</strong>
                      <p>S/. {{prestamo.importe_final}}</p>
                    </li>
                    <li>
                      <strong>Plazo</strong>
                      <p>{{prestamo.cuotas_final || '0'}}</p>
                    </li>
                    <li>
                      <strong>Cuota</strong>
                      <p>{{prestamo.cuota_sistema}}</p>
                    </li>                    
                    <li class="spanner"></li>
                    <li class="spanner"></li>
                  </div>
                </div>
              </div>

              <div v-show="tab == 2" class="form_step">
                <div class="analytics_grid">

                  <div class="analytics_result_wrapper results">
                    <h3 class="title">RESULTADOS DE EVALUACIÓN</h3>
                    <div class="table_wrapper">
                      <table >
                        <thead>
                          <tr>
                            <th>TIPO</th>
                            <th>TITULAR</th>
                            <th v-if="conyuge">CÓNYUGE</th>
                            <th>UNIDAD FAMILIAR</th>
                            <th>COMPROBACIÓN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class>
                            <td class="sub_title">Ingreso / ventas</td>
                            <td v-text="'S/. '+resultadoAnalisis.ingresos_ventas_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.ingresos_ventas_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.ingresos_ventas_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.ingresos_ventas_validacion"></td>
                          </tr>

                          <tr class>
                            <td class="sub_title">Costo de venta</td>
                            <td v-text="'S/. '+resultadoAnalisis.costo_venta_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.costo_venta_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.costo_venta_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.costo_venta_validacion"></td>
                          </tr>

                          <tr class>
                            <td class="sub_title">Margen Bruto</td>
                            <td v-text="'S/. '+resultadoAnalisis.margen_bruto_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.margen_bruto_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.margen_bruto_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.margen_bruto_validacion"></td>
                          </tr>

                          <tr class>
                            <td class="sub_title">Servicios LAT</td>
                            <td v-text="'S/. '+resultadoAnalisis.servicios_lat_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.servicios_lat_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.servicios_lat_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.servicios_lat_validacion"></td>
                          </tr>

                          <tr class>
                            <td class="sub_title">Alquiler</td>
                            <td v-text="'S/. '+resultadoAnalisis.alquiler_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.alquiler_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.alquiler_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.alquiler_validacion"></td>
                          </tr>

                          <tr class>
                            <td class="sub_title">Empleados</td>
                            <td v-text="'S/. '+resultadoAnalisis.empleados_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.empleados_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.empleados_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.empleados_validacion"></td>
                          </tr>

                          <tr class>
                            <td class="sub_title">Gasto Financiero</td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Utilidad neta del negocio</td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_neta_negocio_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_neta_negocio_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_neta_negocio_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_neta_negocio_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Otros ingresos</td>
                            <td v-text="'S/. '+resultadoAnalisis.otros_ingresos_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.otros_ingresos_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.otros_ingresos_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.otros_ingresos_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Gasto Hogar</td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_hogar_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_hogar_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_hogar_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_hogar_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Gasto Financiero Personal</td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_personal_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_personal_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_personal_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.gasto_financiero_personal_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Disponible</td>
                            <td v-text="'S/. '+resultadoAnalisis.disponible_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.disponible_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.disponible_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.disponible_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Cuota insitución</td>
                            <td v-text="'S/. '+resultadoAnalisis.cuota_institucion_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.cuota_institucion_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.cuota_institucion_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.cuota_institucion_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Disponible desp. Cuota</td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_desp_cuota_titular"></td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_desp_cuota_conyuge" v-if="conyuge"></td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_desp_cuota_total"></td>
                            <td v-text="'S/. '+resultadoAnalisis.utilidad_desp_cuota_validacion"></td>
                          </tr>
                          <tr class>
                            <td class="sub_title">Participación de la cuota</td>
                            <td v-text="resultadoAnalisis.participacion_cuota_titular + ' %'"></td>
                            <td v-if="conyuge"></td>
                            <td v-text="resultadoAnalisis.participacion_cuota_total + ' %'"></td>
                            <td v-text="resultadoAnalisis.participacion_cuota_validacion + ' %'"></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td class="sub_title" colspan="3">RESULTADO EVA</td>
                            <td >
                              <span v-text="resultadoAnalisis.resultado_eva"></span>
                            </td>
                          </tr>
                          <tr>
                            <td class="sub_title" colspan="3">RESULTADO SIST</td>
                            <td >
                              <span v-text="resultadoAnalisis.resultado_sist"></span>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>

                  <div class="analytics_result_wrapper balance">
                    <h3 class="title">BALANCE</h3>
                    <div class="table_wrapper">
                      <table>
                        <thead>
                          <tr>
                            <th >ACTIVO</th>
                            <th></th>
                            <th >PASIVO</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="sub_title" >CAJA</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_activo_caja"></td>
                            <td class="sub_title" >DEUDAS</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_pasivo_deudas"></td>
                          </tr>
                          <tr>
                            <td class="sub_title">INVENTARIO</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_activo_inventario">0</td>
                            <td class="sub_title">PATRIMONIO</td>
                            <td></td>
                          </tr>
                          <tr>
                            <td class="sub_title" >ACTIVO F</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_activo_f"></td>
                            <td class="sub_title" >CAPITAL</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_patrimonio_capital"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td class="sub_title" >UTILIDAD</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_patrimonio_utilidad"></td>
                          </tr>
                          <tr>
                            <td class="sub_title" >TOTAL</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_activo_total"></td>
                            <td class="sub_title" >TOTAL</td>
                            <td v-text="'S/. '+resultadoAnalisis.balance_patrimonio_total"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="analytics_result_wrapper ratios">
                    <h3 class="title">RATIOS</h3>
                    <div class="table_wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <td class="sub_title">ENDEUDAMIENTO</td>
                            <td v-text="parseFloat(resultadoAnalisis.ratios_endeudamiento*100).toFixed(2) + ' %'"></td>
                            <td v-text="resultadoAnalisis.ratios_endeudamiento_resultado"></td>
                          </tr>
                          <tr>
                            <td class="sub_title">MARGEN NETO</td>
                            <td v-if="resultadoAnalisis.ratios_margen_neto" v-text="parseFloat(resultadoAnalisis.ratios_margen_neto*100).toFixed(2) + ' %'"></td>
                            <td v-else>0</td>
                            <td v-text="resultadoAnalisis.ratios_margen_neto_resultado"></td>
                          </tr>
                          <tr>
                            <td class="sub_title">LIQUIDEZ</td>
                            <td v-if="resultadoAnalisis.ratios_liquidez" v-text="parseFloat(resultadoAnalisis.ratios_liquidez).toFixed(2)"></td>
                            <td v-else>0</td>
                            <td v-text="resultadoAnalisis.ratios_liquidez_resultado"></td>
                          </tr>
                          <tr>
                            <td class="sub_title">SOLVENCIA</td>
                            <td v-if="resultadoAnalisis.ratios_solvencia" v-text="parseFloat(resultadoAnalisis.ratios_solvencia).toFixed(2)"></td>
                            <td v-else>0</td>
                            <td v-text="resultadoAnalisis.ratios_solvencia_resultado"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
               
                  <div v-if="prestamo.forma=='DIARIO'"  class="analytics_result_wrapper flow">
                    <h3 class="title">flujo para creditos diarios</h3>
                    <div class="table_wrapper">
                      <table>
                        <tbody>
                          <tr>
                            <td  class="sub_title">MINIMO INGRESO</td>
                            <td v-text="resultadoAnalisis.fc_diario_minimo_ingreso"></td>
                          </tr>
                          <tr>
                            <td  class="sub_title">CUOTA</td>
                            <td v-text="resultadoAnalisis.fc_diario_cuota"></td>
                          </tr>
                          <tr>
                            <td  class="sub_title">DISPONIBLE DIARIO</td>
                            <td v-text="resultadoAnalisis.fc_diario_disponible_diario"></td>
                          </tr>
                          <tr>
                            <td  class="sub_title">PARTICIPACION DE LA CUOTA</td>
                            <td v-text="resultadoAnalisis.fc_diario_participacion_cuota + ' %'"></td>
                          </tr>
                          <tr>
                            <td  class="sub_title">RESULTADO</td>
                            <td v-text="resultadoAnalisis.fc_diario_resultado"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div v-if="prestamo.forma=='SEMANAL'"  class="analytics_result_wrapper flow">
                    <h3 class="title">flujo para creditos semanal</h3>
                    <div class="table_wrapper">
                      <table
                        class="table table-responsive-sm table-bordered table-striped table-sm">
                        <tbody>
                          <tr >
                            <td  class="sub_title">MINIMO INGRESO</td>
                            <td v-text="resultadoAnalisis.fc_semanal_minimo_ingreso"></td>
                          </tr>
                          <tr >
                            <td  class="sub_title">CUOTA</td>
                            <td v-text="resultadoAnalisis.fc_semanal_cuota"></td>
                          </tr>
                          <tr >
                            <td  class="sub_title">DISPONIBLE SEMANA</td>
                            <td v-text="resultadoAnalisis.fc_semanal_disponible_semana"></td>
                          </tr>
                          <tr >
                            <td  class="sub_title">PARTICIPACION DE LA CUOTA</td>
                            <td v-text="resultadoAnalisis.fc_semanal_participacion_cuota"></td>
                          </tr>
                          <tr >
                            <td  class="sub_title">RESULTADO</td>
                            <td v-text="resultadoAnalisis.fc_semanal_resultado"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <aside
      class="evaluation no_scroll"
      :class="{showing: show_slide}"
      v-if="prestamo.estado==2 && ($store.state.currentUser.nivel=='3' || $store.state.currentUser.nivel=='2') && !evaluado">
      <div class="evaluation_wrapper">
        <div class="input_box">
          <div class="input_box_wrapper">
            <div class="input_checkbox_wrapper radio">
              <input
                type="radio"
                id="radio1"
                name="evaluation"
                v-model="prestamo.evaluacion.estado"
                :value="3"
              />
              <label class="box_content" for="radio1">
                <div class="box"></div>
                <span>Aprobado</span>
              </label>
            </div>
            <div class="input_checkbox_wrapper radio" v-if="$store.state.currentUser.nivel=='3'">
              <input
                type="radio"
                id="radio2"
                name="evaluation"
                v-model="prestamo.evaluacion.estado"
                :value="5"
              />
              <label class="box_content" for="radio2">
                <div class="box"></div>
                <span>Observado</span>
              </label>
            </div>
            <div class="input_checkbox_wrapper radio">
              <input
                type="radio"
                id="radio3"
                name="evaluation"
                v-model="prestamo.evaluacion.estado"
                :value="4"
              />
              <label class="box_content" for="radio3">
                <div class="box"></div>
                <span>{{$store.state.currentUser.nivel== '3' ? 'Desaprobado' : 'Rechazado'}}</span>
              </label>
            </div>
          </div>
        </div>

        <div class="form_content" >
          <div class="input_wrapper" v-if="$store.state.currentUser.nivel=='3'">
            <label>Comentarios</label>
            <textarea v-model="prestamo.evaluacion.detalle"></textarea>
          </div>

          <div class="input_wrapper" v-if="$store.state.currentUser.nivel=='2'">
            <label for>Producto</label>
            <select v-model="prestamo.producto_analista" >
                <option value="CREDIDIARIO">CREDIDIARIO</option>
                <option value="CREDISEMANA">CREDISEMANA</option>
                <option value="PYME">PYME</option>
                <option value="PYME ESPECIAL">PYME ESPECIAL</option>
                <option value="CONSUMO">CONSUMO</option>
                <option value="CONSUMO ESPECIAL">CONSUMO ESPECIAL</option>
            </select>
          </div>

          <div class="inline_inputs" v-if="$store.state.currentUser.nivel=='2'">
            <div class="input_wrapper">
              <label for>Aporte</label>
              <input type="text" v-model="prestamo.aporte_analista" />
            </div>

            <div class="input_wrapper">
              <label for>Cuotas</label>
              <input type="text" v-model="prestamo.cuotas_analista" />
            </div>
          </div>

          <div class="input_wrapper" v-if="$store.state.currentUser.nivel=='2'">
            <label for>Importe</label>
            <input type="text" v-model="prestamo.importe_analista" />
          </div>

          <div class="input_wrapper" v-if="$store.state.currentUser.nivel=='2'">
            <label for>Cuota Sistema</label>
            <input type="text" v-model="prestamo.cuota_sistema" />
          </div>

        </div>

        <button class="button_primary medium" @click="firmarEvaluacion()">
          <span v-if="$store.state.currentUser.nivel==3">FIRMAR EVALUACIÓN</span>
          <span v-else>FINALIZAR EVALUACIÓN</span>
          <i class="material-icons-outlined">fingerprint</i>
        </button>
      </div>
    </aside>
  </div>
</template>

<script>
import { serviceNumber } from "../../mixins/functions";

export default {
  mixins: [serviceNumber],
  data() {
    return {
      show_slide: false,
      tab: 1,
      conyuge:0,
      resultadoAnalisis: {},
      evaluado:false,
      estados:{
        3:'ACEPTADO',
        4:'DESAPROBADO',
        5:'OBSERVADO',
      },
      prestamo: {
        evaluaciones:[],
        evaluacion:{
          estado:3,
          aporte:'',
          cuota:'',
          importe:'',
          cuota:'',
          detalle:''
        }
      },
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
    };
  },
  mounted() {
    this.obtenerPrestamo(this.$route.params.prestamoID);
  },
  methods: {   
    obtenerPrestamo(id) {
      this.$http
        .get(`/prestamos/` + id)
        .then(response => {
          
          this.prestamo = response.data
          console.log(response)
          if(this.prestamo.cliente.persona.conyuge){
            this.conyuge=1
          }else{
            this.conyuge=0
          }
          this.prestamo.evaluacion={
            estado:3,
            aporte:'',
            cuota:'',
            importe:'',
            cuota:'',
            detalle:''
          }
          let self=this
          this.prestamo.evaluaciones.map(item=>{
            if(item.user_id==self.$store.state.currentUser.id)
              self.evaluado=true
          })
          if (response.data.resultado_analisis)
            this.resultadoAnalisis = response.data.resultado_analisis;        
        });
    },
    cargarPdf() {
      window.open("/pdf/prestamo/expediente/" + this.prestamo.id, "_blank");
    },
    firmarEvaluacion() {
      this.$http
      .post(`/prestamos/evaluar`, this.prestamo)
      .then(response => {
        this.obtenerPrestamo(this.$route.params.prestamoID);
        this.$toast.success(
          "La evaluación fue exitosa",
          "Exitoso",
          this.notificationSystem.options.success
        );
        this.tab=1;
        this.show_slide=false
        // this.prestamos.push(prestamos)
      })
      .catch(err=>{
        this.$toast.error(
          "La evaluación falló", 
          "Error",
          this.notificationSystem.options.error
        );
      });
      
    },
    stateEvaluation(estado) {
      if (estado == 3) return "accept";
      if (estado == 4) return "observed";
      if (estado == 5) return "denied";
      return;
    }
  }  
};
</script>

<style lang="sass">
@import "../../../sass/variables"
.evaluation_content
  display: flex
  .evaluation_detail
    flex: 1
    .tab_inline
      background-color: white
      height: 40px
      display: flex
      box-shadow: $shadow
      position: sticky
      top: 55px
      z-index: 8
      border-bottom: 1px solid $line_color
      .tab
        width: 100px
        display: flex
        align-items: center
        justify-content: center
        height: 100%
        cursor: pointer
        border-bottom: 2px solid transparent
        user-select: none
        margin-left: 20px
        &.slide_mobile
          display: none
        &.selected
          border-bottom: 2px solid $primary_color
          p
            color: $primary_color
        p
          margin: 0
          font-size: 12px
          font-weight: 700
          margin-left: 10px
          color: rgba($text_color, .5)
          margin-bottom: -1px
    .evaluation_detail_wrapper
      margin-top: 20px
      margin-bottom: 20px
      .add_section
        border-top: none
      .analytics_grid
        display: grid
        grid-template-areas: "results results" "balance balance" "ratios flow"
        grid-template-columns: 1fr 1fr
        grid-gap: 10px
        .analytics_result_wrapper
          background-color: white
          box-shadow: $shadow
          box-sizing: border-box
          border: 1px solid $line_color
          border-radius: 4px
          overflow: hidden
          h3.title
            font-size: 12px
            margin: 0
            width: 100%
            border-bottom: 1px solid $line_color
            font-weight: 700
            padding: 7px 20px
            display: flex
            align-items: center
            justify-content: space-between
            min-height: 30px
            text-transform: uppercase
          &.results
            grid-area: results
          &.ratios
            grid-area: ratios
          &.balance
            grid-area: balance
          &.flow
            grid-area: flow
          table
            background-color: $bg_color
            thead tr
              border-radius: 0
            tr
              td
                text-align: left
            tbody:hover tr
              background-color: white
            .sub_title
              font-weight: 700
              text-transform: uppercase
            tfoot
              display: block
              color: $primary_color
              tr
                display: flex
                width: 100%
                font-family: $font
                transition: all ease-in-out .2s
                border-left: 3px solid $primary_color
                background-color: rgba($primary_color, .03) !important
                td
                  text-align: center
                  font-size: 12px
                  display: flex
                  justify-content: flex-start
                  align-items: center
                  flex: 1
                  padding: 12px 15px
                  color: $text_color
      .empty_message_evaluation
        display: flex
        align-items: center
        justify-content: center
        flex-direction: column
        padding: 20px
        height: 250px
        overflow: hidden
        img
          width: 120px
        h1
          margin: 0
          font-size: 14px
          margin-top: 15px
          margin-bottom: 5px
          font-weight: 600
        p
          margin: 0
          font-size: 12px
          text-align: center
          line-height: 1.4
      table.table_evaluation
        thead, tbody
          tr
            margin-bottom: 0px
            border-bottom: 1px solid $bg_color
        &.no_hover 
          tbody:hover tr
            background-color: inherit
        tbody
          tr
            td.client
              text-transform: uppercase
            td
              text-transform: lowercase
              text-align: left
            &.final_result
              background-color: rgba($primary_color, .03) !important
              border-left: 3px solid $primary_color
              &:hover
                background-color: rgba($primary_color, .03) !important
            &:last-child
              border-bottom: 0
        
        .state
          strong
            margin-left: 7px
          span
            width: 12px
            height: 12px
            border-radius: 50%
            background-color: $line_color
            margin-right: 5px
            margin-top: 0px
            &.accept
              background-color: $primary_color
            &.observed
              background-color: $highlight_color
            &.denied
              background-color: $require_color
  .evaluation
    width: 350px
    background-color: white
    box-shadow: $shadow
    border-left: 1px solid $line_color
    height: calc(100vh - 55px)
    display: flex
    flex-direction: column
    position: sticky
    top: 55px
    overflow: auto
    .title
      border-bottom: 1px solid $line_color
      font-size: 11px
      font-weight: 600
      color: rgba($text_color, .4)
      padding: 0 20px
      display: flex
      align-items: center
      height: 30px
    .evaluation_wrapper
      padding: 20px
      .input_box
        &.no_label
            margin-top: 5px
        & > label
            font-family: $font
            font-weight: 500
            font-size: 11px
            margin-bottom: 4px
            display: block
        .input_box_wrapper
            display: grid
            align-items: center
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr))
            grid-gap: 10px
            .input_checkbox_wrapper
                height: 40px
                input
                    &:checked + label.box_content
                        border: 1px solid $primary_color
                        color: $primary_color
                        font-weight: 600
                & > label.box_content
                    border: 1px solid rgba(0, 0, 0, 0.2)
                    height: 100%
                    border-radius: 3px
                    display: flex
                    align-items: center
                    padding: 0 20px
                    box-sizing: border-box
                    margin-bottom: 0
                    span
                        margin-left: 10px

      .form_content
        display: grid
        grid-template-columns: 1fr
        grid-gap: 10px
        margin-top: 10px
        textarea
          display: block
        .inline_inputs
          display: grid
          grid-template-columns: 1fr 1fr
          grid-gap: 10px
      button
        width: 100%
        margin-top: 15px
        i
          font-size: 20px

@media screen and (max-width: 1000px)
  .evaluation_content
    .evaluation_detail
      .tab_inline
        .tab
          &.slide_mobile
            display: flex
    .evaluation
      width: 100%
      position: fixed
      top: 95px
      z-index: 5
      right: -100%
      transition: all ease-in-out .3s
      height: calc(100vh - 95px)
      &.showing
        right: 0
      .button_primary
        height: 45px
@media screen and (max-width: 720px)
  .evaluation_content
    .evaluation_detail
      .evaluation_detail_wrapper
        table.table_evaluation
          thead
            display: none
          tbody
            tr
              flex-direction: column
              td
                padding: 1px 15px
                &:first-child
                  padding-top: 15px
                &:last-child
                  padding-bottom: 15px
                &.observation
                  color: rgba($text_color, .77)
                &.client
                  font-weight: 500
                &.date
                  display: none


@media screen and (max-width: 500px)
  .evaluation_content
    .evaluation_detail
      .tab_inline
        .tab
          flex: 1
          flex-basis: 0
          margin-left: 0
      .evaluation_detail_wrapper
        margin-top: 15px
        margin-bottom: 15px
</style>
