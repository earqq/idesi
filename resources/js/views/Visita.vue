<template>
<div class="views-list">
    <header>
      <span @click="retornar()">
        <i class="fas fa-angle-left"></i>
      </span>
      <h1>Lista de visitas</h1>
    </header>

    <div class="loans-views">
      <div class="row m-0" v-if="tipo">
            <div class="col-md-12 d-flex justify-content-between p-0 ">
              <p></p>
              <button class="btn btn-def " style="width:15%"  @click="crearVisita()">Crear Visita</button>
            </div>
            <div class="col-md-12 views p-0">
              <h1>Visitas Programadas</h1>
              <table style="width:100%">
                <tr>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Motivo</th>
                  <th>Lugar</th>
                  <th></th>
                </tr>
                <tr v-for="visita in list_vistas" :key="visita.id">
                  <td v-text="stringDate(visita.fecha)"></td>
                  <td v-text="visita.hora"></td>
                  <td v-text="visita.motivo"></td>
                  <td>
                    <i class="fas fa-map-marked-alt"></i>
                  </td>
                  <td class="d-flex justify-content-end">
                    <button
                      class="btn btn-orange"
                      style="width:50%"
                      v-if="visita.estado==1"
                    >Completar</button>
                    <button class="btn btn-success disabled" style="width:50%" v-else>Completo</button>
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="new-view" v-else>
            <div class="row">
              <div class="form-group col-md-8">
                  <label for="motivo">Motivo</label>
                  <input
                    type="text"
                    class="form-control documento-input"
                    v-model="formViews.motivo"
                  />
              </div>
              <div class="form-group col-md-2">
                    <label for="fecha">Fecha</label>
                    <date-pick v-model="formViews.fecha" :months="mesEs" :weekdays="diaEs"></date-pick>
              </div>

              <div class="form-group col-md-2">
                    <label for="hora">Hora</label>
                    <input type="text" class="form-control" v-model="formViews.hora" placeholder />
              </div>

              <div class="form-group col-md-12 d-flex justify-content-center mt-2 mb-2">
                    <label for="">
                        <gmap-autocomplete
                            @place_changed="setPlace">
                          </gmap-autocomplete>
                          <button @click="addMarker">Agregar Ubicación</button>
                    </label>
              </div>

                <div class="form-group col-md-12">
                           <gmap-map
                            :center="formViews.center"
                            :zoom="12"
                            style="width:100%;  height: 400px;"
                             :options="{
                                zoomControl: true,
                                mapTypeControl: false,
                                scaleControl: false,
                                streetViewControl: false,
                                rotateControl: false,
                                fullscreenControl: true,
                                disableDefaultUi: false,
                                click:true,
                                dblclick:true
                              }"
                          >
                            <gmap-marker
                              :key="index"
                              v-for="(m, index) in formViews.markers"
                              :position="m.position"
                              @click="formViews.center=m.position"
                            ></gmap-marker>
                          </gmap-map>
                    
            </div>

              <div class="col-md-12 mt-3 d-flex justify-content-end">
                <button class="btn btn-dark  w-25" @click="cancelarVisita">Cancelar</button>
                <button class="btn btn-orange w-25" @click.prevent="submit">Registrar Visita</button>
              </div>
            </div>
          </div>
  </div>
</div>

</template>
 
<script>
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
import moment from "moment";



const mesConf = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
];
const diaConf = ["Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"];
export default {
  name: 'visita',
  components: { DatePick },
  props: ["prestamo"],
  data() {
    return {
      resource: "clientes",
      errors: {},
      formViews: {},
      list_vistas: [],
      tipo: true,
      notificationSystem: {
        options: {
          success: {
            position: "topRight"
          },
          error: {
            position: "topRight"
          }
        }
      },
      mesEs: mesConf,
      diaEs: diaConf,
    };
  },
  async created() {


    await this.views();
    /**
     * DATOS VIES
     */
    await this.initForm();
  },
  mounted() {
    this.geolocate();
  },
  methods: {
   retornar() {
     this.$parent.view = false; 
     this.$parent.idprestamo = 0; 
    },
    stringDate(date) {
      var string = moment(date)
        .locale("es")
        .format("D [de] MMMM [del] YYYY");
      return string;
    },

    crearVisita() {
      this.tipo = false;
    },
    cancelarVisita() {
      this.tipo = true;
    },

    initForm() {
      this.formViews = {
        fecha: "",
        hora: "",
        motivo: "",
        prestamos_id: this.prestamo,
        estado: 1,
        center: { lat: -9.9207648, lng: -76.2410843 },
        markers: [],
        places: [],
        currentPlace: null,
      };
    },
    clearform(){
      this.initForm()
    },
    views() {
      this.$http
        .get(`/${this.resource}/visitas/` + this.prestamo)
        .then(response => {
          this.list_vistas = response.data;
        });
    },

      submit() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }
      this.$http
        .post(`/${this.resource}/visita/nuevo`, this.formViews)
        .then(response => {
          // this.clearForm()
          this.views()
          this.tipo = true
          this.clearform()

          this.$toast.success(
              "La visita fue registrada",
              "Exitoso",
              this.notificationSystem.options.success
            ); 
        })
        // .catch(error => {
        //   if (error.response.status === 422) {
        //     this.errors = error.response.data;
        //   } else {
        //     this.$message.error(error.response.data.message);
        //   }
        // })
        .then(() => {
          // this.loading_submit = false;
        });
    },
    
    resetForm() {
      this.initForm(); 
    },
     // receives a place object via the autocomplete component
    setPlace(place) {
      this.formViews.currentPlace = place;
    },
    addMarker() {
      if (this.formViews.currentPlace) {
        const marker = {
          lat: this.formViews.currentPlace.geometry.location.lat(),
          lng: this.formViews.currentPlace.geometry.location.lng()
        };
        this.formViews.markers.push({ position: marker });
        this.formViews.places.push(this.formViews.currentPlace);
        this.formViews.center = marker;
        this.formViews.currentPlace = null;
      }
    },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.formViews.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    }

  }
};
</script>

<style>

</style>