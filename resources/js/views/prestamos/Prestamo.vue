<template>
  <div class="credit_detail_content">

    <div class="modal_content" v-if="flagModalPhoto" >
      <div class="modal_wrapper photo_viewer">
        <div class="title"> 
          <h1> Infomacion de Foto </h1>
          <i  @click="flagModalPhoto = false" class="material-icons-outlined">close</i>
        </div>
        <div class="photo_viewer" v-if="currentPhoto">
          <img :src="'../storage/'+prestamo.cliente.documento+'_'+prestamo.cliente.id+'/prestamo_'+currentPhoto.prestamos_id+'/imagen/'+currentPhoto.nombre+'.'+currentPhoto.extension">
          <div class="map_wrapper">
            <GmapMap
              :center="{lat:  Number(currentPhoto.latitud), lng: Number(currentPhoto.altitud) }"
              :zoom="15"
              style="width: 100%; height: 270px"
              :options="optionsMap">
                    <Gmap-Marker 
                    :position="{
                      lat: Number(currentPhoto.latitud),
                      lng: Number(currentPhoto.altitud),
                    }"
                  ></Gmap-Marker>
            </GmapMap>
          </div>
        </div>
      </div>
    </div>

    <transition name="fade" mode="in-out">
      <div class="camera_screen_content" v-if="camara_on">
        <div class="camera_screen_wrapper">
          <div  class="header_camera">
            <select @change='refreshCamera()' v-model='selected_camera_id'>
              <option v-for='(camera_id,index) in listDevices'  v-bind:key='index' :value='camera_id'> Camara {{index+1}} </option>
            </select>
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
    </transition>

    <div class="create_client_content">
      <section class="client_forms">
        <div class="client_forms_wrapper">
          <div class="form_step">

            <div class="form_step_wrapper">
              <h3 class="title">Solicitud de Crédito asdfawef {{listDevices.length}}</h3>
              <div class="detail_content"> 
                <li>
                  <strong>Monto </strong> 
                  <p>S/ {{prestamo.monto_cliente}}</p>
                </li>
                <li>
                  <strong>Forma </strong> 
                  <p>{{prestamo.forma}}</p>
                </li>
                  <li>
                  <strong>Cuotas </strong> 
                  <p>{{prestamo.cuotas_cliente}}</p>
                </li>
                  <li>
                  <strong>Disponibilidad de pago </strong> 
                  <p>S/. {{prestamo.disponibilidad_pago ? prestamo.disponibilidad_pago : '0.00'}}</p>
                </li>               
                <li class="spanner"></li>
                <li class="spanner"></li>
              </div>
            </div>

            <div class="form_step_wrapper in_bottom">
              <h3 class="title">Propuesta del Analista</h3>
              <div class="detail_content"> 
                <li>
                  <strong>Producto </strong> 
                  <p>{{prestamo.producto_analista}}</p>
                </li>
                <li>
                  <strong>Importe </strong> 
                  <p>S/. {{prestamo.importe_analista}}</p>
                </li>
                  <li>
                  <strong>Cuotas </strong> 
                  <p>{{prestamo.cuotas_analista}}</p>
                </li>
                  <li>
                  <strong>Cuota del Sistema </strong> 
                  <p>{{prestamo.cuota_sistema}}</p>
                </li>
                  <li>
                  <strong>Aporte </strong> 
                  <p>S/. {{prestamo.aporte_analista}}</p>
                </li>
                  <li>
                  <strong>Comentarios </strong> 
                  <p>{{prestamo.comentarios || 'SIN COMENTARIOS'}}</p>
                </li>
              </div>
            </div>

            <div v-if='prestamo.estado>2' class="form_step_wrapper in_bottom">
              <h3 class="title">Resultado final</h3>
              <div class="detail_content"> 
                <li>
                  <strong>Producto </strong> 
                  <p>{{prestamo.producto_final}}</p>
                </li>
                <li>
                  <strong>Importe </strong> 
                  <p>{{prestamo.importe_final}}</p>
                </li>
                  <li>
                  <strong>Cuotas </strong> 
                  <p>{{prestamo.cuotas_final}}</p>
                </li>
                  <li>
                  <strong>Cuota del Sistema </strong> 
                  <p>{{prestamo.cuota_final}}</p>
                </li>
                  <li>
                  <strong>Aporte </strong> 
                  <p>{{prestamo.aporte_final}}</p>
                </li>              
                <li>
                  <strong>Forma </strong> 
                  <p>{{prestamo.forma}}</p>
                </li>
                <li class="spanner"></li>
                <li class="spanner"></li>
              </div>
            </div>

            <div v-if='prestamo.estado==1'  v-show="prestamo.fotos.length > 0 " class="form_step_wrapper in_bottom">
              <h3 class="title" >Negocio</h3>
              <div class="table_wrapper" >
                <table class="table_photos">
                  <thead>
                    <tr>
                      <th class="photo">Foto</th>
                      <th>Ubicación</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="foto in prestamo.fotos" :key="foto.id" @click="selectPhoto(foto)">
                      <td class="photo">
                        <img :src="'../storage/'+prestamo.cliente.documento+'_'+prestamo.cliente.id+'/prestamo_'+foto.prestamo_id+'/imagen/'+foto.nombre+'.'+foto.extension">
                      </td>
                      <td class="place_photo">
                        <i class="material-icons-outlined">place</i>
                        <p v-if="geocoder"> {{ getLocationName(foto.latitud, foto.altitud, foto)}} {{foto.location_name ? foto.location_name : 'Desconocido'}}</p>
                        
                      </td>
                      <td v-text="stringDate(foto.created_at)"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="form_step_wrapper in_bottom">
              <button  type="button" class="add_section" :class="{no_border: prestamo.fotos.length == 0 }" @click="startCamera"  v-if="listDevices.length > 0">
                <span> CAPTURAR FOTO DE NEGOCIO  </span>
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
import { STYLES_MAP } from '../../constants'

