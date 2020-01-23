<template>
  <div>
    <nav>
        <div class="menu_items">
            <img class="logo" src="/img/logo_alt.svg">
            <ul>
                <li :class="{selected: tab == 'inicio'}" v-if="tipo=='1' || tipo=='2' || tipo=='3' || tipo=='4' | tipo=='5' ">
                  <router-link :to="{name: 'inicio'}" > Inicio</router-link> 
                </li>

                <li :class="{selected: tab == 'clientes'}" v-if="tipo=='1' || tipo=='2'">
                  <router-link :to="{name: 'clientes'}"  >Clientes</router-link>
                </li>

                <li :class="{selected: tab == 'evaluaciones_final'}">
                  <router-link :to="{name: 'evaluaciones'}"  >Prestamos</router-link>
                </li>

                <li :class="{selected: tab == 'usuarios'}" v-if="tipo=='1'"> 
                  <router-link :to="{name: 'usuarios'}"  >Usuarios</router-link>
                </li>
                <div class="current_user">
                  <img  @click="menu_user = !menu_user"
                    src="https://picsum.photos/200/300"
                    alt="User profile picture"
                  />
                  <transition name="slide-fade" mode="in-out">
                    <div v-show="menu_user" class="users_options">
                      <div class="name">
                        <img
                          src="https://picsum.photos/200/300"
                          alt="User profile picture"
                        />
                        <h1>
                          Omar Benjamin Chagua Ramos
                          <a href="#">
                            Editar
                          </a>
                        </h1>
                      </div>
                      <a class="logout" href="#">
                        Cerrar Sesión
                      </a>
                    </div>
                  </transition>
                </div>
            </ul>
        </div>
    </nav>
    <main class="container_app">
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </main>
  </div>
</template>

<script>
export default {
  data () {
    return {
      resource: "user",
      tipo: 0,
      menu_user: false,
      tab: ''
    }
  },
  async created() {
    await this.$http.get(`/${this.resource}/tipo/`).then(response => {
      this.tipo = response.data.idrol
    })
  },
  mounted () {
    this.tab = this.$route.name
    this.$router.beforeEach((to, from, next) => {
        this.tab = to.name
        next()
    })
  }
}
</script>

<style lang="sass" scoped>
@import "../../sass/_variables"
nav
  background-color: white
  height: 55px
  display: flex
  justify-content: space-between
  align-items: center
  width: 100%
  z-index: 10
  position: relative
  box-shadow: $shadow
  position: sticky
  top: 0
  .logo
    height: 30px
    margin-left: 20px
  .menu_items
    display: flex
    justify-content: space-between
    align-items: center
    width: 100%
    height: 100%
    margin-right: 20px
    ul
      display: flex
      justify-content: space-between
      align-items: center
      width: 450px
      height: 100%
      margin: 0
      padding: 0
      li
        list-style: none
        height: 100%
        border-bottom: 3px solid transparent
        flex: 1
        a
          text-decoration: none
          color: rgba($text_color, .5)
          font-weight: 700
          font-size: 12px
          display: flex
          justify-content: center
          align-items: center
          height: 100%
        &.selected
          border-bottom: 3px solid $primary_color
          a
            color: $text_color
      .current_user
        margin-left: 20px
        position: relative
        img
          width: 30px
          height: 30px
          object-fit: cover
          border-radius: 50%
          cursor: pointer
        .users_options
          position: absolute
          right: 0
          top: 50px
          background-color: white
          width: 250px
          box-shadow: $shadow
          .name
            display: flex
            align-items: center
            padding: 20px
            border-bottom: 1px solid rgba($text_color, .07)
            h1
              font-size: 12px
              margin-bottom: 0
              margin-left: 10px
              font-weight: 500
              a
                text-decoration: none
                color: $primary_color
          a.logout
            padding: 10px 20px
            display: flex
            text-decoration: none
            font-size: 12px
            color: $text_color
            font-weight: 500
            &:hover
              color: $text_color

</style>
