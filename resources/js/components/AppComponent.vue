<template>
  <div class="menu-general">
      <nav class="menu">
    <ul class="active">
          <li class="current-item">
            <router-link :to="{name: 'inicio'}" >  Inicio</router-link>
            </li>
          <li>
            <router-link :to="{name: 'clientes'}"  >Clientes</router-link>
            </li>
          <li>
            <router-link :to="{name: 'perfil'}">  Perfil</router-link>
            </li>
          <li>
            <router-link :to="{name: 'prestamo'}">  Prestamo</router-link>
          </li>
      </ul>
    
      <a class="toggle-nav" id="toggle-nav" @click="toggleActive" href="#">&#9776;</a>
    
      <form class="search-form">
          <input type="text">
          <button>Buscar</button>
      </form>
  </nav>
  <div class="container-fluid p-0">
    <router-view></router-view>
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

</style>
