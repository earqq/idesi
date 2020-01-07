<template>
  <div>
    <div class="container-general" v-if="tipo">

        <div class="row col-md-12 clients-option">

          <div class="col-md-2 type-view">
              <button class="btn btn-def form-control">Card</button>
              <button class="btn btn-def form-control">Lista</button>
          </div>
          <div class="col-md-5 search-option">
              <input type="text" class="form-control" placeholder="Buscar Cliente" v-model="search_input" @input="search_product">
              <i class="fas fa-search"></i>
          </div>

          <div class="row col-md-5 more-option">
             <select class="col-md-4 form-control col-md-3" v-model="form.tipo_persona" @change="getType()" >
              <option value="PN">Persona Natural</option>
              <option value="PJ">Persona Juridica</option>
            </select>
            <button class="btn btn-def col-md-4 form-control" @click="crearCliente()">Crear Solicutd</button>
          </div>

        </div>
        <div class="col-md-12 clients-date">
            <div class="row date"  v-if="form.tipo_persona=='PN'">
                <div class="card-client d-flex align-items-center flex-column justify-content-center" v-for="cliente in clientes" :key="cliente.id" >
                    <router-link :to="{name:'perfil', params:{documento:cliente.documento}}">
                      <p class="card-name" v-text="cliente.nombres"></p>
                      <p class="card-document" v-text="cliente.documento">dni</p>
                      <img src="https://picsum.photos/100/100" alt />
                    </router-link>
                </div>     
            </div>
            <div class="row date"  v-else>
                <div class="card-client d-flex align-items-center flex-column justify-content-center" v-for="cliente in clientes" :key="cliente.id" >
                    <router-link :to="{name:'perfiljuridico', params:{documento:cliente.documento}}">
                      <p class="card-name" v-text="cliente.nombres"></p>
                      <p class="card-document" v-text="cliente.documento">dni</p>
                      <img src="https://picsum.photos/100/100" alt />
                    </router-link>
                </div>     
            </div>
        </div>

    </div>

    <!-- +++++++++++++++++++ -->
    <!-- CREAR NUEVO CLIENTE -->
    <!-- +++++++++++++++++++ -->

    <div class="container-general create-client" style="background:#dceaf0" v-else>
      <header>
        <span @click="cancelarCliente()">
          <i class="fas fa-angle-left"></i>
        </span>
        <h1 v-if="form.tipo_persona=='PN'" >Admision Persona Natural</h1>
        <h1 v-else > Admision Persona Juridica </h1>
      </header>

      <div class="date-client">    
        <div class="col-md-12">
          <registrar-natural :tipo_persona="form.tipo_persona" v-if="form.tipo_persona=='PN'" ></registrar-natural>
          <registrar-juridico :tipo_persona="form.tipo_persona"  v-else-if="form.tipo_persona=='PJ'"></registrar-juridico>
        </div>

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
  name: 'clients',
  components: { InfiniteLoading, DatePick,RegistrarNatural,RegistrarJuridico },
  data() {
    return {
      resource: "clientes",
      clientes: [],
      page: 0,
      tipo: true,
      search_input: "",
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
  async mounted() {
    await this.getRecords();
  },
  methods: {
    async search_product() {
      // this.search_status = 0;
      await this.getRecords();
      // this.search_status = 1;
    },
    getType(){
      this.getRecords()
    },
    getRecords() {
      console.log(this.form.tipo_persona)
      this.clientes= [];
      if(this.form.tipo_persona=='PN'){
        return this.$http 
        .get(
          `/${this.resource}/listado?search_input=${this.search_input}`
        )
        .then(response => {
          this.clientes = response.data.data;
        });
      }else{
        return this.$http 
        .get(
          `/${this.resource}/listado/juridico?search_input=${this.search_input}`
        )
        .then(response => {
          this.clientes = response.data.data;
        });
      }
    },
    crearCliente() {
      this.tipo = false;
    },
    cancelarCliente() {
      this.tipo = true;
    },
    initForm() {
      this.form = {
        tipo_persona: "PN"
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
