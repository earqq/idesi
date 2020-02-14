<template>
  <div>

    <div class="credits_content" >

      <div class="options_bar">
        <div class="search_bar" >
          <i class="material-icons-outlined">search</i>
          <input type="text" placeholder="Buscar Prestamos"  v-model="search.text" @input="getPrestamos">
          <select v-model="search.state" v-if='$store.state.currentUser.nivel!="3"' @change="getPrestamos()">
            <option value="TODOS">TODOS</option>
            <option value=2>PENDIENTE</option>
            <option value=3>APROBADO</option>
            <option value=4>DESAPROBADO</option>
          </select>
        </div>
        <div class="switch_view">
          <a :class="{selected: type_list == 0}" @click="type_list = 0" >
            <i class="material-icons-outlined">border_all</i>
          </a>
          <a :class="{selected: type_list == 1}" @click="type_list = 1">
            <i class="material-icons-outlined">notes</i>
          </a>
        </div>
      </div> 

      <div class="empty_message" v-if="prestamos.length==0 && queryCount==0">
        <img src="img/empty_2.svg" >
        <h1> NO REGISTRA PRESTAMOS EN EVALUACIÓN O EVALUDADOS </h1>
        <p>Registra un nuevo cliente para crear prestamos.</p>
      </div>

      <div class="table_container" v-else >

        <div class="table_grid"  v-if="type_list==0">
          <article class="credit_card" v-for="prestamo in prestamos" :key="prestamo.id" >
            <div class="client">
              <div class="avatar">
                <img src="https://picsum.photos/100/100" v-if="false"/>
                <div class="avatar_alt" v-else> {{prestamo.cliente.persona ?  prestamo.cliente.persona.apellidos.substring(0,1):prestamo.cliente.empresa.razon_social.substring(0,1) }} </div>
              </div>
              <p class="truncate" v-if='prestamo.cliente.persona '>{{prestamo.cliente.persona.nombres}} {{prestamo.cliente.persona.apellidos }}</p>
              <p class="truncate" v-else> {{prestamo.cliente.empresa.razon_social}}</p>
            </div>
            <div class="detail">
              <h2> {{prestamo.producto}} </h2>
              <div class="progress_bar">
                <span class="bar"></span>
                <p>0% </p>
              </div> 
              <h3> S/ {{prestamo.importe}} &nbsp; / &nbsp; {{prestamo.plazo}} {{timeCredit[prestamo.producto]}} </h3>
            </div>
            <div class="actions">
              
              <router-link class="credit_link"  :to="{name:'prestamo', params:{prestamoID:prestamo.id}}"> VER DETALLE PRESTAMO</router-link>
              <a class="credit_link" v-if="id_rol==5 && prestamo.estado=='APROBADO'" @click="entregarPrestamos(prestamo.id)"> ENTREGAR</a>

              <div class="options">
                <i class="material-icons-outlined" >more_horiz</i>
                <ul>
                  <li v-if='currentUser.nivel<4 && prestamo.estado==2'> <router-link :to="{name:'/prestamos/evaluar/', params:{prestamoID:prestamo.id}}"  >Evaluar</router-link></li>
                  <li v-else-if='currentUser.nivel<4'> <router-link :to="{name:'/prestamos/evaluar/', params:{prestamoID:prestamo.id}}"  >Ver Evaluación</router-link></li>
                  <li > <router-link :to="{name:'archivos', params:{prestamoID:prestamo.id}}" > Documentos </router-link> </li>
                </ul>
              </div>
            </div>
            
          </article>
          <a v-show="prestamos.length < 4" class="spanner" v-for="i in 4" :key="i*1.3"  > 
          </a>
        </div>

        <div class="table_wrapper" v-else>
          <table class="table_credits">
            <thead>
              <tr>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Monto</th>
                <th>Plazo</th>
                <th>Progreso</th>
                <th class="options">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="prestamo in prestamos" :key="prestamo.id">
                <td class="client">
                  <div class="avatar">
                    <img src="https://picsum.photos/100/100" v-if="false" />
                    <div class="avatar_alt" v-else>  {{prestamo.cliente.persona ? prestamo.cliente.persona.apellidos.substring(0,1):prestamo.cliente.empresa.razon_social.substring(0,1) }} </div>              
                  </div>
                  <p class="truncate" v-if='prestamo.cliente.persona'> {{prestamo.cliente.persona.nombres}} {{prestamo.cliente.persona.apellidos}}</p>
                  <p class="truncate" v-else> {{prestamo.cliente.empresa.razon_social}}</p>
                </td>
                <td> {{prestamo.producto}} </td>
                <td> S/ {{prestamo.importe}}</td>
                <td> {{prestamo.plazo}} {{timeCredit[prestamo.producto]}} </td>
                <td> 
                  <div class="progress_bar">
                    <span class="bar"></span>
                    <p>0% </p>
                  </div> 
                </td>
                <td class="options" >
                  <i class="material-icons-outlined" >more_horiz</i>
                  <ul>
                    <li v-if="id_rol==2"> 
                      <router-link  v-if="tipo_persona=='PN'" :to="{name:'/editar/solicitud/credito/natural/', params:{prestamo:prestamo.id}}"> Editar </router-link>
                      <router-link  v-else :to="{name:'/editar/solicitud/credito/juridica/', params:{prestamo:prestamo.id}}"> Editar </router-link>
                    </li>
                    <li v-if="prestamo.cualitativa=='0' && id_rol=='2'"> <router-link :to="{name:'evalCualtitativa', params:{prestamo:prestamo.id,documento:prestamo.documento,persona:tipo_persona}}" >E. Cualitativa</router-link> </li>
                    <li v-if="prestamo.cuantitativa=='0' && prestamo.cualitativa=='1' && id_rol=='2' "> <router-link :to="{name:'evalCuantitativa', params:{prestamo:prestamo.id,documento:prestamo.documento,persona:tipo_persona}}" >E. Cuantitativa</router-link> </li>
                    <li v-if='currentUser.nivel<4'> <router-link :to="{name:'/prestamos/evaluar/', params:{prestamoID:prestamo.id}}"  >Evaluación</router-link></li>
                    <li> <router-link :to="{name:'archivos', params:{prestamo:prestamo.id}}" > Documentos </router-link> </li>
                    <li v-if="id_rol==5 && prestamo.estado=='APROBADO'" @click="entregarPrestamos(prestamo.id)" >  Entregar Prestamo</li>
                    
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
import vSelect from 'vue-select'
export default {
  data() {
    return {
      currentUser:{
        id:0,
        nivel:1,        
      },
      resource: "evaluaciones", 
      prestamos: [],
      search_input: "",
      tipo_persona: 'PN',
      id_usuario: 0 ,
      id_rol:0,
      type_list: 0,
      search:{
        state:'TODOS',
        text:''
      },
      queryCount: 0
    };
  },
  async created() { 
    await this.getCurrentUser();   
    await this.getPrestamos();   
  },
  methods: {
    entregarPrestamos(id){
      this.$http
        .get(`/clientes/entregarPrestamo/` + id)
        .then(response => {

        })
    },
    getCurrentUser () {
      axios.get("/currentUser")
      .then(res => { 
        this.currentUser = res.data   
      })
    },
    getPrestamos() {
      this.prestamos = []
      this.$http 
      .get(
        '/prestamos/search/'+this.search.state+'/'+this.search.text
      )
      .then(response => {
        response.data.map(prestamo=>{
          if(!this.prestamos.find(element=>element.id==prestamo.id)){
            if(this.currentUser.nivel==3 && prestamo.evaluaciones.length>0 ) {
              prestamo.evaluaciones.map(item=>{
                if(item.user_id!=this.currentUser.id)
                  this.prestamos.push(prestamo)
              })
            }else 
            this.prestamos.push(prestamo)
          }
        })
      })
    }, 

  },
  computed: {
    timeCredit () {
      return {
        'CREDIDIARIO': 'Dias',
        'CREDISEMANA': 'Semanas',
        'PYME': 'Meses',
        'PYME ESPECIAL': 'Meses',
        'CONSUMO': 'Meses',
        'CONSUMO ESPECIAL': 'Meses',
        }
    },   
  }
};
</script>

