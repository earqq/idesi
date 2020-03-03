<template>
  <div>
    <div class="clients_content" >
      <div class="options_bar" :class="{no_button: !permissionCreate}">
        <div class="search_bar">
          <i class="material-icons-outlined">search</i>
          <input type="text" placeholder="Buscar Cliente" v-model="search.text" @input="search_product">         
        </div>
        <div class="switch_view">
          <a @click="type_list_card" :class="{selected: type_list == 1}">
            <i class="material-icons-outlined">border_all</i>
          </a>
          <a @click="type_list_list" :class="{selected: type_list == 0}">
            <i class="material-icons-outlined">notes</i>
          </a>
        </div>
        <a class="add_client button_primary medium" @click="option_open=!option_open" v-if='permissionCreate'>
          <span>
            CREAR CLIENTE
          </span>
          <i class="material-icons-outlined">add</i>
        </a>
        <transition name="slide-fade" mode="in-out">
          <ul class="button_options" v-if='permissionCreate' v-show="option_open">
            <router-link :to="{name:'registrar/persona'}"  >
              <span>
                CREAR PERSONA
              </span>
            </router-link> 
            <router-link :to="{name:'registrar/empresa'}"  >
              <span>
                CREAR EMPRESA
              </span>
            </router-link>  
          </ul>
        </transition>
      </div>
      <div class="empty_message" v-if="clientes.length==0 && queryCount > 0">
        <img src="img/empty.svg" >
        <h1> No Se Encontraron Clientes </h1>
        <p>Registra un nuevo cliente para continuar.</p>
      </div>
      <div class="table_container" v-else >
        <div class="table_grid"  v-if=" type_list=='1'">
          <article class="client_card" v-for="cliente in clientes" :key="cliente.id" >
            <div class="options" v-if="cliente.estado=='2'">
              <i class="material-icons-outlined" >more_horiz</i>
              <ul>
                <li> 
                  <router-link  v-if="cliente.tipo_cliente=='1'"   :to="{name: 'registarPrestamo', params:{clienteID:cliente.id,prestamoID:'0'}}">
                    Nuevo prestamo
                  </router-link>
                  <router-link  v-if="cliente.tipo_cliente=='2'"   :to="{name: 'registrarPrestamoEmpresa', params:{clienteID:cliente.id,prestamoID:'0'}}">
                    Nuevo prestamo
                  </router-link>
                </li>
              </ul>   
            </div>
            <router-link :to="{ name:'perfil', params: { id: cliente.id } }">
              <div class="detail">
                <div class="avatar">
                  <div class="avatar_alt" >{{ cliente.persona ? cliente.persona.apellidos.substring(0,1) : cliente.empresa.razon_social.substring(0,1) }}</div>
                </div>
                <div class="name_wrapper">
                  <p class="truncate">{{ cliente.persona ?  cliente.persona.apellidos : cliente.empresa.razon_social}}</p>
                  <small class="truncate" >{{ cliente.persona ? cliente.persona.nombres : cliente.empresa.documento}}</small>
                </div>
              </div>
            </router-link>
          </article>
          <a class="spanner" v-for="i in 6" :key="i*1.5" v-show='clientes.length<6' >
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
              <tr  v-for="(cliente,index) in clientes" :key="index">
                <td class="client">
                  <div class="avatar">
                    <div class="request" v-show="cliente.estado=='1'">
                      <i class="material-icons-outlined">email</i>
                    </div>
                    <img src="https://picsum.photos/200/300" v-if="false" />
                    <div class="avatar_alt"  :class="{denied : cliente.estado=='3'}" v-else> {{ cliente.persona ? cliente.apellidos.substring(0,1) : cliente.razon_social.substring(0,1) }} </div>
                  </div>
                  <p class="truncate" v-if='persona.cliente'> {{cliente.persona.nombres}} {{cliente.persona.apellidos }}</p>
                  <p class="truncate" v-else>  cliente.empresa.razon_social}}</p>
                </td>
                <td>
                  {{cliente.celular || '--'}}
                </td>
                <td> {{cliente.documento}} </td>
                <td>
                  {{cliente.ubicacion_direccion_declarada || '--'}}
                </td>
                <td class="options" >
                  <i class="material-icons-outlined" >more_horiz</i>
                  <ul>
                    <li>
                      <router-link :to="{name:'perfil', params:{id: cliente.id }}" >
                        Ver Cliente
                      </router-link>
                    </li>
                    <li>
                        <router-link  v-if="cliente.estado=='2' && cliente.tipo_cliente=='1'"   :to="{name: 'registarPrestamo', params:{clienteID:cliente.id,prestamoID:'0'}}">
                            Nuevo prestamo
                        </router-link>
                        <router-link  v-if="cliente.estado=='2' && cliente.tipo_cliente=='2'"   :to="{name: 'registrarPrestamoEmpresa', params:{clienteID:cliente.id,prestamoID:'0'}}">
                            Nuevo prestamo
                        </router-link>
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
      queryCount: 0,
      search:{
        state:4,
        text:''
      },
      option_open: false
    }
  },
  async mounted() {
    await this.getClients();
  },
  methods: {
    async search_product() { 
      await this.getClients();
    },
    type_list_card(){
      this.type_list=1
    },
    type_list_list(){
      this.type_list=0
    },
    getClients() {
      this.clientes= [];
      this.$http 
        .get(
          '/clientes/search/'+this.search.state+'/'+this.search.text,          
        )
        .then(response => {
          this.clientes=response.data
          this.queryCount ++
        })
    },   
  },
  computed: {
    permissionCreate () {
      return this.$store.state.currentUser.nivel==2 || this.$store.state.currentUser.nivel==4
    }
  }
};
</script>

