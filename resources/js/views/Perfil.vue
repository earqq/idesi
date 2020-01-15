<template>
  <div class="container-general">

   
    <div class="gm-grid-container">
      <div class="profile scroll-style">
        <div class="return" @click="retornar()">
          <i class="fas fa-chevron-left back"></i>
          <p>Clientes</p>
          <i class="fas fa-users icon-users"></i>
        </div>
        <loader-perfil v-if="loader"></loader-perfil>
        <div class="box-profile" v-else>
          <div class="text-center">
            <img
              class="profile-user-img img-fluid img-circle"
              src="https://picsum.photos/200/300"
              alt="User profile picture"
            />
          </div>

          <h3 class="profile-username text-center">
            {{cliente.nombres+''+cliente.apellidos}}
            <!-- <span>
              <i class="fas fa-edit"></i>
            </span> -->
          </h3>

          <div class="access">
            <p class="text-center" data-toggle="tooltip" data-placement="bottom" title="Telefono">
              <i class="fas fa-phone"></i>
            </p>
            <p class="text-center">
              <i class="fas fa-phone"></i>
            </p>
          </div>
          <div id="accordion" class="collpase">
            <div class="card">
              <div
                class="card-header"
                id="headingOne"
                data-toggle="collapse"
                data-target="#collapseOne"
                aria-expanded="false"
                aria-controls="collapseOne"
              >
                <i class="fas fa-chevron-down"></i>
                <span>Datos del cliente</span>
              </div>

              <div
                id="collapseOne"
                class="collapse"
                aria-labelledby="headingOne"
                data-parent="#accordion"
              >
                <div class="card-body">
                  <h5>Nombres</h5>
                  <p v-text="cliente.nombres"></p>
                  <h5>Apellidos</h5>
                  <p v-text="cliente.apellidos"></p>
                  <h5>Documento</h5>
                  <p v-text="cliente.documento"></p>
                  <h5>Fecha de nacimiento</h5>
                  <p v-text="cliente.nacimiento"></p>
                  <h5>Celular</h5>
                  <p v-text="cliente.celular"></p>
                  <h5>Direccion</h5>
                  <p v-text="cliente.direccion_cliente"></p>
                </div>
              </div>
            </div>

            <div class="card">
              <div
                class="card-header"
                id="headingTwo"
                data-toggle="collapse"
                data-target="#collapseTwo"
                aria-expanded="false"
                aria-controls="collapseTwo"
              >
                <i class="fas fa-chevron-down"></i>
                <span>Datos de prestamo</span>
              </div>
              <div
                id="collapseTwo"
                class="collapse"
                aria-labelledby="headingTwo"
                data-parent="#accordion"
              >
                <div class="card-body">Anim pariatur</div>
              </div>
            </div>


          </div>
        </div> 
      </div>

      <div class="general " v-if="option_loan &&  view==false">
        <div class="prestamos scroll-style" v-if="tipo_general" style="background:#dceaf0;">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a  class="nav-item nav-link active"  id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"  >Prestamos</a>
              <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>-->
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active tab-general"  id="nav-home"  role="tabpanel" aria-labelledby="nav-home-tab" >
              <loader-prestamo v-if="loader_loan"></loader-prestamo>
              <div class="loan" v-else v-for="prestamo in prestamos" :key="prestamo.id">
                <h5 class="date-loan" v-text="stringDate(prestamo.created_at)"></h5>
                <div class="cardp-0 mb-3 prop-card">
                  <div class="card-header">
                    <i class="fas fa-box"></i> PRESTAMOS
                  </div>
                  <div class="card-body">
                    <div class="w-100" v-if="prestamos.length>0">
                      <div class="col-md-12 loans">
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

                        <div class="row d-flex justify-content-end">
                          <router-link
                            :to="{name:'ver', params:{prestamo:prestamo.id}}"
                            class="btn btn-def ml-3"
                          >Prestamo</router-link>
                          <router-link
                            :to="{name:'archivos', params:{prestamo:prestamo.id}}"
                            class="btn btn-def ml-3"
                          >Documentos</router-link>
                          <router-link
                            v-if="prestamo.cualitativa =='0'"
                            :to="{name:'evalCualtitativa', params:{prestamo:prestamo.id}}"
                            class="btn btn-def ml-3"
                          >Evaluación Cualitativa</router-link>
                          <router-link
                          v-if="prestamo.cuantitativa=='0'"
                            :to="{name:'evalCuantitativa', params:{prestamo:prestamo.id}}"
                            class="btn btn-def ml-3"
                          >Evaluación Cuantitativa</router-link>
                          <!-- <router-link
                            :to="{name:'visitas', params:{prestamo:prestamo.id}}"
                            class="btn btn-def ml-3"
                          >Visitas</router-link> -->
                          <button class="btn btn-def ml-3" @click="cambiarView(prestamo.id)">
                            visitas
                          </button>
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
            <!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>-->
          </div>
        </div>

        <div class="date">
          <div class="date-header">
            <router-link
              :to="{name: 'prestamo', params:{dni:cliente.documento}}"
              class="btn btn-def w-100 p13"
            >
              <i class="fas fa-plus"></i> Solicitud de Credito
            </router-link>
          </div>
          
          <div class="date-body">
            <a
                :href="'../storage/'+cliente.documento+'_'+cliente.idcliente+'/general/documento/inscripcion_de_socio.pdf'"
                target="_blank"
              >

            <div class="card">
                <div class="card-header text-center" >
                  <i class="fas fa-print"></i>
                  <span>Solicitud de admisión</span>
            </div>

            </div>

            </a>
          </div>

        </div>
      </div> 
      
      <div class="general-view" v-else>
          <visitas :prestamo="idprestamo" ></visitas>
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
  }
};
</script>
