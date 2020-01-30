<template>
  <div class="views-list">
    <div class="loans-views">
      <div class="create_client_content">
        <section class="client_forms">
          <div class="client_forms_wrapper">
            <div class="form_step">
              <div class="form_step_wrapper">
                <h3 class="title">Solicitud de Crédito</h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Monto</label>
                      <input type="text" :value="prestamo_detalle.monto_inicial" disabled />
                    </div>
                    <div class="input_wrapper">
                      <label>Forma</label>
                      <input type="text" :value="prestamo_detalle.forma_inicial" disablgied />
                    </div>
                    <div class="input_wrapper">
                      <label>Plazo</label>
                      <input type="text" :value="prestamo_detalle.plazo_inicial" disabled />
                    </div>
                    <div class="input_wrapper">
                      <label>Disponibilidad de pago</label>
                      <input
                        type="text"
                        :value="prestamo_detalle.disponibilidad_pago_inicial"
                        disabled
                      />
                    </div>
                  </div>
                  <div class="group_form all">
                    <div class="input_wrapper">
                      <label>Destino de crédito (propuesta cliente)</label>
                      <input type="text" :value="prestamo_detalle.destino_inicial" disabled />
                    </div>
                  </div>
                </div>
              </div>
 
              <div class="form_step_wrapper">
                <h3 class="title">Propuesta del Analista</h3>

                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Producto</label>
                      <input type="text" :value="prestamo_detalle.producto" disabled />
                    </div>

                    <div class="input_wrapper">
                      <label>Importe</label>
                      <input type="text" :value="prestamo_detalle.forma" disabled />
                    </div>

                    <div class="input_wrapper">
                      <label>Plazo</label>
                      <input type="text" :value="prestamo_detalle.importe" disabled />
                    </div>
                  </div>

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Cuotas del Sistema</label>
                      <input type="text" :value="prestamo_detalle.cuotas" disabled />
                    </div>

                    <div class="input_wrapper">
                      <label>Aporte</label>
                      <input type="text" :value="prestamo_detalle.aporte" disabled />
                    </div>
                  </div>

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Comentarios</label>
                      <input type="text" :value="prestamo_detalle.comentarios" disabled />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form_step_wrapper">
                <h3 class="title">Evaluaciones</h3>

                <div class="table_wrapper">
                  <table class="table_clients">
                    <thead>
                      <tr>
                        <th>Evaluador</th>
                        <th>Observaciones</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <!-- <th class="options">Opciones</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <!-- <tr  v-for="evaluacion in form.evaluacion" :key="evaluacion.id">
                                        <td v-text="evaluacion.name"></td>
                                        <td v-text="evaluacion.detalle"></td>
                                        <td v-text="evaluacion.created_at"></td>
                                        <td v-text="evaluacion.estado"></td>
                      </tr>-->
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="form_step_wrapper">
                <h3 class="title">Ubicación del negocio</h3>

                <div class="table_wrapper">
                  <table class="table_clients">
                    <thead>
                      <tr>
                        <th>Fecha de registro</th>
                        <th>Foto</th>
                        <th>Ver en mapa</th>
                        <!-- <th class="options">Opciones</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="visita in list_vistas" :key="visita.id">
                        <td v-text="stringDate(visita.fecha)"></td>
                        <td>
                          <i class="fas fa-map-marked-alt"></i>
                        </td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="form_content">
                  <div>
                    <video ref="video" id="video" width="640" height="480" autoplay></video>
                  </div>
                  <div>
                    <button id="snap" v-on:click="capture()">Registrar Ubicación</button>
                  </div>
                  <canvas ref="canvas" id="canvas" width="640" height="480"></canvas>
                  
                  <ul>
                    <!-- <li v-for="c in captures" :key="c"> -->
                    <img v-bind:src="captura" height="50" />
                    <!-- </li> -->
                  </ul>
                </div>

                <div class="form_buttons">
                  <a class="button_inline_primary medium prev"  >
                    <i class="material-icons-outlined">navigate_before</i>
                    <span>REGRESAR PERFIL</span>
                  </a>
                  <a class="button_primary medium next" >
                    <span>GUARDAR UBICACION</span>
                    <i class="material-icons-outlined">navigate_next</i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- <div class="row m-0">
        <div class="col-md-12 d-flex justify-content-between p-0">
          <p></p>
          <button class="btn btn-def" style="width:15%" @click="crearVisita()">Crear Ubicación</button>
        </div>
        <div class="col-md-12 views p-0">
          <h1>Ubicación del negocio</h1>

        </div>
      </div>

      <div class="new-view" >
        <div class="row">
          <div class="form-group col-md-12">
            <gmap-map
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
            </gmap-map>
          </div>

          <div class="col-md-12 mt-3 d-flex justify-content-end">
            <button class="btn btn-dark w-25" @click="cancelarVisita">Cancelar</button>
            <button class="btn btn-orange w-25" @click.prevent="submit">Registrar Visita</button>
          </div>
        </div>
      </div>-->
    </div>
  </div>
</template>
 
<script>
import moment from "moment";
import { gmapApi } from "vue2-google-maps";

export default {
  name: "visita",
  components: {},
  data() {
    return {
      resource: "clientes",
      location: null,
      gettingLocation: false,
      errorStr: null,
      video: {},
      canvas: {},
      captura: "",
      prestamo: this.$route.params.prestamo,
      errors: {},
      prestamo_detalle: [],
      camara: [],
      latitud: '',
      altitud: '',
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
      }
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
      // this.DownloadCanvasAsImage()
      this.submit()
      this.apagar()
    },
    DownloadCanvasAsImage(){
      let downloadLink = document.createElement('a');
      downloadLink.setAttribute('download', 'captura.png');
      let canvas = document.getElementById('canvas');
      let dataURL = canvas.toDataURL('image/png');
      let url = dataURL.replace(/^data:image\/png/,'data:application/octet-stream');
      console.log(dataURL)
      downloadLink.setAttribute('href',url);
      downloadLink.click();
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
          this.list_vistas = response.data["visita"];
          this.prestamo_detalle = response.data["prestamo"];
          console.log(this.prestamo_detalle);
        });
    },

    submit() {
      this.formData = new FormData();
      this.formData.append("name", "addsdasd");
      this.formData.append("prestamo_id", this.prestamo);
      this.formData.append("latitud", this.location.coords.latitude);
      this.formData.append("longitud",  this.location.coords.longitude); 
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
 