import GoogleMapsLoader from 'google-maps'
import Vue from 'vue'


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
      selected_camera_id: {},
      screen: screen,
      location: null,
      gettingLocation: false,
      errorStr: null,
      video: null,
      canvas: {},
      mobile:false,
      captura: "",
      camara_on: false,
      errors: {},
      location:{
        coords:{
          latitude: "",
          altitude: "",
        }
      },
      prestamo:{
        fotos:[],
        evaluaciones:[]
      },      
      camara: [],
      formViews: {},
      evaluacion: [],
      formData: {},
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
      geocoder: null,
      flagModalPhoto: false,
      currentPhoto: null,
      listDevices: []
    }
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
    if (process.client) {  // en lado del servidor no existe windown, document, etc
        if (window.innerWidth < 850) this.mobile = true
        else this.mobile = false

        this.$nextTick(() => {
            window.addEventListener('resize', () => {
                if (window.innerWidth < 850) this.mobile = true
                else this.mobile = false
            })
        })
    }
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
    )
    GoogleMapsLoader.load((google) => {
      this.initMap(google)
    })
    this.selectCamera()
  },  
  methods: {
    selectPhoto (visita) {
      this.flagModalPhoto = true
      this.currentPhoto = visita
    },
    getLocationName (lat, lng, visita) {
      if (lat != undefined) {
        let latlng = new google.maps.LatLng(Number(lat) , Number(lng))
        this.geocoder.geocode( {'location': latlng} , (results, status) => {
          if (results && results[0]) Vue.set(visita, "location_name", results[0].formatted_address)
        })
      }
    },
    initMap (google) {
      this.geocoder = new google.maps.Geocoder()
      this.getLocationName()
    },
    selectCamera () {
      // https://www.html5rocks.com/en/tutorials/getusermedia/intro/
      navigator.mediaDevices.enumerateDevices()
        .then(this.gotDevices).then(this.getStream).catch(console.error)

    },
    gotDevices(deviceInfos) {
      for (let i = 0; i !== deviceInfos.length; ++i) {
        const deviceInfo = deviceInfos[i]
        if (deviceInfo.kind == 'videoinput') {
          console.log(deviceInfo.kind , 'camera')
          this.listDevices.push(deviceInfo.deviceId)
          this.selected_camera_id=deviceInfo.deviceId
        } else {
          console.log('Found another kind of device: ', deviceInfo);
        }
      }
    },
    getStream() {
      if (window.stream) {
        window.stream.getTracks().forEach(function(track) {
          track.stop()
        })
      }
      const constraints = {
        video: {
          deviceId: {exact: this.selected_camera_id}
        }
      }
    },
    refreshCamera(){
      this.stopCamera();
      this.startCamera();
    },
    startCamera() {
        this.captura = null 
        this.camara_on = true
        this.$nextTick(() => {
          this.video = this.$refs.video;
        })
        navigator.getMedia =
        navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia
        
        if (!navigator.getMedia) {
          console.error("Tu navegador no soporta el uso de la camara")
        } else {
          navigator.getMedia(
            {
              video: {
                deviceId:{exact: this.selected_camera_id}
              }
            },
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
              console.error("Ocurrio un error")
            }
          );
        }
    },
    pauseCamera () {
      this.video.pause();
    },
    stopCamera() {
      //this.video = this.$refs.video;
      this.video.pause();
      this.camara.getVideoTracks().forEach(function(track) {
        track.stop();
      });
      this.camara_on = false
      this.video = null
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
      downloadLink.setAttribute("href", url);
      downloadLink.click();
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
        .get(`/prestamos/` + this.$route.params.prestamoID)
        .then(response => {
          this.prestamo = response.data
        });
    },
    stateEvaluation(estado) {
      if (estado == 3) return "accept";
      if (estado == 4) return "observed";
      if (estado == 5) return "denied";
      return;
    },
    storePhoto() {
      console.log("store photo")
      console.log(this.location)
      this.formData = new FormData()
      this.formData.append("name", "captura")
      this.formData.append("prestamo_id", this.prestamo.id)
      this.formData.append("latitud", this.location.coords.latitude)
      this.formData.append("longitud", this.location.coords.longitude)
      this.formData.append("file", this.captura)
      this.$http
        .post(`/prestamos/foto/`, this.formData, {
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
  }
  // ,
  // filters: {
  //   toCapitalize (text) {
  //     return text.toLowerCase().replace(/\b\w/g, l => l.toUpperCase())
  //   }
  // }
}
</script>

<style lang="sass">
@import "../../../sass/variables"
.credit_detail_content
  position: relative
  .photo_viewer
    border: 1px solid $line_color
    border-radius: 4px
    overflow: hidden
    img
      width: 100%
      height: 400px
      object-fit: cover
    .map_wrapper
      height: 250px
  .camera_screen_content
    position: fixed
    left: 0
    top: 0
    background-color: black
    width: 100%
    height: calc(100vh - 175px)
    z-index: 15
    .camera_screen_wrapper
      .header_camera
        height: 50px
        background-color: black
        select
          height: 32px
          padding: 0 10px
          margin-top: 10px
          margin-left: 15px
          border-radius: 3px
          font-size: 14px
          background-color: black
          color: white
          &:focus, &:active
            outline: none
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
        height: calc(100vh - 170px)
        width: 100%
        display: block
        background-color: black
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
          cursor: pointer
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
              width: 80px
              height: 50px
              object-fit: cover
              display: block
      .photo
        max-width: 200px
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
            td.client
              text-transform: uppercase
            td
              text-transform: lowercase
              text-align: left
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
            margin-right: 5px
            margin-top: 0px
            &.accept
              background-color: $primary_color
            &.observed
              background-color: $highlight_color
            &.denied
              background-color: $require_color

@media screen and (max-width: 720px)
  .credit_detail_content
    .create_client_content
      table
        &.table_photos
          tbody
            tr
              td.photo
                img
                  width: 150px
                  height: 100px
              td.place_photo
                padding: 7px 15px
                i
                  margin-left: -5px
          .photo
            max-width: 100%
        thead
          display: none
        tbody
          tr
            flex-direction: column
            td
              padding: 1px 15px
              &:first-child
                padding-top: 15px
              &:last-child
                padding-bottom: 15px
              &.observation
                color: rgba($text_color, .77)
              &.client
                font-weight: 500
              &.date
                display: none

@media screen and (max-width: 500px)
  .credit_detail_content
    .create_client_content
      margin: 15px 0
</style>
 