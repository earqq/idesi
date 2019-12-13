<template>
  <div>
    <div class="container-general" v-if="tipo">
        <div class="row col-12 box-search">
            <div class="search">
               <i class="fas fa-search"></i>
                <input type="text" class="form-control"  placeholder="Buscar cliente"/>
            </div>
            <select name="" id="">
              <option value="">TODOS</option>
              <option value="">PERSONA NATURAL</option>
              <option value="">PERSONA JURIDICA</option>
            </select>
         </div>
      <div class="clients">
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
            </infinite-loading>
      </div>
      
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
              <div class="form-group col-md-3">
                <label>Tipo de persona</label>
                <select v-model="form.tipo_persona" class="form-control">
                  <option value="0">SELECCIONE</option>
                  <option value="PJ">PERSONA JURIDICA</option>
                  <option value="PN">PERSONA NATURAL</option>
                </select>
              </div>
        <registrar-natural :tipo_persona="form.tipo_persona" v-if="form.tipo_persona=='PN'" ></registrar-natural>
        <registrar-juridico :tipo_persona="form.tipo_persona"  v-else-if="form.tipo_persona=='PJ'"></registrar-juridico>

      </div>
    </div>
  </div>
</template> 

<script>
import InfiniteLoading from "vue-infinite-loading";
import DatePick from 'vue-date-pick';
import RegistrarNatural from './componentes/clientes/RegistrarNatural.vue'; 
import RegistrarJuridico from "./componentes/clientes/RegistrarJuridico.vue";
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
  components: { InfiniteLoading, DatePick,RegistrarNatural,RegistrarJuridico },
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
      this.page++;
      console.log($estado);
      let url = "/clientes/listado?page=" + this.page;
      axios.get(url).then(response => {
        let datos = response.data.data;
          console.log(response.data.data)
        if (this.page <= this.last_page) {
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
        tipo_persona: "0"
      };
    },
    resetForm() {
      this.initForm();
    },
    
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
