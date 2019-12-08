<template>
  <div class="container-general">
      <header>
        <span @click="retornar()">
          <i class="fas fa-angle-left"></i>
        </span>
        <h1>Perfil</h1>
      </header>
    <div class="row">
    <div class="col-md-3 m-0 profile">
        <div class="row date-customer">
          <!-- <div
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
          </div> -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="https://picsum.photos/200/300"  alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Nina Mcintire añlbornoz</h3>

                <p class="text-muted text-center m-0">Nac. 2014-12-6</p>
                <p class="text-muted text-center">Doc. 72114126</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Prestamos totales</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Prestamos Aceptado</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Prestamos Pendientes</b> <a class="float-right">13,287</a>
                  </li>
                  <li class="list-group-item">
                    <b>Prestamos Rechazados</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-crecer w-100" style="color:#fff"> Editar</a>
              </div>
            </div>

        </div>
        <div class="row other-customer"></div>
    </div>

    <div class="col-md-9 body-loans">
        <div class="row m-0">
          <div class="card col-md-12 p-0">
            <div class="card-header d-flex justify-content-between">
              PRESTAMOS
              <router-link
                :to="{name: 'prestamo', params:{dni:cliente.documento}}"
                class="btn btn-crecer"
              >
                <i class="fas fa-plus"></i> Nuevo Prestamo
               </router-link>
            </div>
            <div class="card-body">
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
                    <router-link
                      :to="{name:'ver', params:{prestamo:prestamo.id}}"
                      class="btn btn-success ml-3"
                    >VER PRESTAMO</router-link>
                    <router-link
                      :to="{name:'archivos', params:{prestamo:prestamo.id}}"
                      class="btn btn-danger ml-3"
                    >CARGAR ARCHIVOS</router-link>
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
      </div>
  </div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
export default {
  mixins: [serviceNumber],
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
  methods: {
    retornar(){
      this.backMixin_handleBack()
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
