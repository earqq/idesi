<template>

    <div class="create_client_content">

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

                    </div>detalle.comentarios

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
