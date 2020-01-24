<template>
  <div class="profile_content">

    <aside class="profile_detail">
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
        <img src="https://picsum.photos/200/300" />
        <p> {{cliente.nombres}} </p>
        <small> {{cliente.apellidos}} </small>
      </div>
      <ul>
        <li>
          <strong>Documento</strong>
          <p>{{cliente.documento}}</p>
        </li>
        <li>
          <strong>Fecha de Nacimiento</strong>
          <p>{{cliente.nacimiento || "--"}}</p>
        </li>
        <li>
          <strong>Celular</strong>
          <p>{{cliente.celular || "--"}}</p>
        </li>
        <li>
          <strong>Dirección</strong>
          <p>{{cliente.direccion_cliente || '--' }}</p>
        </li>
      </ul>
    </aside>

    <div class="credits_grid">

      <div class="table_grid" >

        <router-link class="add_credit" :to="{name: 'prestamo', params:{dni:cliente.documento}}">
          <span>
            <i class="material-icons-outlined">add</i>
          </span>
          <p> NUEVO PRESTAMO  </p>
        </router-link>

        <article class="credit_card" v-for="prestamo in prestamos" :key="prestamo.id" >
          <div class="detail">
            <h2> {{prestamo.producto}} </h2>
            <div class="progress_bar">
              <span class="bar"></span>
              <p>0% </p>
            </div>
            <h3> S/ {{prestamo.importe}} &nbsp; / &nbsp; {{prestamo.plazo}} {{timeCredit[prestamo.producto]}} </h3>
          </div>
          <div class="actions">
            <router-link class="credit_link" :to="{ name:'/evaluacion/final/', params: { prestamo:prestamo.id } }">
              VER PRESTAMO
            </router-link>
            <div class="options">
              <i class="material-icons-outlined" >more_horiz</i>
              <ul>
                <li> 
                  <router-link :to="{name:'ver', params:{prestamo:prestamo.id}}"> Editar </router-link>
                </li>
                <li> <router-link v-if="prestamo.cuantitativa=='0'" :to="{name:'evalCuantitativa', params:{prestamo:prestamo.id}}" >E. Cuantitativa</router-link> </li>
                <li> <router-link v-if="prestamo.cualitativa =='0'" :to="{name:'evalCualtitativa', params:{prestamo:prestamo.id}}" >E. Cualitativa </router-link></li>
                <li> <router-link :to="{name:'archivos', params:{prestamo:prestamo.id}}" > Documentos </router-link> </li>
              </ul>
            </div>
          </div>
        </article>
        <a v-show="prestamos.length || 0 < 4" class="spanner" v-for="i in 4" :key="i*1.5"  >
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
      idprestamo: 0,
      prestamos: {},
      loader: 1,
      loader_loan: 1,
      tipo_general: 1,
      option_loan: 1
    };
  },
  created() {
    this.$http
      .get(`/${this.resource}/perfil/cliente/` + this.$route.params.documento)
      .then(response => {
        this.cliente = response.data["cliente"];
        this.prestamos = response.data["prestamos"];
        this.loader = 0;
        this.loader_loan = 0;
        console.log(this.prestamos);
      });
  },
  methods: {
    cambiarView(id){
      this.idprestamo= id
      this.view=true
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
  mounted() {
    console.log("Component mounted.");
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
  .profile_detail
    background-color: white
    box-shadow: $shadow
    height: calc(100vh - 55px)
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
        height: 80px
        background-color: $primary_color
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
            color: white
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
            &::before
              position: absolute
              display: block
              content: ''
              width: 12px
              height: 12px
              background-color: white
              top: -5px
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
    ul
      margin: 0
      padding: 0
      li
        list-style: none
        border-bottom: 1px solid $line_color
        height: 50px
        padding: 0 20px
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
      grid-template-columns: repeat(auto-fit, minmax(270px, 1fr) )
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
      
</style>