<template>
  <div>
    <div class="clients_content" >

      <div class="options_bar">
        <div class="search_bar">
          <i class="material-icons-outlined">search</i>
          <input type="text" placeholder="Buscar Cliente" v-model="search_input" @input="search_product">
          <select  v-model="form.tipo_persona" @change="getType()" >
            <option value="PN">Persona Natural</option>
            <option value="PJ">Persona Juridica</option>
          </select>
        </div>
        <div class="switch_view">
          <a @click="type_list_card" :class="{selected: type_list == 1}">
            <i class="material-icons-outlined">border_all</i>
          </a>
          <a @click="type_list_list" :class="{selected: type_list == 0}">
            <i class="material-icons-outlined">notes</i>
          </a>
        </div>

        <router-link  class="add_client button_primary medium" :to="{name:'registrar/natural'}"  v-if="form.tipo_persona=='PN'">
          <span>
            CREAR CLIENTE
          </span>
          <i class="material-icons-outlined">add</i>
        </router-link>
        <router-link class="add_client button_primary medium" :to="{name:'registrar/juridico'}"  v-if="form.tipo_persona=='PJ'">
          <span>
            CREAR CLIENTE
          </span>
          <i class="material-icons-outlined">add</i>
        </router-link>
      </div>

      <div class="table_container">

        <div class="table_grid"  v-if=" type_list=='1'">
          <article class="client_card" v-for="cliente in clientes" :key="cliente.id" >
            <router-link :to="{ name:'perfil', params: { documento: cliente.documento } }">
              <div class="detail">
                 <img src="https://picsum.photos/100/100" />
                <p class="card-document">{{cliente.apellidos || cliente.razon_social}}</p>
                <small class="card-name" >{{cliente.nombres}}</small>
              </div>
              <div class="phone">
                <i class="material-icons-outlined"> phone </i>
                <span>
                  971 755 982
                </span>
              </div>
            </router-link>
          </article>
          <a v-show="clientes.length < 6" class="spanner" v-for="i in 6" :key="i"  >
          </a>
        </div>

        <div class="table_wrapper" v-if=" type_list=='0'">
          <table class="table_clients">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Celular</th>
                <th>Documento</th>
                <th>Negocio</th>
                <th class="options">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr  v-for="cliente in clientes" :key="cliente.id">
                <td class="client">
                  <img src="https://picsum.photos/100/100" alt />
                  <p> {{cliente.nombres}} {{cliente.apellidos || cliente.razon_social}}</p>
                </td>
                <td>
                  971755982
                </td>
                <td> {{cliente.documento}} </td>
                <td>
                  Tienda de Ropa
                </td>
                <td class="options" >
                  <i class="material-icons-outlined" >more_horiz</i>
                  <ul>
                    <li>
                      <router-link :to="{name:'perfil', params:{documento:cliente.documento}}" >
                        Ver Cliente
                      </router-link>
                    </li>
                    <li>
                        Nuevo Prestamo
                    </li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>

    </div>

  </div>
</template> 

<script>
import DatePick from 'vue-date-pick'; 
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
  components: { DatePick},
  data() {
    return {
      resource: "clientes",
      clientes: [],
      type_list: 1,
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
    type_list_card(){
      this.type_list=1
    },
    type_list_list(){
      this.type_list=0
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
          this.clientes = response.data.data
        })
      }else{
        return this.$http 
        .get(
          `/${this.resource}/listado/juridico?search_input=${this.search_input}`
        )
        .then(response => {
          this.clientes = response.data.data;
        })
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

<style lang="sass" scoped>
@import "../../sass/variables"
@import "../../sass/buttons"
.clients_content
  .options_bar
    display: grid
    grid-template-columns: 1fr 120px 200px
    grid-gap: 15px
    padding: 20px
    box-sizing: border-box 
    .add_client
      width: 200px
    .search_bar
      border-radius: 3px
      background-color: white
      box-shadow: $shadow
      flex: 1
      height: 40px
      display: flex
      align-items: center
      padding: 0 15px
      i
        font-size: 20px
      input, select
        border: none
        font-family: $font
        height: 100%
        font-size: 13px
        &:hover, &:focus
          outline: none
      input
        flex: 1
        padding-left: 10px
      select
        border-left: 1px solid $line_color
        padding: 0 15px
        box-sizing: border-box
    .switch_view
      border-radius: 3px
      background-color: white
      box-shadow: $shadow
      flex: 1
      height: 40px
      display: flex
      a
        height: 100%
        flex: 1
        flex-basis: 0
        display: flex
        justify-content: center
        align-items: center
        cursor: pointer
        color: rgba($text_color, .3)
        user-select: none
        &.selected
          i
            color: $primary_color
        i
          font-size: 20px
        &:first-child
          border-right: 1px solid $line_color

  .table_container
    .table_grid
      display: grid
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr) )
      grid-gap: 15px
      padding: 0 20px
      box-sizing: border-box
      .client_card
        background-color: white
        border-radius: 4px
        box-shadow: $shadow
        box-sizing: border-box
        transition: all ease-in-out .3s
        &:hover
          box-shadow: $shadow_hover
        a
          text-decoration: none
          .detail
            display: flex
            flex-direction: column
            align-items: center
            justify-content: center
            padding: 30px 20px
            width: 100%
            img
              width: 55px
              height: 55px
              border-radius: 50%
              object-fit: cover
            p, small
              color: $text_color
              margin: 0
            p
              font-weight: 500
              font-size: 12px
              margin-top: 10px
              text-align: center
              line-height: 1.3
            small
              font-size: 10px
              display: block
          .phone
            display: flex
            justify-content: space-between
            align-items: center
            width: 100%
            padding: 10px 20px
            border-top: 1px solid $line_color
            i
              font-size: 18px
              color: $primary_color
            span
              flex: 1
              text-align: center
              font-size: 12px
              color: $text_color
              font-weight: 500
              margin-bottom: -2px
    .table_wrapper
      padding: 0 20px
      box-sizing: border-box
      .table_clients
        box-shadow: $shadow
        tbody
          .client
            img
              width: 24px
              height: 24px
              border-radius: 50%
              object-fit: cover
            p
              margin: 0
              margin-left: 10px
              text-align: left
</style>
