<template>

<div class="">
 
  <div class="container-general">
    <div class="evaluations">
      <div class="row col-md-12 m-0 evaluations p-0">

        
        <div class="col-md-9 p-0" style="overflow-y: auto;height: calc(100vh - 66px);">

          <div class="create_client_content">
              <section class="tabs_section">
                <div class="tabs_wrapper">
                  <div
                    class="tab"
                    @click="tab = 1"
                    :class=" {selected: tab == 1}"
                  >
                    <p>Detalles</p>
                  </div>
                  <div class="tab" @click="tab = 2" :class="{selected: tab == 2}">
                    <p>Evaluaciòn</p>
                  </div>
                </div>
              </section>

               <section class="client_forms">
                  <div class="client_forms_wrapper">

                    <transition name="slide-fade" mode="in-out">

                      <div v-show="tab == 1" class="form_step">
                        
                        <button
                          type="button"
                          @click="cargarPdf()"
                          class="add_section"
                        >
                          <span>DESCARGAR EXPEDIENTE DE PRESTAMO</span>
                          <i class="fas fa-plus"></i>
                        </button>


                        <div class="form_step_wrapper">
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
                            </div>

                            <div class="group_form">

                              <div class="input_wrapper">
                                <label>Cuotas del Sistema</label>
                                <input type="text" :value="detalle.cuotas" disabled>
                              </div>

                              <div class="input_wrapper">
                                <label>Aporte</label>
                                <input type="text" :value="detalle.aporte" disabled>
                              </div>

                            </div>

                            <div class="group_form">

                              <div class="input_wrapper">
                                <label>Comentarios</label>
                                <textarea name="" id="" cols="auto" rows="10" :value="detalle.comentarios" disabled></textarea>
                              </div>

                            </div>
                          </div>
                        </div>


                        <div class="form_step_wrapper">
                          <h3 class="title">Evaluaciones</h3>

                          <div class="table_wrapper" v-if=" type_list=='0'">
                            <table class="table_clients">
                              <thead>
                                <tr>
                                  <th>Evaluador</th>
                                  <th>Observaciones</th>
                                  <th>Fecha</th>
                                  <th>Estado</th>
                                  <!-- <th class="options">Opciones</th> -->
                                </tr>
                              </thead>
                              <tbody>
                                <tr  v-for="evaluacion in form.evaluacion" :key="evaluacion.id">
                                  <td v-text="evaluacion.name"></td>
                                  <td v-text="evaluacion.detalle"></td>
                                  <td v-text="evaluacion.created_at"></td>
                                  <td v-text="evaluacion.estado"></td>
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
                                        <td>Cónyuge</td>
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

      <!-- <p>{{!(estado!='APROBADO' || rol!='2')}}</p> -->
        <div class="col-md-3 m-0 views" v-if="estado=='PENDIENTE' && (rol=='3' || rol=='4')">

          <div class="create_client_content">

              <section class="client_forms">

                  <div class="client_forms_wrapper">

                      <transition name="slide-fade" mode="in-out">

                        <div class="form_step_wrapper">
                      
                          <div class="form_content">

                            <div class="group_form">

                              <div class="input_wrapper">
                                <input type="radio" v-model="form.estado" value="APROBADO" />APROBADO
                              </div>

                              <div class="input_wrapper" v-if="rol=='3'">
                                <input  type="radio" v-model="form.estado" value="OBSERVADO">OBSERVADO
                              </div>

                              <div class="input_wrapper">
                                <input type="radio" v-model="form.estado" value="DESAPROBADO" />DESAPROBADO
                              </div>
                            </div>

                
                            <div class="group_form" v-if="rol=='3'" >
                              <div class="input_wrapper">
                                <label>Observación</label>
                                <textarea v-model="form.detalle" cols="auto" rows="5" class="w-100"></textarea>
                              </div>
                            </div>


                            <div class="group_form" v-if="rol=='4'">

                              <div class="input_wrapper">
                                  <label for>Producto</label>
                                  <input  type="text" v-model="form.producto"/> 
                              </div>
                              
                            </div>

                            <div class="group_form" v-if="rol=='4'">

                              <div class="input_wrapper">
                                  <label   for>Aporte</label>
                                  <input   type="text" v-model="form.aporte"  /> 
                              </div>

                              <div class="input_wrapper">
                                  <label  for>Importe</label>
                                  <input  type="text" v-model="form.importe"  /> 
                              </div>

                            </div>

                            <div class="group_form" v-if="rol=='4'">

                              <div class="input_wrapper">
                                  <label  for>Plazo</label>
                                  <input  type="text" v-model="form.plazo" /> 
                              </div>
                              
                            </div>

                            <div class="group_form" v-if="rol=='4'">

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
                        </div>

                      </transition>


                  </div>

              </section>
          </div>

          <div class="row m-0">
 

            <div class="col-md-12" >
              <button class="btn btn-success w-100 mb-1 mt-2" @click="firmarEvaluacion()">FIRMAR</button> 
            </div> 
            <div class="col-md-12">
              <button class="btn btn-danger w-100 mb-1 mt-1" @click="cancelarEvaluacion()">CANCELAR</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
    cancelarEvaluacion() {
      
    }
  },
};
</script>
