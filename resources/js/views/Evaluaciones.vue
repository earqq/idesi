<template>
  <div class="container-general" style="background: rgb(220, 234, 240);">
    <div class="evaluations">
      <div class="row col-md-12 m-0" v-if="tipo">
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Lista de Evaluaciones
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" >
                                      <option value="name">Nombre</option>
                                      <option value="num_documento">Documento</option>
                                      <option value="Fecha">FEcha</option>
                                    </select>
                                    <input type="text" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
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
                                      <button type="button" @click="methodsDetalle(prestamo.id)" class="btn btn-warning btn-sm">
                                          <i class="fas fa-pencil-alt"></i> Evalular
                                        </button> &nbsp;
                                    </td>
                                  </tr>
                                                             
                            </tbody>
                        </table>
                        <!-- <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
      </div>

      <div class="row col-md-12 m-0 evaluations" v-else>
        <div class="col-md-9 p-0">
          <div class="row m-0">
                    <div class="nav-tabs style-tab-menu">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item col-md-2">
                          <a class="nav-link active text-center " id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="true" >Detalles</a>
                        </li>

                        <li class="nav-item col-md-2">
                          <a class="nav-link text-center" id="representantes-tab" data-toggle="tab" href="#representantes"  role="tab" aria-controls="representantes" aria-selected="false" >Evaluaciones</a>
                        </li>
                      </ul>
                    </div>
            <div class="card loans w-100">
              <div class="card-header">ARCHIVOS</div>
              <div class="card-body">
                <div class="col-md-12 file p-0">
                  <div class="row m-0">

                      <div class="file-type " @click="cargarPdf()">
                          <div class="type file-document" >
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
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 m-0 views" style="background:#fff">
          <div class="row m-0">
            <div class="col-md-12 status pt-4 pb-4 pl-3">
              <input type="radio" v-model="form.estado" value="APROBADO">APROBADO
              <input type="radio" v-model="form.estado" value="OBSERVADO">OBSERVADO
              <input type="radio" v-model="form.estado" value="DESAPROBADO">DESAPROBADO
              <textarea  v-model="form.detalle" cols="auto" rows="5" class="w-100"></textarea>
            </div>


            
            <div class="col-md-12">
              <button class="btn btn-def w-100 mb-1 mt-2" @click="firmarEvaluacion()">FIRMAR</button>
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
    await this.formInit()
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
          this.form.prestamos_id = id;
          this.id_prestamo= id;
        });
    },
    formInit() {
      this.form = {
        detalle: "",
        estado: "",
        prestamos_id: ""
      };
    },
    resetForm(){
      this.formInit()
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
