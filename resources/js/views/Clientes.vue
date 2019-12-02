<template>
  <div>
    <!-- +++++++++++++++++++ -->
    <!-- LISTADO DE  CLIENTE -->
    <!-- +++++++++++++++++++ -->

    <div class="container-general container-fluid clients" v-if="tipo">
      <div class="card-client new" @click="crearCliente()">
        <i class="fas fa-plus-circle"></i>
        <h1>Crear Cliente</h1>
      </div>

      <div
        class="card-client d-flex align-items-center flex-column justify-content-center"
        v-for="cliente in clientes"
        :key="cliente.id"
      >
        <router-link :to="{name:'perfil', params:{documento:cliente.documento}}">
          <img src="https://picsum.photos/100/100" alt />
          <p v-text="cliente.nombres"></p>
          <p v-text="cliente.documento">dni</p>
        </router-link>
      </div>
      <infinite-loading @infinite="infiniteHander">
        <div
          slot="no-more"
          class
          style="text-align: center;line-height: 200px;"
        >No se encuentran mas datos</div>
        <div slot="spinner" class>Cargando datos ...</div>
      </infinite-loading>
    </div>

    <!-- +++++++++++++++++++ -->
    <!-- CREAR NUEVO CLIENTE -->
    <!-- +++++++++++++++++++ -->

    <div class="container-general create-client" v-else>
      <header>
        <span @click="cancelarCliente()">
          <i class="fas fa-angle-left"></i>
        </span>
        <h1>Crear Cliente</h1>
      </header>

      <div class="date-client">
        <div class="row d-flex justify-content-center">
          <div class="col-md-2 image">
            <img src alt />
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label for="documento">Documento de Identidad</label>
              <input
                type="text"
                class="form-control documento-input"
                v-model="form.documento"
                @change="datosCliente()"
                v-mask="{mask: '99999999', greedy: true}"
              />
            </div>

            <div class="row">
              <div class="form-group col-md-4">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" v-model="form.nombres" placeholder />
              </div>

              <div class="form-group col-md-4">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" v-model="form.apellidos" placeholder />
              </div>

              <div class="form-group col-md-4">
                <label for="nacimiento">Fecha de Nacimiento</label>
                <date-pick v-model="form.nacimiento"  :months="mesEs" :weekdays="diaEs"></date-pick>
              </div>
            </div>
          </div>

          <div class="col-md-2 offset-md-8 d-flex justify-content-end">
            <button class="btn btn-success w-100" @click.prevent="submit">Registrar Cliente</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";

const mesConf = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
];
const diaConf = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
export default { 
  components: { InfiniteLoading,DatePick },
  data() {
    return {
      resource: "clientes",
      clientes: [],
      page: 0,
      tipo: true,
      last_page: 1,
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
      mesEs: mesConf,
      diaEs: diaConf
    };
  },
  async created() {
    await this.initForm();
  },
  methods: {
    infiniteHander($estado) {
        this.page++
      console.log($estado);
      let url = "/clientes?page=" + this.page; 
      axios.get(url).then(response => {
        let datos = response.data.data;
        
        if (this.page<=this.last_page) {
          this.clientes = this.clientes.concat(datos);
          $estado.loaded();
        } else {
          $estado.complete();
        }

        this.last_page = response.data.last_page;
      });
    },
    crearCliente() {
      this.tipo = false;
    },
    cancelarCliente() {
      this.tipo = true;
    },
    initForm() {
      this.form = {
        documento: "",
        nombres: "",
        apellidos: "",
        nacimiento: ""
      };
    },
    resetForm() {
      this.initForm();
    },
    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.documento
        })
        .then(function(response) {
          console.log(response.data);
          me.form.nombres = response.data["nombres"];
          me.form.apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          me.initForm();
        });
    },

    submit() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }

      this.$http
        .post(`/${this.resource}/nuevo`, this.form)
        .then(response => {
          if (response.data.success) {
            this.resetForm();
            this.$toast.success(
              "El cliente fue creado",
              "Exitoso",
              this.notificationSystem.options.success
            );
            this.tipo=true
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
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>

<style lang="scss" scoped>
.vdpWithInput {
  width: 100%;
}
.vdpWithInput > input {
  font-size: 16px;
  display: block;
  width: 100%;
  box-sizing: border-box;
  -webkit-appearance: none;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0.1em 0.3em;
  padding: 5px 40px 6px 15px;
  border-radius: 4px;
  background: white;
  border-width: 1px;
  border-style: solid;
  border-color: rgb(224, 224, 224);
  border-image: initial;
  outline: 0px;
}
</style>