<style lang="sass" scoped>
@import "../../sass/variables"
@import "../../sass/buttons"

.clients_content
  .empty_message
    height: calc(100vh - 135px)
  .options_bar
    display: grid
    grid-template-columns: 1fr 120px 200px
    grid-gap: 15px
    padding: 20px
    box-sizing: border-box 
    position: relative
    &.no_button
      grid-template-columns: 1fr 120px
    .add_client
      width: 200px
    ul.button_options
      position: absolute
      right: 20px
      top: 75px
      background-color: white
      padding: 0
      border-radius: 3px
      box-shadow: $shadow_hover
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
      a
        display: block
        height: 40px
        display: flex
        align-items: center
        padding: 0 20px
        text-decoration: none
        font-size: 13px
        color: rgba($text_color, .5)
        font-weight: 500
        &:first-child
          border-bottom: 1px solid $line_color
        &:hover
          color: $text_color
    .search_bar
      border-radius: 4px
      overflow: hidden
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
        position: relative
        .options
          display: flex
          align-items: center
          justify-content: center
          width: 40px
          height: 27px
          cursor: pointer
          position: absolute
          top: 5px
          right: 5px
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
            user-select: none
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
              position: relative
              .request
                position: absolute
                left: 0
                top: 0
                width: 55px
                height: 55px
                background-color: lighten($highlight_color, 45%)
                border-radius: 50%
                display: flex
                align-items: center
                justify-content: center
                font-size: 17px
                font-weight: 600
                color: $highlight_color
                i
                  font-size: 20px
                  color: $highlight_color
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
                &.denied
                  background-color: lighten($require_color, 45%)
                  color: $require_color
              img
                width: 55px
                height: 55px
                border-radius: 50%
                object-fit: cover
            .name_wrapper
              text-align: center
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
                font-size: 11px
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
              position: relative
              .request
                position: absolute
                left: 0
                top: 0
                width: 30px
                height: 30px
                background-color: lighten($highlight_color, 45%)
                border-radius: 50%
                display: flex
                align-items: center
                justify-content: center
                font-size: 17px
                font-weight: 600
                color: $highlight_color
                i
                  font-size: 18px
                  color: $highlight_color
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
                &.denied
                  background-color: lighten($require_color, 45%)
                  color: $require_color
              img
                width: 30px
                height: 30px
                border-radius: 50%
                object-fit: cover
            p
              margin: 0
              margin-left: 10px
              text-align: left
