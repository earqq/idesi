<template>
<div class="container-general">
    <div class="loans-views">
      <div class="row m-0" v-if="tipo">
            <div class="col-md-12 d-flex justify-content-between">
              <p>Lista de Visitas</p>
              <button class="btn btn-success" @click="crearVisita()">Crear Visita</button>
            </div>
            <div class="col-md-12 views p-0">
              <h1>Visitas</h1>
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
                  <td>
                    <button
                      class="btn btn-success"
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
            <div class="row d-flex justify-content-center">
              <div class="col-md-10">
                <div class="form-group">
                  <label for="motivo">Motivo</label>
                  <input
                    type="text"
                    class="form-control documento-input"
                    v-model="formViews.motivo"
                  />
                </div>

                <div class="row">
                  <div class="form-group col-md-3">
                    <label for="fecha">Fecha</label>
                    <date-pick v-model="formViews.fecha" :months="mesEs" :weekdays="diaEs"></date-pick>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="hora">Hora</label>
                    <input type="text" class="form-control" v-model="formViews.hora" placeholder />
                  </div>

                  <div class="form-group col-md-12">
                    <label for="">
                        <gmap-autocomplete
                            @place_changed="setPlace">
                          </gmap-autocomplete>
                          <button @click="addMarker">Add</button>
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

                </div>
              </div>

              <div class="col-md-2 offset-md-8 d-flex justify-content-end">
                <button class="btn btn-danger w-100" @click="cancelarVisita">Cancelar</button>
                <button class="btn btn-success w-100" @click.prevent="submit">Registrar Visita</button>
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
  components: { DatePick },
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
        prestamos_id: this.$route.params.prestamo,
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
        .get(`/${this.resource}/visitas/` + this.$route.params.prestamo)
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
              "El prestamo fue creado",
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


        retornar(){
      this.backMixin_handleBack()
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