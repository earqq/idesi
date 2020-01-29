<template>

<div class="evaluation_content">

    <div class="evaluation_detail">
      <section class="tab_inline">
        <div
          class="tab"
          @click="tab = 1"
          :class=" {selected: tab == 1}">
          <p>Detalles</p>
        </div>
        <div class="tab" @click="tab = 2" :class="{selected: tab == 2}">
          <p>Evaluación</p>
        </div>
      </section>
      <div class="evaluation_detail_wrapper">
        <div class="create_client_content">
          <section class="client_forms">
            <div class="client_forms_wrapper">
              <transition name="slide-fade" mode="in-out">
                <div v-show="tab == 1" class="form_step">
                  
                  <div class="form_step_wrapper">
                    <button
                      type="button"
                      @click="cargarPdf()"
                      class="add_section">
                      <span>DESCARGAR EXPEDIENTE DE PRESTAMO</span>
                      <i class="material-icons-outlined">download</i>
                    </button>
                  </div>

                  <div class="form_step_wrapper in_bottom">
                    <h3 class="title">Propuesta del Analista</h3>

                    <div class="form_content">

                      <div class="group_form">

                        <div class="input_wrapper">
                          <label>Producto</label>
                          <input type="text" :value="detalle.producto" disabled>
                        </div>

                        <div class="input_wrapper">
                          <label>Importe</label>
                          <input type="text" :value="detalle.importe" disabled>
                        </div>

                        <div class="input_wrapper">
                          <label>Plazo</label>
                          <input type="text" :value="detalle.plazo" disabled>

                        </div>

                        <div class="input_wrapper">
                          <label>Cuotas del Sistema</label>
                          <input type="text" :value="detalle.cuotas" disabled>
                        </div>

                        <div class="input_wrapper">
                          <label>Aporte</label>
                          <input type="text" :value="detalle.aporte" disabled>
                        </div>

                      </div>

                      <div class="group_form all">
                        <div class="input_wrapper">
                          <label>Comentarios</label>
                          <textarea name="" id="" cols="auto" rows="10" :value="detalle.comentarios" disabled></textarea>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="form_step_wrapper in_bottom">
                    <h3 class="title">Evaluaciones</h3>

                    <div class="empty_message" v-if="!form.evaluacion">
                      <img src="img/empty.svg" >
                      <h1> Sin Evaluaciones </h1>
                      <p>Todavia no se han relizado evaluaciones a este prestamo</p>
                    </div>

                    <div class="table_wrapper" v-else>
                      <table class="table_clients">
                        <thead>
                          <tr>
                            <th>Evaluador</th>
                            <th>Comentarios</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr  v-for="evaluacion in form.evaluacion" :key="evaluacion.id">
                            <td v-text="evaluacion.name"></td>
                            <td v-text="evaluacion.detalle"></td>
                            <td> {{evaluacion.created_at | moment("D [de] MMMM, YYYY")}} </td>
                            <td class="state"> <span :class="stateEvaluation(evaluacion.estado)">  </span> {{evaluacion.estado | toCapitalize}} </td>
                          </tr>
                        </tbody>
                      </table>
                    </div> 
                    
                  </div>
                </div>
              </transition>

              <transition name="slide-fade" mode="in-out">
                <div v-show="tab == 2" class="form_step">
                  
                  <div class="row">
                      <div class="col-md-3 ratios p-0">
                        <div class="card-body p-0">
                              <table
                                class="table table-responsive-sm table-bordered table-striped table-sm"
                              >
                                <tbody>
                                  <tr  class="mt-3 title-table">
                                    <td colspan="3" class="pt-2 text-center">RATIOS</td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2" style="width: 11%;">ENDEUDAMIENTO</td>
                                    <td class="font-weight-bold pt-2"
                                    v-if="cuantitativa.radios_endeudamiento" 
                                    v-text="parseFloat(cuantitativa.ratios_endeudamiento).toFixed(2)"
                                    >
                                    </td>
                                    <td v-else>0</td>
                                    <td class="font-weight-bold pt-2" v-text="cuantitativa.ratios_endeudamiento_resultado"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2" style="width: 11%;">MARGEN NETO</td>
                                    <td
                                    v-if="cuantitativa.ratios_margen_neto"
                                    v-text="parseFloat(cuantitativa.ratios_margen_neto).toFixed(2)"
                                  ></td>
                                  <td v-else>0</td>
                                  <td v-text="cuantitativa.ratios_margen_neto_resultado"></td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2" style="width: 11%;">LIQUIDEZ</td>
                                    <td
                                    v-if="cuantitativa.ratios_liquidez"
                                    v-text="parseFloat(cuantitativa.ratios_liquidez).toFixed(2)"
                                  ></td>
                                  <td v-else>0</td>
                                  <td v-text="cuantitativa.ratios_liquidez_resultado"></td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2" style="width: 11%;"> SOLVENCIA</td>
                                    <td
                                    v-if="cuantitativa.ratios_solvencia"
                                    v-text="parseFloat(cuantitativa.ratios_solvencia).toFixed(2)"
                                  ></td>
                                  <td v-else>0</td>
                                  <td v-text="cuantitativa.ratios_solvencia_resultado"></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                      </div>
                      <div class="col-md-3 balance p-0">
                          <div class="card-body p-0">
                              <table
                                class="table table-responsive-sm table-bordered table-striped table-sm"
                              >
                                <tbody>
                                  <tr class="title-table">
                                    <td colspan="4" class="pt-2 text-center">BALANCE</td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 text-center" colspan="2">ACTIVO</td>
                                    <td class="pt-2 text-center" colspan="2">PASIVO</td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2">CAJA</td>
                                    <td class="font-weight-bold pt-2 " v-text="cuantitativa.balance_activo_caja"></td>
                                    <td class="pt-2">DEUDAS</td>
                                    <td class="font-weight-bold pt-2" v-text="cuantitativa.balance_pasivo_deudas"></td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2">INVENTARIO</td>
                                    <td class="font-weight-bold pt-2 " v-text="cuantitativa.balance_activo_inventario">0</td>
                                    <td class="font-weight-bold pt-2 text-center" colspan="2">PATRIMONIO</td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2">ACTIVO F</td>
                                    <td class="font-weight-bold pt-2 " v-text="cuantitativa.balance_activo_f"></td>
                                    <td class="pt-2">CAPITAL</td>
                                    <td class="font-weight-bold pt-2" v-text="cuantitativa.balance_patrimonio_capital"></td>
                                  </tr>
                                  <tr style="background: white;">
                                    
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 text-center" colspan="2"></td>
                                    <td class="pt-2">UTILIDAD</td>
                                    <td class="font-weight-bold pt-2 " v-text="cuantitativa.balance_patrimonio_utilidad"></td>
                                  </tr>

                                  <tr style="background: white;">
                                    <td class="pt-2">TOTAL</td>
                                    <td class="font-weight-bold pt-2 " v-text="cuantitativa.balance_activo_total"></td>
                                    <td class="pt-2">TOTAL</td>
                                    <td class="font-weight-bold pt-2 " v-text="cuantitativa.balance_patrimonio_total"></td>
                                  </tr>
                                  
                                </tbody>
                              </table>
                            </div>
                      </div>

                      <div class="col-md-3 ratios p-0">
                        <div class="card-body p-0">
                              <table
                                class="table table-responsive-sm table-bordered table-striped table-sm"
                              >
                                <tbody>
                                  <tr  class="mt-3 title-table">
                                    <td colspan="3" class="pt-2 text-center">FLUJO PARA CREDITOS DIARIOS</td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">MINIMO INGRESO</td>
                                    <td v-text="cuantitativa.fc_diario_minimo_ingreso"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">CUOTA</td>
                                    <td v-text="cuantitativa.fc_diario_cuota"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">DISPONIBLE DIARIO</td>
                                    <td v-text="cuantitativa.fc_diario_disponible_diario"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">PARTICIPACION DE LA CUOTA</td>
                                    <td v-text="cuantitativa.fc_diario_participacion_cuota"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">RESULTADO</td>
                                    <td v-text="cuantitativa.fc_diario_resultado"></td>

                                  </tr>

                                </tbody>
                              </table>
                            </div>
                      </div>

                      <div class="col-md-3 ratios p-0">
                        <div class="card-body p-0">
                              <table
                                class="table table-responsive-sm table-bordered table-striped table-sm"
                              >
                                <tbody>
                                  <tr  class="mt-3 title-table">
                                    <td colspan="3" class="pt-2 text-center">FLUJO PARA CREDITOS SEMANA</td>
                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">MINIMO INGRESO</td>
                                    <td v-text="cuantitativa.fc_semanal_minimo_ingreso"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">CUOTA</td>
                                    <td v-text="cuantitativa.fc_semanal_cuota"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">DISPONIBLE SEMANA</td>
                                    <td v-text="cuantitativa.fc_semanal_disponible_semana"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">PARTICIPACION DE LA CUOTA</td>
                                    <td v-text="cuantitativa.fc_semanal_"></td>

                                  </tr>
                                  <tr style="background: white;">
                                    <td class="pt-2 w-50">RESULTADO</td>
                                    <td v-text="cuantitativa.fc_semanal_resultado"></td>

                                  </tr>

                                </tbody>
                              </table>
                            <div class="col-md-12 cuantitativa p-0">
                              <div class="card">
                                <div class="d-flex justify-content-between title-table">
                                  EVALUACION CUANTITATIVA
                                </div>
                                <div class="card-body p-0">
                                  <table
                                    class="table table-responsive-sm table-bordered table-striped table-sm"
                                  >
                                    <tbody>
                                      <tr>
                                        <td>FLUJO DE CAJA MENSUAL</td>
                                        <td>Titular</td>
                                        <td>CONYUGE</td>
                                        <td>Unidad Familiar</td>
                                        <td>Comprobación</td>
                                      </tr>
                                      <tr>
                                        <td class="">INGRESOS/ VENTAS</td>
                                        <td v-text="cuantitativa.ingresos_ventas_titular"></td>
                                        <td v-text="cuantitativa.ingresos_ventas_CONYUGE"></td>
                                        <td v-text="cuantitativa.ingresos_ventas_total"></td>
                                        <td v-text="cuantitativa.ingresos_ventas_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td class="">Costo de venta</td>
                                        <td v-text="cuantitativa.costo_venta_titular"></td>
                                        <td v-text="cuantitativa.costo_venta_CONYUGE">0</td>
                                        <td v-text="cuantitativa.consto_venta_total"></td>
                                        <td v-text="cuantitativa.costo_venta_validacion"></td>
                                      </tr>
                                      <tr style="background: rgb(155, 155, 155);">
                                        <td class="font-weight-bold">Margen Bruto</td>
                                        <td v-text="cuantitativa.margen_bruto_titular"></td>
                                        <td v-text="cuantitativa.margen_bruto_CONYUGE"></td>
                                        <td v-text="cuantitativa.margen_bruto_total"></td>
                                        <td v-text="cuantitativa.margen_bruto_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td>Otros ingresos</td>
                                        <td v-text="cuantitativa.otros_ingresos_titular"></td>
                                        <td v-text="cuantitativa.otros_ingresos_CONYUGE"></td>
                                        <td v-text="cuantitativa.otros_ingresos_total"></td>
                                        <td v-text="cuantitativa.otros_ingresos_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td>Servicios LAT</td>
                                        <td v-text="cuantitativa.servicios_lat_titular"></td>
                                        <td v-text="cuantitativa.servicios_lat_CONYUGE"></td>
                                        <td v-text="cuantitativa.servicios_lat_total"></td>
                                        <td v-text="cuantitativa.servicios_lat_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td>Alquiler</td>
                                        <td v-text="cuantitativa.alquiler_titular"></td>
                                        <td v-text="cuantitativa.alquiler_CONYUGE"></td>
                                        <td v-text="cuantitativa.alquiler_total"></td>
                                        <td v-text="cuantitativa.alquiler_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td>Empleados</td>
                                        <td v-text="cuantitativa.empleados_titular"></td>
                                        <td v-text="cuantitativa.empleados_CONYUGE"></td>
                                        <td v-text="cuantitativa.empleados_total"></td>
                                        <td v-text="cuantitativa.empleados_validacion"></td>
                                      </tr>

                                      <tr>
                                        <td>Gasto Financiero</td>
                                        <td v-text="cuantitativa.gasto_financiero_titular"></td>
                                        <td v-text="cuantitativa.gasto_financiero_CONYUGE"></td>
                                        <td v-text="cuantitativa.gasto_financiero_total"></td>
                                        <td v-text="cuantitativa.gasto_financiero_validacion"></td>
                                      </tr>

                                        <tr>
                                        <td>Gasto Hogar</td>
                                        <td v-text="cuantitativa.gasto_hogar_titular"></td>
                                        <td v-text="cuantitativa.gasto_hogar_CONYUGE"></td>
                                        <td v-text="cuantitativa.gasto_hogar_total"></td>
                                        <td v-text="cuantitativa.gasto_hogar_validacion"></td>
                                      </tr>
                                      
                                      <tr style="background: rgb(155, 155, 155);">
                                        <td class="font-weight-bold">UTILIDAD</td>
                                        <td v-text="cuantitativa.utilidad_titular"></td>
                                        <td v-text="cuantitativa.utilidad_CONYUGE"></td>
                                        <td v-text="cuantitativa.utilidad_total"></td>
                                        <td v-text="cuantitativa.utilidad_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td>CUOTA INSITUTCION</td>
                                        <td v-text="cuantitativa.cuota_institucion_titular"></td>
                                        <td v-text="cuantitativa.cuota_institucion_CONYUGE"></td>
                                        <td v-text="cuantitativa.cuota_institucion_total"></td>
                                        <td v-text="cuantitativa.cuota_institucion_validacion"></td>
                                      </tr>
                                      <tr style="background: rgb(155, 155, 155);">
                                        <td class="font-weight-bold">UTILIDAD DESP CUOTA</td>
                                        <td v-text="cuantitativa.utilidad_desp_cuota_titular"></td>
                                        <td v-text="cuantitativa.utilidad_desp_cuota_CONYUGE"></td>
                                        <td v-text="cuantitativa.utilidad_desp_cuota_total"></td>
                                        <td v-text="cuantitativa.utilidad_desp_cuota_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td>Participacion de la cuota</td>
                                        <td v-text="cuantitativa.participacion_cuota_titular"></td>
                                        <td></td>
                                        <td v-text="cuantitativa.participacion_cuota_total"></td>
                                        <td v-text="cuantitativa.participacion_cuota_validacion"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="5">RESULTADO EVA <span v-text="cuantitativa.resultado_eva" ></span></td>
                                      </tr>
                                      <tr>
                                        <td colspan="5">RESULTADO SIST <span v-text="cuantitativa.resultado_sist"></span></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                      </div>

                      <div class="col-md-12 cuantitativa p-0">
                        <div class="card">
                          <div class="d-flex justify-content-between title-table">
                            EVALUACION CUANTITATIVA
                          </div>
                          <div class="card-body p-0">
                            <table
                              class="table table-responsive-sm table-bordered table-striped table-sm"
                            >
                              <tbody>
                                <tr>
                                  <td>FLUJO DE CAJA MENSUAL</td>
                                  <td>Titular</td>
                                  <td>Conyuge</td>
                                  <td>Unidad Familiar</td>
                                  <td>Comprobación</td>
                                </tr>
                                <tr>
                                  <td class="">INGRESOS/ VENTAS</td>
                                  <td v-text="cuantitativa.ingresos_ventas_titular"></td>
                                  <td v-text="cuantitativa.ingresos_ventas_conyuge"></td>
                                  <td v-text="cuantitativa.ingresos_ventas_total"></td>
                                  <td v-text="cuantitativa.ingresos_ventas_validacion"></td>
                                </tr>
                                <tr>
                                  <td class="">Costo de venta</td>
                                  <td v-text="cuantitativa.costo_venta_titular"></td>
                                  <td v-text="cuantitativa.costo_venta_conyuge">0</td>
                                  <td v-text="cuantitativa.consto_venta_total"></td>
                                  <td v-text="cuantitativa.costo_venta_validacion"></td>
                                </tr>
                                <tr style="background: rgb(155, 155, 155);">
                                  <td class="font-weight-bold">Margen Bruto</td>
                                  <td v-text="cuantitativa.margen_bruto_titular"></td>
                                  <td v-text="cuantitativa.margen_bruto_conyuge"></td>
                                  <td v-text="cuantitativa.margen_bruto_total"></td>
                                  <td v-text="cuantitativa.margen_bruto_validacion"></td>
                                </tr>
                                <tr>
                                  <td>Otros ingresos</td>
                                  <td v-text="cuantitativa.otros_ingresos_titular"></td>
                                  <td v-text="cuantitativa.otros_ingresos_conyuge"></td>
                                  <td v-text="cuantitativa.otros_ingresos_total"></td>
                                  <td v-text="cuantitativa.otros_ingresos_validacion"></td>
                                </tr>
                                <tr>
                                  <td>Servicios LAT</td>
                                  <td v-text="cuantitativa.servicios_lat_titular"></td>
                                  <td v-text="cuantitativa.servicios_lat_conyuge"></td>
                                  <td v-text="cuantitativa.servicios_lat_total"></td>
                                  <td v-text="cuantitativa.servicios_lat_validacion"></td>
                                </tr>
                                <tr>
                                  <td>Alquiler</td>
                                  <td v-text="cuantitativa.alquiler_titular"></td>
                                  <td v-text="cuantitativa.alquiler_conyuge"></td>
                                  <td v-text="cuantitativa.alquiler_total"></td>
                                  <td v-text="cuantitativa.alquiler_validacion"></td>
                                </tr>
                                <tr>
                                  <td>Empleados</td>
                                  <td v-text="cuantitativa.empleados_titular"></td>
                                  <td v-text="cuantitativa.empleados_conyuge"></td>
                                  <td v-text="cuantitativa.empleados_total"></td>
                                  <td v-text="cuantitativa.empleados_validacion"></td>
                                </tr>

                                <tr>
                                  <td>Gasto Financiero</td>
                                  <td v-text="cuantitativa.gasto_financiero_titular"></td>
                                  <td v-text="cuantitativa.gasto_financiero_conyuge"></td>
                                  <td v-text="cuantitativa.gasto_financiero_total"></td>
                                  <td v-text="cuantitativa.gasto_financiero_validacion"></td>
                                </tr>

                                  <tr>
                                  <td>Gasto Hogar</td>
                                  <td v-text="cuantitativa.gasto_hogar_titular"></td>
                                  <td v-text="cuantitativa.gasto_hogar_conyuge"></td>
                                  <td v-text="cuantitativa.gasto_hogar_total"></td>
                                  <td v-text="cuantitativa.gasto_hogar_validacion"></td>
                                </tr>
                                
                                <tr style="background: rgb(155, 155, 155);">
                                  <td class="font-weight-bold">UTILIDAD</td>
                                  <td v-text="cuantitativa.utilidad_titular"></td>
                                  <td v-text="cuantitativa.utilidad_conyuge"></td>
                                  <td v-text="cuantitativa.utilidad_total"></td>
                                  <td v-text="cuantitativa.utilidad_validacion"></td>
                                </tr>
                                <tr>
                                  <td>CUOTA INSITUTCION</td>
                                  <td v-text="cuantitativa.cuota_institucion_titular"></td>
                                  <td v-text="cuantitativa.cuota_institucion_conyuge"></td>
                                  <td v-text="cuantitativa.cuota_institucion_total"></td>
                                  <td v-text="cuantitativa.cuota_institucion_validacion"></td>
                                </tr>
                                <tr style="background: rgb(155, 155, 155);">
                                  <td class="font-weight-bold">UTILIDAD DESP CUOTA</td>
                                  <td v-text="cuantitativa.utilidad_desp_cuota_titular"></td>
                                  <td v-text="cuantitativa.utilidad_desp_cuota_conyuge"></td>
                                  <td v-text="cuantitativa.utilidad_desp_cuota_total"></td>
                                  <td v-text="cuantitativa.utilidad_desp_cuota_validacion"></td>
                                </tr>
                                <tr>
                                  <td>Participacion de la cuota</td>
                                  <td v-text="cuantitativa.participacion_cuota_titular"></td>
                                  <td></td>
                                  <td v-text="cuantitativa.participacion_cuota_total"></td>
                                  <td v-text="cuantitativa.participacion_cuota_validacion"></td>
                                </tr>
                                <tr>
                                  <td colspan="5">RESULTADO EVA <span v-text="cuantitativa.resultado_eva" ></span></td>
                                </tr>
                                <tr>
                                  <td colspan="5">RESULTADO SIST <span v-text="cuantitativa.resultado_sist"></span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

              
                </div>
              </transition>
            </div>
          </section>
        </div>
      </div>
    </div>

    <aside class="evaluation" v-if="estado=='PENDIENTE' && (rol=='3' || rol=='4')">
      <div class="title">Evaluador</div>
      <div class="evaluation_wrapper">

        <div class="input_box">
          <div class="input_box_wrapper">
            <div class="input_checkbox_wrapper radio" >
              <input type="radio" id="radio1" name="evaluation" v-model="form.estado" :value="'APROBADO'" />
              <label class="box_content" for="radio1">
                <div class="box">
                </div>
                <span>Aprobado</span>
              </label>
            </div>
            <div class="input_checkbox_wrapper radio" v-if="rol=='3'">
              <input type="radio" id="radio2" name="evaluation" v-model="form.estado" :value="'OBSERVADO'" />
              <label class="box_content" for="radio2">
                <div class="box">
                </div>
                <span>Observado</span>
              </label>
            </div>
            <div class="input_checkbox_wrapper radio" >
              <input type="radio" id="radio3" name="evaluation" v-model="form.estado" :value="'DESAPROBADO'" />
              <label class="box_content" for="radio3">
                <div class="box">
                </div>
                <span>{{rol== '3' ? 'Desaprobado' : 'Rechazado'}}</span>
              </label>
            </div>
          </div>
        </div>

        <div class="form_content">

          <div class="input_wrapper" v-if="rol=='3'">
            <label>Comentarios</label>
            <textarea v-model="form.detalle" ></textarea>
          </div>

          <div class="input_wrapper" v-if="rol=='4'">
              <label for>Producto</label>
              <input  type="text" v-model="form.producto"/> 
          </div>
            
          <div class="inline_inputs" v-if="rol=='4'">

            <div class="input_wrapper">
                <label   for>Aporte</label>
                <input   type="text" v-model="form.aporte"  /> 
            </div>

            <div class="input_wrapper" >
              <label  for>Plazo</label>
              <input  type="text" v-model="form.plazo" /> 
            </div>

          </div>

          <div class="input_wrapper" v-if="rol=='4'">
            <label  for>Importe</label>
            <input  type="text" v-model="form.importe"  /> 
          </div>

          <div class="inline_inputs" v-if="rol=='4'">

            <div class="input_wrapper">
                <label  for>Cuotas</label>
                <input type="text" v-model="form.cuotas"  /> 
            </div>
            
            <div class="input_wrapper">
                <label  for>Tasa</label>
                <input  type="text" v-model="form.tasa"/> 
            </div>

          </div>

        </div>

        <button class="button_primary medium" @click="firmarEvaluacion()">
          <span>
            FIRMAR EVALUACIÓN
          </span>
          <i class="material-icons-outlined">fingerprint</i>
        </button> 
      </div>
    </aside>
    
