<template>
  <div class="container-general">
    <div class="row m-0 evaluations">
      <div class="row col-md-12 m-0" v-if="tipo">
        <div class="col-md-12 loans">
          <h1>Prestamos</h1>
          <table style="width:100%">
            <tr>
              <th>Cliente</th>
              <th>Estado</th>
              <th></th>
            </tr>

            <tr v-for="prestamo in prestamos" :key="prestamo.id">
              <td v-text="prestamo.nombres +' '+ prestamo.apellidos"></td>
              <td v-text="prestamo.estado">Pendiente</td>
              <td>
                <button
                  class="btn btn-success"
                  style="width:50%"
                  @click="methodsDetalle(prestamo.id)"
                >Evaluar</button>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row col-md-12 m-0 evaluations" v-else>
        <div class="col-md-9 p-0">
          <div class="row m-0">
            <div class="col-md-12 p-0 loans">
              <h1>Archivos</h1>
            </div>

            <div class="col-md-12 file p-0">
              <div class="row m-0">
                <div class="files" v-for="(archivo, index) in archivos" :key="index">
                  <i class="fas fa-eye eye"></i>
                  <a
                    :href="'../storage/'+person.nombres+'_'+person.apellidos+'_'+person.id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension"
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

            <div class="col-md-12 p-0">
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

        <div class="col-md-3 m-0 views">
          <div class="row m-0">
            <div class="col-md-12 status pt-4 pb-4 pl-3">
              <input type="radio" v-model="form.tipo" /> Aprobado
              <input type="radio" v-model="form.tipo" /> Observado
              <input type="radio" v-model="form.tipo" /> Desaprobado
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
              <label for>Taza</label>
              <input type="text" v-model="form.taza" class="form-control" />
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
        console.log(this.person);
      });
    },
    methodsPrestamo() {
      this.$http.get(`/${this.resource}/prestamos/`).then(response => {
        this.prestamos = response.data;
        console.log(this.prestamos);
      });
    },
    methodsDetalle(id) {
      this.tipo = false;
      this.$http
        .get(`/${this.resource}/prestamos/detalle/` + id)
        .then(response => {
          this.detalle = response.data;
          this.listFile(id);
          // console.log(this.detalle);
        });
    },
    formInit() {
      this.form = {
        producto: "",
        aporte: "",
        importe: "",
        plazo: "",
        cuotas: "",
        taza: "",
        tipo: ""
      };
    },
    firmarEvaluacion() {},
    cancelarEvaluacion() {
      this.tipo = true;
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
