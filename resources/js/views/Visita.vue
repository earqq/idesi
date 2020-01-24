<template>
  <div class="views-list">
    <header>
      <span @click="retornar()">
        <i class="fas fa-angle-left"></i>
      </span>
      <h1>Ubicación del negocio</h1>
    </header>
    <div class="loans-views">
      <div>
        <video ref="video" id="video" width="640" height="480" autoplay></video>
      </div>
      <div>
        <button id="snap" v-on:click="capture()">Snap Photo</button>
        <button @click="apagar()">apagar</button>
      </div>
      <canvas ref="canvas" id="canvas" width="640" height="480"></canvas>
      <ul>
        <!-- <li v-for="c in captures" :key="c"> -->
        <img v-bind:src="captura" height="50" />
        <!-- </li> -->
      </ul>
      <div class="row m-0" v-if="tipo">
        <div class="col-md-12 d-flex justify-content-between p-0">
          <p></p>
          <button class="btn btn-def" style="width:15%" @click="crearVisita()">Crear Ubicación</button>
        </div>
        <div class="col-md-12 views p-0">
          <h1>Ubicación del negocio</h1>
          <table style="width:100%">
            <tr>
              <th>Fecha de registro</th>
              <th>Foto</th>
              <th>Ver en mapa</th>
            </tr>
            <tr v-for="visita in list_vistas" :key="visita.id">
              <td v-text="stringDate(visita.fecha)"></td>
              <td>
                <i class="fas fa-map-marked-alt"></i>
              </td>
              <td class="d-flex justify-content-end">
                <button class="btn btn-orange" style="width:50%" v-if="visita.estado==1">Completar</button>
                <button class="btn btn-success disabled" style="width:50%" v-else>Completo</button>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="new-view" v-else>
        <div class="row">
          <div class="form-group col-md-12">
            <!-- <gmap-map
                            :center="formViews.center"
                            :zoom="18"
                            style="width:100%;  height: 400px;"
                            map-type-id="terrain"  
                          >
                            <gmap-marker
                              :key="index"
                              v-for="(m, index) in formViews.markers"
                              :position="m.position"
                              @click="formViews.center=m.position"
                            ></gmap-marker>
            </gmap-map>-->
          </div>

          <div class="col-md-12 mt-3 d-flex justify-content-end">
            <button class="btn btn-dark w-25" @click="cancelarVisita">Cancelar</button>
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
import { gmapApi } from "vue2-google-maps";

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
  name: "visita",
  components: { DatePick },
  props: ["prestamo"],
  data() {
    return {
      resource: "clientes",
      location: null,
      gettingLocation: false,
      errorStr: null,
      video: {},
      canvas: {},
      captura: "",
      errors: {},
      camara: [],
      formViews: {},
      formData: {},
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
      diaEs: diaConf
    };
  },
  computed: {
    google: gmapApi
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

    if (!("geolocation" in navigator)) {
      this.errorStr = "Geolocation is not available.";
      return;
    }

    this.gettingLocation = true;

    navigator.geolocation.getCurrentPosition(
      pos => {
        this.gettingLocation = false;
        this.location = pos;
      },
      err => {
        this.gettingLocation = false;
        this.errorStr = err.message;
      }
    );
    this.video = this.$refs.video;
    navigator.getMedia =
      navigator.getUserMedia ||
      navigator.webkitGetUserMedia ||
      navigator.mozGetUserMedia ||
      navigator.msGetUserMedia;
    if (!navigator.getMedia) {
      output.innerHTML = errorMsg(
        "Tu navegador no soporta el uso de la camara",
        null
      );
    } else {
      navigator.getMedia(
        { video: true },
        stream => {
          try {
            this.camara = stream;
            this.video.srcObject = this.camara;
          } catch (error) {
            this.video.src = URL.createObjectURL(mediaSource);
          }

          this.video.play();
        },
        err => {
          output.innerHTML = errorMsg("Ocurrio un error", null);
        }
      );
    }
  },
  methods: {
    capture() {
      this.canvas = this.$refs.canvas;
      var context = this.canvas
        .getContext("2d")
        .drawImage(this.video, 0, 0, 640, 480);
      this.captura = canvas.toDataURL("image/png");
    },
    apagar() {
      this.video = this.$refs.video;
      this.video.pause();
      this.camara.getVideoTracks().forEach(function(track) {
        track.stop();
      });
    },

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
      this.addMarker();
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
        currentPlace: null
      };
    },
    clearform() {
      this.initForm();
    },
    views() {
      this.$http
        .get(`/${this.resource}/visitas/` + this.prestamo)
        .then(response => {
          this.list_vistas = response.data;
        });
    },

    submit() {
      this.formData = new FormData();
      this.formData.append("name", "addsdasd");
      this.formData.append("prestamo_id", this.prestamo);
      this.formData.append("file", this.captura);
      this.$http
        .post(`/${this.resource}/visita/nuevo`, this.formData, {
          headers: { "Content-Type": "multipart/form-data" }
        })
        .then(response => {
          // this.clearForm()
          this.views();
          this.tipo = true;
          this.clearform();

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
      const marker = {
        lat: this.location.coords.latitude,
        lng: this.location.coords.longitude
      };
      this.formViews.markers.push({ position: marker });
      this.formViews.places.push(this.formViews.currentPlace);
      this.formViews.center = marker;
      this.formViews.currentPlace = null;
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

<style lang="css" scoped>
#app {
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
#video {
  background-color: #000000;
}
#canvas {
  display: none;
}
li {
  display: inline;
  padding: 5px;
}
</style>>
 