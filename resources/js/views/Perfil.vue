<template>
  <div class="profile_content">

    <aside class="profile_detail no_scroll" :class="{showing: show_slide}">
      <div class="head_profile">
        <div class="bg">
          <div class="options_profile">
            <i class="material-icons-outlined" >more_horiz</i>
            <ul>
              <li>Editar</li>
              <li>
                <a class="" :href="'../storage/'+cliente.documento+'_'+cliente.idcliente+'/general/documento/inscripcion_de_socio.pdf'" target="_blank">
                  Solicitud de Admisión
                </a>
            </li>
            </ul>
          </div>
        </div>
        <div class="avatar">
          <img src="https://picsum.photos/200/300" v-if="false" />
          <div class="avatar_alt" v-else> {{ cliente.apellidos ? cliente.apellidos.substring(0,1) : cliente.razon_social ? cliente.razon_social.substring(0,1) : "" }} </div>
        </div>
        <p v-if="tipo_persona=='PN'"> {{cliente.apellidos}} </p>
        <p v-else> {{cliente.razon_social}} </p>
        <small v-if="tipo_persona=='PN'"> {{cliente.nombres}} </small>
      </div>
      <ul>
        <li>
          <strong v-if="tipo_persona=='PN'">Documento</strong>
          <strong v-else>R.U.C</strong>
          <p>{{cliente.documento}}</p>
        </li>
        <li v-if="tipo_persona=='PN'">
          <strong>Fecha de Nacimiento</strong>
          <p>{{cliente.nacimiento || "--"}}</p>
        </li>
        <li v-else>
          <strong>Partida Registral</strong>
          <p>{{cliente.partida_registral || "--"}}</p>
        </li>
        <li>
          <strong>Celular</strong>
          <p>{{cliente.celular || "--"}}</p> 
        </li>
        <li>
          <strong>Dirección</strong>
          <p v-if="tipo_persona=='PN'">{{cliente.direccion_cliente || '--' }}</p>
          <p v-else>{{cliente.direccion || '--' }}</p>
        </li>
        <li>
          <strong>Estado</strong>
          <p v-if="cliente.estado==0">Pendiente</p> 
          <p v-if="cliente.estado==1">Aprobado</p> 
          <p v-if="cliente.estado==2">Rechazado</p> 
        </li>
        <blockquote class="message_request" v-if="cliente.estado==0 && id_rol=='1'">
          <div class="message_request_wrapper">
            <h1>SOLICITUD DE ACEPTACIÓN</h1>
            <p> Se ha registrado un nuevo cliente esperando por aprobación.  </p>
            <div class="actions">
              <a class="denied" @click="rechazarSolicitud"> RECHAZAR </a>
              <a class="button_primary small" @click="aceptarSolicitud">
                <span> ACEPTAR </span>
              </a>
            </div>
          </div>
        </blockquote>
      </ul>
    </aside>

    <div class="slide_mobile"  @click="show_slide = !show_slide">
      <i class="material-icons-outlined">{{!show_slide ? 'menu_open' : 'close'}}</i>
      <span>PERFIL</span>
    </div>

    <div class="empty_message" v-if="prestamos.length==0">
      <img src="img/empty_2.svg" >
      <h1> Sin Prestamos Registrados </h1>
      <p>Todavía no se han registrado ningun prestamo a este cliente.</p>
      <router-link  v-if="tipo_persona=='PN' && cliente.estado=='1' && id_rol!='5'"  class="button_primary small" :to="{name: 'prestamo', params:{dni:cliente.documento}}">
        <span> NUEVO PRESTAMO  </span>
        <i class="material-icons-outlined">add</i>
      </router-link>
      <router-link  v-else-if="tipo_persona=='PJ' && cliente.estado=='1' && id_rol!='5'" class="button_primary small" :to="{name: 'prestamojuridico', params:{dni:cliente.documento}}">
        <span> NUEVO PRESTAMO  </span>
        <i class="material-icons-outlined">add</i>
      </router-link>
    </div>

    <div class="credits_grid" v-else>
     
      <div class="table_grid" >
        <router-link  v-if="tipo_persona=='PN' && cliente.estado=='1' && id_rol!='5'"  class="add_credit" :to="{name: 'prestamo', params:{dni:cliente.documento}}">
          <span>
            <i class="material-icons-outlined">add</i>
          </span>
          <p> NUEVO PRESTAMO  </p>
        </router-link>

        <router-link  v-else-if="tipo_persona=='PJ' && cliente.estado=='1' && id_rol!='5'" class="add_credit" :to="{name: 'prestamojuridico', params:{dni:cliente.documento}}">
          <span>
            <i class="material-icons-outlined">add</i>
          </span>
          <p> NUEVO PRESTAMO  </p>
        </router-link>

        <article class="credit_card" v-for="prestamo in prestamos" :key="prestamo.id"  >
          <div class="detail">
            <h2> {{prestamo.producto}} </h2>
            <div class="progress_bar">
              <span class="bar"></span>
              <p>0% </p>
            </div> 
            <h3> S/ {{prestamo.importe}} &nbsp; / &nbsp; {{prestamo.plazo}} {{timeCredit[prestamo.producto]}} </h3>
          </div>
          <div class="actions">
            
            <router-link class="credit_link"  :to="{name:'/ver/prestamo/', params:{prestamo:prestamo.id}}"> VER PRESTAMO</router-link>

            <div class="options">
              <i class="material-icons-outlined" >more_horiz</i>
              <ul>
                <li> 
                  <router-link  v-if="tipo_persona=='PN'" :to="{name:'/editar/solicitud/credito/natural/', params:{prestamo:prestamo.id,dni:cliente.documento}}"> Editar </router-link>
                  <router-link  v-else :to="{name:'/editar/solicitud/credito/juridica/', params:{prestamo:prestamo.id,dni:cliente.documento}}"> Editar </router-link>
                </li>
                <li v-if="prestamo.cualitativa=='0'"> <router-link :to="{name:'evalCualtitativa', params:{prestamo:prestamo.id,documento:cliente.documento,persona:tipo_persona}}" >E. Cualitativa</router-link> </li>
                <li v-if="prestamo.cuantitativa=='0' && prestamo.cualitativa=='1' "> <router-link :to="{name:'evalCuantitativa', params:{prestamo:prestamo.id,documento:cliente.documento,persona:tipo_persona}}" >E. Cuantitativa</router-link> </li>
                <li> <router-link :to="{name:'/evaluacion/detalle/', params:{prestamo:prestamo.id}}"  >Evaluación</router-link></li>
                <li> <router-link :to="{name:'archivos', params:{prestamo:prestamo.id}}" > Documentos </router-link> </li>
              </ul>
            </div>
          </div>
        </article>
        <a v-show="prestamos.length < 4 && prestamos.length > 0" class="spanner" v-for="i in 4" :key="i*1.5"  >
        </a>
      </div>
    
    </div>

  </div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
