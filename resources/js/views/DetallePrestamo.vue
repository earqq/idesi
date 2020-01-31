<template>
  <div class="credit_detail_content">

    <div class="camera_screen_content" v-if="camara_prendida">
      <div class="camera_screen_wrapper">
        <div  class="close_camera">
          <i @click="stopCamera()" class="material-icons-outlined">close</i>
        </div>
        <video ref="video" id="video"  autoplay></video>
        <div class="controls" >
          <button class="capture_photo" id="snap" v-on:click="capture()"  v-if="!captura"></button>
          <div class="options" v-else>
            <a @click="storePhoto()"> GUARDAR </a>
            <a @click="startCamera()"> ELIMINAR </a>
          </div>
          <canvas v-show="false" ref="canvas" id="canvas" width="640" height="480"></canvas>
          <img v-show="false" v-bind:src="captura" height="50" />
        </div>
      </div>
    </div>

    <div class="create_client_content">
      <section class="client_forms">
        <div class="client_forms_wrapper">
          <div class="form_step">
            <div class="form_step_wrapper">
              <h3 class="title">Solicitud de Crédito</h3>

              <div class="detail_content"> 
                <li>
                  <strong>Monto </strong> 
                  <p>S/ {{prestamo_detalle.monto_inicial}}</p>
                </li>
                <li>
                  <strong>Forma </strong> 
                  <p>{{prestamo_detalle.forma_inicial}}</p>
                </li>
                  <li>
                  <strong>Plazo </strong> 
                  <p>{{prestamo_detalle.plazo_inicial}}</p>
                </li>
                  <li>
                  <strong>Disponibilidad de pago </strong> 
                  <p>{{prestamo_detalle.disponibilidad_pago_inicial ? prestamo_detalle.disponibilidad_pago_inicial : '--'}}</p>
                </li>
                <li>
                  <strong>Destino de crédito   </strong> 
                  <p>{{prestamo_detalle.destino_inicial}}</p>
                </li>
                <li></li>
              </div>
            </div>

            <div class="form_step_wrapper in_bottom">
              <h3 class="title">Propuesta del Analista</h3>
              <div class="detail_content"> 
                <li>
                  <strong>Producto </strong> 
                  <p>{{prestamo_detalle.producto}}</p>
                </li>
                <li>
                  <strong>Importe </strong> 
                  <p>{{prestamo_detalle.importe}}</p>
                </li>
                  <li>
                  <strong>Plazo </strong> 
                  <p>{{prestamo_detalle.plazo}}</p>
                </li>
                  <li>
                  <strong>Cuotas del Sistema </strong> 
                  <p>{{prestamo_detalle.cuotas}}</p>
                </li>
                  <li>
                  <strong>Aporte </strong> 
                  <p>{{prestamo_detalle.aporte}}</p>
                </li>
                  <li>
                  <strong>Comentarios </strong> 
                  <p>{{prestamo_detalle.comentarios}}</p>
                </li>
                <li>
                  <strong>Forma </strong> 
                  <p>{{prestamo_detalle.forma}}</p>
                </li>
                <li></li>
                <li></li>
              </div>
            </div>

            <div class="form_step_wrapper in_bottom">
              <h3 class="title">Evaluaciones</h3>
              <div class="empty_message_evaluation" v-if="evaluacion.length == 0">
                <img src="img/empty.svg" >
                <h1> Sin Evaluaciones </h1>
                <p>Todavia no se han relizado evaluaciones a este prestamo</p>
              </div>
              <div class="table_wrapper" v-else>
                <table class="table_evaluations no_hover">
                  <thead>
                    <tr>
                      <th>Evaluador</th>
                      <th>Comentarios</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="evaluacion in evaluacion"
                      :key="evaluacion.id"
                      :class="{final_result: evaluacion.idrol == 4}">
                      <td v-text="evaluacion.name"></td>
                      <td v-text="evaluacion.detalle ? evaluacion.detalle : '--'"></td>
                      <td>{{evaluacion.created_at | moment("D [de] MMMM, YYYY")}}</td>
                      <td class="state">
                        <span :class="stateEvaluation(evaluacion.estado)"></span>
                        {{evaluacion.estado | toCapitalize}}
                        <strong v-show="evaluacion.idrol == 4">( Decisión )</strong>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="form_step_wrapper in_bottom">
              <h3 class="title" v-show="list_vistas.length > 0 " >Negocio</h3>

              <div class="table_wrapper" v-show="list_vistas.length > 0 ">
                <table class="table_photos">
                  <thead>
                    <tr>
                      <th>Foto</th>
                      <th>Ubicación</th>
                      <th>Fecha</th>
                      <th class="options">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="visita in list_vistas" :key="visita.id">
                      <td class="photo">
                        <img :src="'../storage/'+cliente.documento+'_'+cliente.id+'/prestamo_'+visita.prestamos_id+'/imagen/'+visita.nombre+'.'+visita.extension">
                      </td>
                      <td class="place_photo">
                        <i class="material-icons-outlined">place</i>
                        <p> {{visita.latitud}} , {{visita.altitud}}</p>
                        <!-- <GmapMap
                          :center="{lat:  Number(visita.latitud), lng: Number(visita.altitud) }"
                          :zoom="15"
                          style="width: 500px; height: 300px"
                          :options="optionsMap">
                                <Gmap-Marker 
                                :position="{
                                  lat: Number(visita.latitud),
                                  lng: Number(visita.altitud),
                                }"
                              ></Gmap-Marker>
                        </GmapMap> -->
                      </td>
                      <td v-text="stringDate(visita.created_at)"></td>
                      <td class="options">
                        <i class="material-icons-outlined" >more_horiz</i>
                        <ul>
                          <li>
                            Ver Foto
                          </li>
                          <li>
                            Eliminar
                          </li>
                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <button type="button" class="add_section" :class="{no_border: list_vistas.length == 0 }" @click="startCamera" >
                <span> CAPTURAR FOTO DE NEGOCIO </span>
                <i class="material-icons-outlined">camera_alt</i> 
              </button>

            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
 
