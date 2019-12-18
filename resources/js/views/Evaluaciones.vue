<template>
  <div class="container-general">
    <div class="evaluations">
      <div class="row col-md-12 m-0" v-if="tipo">
        <div class="card col-md-12 p-0 ">
          <div class="card-header">PRESTAMOS</div>
          <div class="card-body p-0"> 
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Fecha de registro</th>
                    <th>Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="prestamo in prestamos" :key="prestamo.id">
                    <td v-text="prestamo.nombres +' '+ prestamo.apellidos"></td>
                    <td v-text="prestamo.created_at"></td>
                    <td v-text="prestamo.estado"></td>
                    <td>
                      <button
                        class="btn btn-success"
                        style="width:50%"
                        @click="methodsDetalle(prestamo.id)"
                      >Evaluar</button>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>

      <div class="row col-md-12 m-0 evaluations" v-else>
        <div class="col-md-9 p-0">
          <div class="row m-0">
            <div class="card loans w-100">
              <div class="card-header">ARCHIVOS</div>
              <div class="card-body">
                <div class="col-md-12 file p-0">
                  <div class="row m-0">

                      <div class="file-type " @click="cargarPdf()">
                          <div class="type file-document" >
                            <!-- <button
                              class="btn btn-def "
                              title="Delete"
                              data-toggle="modal"
                              data-target="#exampleModal"
                            >
                              <i class="fas fa-trash"></i> ELIMINAR
                            </button> -->
                            
                            <p>solicitud_credito.pdf</p> 
                              <div class="mask">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M17.656 4c-1.336 0-2.59.52-3.535 1.465L5.465 14.12A4.964 4.964 0 0 0 4 17.656V57c0 1.652 1.348 3 3 3h40c1.652 0 3-1.348 3-3V46h8c1.102 0 2-.898 2-2V24c0-1.102-.898-2-2-2h-8V7c0-1.652-1.348-3-3-3zM18 6h29c.55 0 1 .45 1 1v15H16c-1.102 0-2 .898-2 2v20c0 1.102.898 2 2 2h32v11c0 .55-.45 1-1 1H7c-.55 0-1-.45-1-1V18h9c1.652 0 3-1.348 3-3zm-2 .5V15c0 .55-.45 1-1 1H6.5c.11-.164.234-.32.379-.465l8.656-8.656c.145-.145.3-.27.465-.379zM16 24h42v20H16zm9 4a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3c1.652 0 3-1.348 3-3v-2c0-1.652-1.348-3-3-3zm10 0a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3c2.207 0 4-1.793 4-4v-4c0-2.207-1.793-4-4-4zm10 0a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3a1 1 0 1 0 0-2h-3v-4h4a1 1 0 1 0 0-2zm-19 2h3c.55 0 1 .45 1 1v2c0 .55-.45 1-1 1h-3zm10 0h2c1.102 0 2 .898 2 2v4c0 1.102-.898 2-2 2h-2zM9 52a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1z"></path></svg>
                              </div>
                          </div>
                        </div>

                    <div class="files" v-for="(archivo, index) in archivos" :key="index">
                      <i class="fas fa-eye eye"></i>
                      <a
                        :href="'../storage/'+person.documento+'_'+person.id+'/prestamo_'+archivo.prestamos_id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension"
                        target="_blank"
                      >
                        <p v-text="archivo.nombre+'.'+archivo.extension"></p>
                        <div class="mask">
                          <i class="fas fa-file-download file-one"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 p-0">
              <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">EVALUACIONES</div>
                    <div class="card-body">
                      <h5 class="card-title">Special title treatment</h5>
                      <p
                        class="card-text"
                      >With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">DETALLE DE PRESTAMO</div>
                    <div class="card-body">
                      <div class="row loan-date m-0">
                        <div class="col-md-6">
                          <label for>Producto</label>
                          <p v-text="detalle.producto"></p>
                        </div>
                        <div class="col-md-6">
                          <label for>Formas</label>
                          <p v-text="detalle.forma"></p>
                        </div>
                        <div class="col-md-3">
                          <label for>Importe</label>
                          <p v-text="detalle.importe"></p>
                        </div>
                        <div class="col-md-3">
                          <label for>Plazo</label>
                          <p v-text="detalle.plazo"></p>
                        </div>
                        <div class="col-md-3">
                          <label for>Cuotas</label>
                          <p v-text="detalle.cuotas"></p>
                        </div>
                        <div class="col-md-3">
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
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 m-0 views">
          <div class="row m-0">
            <div class="col-md-12 status pt-4 pb-4 pl-3">
              <input type="radio" id="aprobado" value="APROBADO" v-model="form.tipo" />
              <label for="uno">Aprobado</label>
              <input type="radio" id="observado" value="OBSERVADO" v-model="form.tipo" />
              <label for="Dos">Observado</label>
              <input type="radio" id="desaprobado" value="DESAPROBADO" v-model="form.tipo" />
              <label for="Dos">Desaprobado</label>
            </div>

            <div class="col-md-12">
              <label for>Producto</label>
              <input type="text" v-model="form.producto" class="form-control" />
            </div>
            <div class="col-md-6">
              <label for>Aporte</label>
              <input type="text" v-model="form.aporte" class="form-control" />
            </div>
            <div class="col-md-6">
              <label for>Importe</label>
              <input type="text" v-model="form.importe" class="form-control" />
            </div>
            <div class="col-md-12">
              <label for>Plazo</label>
              <input type="text" v-model="form.plazo" class="form-control" />
            </div>
            <div class="col-md-6">
              <label for>Cuotas</label>
              <input type="text" v-model="form.cuotas" class="form-control" />
            </div>
            <div class="col-md-6">
              <label for>Tasa</label>
              <input type="text" v-model="form.tasa" class="form-control" />
            </div>
            <div class="col-md-12">
              <button class="btn btn-success w-100 mb-1 mt-2" @click="firmarEvaluacion()">FIRMAR</button>
            </div>
            <!-- <div class="col-md-12">
              <button class="btn btn-success w-100 mb-1 mt-1">GUARDAR</button>
            </div>-->
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
      prestamos: [],
      detalle: {},
      tipo: true,
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
    await this.methodsPrestamo();
  },
  methods: {
    listFile(id) {
      this.$http.get(`/files/${id}`).then(response => {
        this.person = response.data["datos"];
        this.archivos = response.data["files"];
      });
    },
    methodsPrestamo() {
      this.$http.get(`/${this.resource}/prestamos/`).then(response => {
        this.prestamos = response.data;
      });
    },
    methodsDetalle(id) {
      this.tipo = false;
      this.$http
        .get(`/${this.resource}/prestamos/detalle/` + id)
        .then(response => {
          this.detalle = response.data;
          this.listFile(id);
          this.form.producto = this.detalle.producto;
          this.form.aporte = this.detalle.aporte;
          this.form.importe = this.detalle.importe;
          this.form.plazo = this.detalle.plazo;
          this.form.cuotas = this.detalle.cuotas;
          this.form.tasa = this.detalle.tasa;
          this.form.tipo = "";
          this.form.prestamos_id = id;
          this.id_prestamo= id;
        });
    },
    formInit() {
      this.form = {
        producto: "",
        aporte: "",
        importe: "",
        plazo: "",
        cuotas: "",
        tasa: "",
        tipo: "",
        prestamos_id: ""
      };
    },
        cargarPdf(){
                window.open('/clientes/solicitudPdf/'+this.id_prestamo,'_blank'); 
      },
    firmarEvaluacion() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }

      this.$http
        .post(`/${this.resource}/prestamos/evaluar`, this.form)
        .then(response => {
          if (response.data.success) {
            console.log();
          } else {
            this.resetForm();
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
    },
    cancelarEvaluacion() {
      this.tipo = true;
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
