<template>
  <div>
    <div class="empty_message" v-if="clientes.length==0">
      <img src="img/empty.svg" >
      <h1> No se Encontraron Clientes </h1>
      <p>Registra un nuevo cliente para continuar.</p>
      <router-link  class="add_client button_primary small" :to="{name:'registrar/natural'}"  v-if="form.tipo_persona=='PN' && rol!='5'">
        <span>
          CREAR CLIENTE
        </span>
        <i class="material-icons-outlined">add</i>
      </router-link>
    </div>

    <div class="clients_content" v-else >

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
 
        <router-link  class="add_client button_primary medium" :to="{name:'registrar/natural'}"  v-if="form.tipo_persona=='PN' && rol!='5'">
          <span>
            CREAR CLIENTE
          </span>
          <i class="material-icons-outlined">add</i>
        </router-link>
        <router-link class="add_client button_primary medium" :to="{name:'registrar/juridico'}"  v-if="form.tipo_persona=='PJ' && rol!='5' ">
          <span>
            CREAR CLIENTE
          </span>
          <i class="material-icons-outlined">add</i>
        </router-link>
      </div>

      <div class="table_container">

        <div class="table_grid"  v-if=" type_list=='1'">
          <article class="client_card" v-for="cliente in clientes" :key="cliente.id" >
            <div class="options">
              <i class="material-icons-outlined" >more_horiz</i>
              <ul>
                <li>
                  Editar
                </li>
                <li>
                  Nuevo Prestamo
                </li>
              </ul>   
            </div>
            <router-link :to="{ name:'perfil', params: { documento: cliente.documento,persona:form.tipo_persona } }">
              <div class="detail">
                <div class="avatar">
                  <img src="https://picsum.photos/100/100" v-if="false"/>
                  <div class="avatar_alt" v-else>{{ cliente.apellidos ? cliente.apellidos.substring(0,1) : cliente.razon_social.substring(0,1) }}</div>
                </div>
                <p class="card-document">{{cliente.apellidos || cliente.razon_social}}</p>
                <small class="card-name" >{{cliente.nombres || cliente.documento}}</small>
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
                <th>Dirección</th>
                <th class="options">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr  v-for="cliente in clientes" :key="cliente.id">
                <td class="client">
                  <div class="avatar">
                    <img src="https://picsum.photos/200/300" v-if="false" />
                    <div class="avatar_alt" v-else> {{ cliente.apellidos ? cliente.apellidos.substring(0,1) : cliente.razon_social.substring(0,1) }} </div>
                  </div>
                  <p> {{cliente.nombres}} {{cliente.apellidos || cliente.razon_social}}</p>
                </td>
                <td>
                  {{cliente.celular || '--'}}
                </td>
                <td> {{cliente.documento}} </td>
                <td>
                  {{cliente.direccion_cliente || cliente.direccion || '--'}}
                </td>
                <td class="options" >
                  <i class="material-icons-outlined" >more_horiz</i>
                  <ul>
                    <li>
                      <router-link :to="{name:'perfil', params:{documento:cliente.documento,persona:form.tipo_persona}}" >
                        Ver Cliente
                      </router-link>
                    </li>
                    <li>
                      Editar
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
 
 
export default {
  name: 'clients', 
  data() {
    return {
      resource: "clientes",
      clientes: [],
      type_list: 1,
      page: 0,  
      search_input: "",
      last_page: 1,
      form: {},
      rol: 0,
      notificationSystem: {
        options: {
          success: {
            position: "topRight"
          },
          error: {
            position: "topRight"
          }
        }
      }
    }
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
      this.clientes= [];
      if(this.form.tipo_persona=='PN'){
        return this.$http 
        .get(
          `/${this.resource}/listado?search_input=${this.search_input}`
        )
        .then(response => {
          console.log(response.data['clientes'].data)
          this.clientes = response.data['clientes'].data
          this.rol = response.data['rol']
        })
      }else{
        return this.$http 
        .get(
          `/${this.resource}/listado/juridico?search_input=${this.search_input}`
        )
        .then(response => {
          this.clientes = response.data['clientes'].data
        })
      }
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
      border: 1px solid $line_color
      i
        font-size: 20px
      input, select
        border: none
        font-family: $font
        height: 100%
        font-size: 13px
        background-color: white
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
      border: 1px solid $line_color
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
        border: 1px solid $line_color
        .options
          display: flex
          align-items: center
          justify-content: center
          width: 40px
          height: 27px
          cursor: pointer
          position: relative
          float: right
          &:hover
            i
              opacity: 1
            ul
              display: block
          i
            cursor: pointer
            opacity: .5
            color: $text_color
          ul
            position: absolute
            background-color: #fff
            box-shadow: $shadow_hover
            border-radius: 4px
            top: 30px
            right: 6px
            font-size: 12px
            z-index: 4
            width: 140px
            transition: opacity ease 200ms
            padding: 10px 0
            display: none
            border: 1px solid $line_color
            &::before
              position: absolute
              display: block
              content: ''
              width: 12px
              height: 12px
              background-color: white
              top: -7px
              right: 7px
              transform: rotateZ(45deg)
              border-top: 1px solid #f3f1f1
              border-left: 1px solid #f3f1f1
            li
              height: 35px
              line-height: 38px
              cursor: pointer
              text-align: left
              padding-left: 20px
              color: $primary_color
              list-style: none
              color: black
              &:hover
                  background-color: $bg_color
              a
                text-decoration: none
                color: $primary_color
                height: 100%
                width: 100%
                display: block
                text-decoration: none
                color: black
        &:hover
          box-shadow: $shadow_hover
        a
          text-decoration: none
          .detail
            display: flex
            flex-direction: column
            align-items: center
            justify-content: center
            padding: 40px 20px
            width: 100%
            .avatar
              .avatar_alt
                width: 55px
                height: 55px
                background-color: $line_color
                border-radius: 50%
                display: flex
                align-items: center
                justify-content: center
                font-size: 17px
                font-weight: 600
                color: $primary_color
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
    .table_wrapper
      padding: 0 20px
      box-sizing: border-box
      .table_clients
        box-shadow: $shadow
        border: 1px solid $line_color
        tbody
          .client
            .avatar
              .avatar_alt
                width: 30px
                height: 30px
                background-color: $line_color
                border-radius: 50%
                display: flex
                align-items: center
                justify-content: center
                font-size: 13px
                font-weight: 600
                color: $primary_color
              img
                width: 30px
                height: 30px
                border-radius: 50%
                object-fit: cover
            p
              margin: 0
              margin-left: 10px
              text-align: left
</style>
