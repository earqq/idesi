<template>
  <div class="container-fluid clients">
    <div class="card-client new">
      <i class="fas fa-plus-circle"></i>
      <h1>Crear Cliente</h1>
    </div>

    <div class="card-client" v-for="cliente in clientes" :key="cliente.id">
      <img src="https://picsum.photos/200/300" alt />
      <p v-text="cliente.nombres"></p>
      <p v-text="cliente.documento">dni</p>
    </div>
    <infinite-loading @infinite="infiniteHander">
        <div slot="no-more" class="" style="text-align: center;line-height: 200px;">
            No se encuentran mas datos
        </div>
        <div  slot="spinner" class="">
            Cargando datos ... 
        </div>
    </infinite-loading>

  </div>

</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
export default {
  components: { InfiniteLoading },
  data() {
    return {
      clientes: [],
      page: 0
    };
  },
  methods: {
    infiniteHander($estado) {
      this.page++;
      let url = "http://crecer.test/api/clientes?page=" + this.page;
      axios.get(url).then(response => {
        let datos = response.data.data;
        if (datos.length) {
          this.clientes = this.clientes.concat(datos);
          $estado.loaded();
        } else {
          $estado.complete();
        }
      });
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
