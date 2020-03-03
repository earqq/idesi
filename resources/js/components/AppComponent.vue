<template>
  <div>
    <form id="logout-form" ref="form" action="logout" method="POST" style="display: none;">
      <input type="hidden" name="_token" :value="csrf">
    </form>  
    <nav>
        <div class="menu_items">
            <router-link :to="{name: 'main'}" class="logo" >
              <img src="/img/logo_alt.svg">
            </router-link>
            <transition name="fade" mode="in-out">
              <div class="overlay" @click="menu_user = false" v-show="menu_user"></div>
            </transition>
            <div class="items_wrapper">
              <ul>
                  <li :class="{selected: tab == 'main'}" v-if="currentUser.nivel=='1'  || currentUser.nivel=='2' || currentUser.nivel=='4'">
                    <router-link :to="{name: 'main'}" > Inicio</router-link> 
                  </li>

                  <li :class="{selected: tab == 'clientes'}" v-if="currentUser.nivel=='1' || currentUser.nivel=='2' || currentUser.nivel=='4'">
                    <router-link :to="{name: 'clientes'}"  >Clientes</router-link>
                  </li>
  
                  <li :class="{selected: tab == 'prestamos'}">
                    <router-link :to="{name: 'prestamos'}"  >Prestamos</router-link>
                  </li>

                  <li :class="{selected: tab == 'usuarios'}" v-if="currentUser.nivel=='1'"> 
                    <router-link :to="{name: 'usuarios'}"  >Usuarios</router-link>
                  </li>
              </ul>
              <div class="current_user">
                <div class="avatar"  @click="menu_user = !menu_user">
                  <img 
                    src="https://picsum.photos/200/300"
                    alt="User profile picture"
                    v-if="false"
                  />
                  <div class="avatar_alt" v-else> {{currentUser.name.substring(0,1)}} </div>
                </div>
                <transition name="slide-fade" mode="in-out">
                  <div v-show="menu_user && !mobile" class="users_options">
                    <div class="name">
                    <div class="avatar">
                      <img src="https://picsum.photos/200/300" v-if="false"/>
                      <div class="avatar_alt" v-else> {{currentUser.name.substring(0,1)}} </div>
                    </div>
                      <h1>
                        <p class="truncate">{{currentUser.name}}</p>
                        <a href="#">
                          Editar
                        </a>
                      </h1>
                    </div>
                    <a class="logout" @click="logout">
                      Cerrar Sesión
                    </a>
                  </div>
                </transition>
              </div>
            </div>
            <transition name="slide-fade" mode="in-out">
              <div class="slide_items_wrapper" v-show="menu_user && mobile">
                <div class="users_options">
                  <div class="name">
                    <div class="avatar">
                      <img src="https://picsum.photos/200/300" v-if="false"/>
                      <div class="avatar_alt" v-else> {{currentUser.name.substring(0,1)}} </div>
                    </div>
                    <h1>
                      <p class="truncate">{{currentUser.name}}</p>
                      <a href="#">
                        Editar
                      </a>
                    </h1>
                  </div>
                </div>
                <ul>
                  <li :class="{selected: tab == 'inicio'}" v-if="currentUser.nivel=='1'">
                    <router-link :to="{name: 'inicio'}" > Inicio</router-link> 
                  </li>

                  <li :class="{selected: tab == 'clientes'}" v-if="currentUser.nivel=='1' || currentUser.nivel=='2' || currentUser.nivel=='4'">
                    <router-link :to="{name: 'clientes'}"  >Clientes</router-link>
                  </li>

                  <li :class="{selected: tab == 'prestamos'}">
                    <router-link :to="{name: 'prestamos'}"  >Prestamos</router-link>
                  </li>

                  <li :class="{selected: tab == 'usuarios'}" v-if="currentUser.nivel=='1'"> 
                    <router-link :to="{name: 'usuarios'}"  >Usuarios</router-link>
                  </li>
                  <li class="logout"> 
                    <a @click="logout">
                      Cerrar Sesión
                    </a>
                  </li>
                </ul>
              </div>
            </transition>
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
import { toastOptions } from '../constants.js'
export default {
  data () {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      resource: "user",
      tipo: 0,
      menu_user: false,
      mobile: false,
      tab: '',
      currentUser: {
        name: ''
      }
    }
  },
  async created() {
    this.getCurrentUser()
  },
  methods:{
    logout () {
      this.$refs.form.submit();
    },
    getCurrentUser () {
      axios.get("/currentUser")
      .then(res => { 
        this.currentUser = res.data   
        this.$store.state.currentUser = res.data
      })
    }
  },
  mounted () {
    this.tab = this.$route.name
    console.log( this.$route)
    this.$router.beforeEach((to, from, next) => {
        this.tab = to.name
        this.menu_user = false
        next()
    })
    this.$router.afterEach((to, from) => {
      this.tab = to.name
    })

    if (window.innerWidth < 720) this.mobile = true
    else this.mobile = false

    this.$nextTick(() => {
        window.addEventListener('resize', () => {
            if (window.innerWidth < 720) this.mobile = true
            else this.mobile = false
        })
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
  z-index: 15
  position: relative
  box-shadow: $shadow
  position: sticky
  top: 0
  border-bottom: 1px solid $line_color
  .logo
    img
      height: 30px
      margin-left: 20px
  .menu_items
    display: flex
    justify-content: space-between
    align-items: center
    width: 100%
    height: 100%
    margin-right: 20px
    .overlay
      background-color: transparent
      position: fixed
      right: 0
      top: 0
      height: 100vh
      width: 100%
    .slide_items_wrapper
      background-color: white
      position: fixed
      right: 0
      top: 0
      height: 100vh
      width: 200px
      ul
        padding: 0
        margin: 0
        li
          list-style: none
          border-right: 3px solid transparent
          &.selected
            border-right: 3px solid $primary_color
            a
              color: $text_color
          &.logout
            border-right: 3px solid transparent
            a
              color: $text_color
          a
            padding: 15px 20px
            display: flex
            text-decoration: none
            font-size: 12px
            font-weight: 600
            cursor: pointer
            border-bottom: 1px solid rgba($text_color, .07)
            color: rgba($text_color, .5)
            &:hover
              color: $text_color
      .users_options
        background-color: white
        width: 100%
        .name
          display: flex
          align-items: center
          padding: 15px
          border-bottom: 1px solid rgba($text_color, .07)
          .avatar
            cursor: pointer
            .avatar_alt
              width: 35px
              height: 35px
              background-color: $line_color
              border-radius: 50%
              display: flex
              align-items: center
              justify-content: center
              font-size: 17px
              font-weight: 600
              color: $primary_color
            img
              width: 35px
              height: 35px
              border-radius: 50%
              object-fit: cover
              position: relative
              border: 2px solid white
              background-color: white
          h1
            font-size: 12px
            margin-bottom: 0
            margin-left: 10px
            font-weight: 500
            p
              margin: 0
            a
              text-decoration: none
              color: $primary_color

    .items_wrapper
      display: flex
      height: 100%
      align-items: center
      ul
        display: flex
        justify-content: space-between
        align-items: center
        height: 100%
        margin: 0
        padding: 0
        li
          list-style: none
          height: 100%
          border-bottom: 3px solid transparent
          flex: 1
          min-width: 100px
          a
            text-decoration: none
            color: rgba($text_color, .5)
            font-weight: 600
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
        .avatar
          cursor: pointer
          .avatar_alt
            width: 35px
            height: 35px
            background-color: $line_color
            border-radius: 50%
            display: flex
            align-items: center
            justify-content: center
            font-size: 17px
            font-weight: 600
            color: $primary_color
          img
            width: 35px
            height: 35px
            border-radius: 50%
            object-fit: cover
            position: relative
            border: 2px solid white
            background-color: white
        .users_options
          position: absolute
          right: 2px
          top: 50px
          background-color: white
          width: 250px
          box-shadow: $shadow_hover
          border: 1px solid $line_color
          border-radius: 4px 0 4px 4px
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
              p
                margin: 0
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
            cursor: pointer
            &:hover
              color: $text_color

@media screen and (max-width: 720px)
  nav
    box-shadow: none
    .menu_items
      .overlay
        background-color: rgba($text_color, .7)
      .logo
        width: 100px
      .items_wrapper
        ul
          display: none

</style>
