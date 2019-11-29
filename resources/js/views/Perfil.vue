<template>
  <div class="container-general">
    <div class="row col-md-12 m-0 profile">
      <div class="col-md-3">
        <div class="row date-customer">
          <div
            class="col-md-12 d-flex flex-column justify-content-center align-items-center image-profile"
          >
            <img src="https://picsum.photos/200/300" alt />
          </div>
          <div class="col-md-12 date-profile">
            <p class="mb-0">Documento de Identidad</p>
            <h1 class="font-font-weight-bold mb-3" v-text="cliente.documento"></h1>
          </div>
          <div class="col-md-12 date-profile">
            <p class="mb-0">Nombres</p>
            <h1 class="font-font-weight-bold mb-3" v-text="cliente.nombres"></h1>
          </div>
          <div class="col-md-12 date-profile">
            <p class="mb-0">Albornoz</p>
            <h1 class="font-font-weight-bold mb-3" v-text="cliente.apellidos"></h1>
          </div>
          <div class="col-md-12 date-profile">
            <p class="mb-0">Fecha de Nacimiento</p>
            <h1 class="font-font-weight-bold mb-3" v-text="cliente.nacimiento"></h1>
          </div>
        </div>
        <div class="row other-customer"></div>
      </div>
      <div class="col-md-9 body-loans">
        <div class="row m-0">
          <div class="col-md-12 p-0 d-flex justify-content-between">
            <h1>Prestamos</h1>
            <router-link
              :to="{name: 'prestamo', params:{documento:cliente.documento}}"
              class="btn btn-success"
            >
              <i class="fas fa-plus"></i> Nuevo Prestamo
            </router-link>
          </div>
          <div class="w-100" v-if="prestamos.length>0">
            <div class="col-md-12 loans" v-for="prestamo in prestamos" :key="prestamo.id">
              <div class="row">
                <div class="col-md-3 col-sm-12">
                  <div class="form-group d-flex">
                    <label>Producto:</label>
                    <p class="ml-3" v-text="prestamo.producto"></p>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12">
                  <div class="form-group d-flex">
                    <label>Forma:</label>
                    <p class="ml-3" v-text="prestamo.forma"></p>
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-md-2">
                      <div class="form-group d-flex">
                    <label>Importe:</label>
                    <p class="ml-3" v-text="prestamo.importe"></p>
                  </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group d-flex">
                    <label>aporte:</label>
                    <p class="ml-3" v-text="prestamo.aporte"></p>
                  </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group d-flex">
                    <label>Plazo:</label>
                    <p class="ml-3" v-text="prestamo.plazo"></p>
                  </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group d-flex">
                    <label>Cuotas:</label>
                    <p class="ml-3" v-text="prestamo.cuotas"></p>
                  </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group d-flex">
                    <label>Tasa:</label>
                    <p class="ml-3" v-text="prestamo.tasa"></p>
                  </div>
                  </div> 
                  <div class="col-md-2">
                    <div class="form-group d-flex">
                    <label>Comentarios:</label>
                    <p class="ml-3" v-text="prestamo.comentarios"></p>
                  </div>
                  </div>
                   <router-link :to="{name:'ver', params:{prestamo:prestamo.id}}">
                     VER PRESTAMO
                  </router-link>

              </div>
            </div>
          </div>
          <div class="w-100" v-else>
            <p class="text-center">No registra prestamos</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      resource: "clientes",
      cliente: {},
      prestamos: {}
    };
  },
  created() {
    this.$http
      .get(`/${this.resource}/perfil/` + this.$route.params.documento)
      .then(response => {
        console.log(response.data);
        this.cliente = response.data["cliente"];
        this.prestamos = response.data["prestamos"];
      });
  },
  methods: {},
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