import LoaderPrestamo from "./componentes/loader/prestamos.vue";
import LoaderPerfil from "./componentes/loader/perfil.vue";
import Visitas from "./Visita.vue";
import moment from "moment";


export default {
  mixins: [serviceNumber],
  components: {  LoaderPrestamo, LoaderPerfil, Visitas },
  data() {
    return {
      resource: "clientes",
      view:false,
      cliente: {},
      tipo_persona:  this.$route.params.persona,
      idprestamo: 0,
      prestamos: {},
      id_usuario: 0 ,
      id_rol:0,
      loader: 1,
      loader_loan: 1,
      tipo_general: 1,
      option_loan: 1,
      show_slide: false
    };
  },
  mounted() { 
    this.datosClientesPerfil()
  },
  methods: {
    cambiarView(id){
      this.idprestamo= id
      this.view=true
    },
    datosClientesPerfil(){
         
          if(this.tipo_persona == 'PN'){ 
                    this.$http
                      .get(`/${this.resource}/perfil/cliente/` + this.$route.params.documento)
                      .then(response => {
                        this.cliente = response.data["cliente"];
                        this.prestamos = response.data["prestamos"];
                        this.id_usuario = response.data['usuario'];
                        this.id_rol = response.data['rol'];
                        this.loader = 0;
                        this.loader_loan = 0; 
                      });
              }else if(this.tipo_persona == 'PJ'){
                 console.log(this.$route.params.persona)
                    this.$http
                      .get(`/${this.resource}/perfil/juridico/cliente/` + this.$route.params.documento)
                      .then(response => {
                        
                        this.cliente = response.data["cliente"];
                        this.prestamos = response.data["prestamos"];
                        this.id_usuario = response.data['usuario'];
                        this.id_rol = response.data['rol'];
                        this.loader = 0;
                        this.loader_loan = 0;  
                      });
              }
    },
    aceptarSolicitud(){
          this.$http
            .get(`/${this.resource}/aceptar/solicitud/` + this.cliente.idcliente+'/'+this.tipo_persona)
            .then(response => {
              this.datosClientesPerfil()
            });
    },
    rechazarSolicitud(){
          this.$http
            .get(`/${this.resource}/rechazar/solicitud/` + this.cliente.idcliente+'/'+this.tipo_persona)
            .then(response => {
              this.datosClientesPerfil()
            });
    },
    retornar() {
      this.backMixin_handleBack("/clientes");
    },
    stringDate(date) {
      var string = moment(date)
        .locale("es")
        .format("D [de] MMMM [del] YYYY h:mm:ss a");
      return string;
    }
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
    }
  }
};
</script>
<style lang="sass" scoped>
@import "../../sass/variables"
@import "../../sass/buttons"
.profile_content
  display: grid
  grid-template-columns: 300px 1fr
  .slide_mobile
    display: none
  .profile_detail
    background-color: white
    box-shadow: $shadow
    border-right: 1px solid $line_color
    height: calc(100vh - 55px)
    overflow: auto
    .head_profile
      display: flex
      flex-direction: column
      align-items: center
      box-sizing: border-box
      width: 100%
      height: 180px
      border-bottom: 1px solid $line_color
      .bg
        width: 100%
        height: 70px
        display: flex
        flex-direction: column
        position: relative
        .options_profile
          align-self: flex-end
          margin-top: 5px
          width: 40px
          height: 30px
          text-align: center
          &:hover
            ul
              display: block
          i
            cursor: pointer
            color: black
          ul
            position: absolute
            background-color: #fff
            box-shadow: $shadow_hover
            border-radius: 4px
            top: 35px
            right: 11px
            font-size: 12px
            z-index: 4
            width: 170px
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
              border: none
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
          font-weight: 700
          margin-top: -27px
          color: $primary_color
        img
          width: 55px
          height: 55px
          border-radius: 50%
          object-fit: cover
          position: relative
          margin-top: -27px
          border: 2px solid white
          background-color: white
      p, small
        color: $text_color
        margin: 0
      p
        font-weight: 700
        font-size: 13px
        margin-top: 15px
        text-align: center
        line-height: 1.3
      small
        font-size: 11px
        display: block
    & > ul
      margin: 0
      padding: 0
      blockquote.message_request
        padding: 20px
        box-sizing: border-box
        border-bottom: 1px solid $line_color
        border-left: 2px solid $primary_color
        box-shadow: $shadow
        .message_request_wrapper
          font-weight: 500
          border-radius: 3px
          min-height: 45px
          display: flex
          align-items: flex-start
          flex-direction: column
          font-size: 12px
          box-sizing: border-box
          h1
            font-size: 13px
            color: $primary_color
            font-weight: 600
          p
            color: block
            font-size: 12px
          .actions
            display: flex
            width: 100%
            align-self: flex-end
            align-items: center
            margin-top: 5px
            a
              flex: 1
              cursor: pointer
              text-align: center
              &.denied
                color: $primary_color
      li
        list-style: none
        border-bottom: 1px solid $line_color
        min-height: 50px
        padding: 5px 20px
        box-sizing: border-box
        display: flex
        flex-direction: column
        justify-content: center
        strong
          font-size: 10px
          font-weight: normal
          display: block
        p
          font-weight: 500
          margin: 0
          font-size: 12px
      .download_request
        border-left: 2px solid $primary_color
        a
          display: flex
          align-items: center
          justify-content: space-between
          font-size: 11px
          font-weight: 700
          color: $primary_color
          text-decoration: none
          height: 100%
          i
            font-size: 20px
            margin-top: -2px
  .credits_grid
    padding: 20px
    box-sizing: border-box
    .table_grid
      display: grid
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr) )
      grid-gap: 15px
      box-sizing: border-box
      .add_credit
        border-radius: 4px
        transition: all ease-in-out .3s
        display: flex
        justify-content: center
        align-items: center
        flex-direction: column
        cursor: pointer
        height: 140px
        border: $primary_color
        background-color: white
        box-shadow: $shadow
        user-select: none
        text-decoration: none
        border: 1px solid $line_color
        &:hover
          box-shadow: $shadow_hover
          span
            box-shadow: 0px 4px 10px 0px rgba($primary_color, 0.45)
            &:before
              transform: scale(1.1)
              opacity: 1
        p
          font-weight: 700
          font-size: 12px
          margin: 0
          margin-top: 10px
          color: $primary_color
        span
          width: 40px
          height: 40px
          border-radius: 50%
          background-color: $primary_color
          display: flex
          justify-content: center
          align-items: center
          position: relative
          transition: all cubic-bezier(0.79, 0.03, 0.18, 1.03) 0.3s
          box-shadow: 0px 4px 10px 0px rgba($primary_color, 0.35)
          &:before
            content: ''
            position: absolute
            left: 0
            top: 0
            width: 100%
            height: 100%
            background-color: rgba(white, .2 )
            border-radius: 50%
            transform: scale(0.2)
            transition: all cubic-bezier(0.79, 0.03, 0.18, 1.03) 0.3s
            opacity: 0
          i
            color: white
            position: relative
      .credit_card
        background-color: white
        border-radius: 4px
        box-shadow: $shadow
        box-sizing: border-box
        transition: all ease-in-out .3s
        border: 1px solid $line_color
        &:hover
          box-shadow: $shadow_hover
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

@media screen and (max-width: 720px)
  .profile_content
    grid-template-columns: 250px 1fr

@media screen and (max-width: 500px)
  .profile_content
    grid-template-columns: 1fr
    .slide_mobile
      background-color: white
      box-shadow: $shadow
      display: flex
      align-items: center
      height: 40px
      position: sticky
      top: 55px
      border-bottom: 1px solid $line_color
      z-index: 4
      cursor: pointer
      i
        margin-top: -2px
        padding-left: 10px
      span
        font-size: 12px
        font-weight: 700
        margin-left: 10px
    .credits_grid
      padding: 15px
    .profile_detail
      width: 100%
      position: fixed
      top: 95px
      z-index: 5
      left: -100%
      transition: all ease-in-out .3s
      height: calc(100vh - 95px)
      &.showing
        left: 0
</style>