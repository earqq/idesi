<template>
  <div class="menu-general">
      <nav class="menu d-flex justify-content-between">
          <ul class="active">
                <img :src="'../img/crecer.png'" alt="" srcset="">
                <div class="list-menu">
                  <li class="current-item">
                  <router-link :to="{name: 'inicio'}" >  Inicio</router-link>
                  </li>
                  <li>
                    <router-link :to="{name: 'clientes'}"  >Clientes</router-link>
                    </li>
                  <li>
                    <router-link :to="{name: 'evaluaciones'}"  >Evaluaciones</router-link>
                  </li>
                  <li>
                    <router-link :to="{name: '/lista-evaluaciones'}"  >Evaluaciones Final</router-link>
                  </li>
                </div>
            </ul>
    
         <div class="rigth-option">
              <img
                  class="img-circle"
                  src="https://picsum.photos/200/300"
                  alt="User profile picture"
                />
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Gian Marco
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Cerrar Sessión</a>
                  </div>
          </div>

      <a class="toggle-nav" id="toggle-nav" @click="toggleActive" href="#">&#9776;</a>
    
      <!-- <form class="search-form">
          <input type="text">
          <button>Buscar</button>
      </form> -->
  </nav>
  <div class="container-fluid p-0">
    
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
  </div>
  </div>
</template>

<script>

export default {
  data() {
    return {};
  },
  methods: {
    toggleActive(){
      $("#toggle-nav").toggleClass("active")
      $('.menu ul').toggleClass('active');
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
<style lang="css" scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0
}
</style>
