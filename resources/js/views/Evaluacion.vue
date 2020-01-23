<template>
  <div class="credits_content">

    <div class="options_bar">
      <div class="search_bar">
        <i class="material-icons-outlined">search</i>
        <input type="text" placeholder="Buscar Prestamos">
      </div>
      <div class="switch_view">
        <a class="selected">
          <i class="material-icons-outlined">border_all</i>
        </a>
        <a>
          <i class="material-icons-outlined">notes</i>
        </a>
      </div>
      <router-link to="/"  class="add_client button_primary medium" >
        <span>
          CREAR PRESTAMO
        </span>
        <i class="material-icons-outlined">add</i>
      </router-link>
    </div>

    <div class="table_container">
      <div class="table_wrapper" >
        <table class="table_clients">
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
                <img src="https://picsum.photos/100/100" alt />
                <p> {{prestamo.nombres}} {{prestamo.apellidos}}</p>
              </td>
              <td> {{prestamo.producto}} </td>
              <td> S/ {{prestamo.importe}}</td>
              <td> {{prestamo.plazo}} Meses </td>
              <td> 
                <div class="progress_bar">
                  <span class="bar"></span>
                  <p>0% </p>
                </div> 
              </td>
              <td class="options" >
                <i class="material-icons-outlined" >more_horiz</i>
                <ul v-if="id_rol=='3'">
                  <li>
                    <router-link v-if="prestamo.estado=='PENDIENTE'"
                              :to="{name:'/evaluacion/detalle/', params:{prestamo:prestamo.id}}" >
                      Evaluación
                    </router-link>
                    <router-link v-else
                              :to="{name:'/evaluacion/detalle/', params:{prestamo:prestamo.id}}" >
                      Ver Evaluación
                    </router-link>
                  </li> 
                </ul>
                <ul v-if="id_rol=='3'">
                  <li>
                    <router-link v-if="prestamo.estado=='PENDIENTE'"
                              :to="{name:'/evaluacion/detalle/', params:{prestamo:prestamo.id}}" >
                      Evaluación
                    </router-link>
                    <router-link v-else
                              :to="{name:'/evaluacion/detalle/', params:{prestamo:prestamo.id}}" >
                      Ver Evaluación
                    </router-link>
                  </li>
                  <li> Editar </li>
                  <li> E. Cuantitativa </li>
                  <li> E. Cualitativa </li>
                  <li> Documentos </li>
                  <li> Detalles </li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</template>

<script>
import vSelect from 'vue-select'
export default {
  data() {
    return {
      resource: "evaluaciones", 
      prestamos: [], 
      id_usuario: 0 ,
      id_rol:0
    };
  },
  async created() { 
    await this.methodsPrestamo();
  },
  methods: {
    methodsPrestamo() {
      this.$http.get(`/${this.resource}/prestamos/`).then(response => {
        this.prestamos = response.data.pretamos;
        this.id_usuario = response.data.usuario;
        this.id_rol = response.data.rol;
        console.log(response.data);
      });
    },
  },
};
</script>

<style lang="sass" scoped>
@import "../../sass/variables"
@import "../../sass/buttons"
.credits_content
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
              font-size: 13px
              margin-top: 10px
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
          .progress_bar
            width: 200px
            display: flex
            align-items: center
            span
              display: block
              flex: 1
              height: 6px
              border-radius: 10px
              background-color: $line_color
            p
              margin: 0
              margin-left: 10px
</style>