<script>
import moment from "moment";
import { gmapApi } from "vue2-google-maps";
import { STYLES_MAP } from '../constants'

export default {
  name: "visita",
  components: {},
  data() {
    return {
      optionsMap: {
        styles: STYLES_MAP,
        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
      },
      resource: "clientes",
      location: null,
      gettingLocation: false,
      errorStr: null,
      video: {},
      canvas: {},
      captura: "",
      camara_prendida: false,
      prestamo: this.$route.params.prestamo,
      errors: {},
      prestamo_detalle: [],
      cliente: [],
      camara: [],
      latitud: "",
      altitud: "",
      formViews: {},
      evaluacion: [],
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
  },
  methods: {
    startCamera() {
        this.captura = null 
        this.camara_prendida = true
        this.$nextTick(() => {
          this.video = this.$refs.video;
        })
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
                  this.video.src = URL.createObjectURL(this.camara);
                }

                this.video.play();
              },
              err => {
                output.innerHTML = errorMsg("Ocurrio un error", null);
              }
            );
          }
    },
    capture() {
      this.canvas = this.$refs.canvas;
      var context = this.canvas
        .getContext("2d")
        .drawImage(this.video, 0, 0, 640, 480);
      this.captura = canvas.toDataURL("image/png");
      // this.DownloadCanvasAsImage()
      // this.storePhoto();
      this.pauseCamera();
    },
    DownloadCanvasAsImage() {
      let downloadLink = document.createElement("a");
      downloadLink.setAttribute("download", "captura.png");
      let canvas = document.getElementById("canvas");
      let dataURL = canvas.toDataURL("image/png");
      let url = dataURL.replace(
        /^data:image\/png/,
        "data:application/octet-stream"
      );
      console.log(dataURL);
      downloadLink.setAttribute("href", url);
      downloadLink.click();
    },
    pauseCamera () {
      this.video.pause();
    },
    stopCamera() {
      this.video = this.$refs.video;
      this.video.pause();
      this.camara.getVideoTracks().forEach(function(track) {
        track.stop();
      });
      this.camara_prendida = false
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
          this.evaluacion = response.data["evaluacion"];
          this.cliente = response.data["cliente"];
        });
    },
    stateEvaluation(estado) {
      if (estado == "APROBADO") return "accept";
      if (estado == "OBSERVADO") return "observed";
      if (estado == "DESAPROBADO") return "denied";
      return;
    },
    storePhoto() {
      this.formData = new FormData()
      this.formData.append("name", "captura")
      this.formData.append("prestamo_id", this.prestamo)
      this.formData.append("latitud", this.location.coords.latitude)
      this.formData.append("longitud", this.location.coords.longitude)
      this.formData.append("file", this.captura)
      this.$http
        .post(`/${this.resource}/visita/nuevo`, this.formData, {
          headers: { "Content-Type": "multipart/form-data" }
        })
        .then(response => {
          // this.clearForm()
          this.views()
          this.tipo = true
          this.clearform()
          this.stopCamera()
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
    geolocate() {
      navigator.geolocation.getCurrentPosition(position => {
        this.formViews.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    }
  },
  filters: {
    toCapitalize (text) {
      return text.toLowerCase().replace(/\b\w/g, l => l.toUpperCase())
    }
  }
}
</script>

<style lang="sass">
@import "../../sass/variables"
.credit_detail_content
  position: relative
  .camera_screen_content
    position: fixed
    left: 0
    top: 55px
    background-color: black
    width: 100%
    height: calc(100vh - 175px)
    z-index: 10
    .camera_screen_wrapper
      .close_camera
        height: 50px
        background-color: black
        i
          color: white
          height: 50px
          width: 50px
          margin-right: 10px
          display: flex
          justify-content: center
          align-items: center
          float: right
          font-size: 30px
          cursor: pointer
      video
        height: calc(100vh - 225px)
        width: 100%
        display: block
      .controls
        height: 120px
        display: flex
        justify-content: center
        align-items: center
        background-color: black
        .options
          width: 100%
          display: flex
          a
            flex: 1
            flex-basis: 0
            color: white
            font-weight: 500
            text-align: center
            padding: 10px 0
            cursor: pointer
        button.capture_photo
          width: 65px
          height: 65px
          border-radius: 50%
          border: none
          background-color: white
          border: 7px solid black
          box-shadow: 0px 0px 0px 4px white
          transition: all ease-in-out .15s
          &:focus, &:active
            outline: none
          &:hover
            border: 10px solid black
          
  .create_client_content
    margin: 20px 0
    .empty_message_evaluation
      display: flex
      align-items: center
      justify-content: center
      flex-direction: column
      padding: 20px
      height: 250px
      overflow: hidden
      img
        width: 120px
      h1
        margin: 0
        font-size: 14px
        margin-top: 15px
        margin-bottom: 5px
        font-weight: 600
      p
        margin: 0
        font-size: 12px
        text-align: center
        line-height: 1.4
    table.table_photos
      thead, tbody
        tr
          margin-bottom: 0px
          border-bottom: 1px solid $bg_color
      tbody
        tr
          &:last-child
            border-bottom: 0
        td
          &.place_photo
            p
              margin: 0
              margin-left: 10px
          &.photo
            img
              border-radius: 4px
              width: 60px
              height: 40px
              object-fit: cover
              display: block
    table.table_evaluations
        thead, tbody
          tr
            margin-bottom: 0px
            border-bottom: 1px solid $bg_color
        &.no_hover 
          tbody:hover tr
            background-color: inherit
        tbody
          tr
            &.final_result
              background-color: rgba($primary_color, .03) !important
              border-left: 3px solid $primary_color
              &:hover
                background-color: rgba($primary_color, .03) !important
            &:last-child
              border-bottom: 0
        
        .state
          strong
            margin-left: 7px
          span
            width: 12px
            height: 12px
            border-radius: 50%
            background-color: $line_color
            margin-right: 12px
            margin-top: -2px
            &.accept
              background-color: $primary_color
            &.observed
              background-color: $highlight_color
            &.denied
              background-color: $require_color
</style>
 