.dropdown
  flex: 1
  display: inline-block
  position: relative
  z-index: 10
  &.toggle
    > input
      display: none

    > label
      border-radius: 2px
      box-shadow: 0 6px 5px -5px rgba(0, 0, 0, 0.3)

    > label::after
      content: ""
      float: right
      margin: 15px 15px 0 0
      width: 0
      height: 0
      border-left: 5px solid transparent
      border-right: 5px solid transparent
      border-top: 10px solid #CCC

  > a
    border-radius: 2px
    box-shadow: 0 6px 5px -5px rgba(0, 0, 0, 0.3)

  > a::after
    content: ""
    float: right
    margin: 15px 15px 0 0
    width: 0
    height: 0
    border-left: 5px solid transparent
    border-right: 5px solid transparent
    border-top: 10px solid #CCC

  ul
    list-style-type: none
    display: block
    margin: 0
    padding: 0
    position: absolute
    width: 100%
    box-shadow: 0 6px 5px -5px rgba(0, 0, 0, 0.3)
    overflow: hidden

  a, &.toggle > label
    display: block
    padding: 0 0 0 10px
    text-decoration: none
    line-height: 40px
    font-size: 13px
    text-transform: uppercase
    color: #000018
    background-color: #FFF

  li
    height: 0
    overflow: hidden
    transition: all 500ms

  &.hover li
    transition-delay: 300ms

  li
    &:first-child a
      border-radius: 2px 2px 0 0

    &:last-child a
      border-radius: 0 0 2px 2px

    &:first-child a::before
      content: ""
      display: block
      position: absolute
      width: 0
      height: 0
      border-left: 10px solid transparent
      border-right: 10px solid transparent
      border-bottom: 10px solid #FFF
      margin: -10px 0 0 30px
  &.toggle
    >
      label:hover, input:checked ~ label
        background-color: #EEE
        color: #666

    >
      label:hover::after, input:checked ~ label::after
        border-top-color: #AAA

  > a:hover::after
    border-top-color: #AAA

  // li:first-child a:hover::before
  //   border-bottom-color: #EEE

  &.hover:hover li, &.toggle > input:checked ~ ul li
    height: 40px

  &.hover:hover li:first-child, &.toggle > input:checked ~ ul li:first-child
    padding-top: 15px
@media screen and (max-width: 1000px)
  .clients_content
    .options_bar
      grid-template-columns: 1fr 170px
      .add_client
        width: 170px
      .switch_view
        display: none

@media screen and (max-width: 720px)
  .clients_content
    .options_bar
      grid-template-columns: 1fr 40px
      .add_client
        width: 40px
        span
          display: none
      .switch_view
        display: none

@media screen and (max-width: 500px)
  .clients_content
    .options_bar
      grid-template-columns: 1fr
      padding: 0
      padding-bottom: 15px
      position: sticky
      top: 55px
      z-index: 7
      .search_bar
        padding: 0
        padding-left: 10px
        border-radius: 0
        border: none
        border-bottom: 1px solid $line_color
        height: 50px
        select
          padding: 0 5px
      .add_client
        width: 50px
        height: 50px
        position: fixed
        bottom: 15px
        right: 15px
    .table_container
      .table_grid
        grid-gap: 10px
        padding: 0 15px
        .client_card
          a 
            .detail
              flex-direction: row
              padding: 20px 15px
              justify-content: flex-start
              .avatar
                margin-right: 10px
                .request
                  width: 40px
                  height: 40px
                  font-size: 15px
                .avatar_alt
                  width: 40px
                  height: 40px
                  font-size: 15px
                img
                  width: 40px
                  height: 40px
              .name_wrapper
                text-align: left
                p
                  margin-top: 0
                  text-align: left
</style>