</div>
</template>

<script>
export default {
  data() {
    return {
      resource: "evaluaciones",
      id_prestamo: 0, 
      detalle: {},
      tab: 1,
      cuantitativa: {},
      rol: this.$route.params.rol, 
      estado: this.$route.params.estado,
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

      person: {},
      archivos: []
    };
  },
  async created() {
    await this.formInit(); 
  },
  mounted(){
    this.methodsDetalle(this.$route.params.prestamo);
  },
  methods: {
    listFile(id) {
      this.$http.get(`/files/${id}`).then(response => {
        this.person = response.data["datos"];
        this.archivos = response.data["files"];
      });
    },
    methodsDetalle(id) { 
      if(this.rol=='4' || this.rol=='1' || this.rol=='2'){
        this.$http
        .get(`/${this.resource}/prestamos/detalleF/` + id)
        .then(response => {
          console.log(response.data);
          if (response.data.cuantitativa)
            this.cuantitativa = response.data.cuantitativa;
            this.detalle = response.data.prestamo;
            this.form.evaluacion = response.data.evaluacion;
            this.listFile(id);
            this.form.producto = this.detalle.producto;
            this.form.aporte = this.detalle.aporte;
            this.form.importe = this.detalle.importe;
            this.form.plazo = this.detalle.plazo;
            this.form.cuotas = this.detalle.cuotas;
            this.form.tasa = this.detalle.tasa;
            this.form.estado = this.detalle.estado;
            this.form.prestamos_id = id;
            this.id_prestamo = id;
        });
      }
      else if(this.rol=='3'){
        this.$http
        .get(`/${this.resource}/prestamos/detalle/` + id)
        .then(response => {
          this.detalle = response.data;
          this.listFile(id);
          this.form.prestamos_id = id;
          this.id_prestamo= id;
        });

      }
    },
    formInit() {
       if(this.rol=='4'){
            this.form = {
              producto: "",
              aporte: "",
              importe: "",
              plazo: "",
              cuotas: "",
              tasa: "",
              estado: "",
              prestamos_id: "",
              evaluacion: []
            };
       }
       else if(this.rol=='3'){
            this.form = {
              detalle: "",
              estado: "",
              prestamos_id: ""
            };
       }
    },
    cargarPdf() {
      window.open("/clientes/adjuntarPdf/" + this.id_prestamo, "_blank");
    },
    firmarEvaluacion() {
      if(this.rol=='4'){
              // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }

            this.$http
              .post(`/${this.resource}/prestamos/evaluarFinal`, this.form)
              .then(response => {
                this.$toast.success(
                  "El evaluacion fue exitosa",
                  "Exitoso",
                  this.notificationSystem.options.success
                );
              })

              .then(() => {
                // this.loading_submit = false;
              });
      }
      else if(this.rol=='3'){
              // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }

      this.$http
        .post(`/${this.resource}/prestamos/evaluar`, this.form)
        .then(response => {
          this.tipo= true
          this.$toast.success(
              "El evaluacion fue exitosa",
              "Exitoso",
              this.notificationSystem.options.success
            ); 
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
    stateEvaluation(estado) {
      if (estado == 'APROBADO') return 'accept'
      if (estado == 'OBSERVADO') return 'observed'
      if (estado == 'DESAPROBADO') return 'denied'
      return 
    }
  },
  filters: {
    toCapitalize (text) {
      return text.toLowerCase().replace(/\b\w/g, l => l.toUpperCase())
    }
  }
};
</script>

<style lang="sass">
@import "../../sass/variables"
.evaluation_content
  display: flex
  .evaluation_detail
    flex: 1
    .tab_inline
      background-color: white
      height: 30px
      display: flex
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
      .add_section
        border-top: none
      .empty_message
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
          width: 220px
          text-align: center
          line-height: 1.3
      table
        thead, tbody
          tr
            margin-bottom: 0px
            border-bottom: 1px solid $bg_color
        tbody
          tr:last-child
            border-bottom: 0

        .state
          span
            width: 12px
            height: 12px
            border-radius: 50%
            background-color: $line_color
            margin-right: 12px
            margin-top: -2px
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
</style>
