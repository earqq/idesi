<template>
  <div class="container-general">
    <div class="evaluations">
      <div class="row col-md-12 m-0 evaluations p-0">
        
        <div class="col-md-9 p-0" style="overflow-y: auto;height: calc(100vh - 66px);">
          <div class="row m-0">
            <div class="nav-tabs style-tab-menu col-md-12">
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
                  >Detalles</a>
                </li>

                <li class="nav-item col-md-2">
                  <a
                    class="nav-link text-center"
                    id="representantes-tab"
                    data-toggle="tab"
                    href="#representantes"
                    role="tab"
                    aria-controls="representantes"
                    aria-selected="false"
                  >Evaluaciones</a>
                </li>
              </ul>
            </div>

            <div class="col-md-12 body-tabs p-0">
              <div class="tab-content" id="myTabContent">
                <div
                  class="tab-pane fade show active"
                  id="personal"
                  role="tabpanel"
                  aria-labelledby="personal-tab"
                >
            
            <div class="file-type" @click="cargarPdf()">
                             <button class="btn btn-crecer"> DESCARGAR EXPEDIENTE DE PRESTAMO</button>
            </div>

            <div class="col-md-12 p-0">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">PRESTAMO ANALISTA</div>
                    <div class="card-body p-0">
                      <div class="row loan-date m-0">
                        <div class="col-md-2">
                          <label for>Producto</label>
                          <p v-text="detalle.producto"></p>
                        </div>
                        <div class="col-md-2">
                          <label for>Formas</label>
                          <p v-text="detalle.forma"></p>
                        </div>
                        <div class="col-md-2">
                          <label for>Importe</label>
                          <p v-text="detalle.importe"></p>
                        </div>
                        <div class="col-md-2">
                          <label for>Plazo</label>
                          <p v-text="detalle.plazo"></p>
                        </div>
                        <div class="col-md-2">
                          <label for>Cuotas</label>
                          <p v-text="detalle.cuotas"></p>
                        </div>
                        <div class="col-md-2">
                          <label for>Aporte</label>
                          <p v-text="detalle.aporte"></p>
                        </div>
                        <div class="col-md-12">
                          <label for>Comentarios</label>
                          <p v-text="detalle.comentarios"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="container-fluid">
                    <!-- Ejemplo de tabla Listado -->
                    <div class="card">
                      <div class="card-header">
                        <i class="fa fa-align-justify"></i>Evaluaciones
                      </div>
                      <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Evaluador</th>
                              <th>Observaciones</th>
                              <th>Fecha</th>
                              <th>Estado</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="evaluacion in form.evaluacion" :key="evaluacion.id">
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
                </div>
              </div>
            </div>
                </div>

                <div
                  class="tab-pane fade"
                  id="representantes"
                  role="tabpanel"
                  aria-labelledby="representantes-tab"
                >
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
              </div>
            </div>
            
          </div>
        </div>

      <!-- <p>{{!(estado!='APROBADO' || rol!='2')}}</p> -->
        <div class="col-md-3 m-0 views" v-if="estado=='PENDIENTE' && (rol=='3' || rol=='4')">
          <div class="row m-0">
 
            <div class="col-md-12 status pt-4 pb-4 pl-3">
              <input type="radio" v-model="form.estado" value="APROBADO" />APROBADO
              <input v-if="rol=='3'"  type="radio" v-model="form.estado" value="OBSERVADO">OBSERVADO
              <input type="radio" v-model="form.estado" value="DESAPROBADO" />DESAPROBADO
              <textarea v-if="rol=='3'" v-model="form.detalle" cols="auto" rows="5" class="w-100"></textarea>
            </div>


            <div class="col-md-12"  v-if="rol=='4'">
              <label for>Producto</label>
              <input  type="text" v-model="form.producto" class="form-control" /> 
            </div>
            <div class="col-md-6" v-if="rol=='4'">
              <label   for>Aporte</label>
              <input   type="text" v-model="form.aporte" class="form-control" /> 
            </div>
            <div class="col-md-6" v-if="rol=='4'">
              <label  for>Importe</label>
              <input  type="text" v-model="form.importe" class="form-control" /> 
            </div>
            <div class="col-md-12" v-if="rol=='4'">
              <label  for>Plazo</label>
              <input  type="text" v-model="form.plazo" class="form-control" /> 
            </div>
            <div class="col-md-6"  v-if="rol=='4'">
              <label for>Cuotas</label>
              <input type="text" v-model="form.cuotas" class="form-control" /> 
            </div>
            <div class="col-md-6" v-if="rol=='4'">
              <label  for>Tasa</label>
              <input  type="text" v-model="form.tasa" class="form-control" /> 
            </div>

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
</template>

<script>
export default {
  data() {
    return {
      resource: "evaluaciones",
      id_prestamo: 0, 
      detalle: {},
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
      window.open("/clientes/solicitudPdf/" + this.id_prestamo, "_blank");
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