<style lang="sass" scoped>
@import "../../sass/variables"
@import "../../sass/buttons"
.credits_content
  .empty_message
    height: calc(100vh - 135px)
  .options_bar
    display: grid
    grid-template-columns: 1fr 120px
    grid-gap: 15px
    padding: 20px
    box-sizing: border-box 
    .add_client
      width: 200px
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
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr) )
      grid-gap: 15px
      padding: 0 20px
      box-sizing: border-box
      .credit_card
        background-color: white
        border-radius: 4px
        box-shadow: $shadow
        box-sizing: border-box
        transition: all ease-in-out .3s
        border: 1px solid $line_color
        &:hover
          box-shadow: $shadow_hover
        .client
          display: flex
          align-items: center
          padding: 10px 20px
          border-bottom: 1px solid $line_color
          .avatar
            .avatar_alt
              width: 24px
              height: 24px
              background-color: $line_color
              border-radius: 50%
              display: flex
              align-items: center
              justify-content: center
              font-size: 13px
              font-weight: 600
              color: $primary_color
            img
              width: 24px
              height: 24px
              border-radius: 50%
              object-fit: cover
          p
            margin: 0
            margin-left: 10px
            font-size: 11px
            font-weight: 500
            margin-bottom: -2px
        .detail
          padding: 25px 20px
          h2
            font-size: 12px
            margin: 0
            font-weight: 700
          .progress_bar
            width: 100%
            display: flex
            align-items: center
            margin: 2px 0
            span
              display: block
              flex: 1
              height: 5px
              border-radius: 10px
              background-color: $line_color
            p
              margin: 0
              margin-left: 10px
              font-size: 12px
          h3
            font-size: 11px
            margin: 0
        .actions
          display: flex
          align-items: center
          border-top: 1px solid $line_color
          height: 40px
          position: relative
          a.credit_link
            color: $primary_color
            font-size: 11px
            flex: 1
            display: flex
            align-items: center
            justify-content: center
            text-decoration: none
            font-weight: 700
            padding: 0 20px
            height: 100%
          .options
            display: flex
            align-items: center
            border-left: 1px solid $line_color
            padding: 0 10px
            height: 100%
            cursor: pointer
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
              top: 37px
              right: 10px
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

    .table_wrapper
      padding: 0 20px
      box-sizing: border-box
      .table_credits
        box-shadow: $shadow
        border: 1px solid $line_color
        tbody
          .client
            .avatar
              .avatar_alt
                width: 24px
                height: 24px
                background-color: $line_color
                border-radius: 50%
                display: flex
                align-items: center
                justify-content: center
                font-size: 13px
                font-weight: 600
                color: $primary_color
              img
                width: 24px
                height: 24px
                border-radius: 50%
                object-fit: cover
            p
              margin: 0
              margin-left: 10px
              text-align: left
          .progress_bar
            width: 200px
            display: flex
            align-items: center
            span
              display: block
              flex: 1
              height: 5px
              border-radius: 10px
              background-color: $line_color
            p
              margin: 0
              margin-left: 10px

@media screen and (max-width: 1000px)
  .credits_content
    .options_bar
      grid-template-columns: 1fr
      .switch_view
        display: none

@media screen and (max-width: 720px)
  .credits_content
    .options_bar
      .switch_view
        display: none

@media screen and (max-width: 500px)
  .credits_content
    .options_bar
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
    .table_container
      .table_grid
        grid-gap: 10px
        padding: 0 15px
</style>