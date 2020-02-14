<template>
  <div class="documents_content">
    <div class="modal_content" v-if="flagModalUpload" >
      <div class="modal_wrapper">
        <div class="title"> 
          <h1> Cargar </h1>
          <i  @click="flagModalUpload = false" class="material-icons-outlined">close</i>
        </div>
        <div class="input_wrapper">
          <select v-model="fileName">
            <option value='seleccione'>Seleccione</option> 

            <option v-for="(list, index) in porSubir" :key="index"  :value="list.nombre">
              {{list.texto}}
            </option>         
          </select>
        </div>
        <div class="dropzone_content">
          <input style="display: none" id="file" type="file" ref="file" @change="onFileChange($event)" accept="application/pdf">
          <label class="dropzone" for="file" :class="{ready: fileInto}"  @dragover.prevent="dragover($event)"  @dragleave.prevent="dragleave($event)" @drop.prevent="dragFinish(-1,$event)">
              <div class="open_file"  v-if="!attachment.content">
                <div class="upload">
                  <i class="material-icons-outlined">upload</i>
                </div>
                <h1>
                  Arrastrar y soltar o <strong>carga desde la computadora</strong>
                </h1>
              </div>
              <div class="file_selected" v-else>
                <div class="upload">
                  <i class="material-icons-outlined">picture_as_pdf</i>
                </div>
                <h1>
                  <p>  {{ attachment.content ? attachment.content.name : ''}} {{validateSizeFile}}</p>
                  <small>{{(attachment.content.size / 1000).toFixed(2)}} Kb <b v-if="!validateSizeFile"> ( Archivo muy grande, Max: 8 Mb )</b> </small> 
                </h1>
              </div>
          </label>
        </div>

        <button v-if='fileName!="seleccione" && attachment.content' class="button_primary medium" type="button" @click="uploadFile">
          <span> CARGAR ARCHIVO </span>
        </button>
      </div>
    </div>

    <div class="files_containter">

      <div class="tab_inline slide_mobile"  >
        <div class="tab" :class="{selected: tab == 1}" @click="tab = 1; show_slide=false">
          <p>DOCUMENTOS</p>
        </div>
        <div class="tab" :class="{selected: tab == 2}" @click="tab = 2; show_slide=true">
          <p> CHECKLIST </p>
        </div>
      </div>

      <div class="files_grid">
        <a class="add_file" @click="flagModalUpload = true" v-if="$store.state.currentUser.nivel=='4' && prestamo.estado==1">
          <span>
            <i class="material-icons-outlined">add</i>
          </span>
          <p> NUEVO ARCHIVO  </p>
        </a>

       <div class="file_item">
          <div class="file_detail">
            <a class="" :href="'../storage/'+prestamo.cliente.documento+'_'+prestamo.id+'/general/documento/inscripcion_de_socio.pdf'" target="_blank">
                <i class="material-icons-outlined"> picture_as_pdf </i>
              <div class="file_info">
                <p> Solicitud de Admisión </p> 
                <small> 27 de enero de 2020 </small>              
              </div>
                  
            </a>
            
          </div>  
        </div>

        <div class="file_item"  @click="solicitudPdf()">
          <div class="file_detail">
            <a :href="'#'"
              >
              <i class="material-icons-outlined"> picture_as_pdf </i>
              <div class="file_info">
                <p> Solicitud de credito </p> 
                <small> 27 de enero de 2020 </small>            
              </div>
            </a>
          </div> 
        </div>
        <div class="file_item" v-if='listas[3].estado'  @click="cualitativaPDF()">
          <div class="file_detail">
            <a :href="'#'"
              >
              <i class="material-icons-outlined"> picture_as_pdf </i>
              <div class="file_info">
                <p> Evaluación cualitativa </p> 
                <small> 27 de enero de 2020 </small>            
              </div>
            </a>
          </div> 
        </div>
        <div class="file_item" v-if='listas[4].estado' @click="cuantitativaPDF()">
          <div class="file_detail">
            <a :href="'#'"
              >
              <i class="material-icons-outlined"> picture_as_pdf </i>
              <div class="file_info">
                <p> Evaluación cuantitativa </p> 
                <small> 27 de enero de 2020 </small>            
              </div>
            </a>
          </div> 
        </div>
        <div v-for="(archivo, index) in prestamo.archivos" :key="index">
        <div class="file_item"  v-if="archivo.nombre!='evaluacion_cuantitativa' && archivo.nombre!='evaluacion_cualitativa'">
          <div class="file_detail" v-if="archivo.tipo=='imagen' ">
            <a :href="'../storage/'+prestamo.cliente.documento+'_'+prestamo.id+'/prestamo_'+archivo.prestamo_id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension"
              target="_blank">
              <i class="material-icons-outlined"> collections </i>
              <div class="file_info">
                <p > {{archivo.nombre | noUnderscore }}</p>
                <small> 27 de enero de 2020 </small>            
              </div>
            </a>
          </div>
          <div class="file_detail" v-if="archivo.tipo=='documento' ">
            <a :href="'../storage/'+prestamo.cliente.documento+'_'+prestamo.id+'/prestamo_'+archivo.prestamo_id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension"
              target="_blank">
              <i class="material-icons-outlined"> picture_as_pdf </i>
              <div class="file_info">
                <p> {{archivo.nombre | noUnderscore }} </p>
                <small> 27 de enero de 2020 </small>            
              </div>
            </a>
          </div>
        </div>
        </div>
        <div v-if='prestamo.archivos.length<5'>
          <a class="spanner" v-for="i in 5" :key="i*1.5"  ></a>
        </div>
      </div>
      
      <aside class="checklist"  :class="{showing: show_slide}">
        <div class="checklist_wrapper no_scroll">
          <div class="tree">
            <li v-show='lista.type==0' v-for='(lista,index) in listas' :key='index '>
              <div class="state" :class="{complete: lista.estado}">
                <i class="material-icons-outlined"> check </i>
              </div>
              <a href="#">{{lista.texto}}</a>
            </li>
          </div>

          <div class="tree">
            <div class="title">Documentos de casa</div>
            <li v-show='lista.type==1' v-for='(lista,index) in listas' :key='index '>
              <div class="state" :class="{complete: lista.estado}">
                <i class="material-icons-outlined"> check </i>
              </div>
              <a href="#">{{lista.texto}}</a>
            </li>
          </div>

          <div class="tree">
            <div class="title">Documentos del negocio</div>
            <li v-show='lista.type==2' v-for='(lista,index) in listas' :key='index '>
              <div class="state" :class="{complete: lista.estado}">
                <i class="material-icons-outlined"> check </i>
              </div>
              <a href="#">{{lista.texto}}</a>
            </li>
            
          </div>

          <div class="tree">
            <div class="title">Colateral</div>
            <li v-show='lista.type==3' v-for='(lista,index) in listas' :key='index '>
              <div class="state" :class="{complete: lista.estado}">
                <i class="material-icons-outlined"> check </i>
              </div>
              <a href="#">{{lista.texto}}</a>
            </li>
          </div>
        </div>
        <a class="button_primary generate" @click="generarExpediente">
          <span>
            GENERAR EXPEDIENTE
          </span>
          <i class="material-icons-outlined">repeat</i>
        </a>
      </aside>
      
    </div>
    
  </div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
import LoaderFile from "./componentes/loader/listado-file.vue";
 import { toastOptions } from '../constants.js'
export default {
  mixins: [serviceNumber],
  components: {  LoaderFile},
  data() {
    return {
      show_slide: false,
      tab: 1,
      fileInto: false,
      flagModalUpload: false,
      resource: "clientes",
      clientes: [],
      page: 0,
      tipo: true,
      last_page: 1,
      form: {},
      check: 0,
      loaderFile:1,
      files: {},
      file: {},
      loading: false,
      formData: {},
      fileName: "seleccione",
      attachment: {
        content: null
      },
      deletingFile: {},
      subidos:[],
      notification: false,
      message: "",
      errors: {},
      prestamo: {
        id:0,
        cliente:{},
        archivos:[]
      },      
      listas: [
        {
          nombre:  "inscripcion_socio",
          texto: "Inscripcion de socio",
          estado: true,
          type:0
        },
        {
          nombre:  "solicitud_credito",
          texto: "Solicitud de crédito",
          estado: true,
          type:0
        },
        {
          nombre:  "reporte_de_central",
          texto: "Reporte de central de riesgo",
          estado: false,
          type:0
        },
        {
          nombre:  "evaluacion_cualitativa",
          texto: "Evaluación cualitativa",
          estado: false,
          type:0
        },
        {
          nombre:  "evaluacion_cuantitativa",
          texto: "Evaluación cuantitativa",
          estado: false,
          type:0
        },
        {
          nombre:  "copia_dni",
          texto: "Copia DNI",
          estado: false,
          type:0
        },
        {
          nombre:  "recibo_agua_casa",
          texto: "Recibo de agua casa",
          estado: false,
          type:1
        },
        {
          nombre:  "recibo_luz_casa",
          texto: "Recibo de luz casa",
          estado: false,
          type:1
        },
        {
          nombre:  "ubicacion",
          texto: "Ubicacion casa",
          estado: false,
          type:1
        },
        {
          nombre:  "titulo_casa",
          texto: "Título de propiedad casa" ,
          estado: false,
          type:1
        },
        {
          nombre:  "contrato_alquiler_casa",
          texto: "Contrato de alquiler casa",
          estado: false,
          type:1
        },
        {
          nombre:   "foto_casa",
          texto: "Fotos de casa",          
          estado: false,
          type:1
        },
        {
          nombre: "recibo_agua_negocio",
          texto: "Reporte de agua negocio",
          estado: false,
          type:2
        },
        {
          nombre:  "recibo_luz_negocio",
          texto: "Reporte de luz negocio",
          estado: false,
          type:2
        },
        {
          nombre:  "ubicacion_negocio",
          texto: "Ubicacion negocio",
          estado: false,
          type:2
        },
        {
          nombre: "contrato_alquiler_negocio",
          texto: "Contrato de alquiler negocio",
          estado: false,
          type:2
        },
        {
          nombre: "fotos_negocio",
          texto: "Fotos de negocio",
          estado: false,
          type:2
        },
        {
          nombre: "boleta_compra",
          texto: "Boletas de compra",
          estado: false,
          type:2
        },
        {
          nombre: "factura_compra",
          texto: "Facturas de compra",
          estado: false,
          type:2
        },
        {
          nombre: "boleta_venta",
          texto: "Boletas de venta",
          estado: false,
          type:2
        },       
        {
          nombre:   "factura_venta",
          texto: "Facturas de venta",
          estado: false,
          type:2
        },
        {
          nombre:  "ubicacion_colateral",
          texto: "Ubicacion colateral",
          estado: false,
          type:3
        },
        {
          nombre:  "contrato_alquiler_colateral",
          texto: "Contrato de alquiler colateral",
          estado: false,
          type:3
        },
        {
          nombre:  "fotos_negocio_colateral",
          texto: "Fotos de negocio colateral",
          estado: false,
          type:3
        }  
      ],
      porSubir: []
    };
  },
  created() {
    this.listFile();   
  },

  methods: {
    retornar() {
      this.backMixin_handleBack('/perfil/'+this.prestamo.documento);
    },
    listFile() {
      this.$http.get(`/prestamos/`+this.$route.params.prestamoID).then(response => {
        this.prestamo = response.data        

        this.loaderFile=0
        this.porSubir=[]
        let self=this
        this.listas.map(item=>{
          var a = self.prestamo.archivos.find(f=>f.nombre == item.nombre)
          if(a){
            item.estado= true
          }else{
            if(item.nombre!='inscripcion_socio' && 
              item.nombre!='evaluacion_cualitativa' &&
              item.nombre!='evaluacion_cuantitativa' &&
              item.nombre!='solicitud_credito')
            self.porSubir.push({
              nombre: item.nombre,
              texto: item.texto
            })
          }
          // console.log(a);
        })

      });
    },
    dragFinish (i, e) {
      this.attachment.content = e.dataTransfer.files[0]
      this.fileInto = false
    },
    dragover (e) {
      this.fileInto = true
    },
    dragleave (e) {
      this.fileInto = false
    },
    onFileChange (e) {
      this.attachment.content = event.target.files[0];
    },
    sendPdf () {
      if (this.validateDoc) this.uploadPdf()
    },
    prepareToDelete(file) {
      this.deletingFile = file;
    },
    cancelDeleting() {
      this.deletingFile = {};
    },
    verificar(ad){
      var a = 0
      this.prestamo.archivos.map(item=>{
          
          if(item.nombre==ad){
            a =1
          }
        })
      if(a==1){
          return true
      }
     
    },
    deleteFile() {
      this.$http
        .get(
          `/files/delete/${this.deletingFile.id}/${this.deletingFile.prestamos_id}`
        )
        .then(response => {
          this.resetForm();
          this.listFile();
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.showNotification(error.response.data.message, false);
        });
    },
    resetForm() {
      this.formData = {};
      this.fileName = "seleccione";
      this.attachment.content = "";
      // this.f
    },
    anyError() {
      return Object.keys(this.errors).length > 0;
    },
    clearErrors() {
      this.errors = {};
    },
    uploadFile() {
      this.loading=true
      this.formData = new FormData();
      this.formData.append("name", this.fileName);
      this.formData.append("prestamo_id", this.$route.params.prestamoID);
      this.formData.append("file", this.attachment.content);

      this.$http
        .post(`/prestamos/archivos`, this.formData, {
          headers: { "Content-Type": "multipart/form-data" }
        })
        .then(response => {
          this.loading=false
          this.listFile();
          $('#file').val('')
          this.flagModalUpload = false
          this.$toast.success(
            "El archivo fue subido",
            "Exitoso",
            toastOptions.success
          )
          this.resetForm();

        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.showNotification(error.response.data.message, false);
        });
    },
    generarExpediente(){
                window.open('/pdf/prestamo/expediente/'+this.$route.params.prestamoID,'_blank'); 
    },
    solicitudPdf(){
              window.open('/pdf/prestamo/'+this.$route.params.prestamoID,'_blank'); 
    },
    cualitativaPDF(){
              window.open('/pdf/evaluacion/cualitativa/'+this.$route.params.prestamoID,'_blank'); 
    },
    cuantitativaPDF(){
              window.open('/pdf/evaluacion/cuantitativa/'+this.$route.params.prestamoID,'_blank'); 
    }
  },
  computed: {
    validateSizeFile () {
      return this.attachment.content.size / 1000 <= 8000
    }
  },
  filters: {
    noUnderscore (text) {
      return text.split('_').join(' ')
    }
  }
}
</script>
<style lang="sass" scoped>
@import "../../sass/variables"
@import "../../sass/buttons"
.documents_content
  .modal_content
    .modal_wrapper
      .dropzone_content
        width: 100%
        box-sizing: border-box
        .dropzone
          width: 100%
          height: 220px
          background-color: white
          border: 1px dashed rgba(0, 0, 0, 0.2)
          display: flex
          justify-content: center
          align-items: center
          cursor: pointer
          transition: all ease-in-out .2s
          padding: 10px
          box-sizing: border-box
          margin-top: 15px
          margin-bottom: 15px
          border-radius: 3px
          .open_file, .file_selected
            display: flex
            align-items: center
            justify-content: center
            flex-direction: column
            background-color: rgba($primary_color, .03)
            width: 100%
            height: 100%
            border-radius: 3px
          .file_selected
            small
              font-size: 11px
              font-weight: 400
              margin-top: 5px
              display: block
              b
                color: red
                font-weight: 400
          .upload
            background-color: rgba($primary_color,.2)
            width: 35px
            min-width: 35px
            height: 35px
            border-radius: 50%
            display: flex
            justify-content: center
            align-items: center
            margin-right: 15px
            i
              color: $primary_color
              font-size: 20px
          h1
            font-size: 12px
            font-weight: 500
            margin: 0
            margin-top: 10px
            text-align: center
            p
              line-height: 1.3
              overflow: hidden
              text-overflow: ellipsis
              display: -webkit-box
              -webkit-line-clamp: 1
              -webkit-box-orient: vertical
              margin-bottom: 3px
            strong
              color: $primary_color
              font-weight: 500
          &.ready, &:hover
            border: 1px dashed rgba(0, 0, 0, 0.3)
            .open_file, .file_selected
              background-color: rgba($primary_color, .1)

  .files_containter
    display: grid
    grid-template-columns: 1fr 320px
    .slide_mobile
      &.tab_inline
        background-color: white
        height: 40px
        display: flex
        box-shadow: $shadow
        position: sticky
        top: 55px
        z-index: 8
        border-bottom: 1px solid $line_color
        display: none
        .tab
          width: 100px
          display: flex
          align-items: center
          justify-content: center
          height: 100%
          cursor: pointer
          border-bottom: 2px solid transparent
          user-select: none
          margin-left: 20px
          &.selected
            border-bottom: 2px solid $primary_color
            p
              color: $primary_color
          p
            margin: 0
            font-size: 12px
            font-weight: 700
            margin-left: 10px
            color: rgba($text_color, .5)
            margin-bottom: -1px
    .files_grid
      display: grid
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr) )
      grid-gap: 10px
      padding: 20px
      box-sizing: border-box
      grid-auto-rows: max-content
      .file_item
        border-radius: 4px
        transition: all ease-in-out .3s
        display: flex
        justify-content: center
        align-items: center
        flex-direction: column
        cursor: pointer
        height: 200px
        border: $primary_color
        background-color: white
        box-shadow: $shadow
        user-select: none
        text-decoration: none
        border: 1px solid $line_color
        &:hover
          box-shadow: $shadow_hover
        .file_detail
          width: 100%
          height: 100%
          a
            display: flex
            flex-direction: column
            height: 100%
            text-decoration: none
            i
              flex: 1
              display: flex
              justify-content: center
              align-items: center
              font-size: 30px
              color: $primary_color
            .file_info
              border-top: 1px solid $line_color
              padding: 7px 20px
              p
                font-size: 12px
                font-weight: 600
                margin: 0
                color: $text_color
                text-transform: capitalize
                overflow: hidden
                text-overflow: ellipsis
                display: -webkit-box
                -webkit-line-clamp: 1
                -webkit-box-orient: vertical
                text-align: left
              small
                display: block
                font-size: 11px
                color: $text_color
                margin-top: -2px
      .add_file
        border-radius: 4px
        transition: all ease-in-out .3s
        display: flex
        justify-content: center
        align-items: center
        flex-direction: column
        cursor: pointer
        height: 200px
        border: $primary_color
        background-color: white
        box-shadow: $shadow
        user-select: none
        text-decoration: none
        border: 1px solid $line_color
        &:hover
          box-shadow: $shadow_hover
          span
            box-shadow: 0px 4px 10px 0px rgba($primary_color, 0.45)
            &:before
              transform: scale(1.1)
              opacity: 1
        p
          font-weight: 700
          font-size: 12px
          margin: 0
          margin-top: 10px
          color: $primary_color
        span
          width: 40px
          height: 40px
          border-radius: 50%
          background-color: $primary_color
          display: flex
          justify-content: center
          align-items: center
          position: relative
          transition: all cubic-bezier(0.79, 0.03, 0.18, 1.03) 0.3s
          box-shadow: 0px 4px 10px 0px rgba($primary_color, 0.35)
          &:before
            content: ''
            position: absolute
            left: 0
            top: 0
            width: 100%
            height: 100%
            background-color: rgba(white, .2 )
            border-radius: 50%
            transform: scale(0.2)
            transition: all cubic-bezier(0.79, 0.03, 0.18, 1.03) 0.3s
            opacity: 0
          i
            color: white
            position: relative
    aside.checklist
      background-color: white
      box-shadow: $shadow
      border-left: 1px solid $line_color
      height: calc(100vh - 55px)
      display: flex
      flex-direction: column
      position: sticky
      top: 55px
      .generate
        border-radius: 0
        height: 40px
        i
          font-size: 20px
      .checklist_wrapper
        box-sizing: border-box
        flex: 1
        height: calc(100vh - 55px)
        overflow: auto
        .tree
          .title
            border-top: 1px solid $line_color
            border-bottom: 1px solid $line_color
            font-size: 11px
            font-weight: 600
            color: rgba($text_color, .4)
            padding: 2px 20px
            margin-bottom: 10px
          li
            list-style: none
            display: flex
            align-items: center
            height: 30px
            padding: 0 20px
            &:first-child
              margin-top: 10px
            &:last-child
              margin-bottom: 10px
            a
              color: $text_color
              font-size: 12px
              margin-left: 10px
              text-decoration: none
              cursor: inherit
            .state
              width: 22px
              height: 22px
              border-radius: 50%
              border: 1px solid rgba($text_color, .25)
              display: flex
              justify-content: center
              align-items: center
              &.complete
                background-color: $primary_color
                border: 1px solid $primary_color
                color: white
                i
                  display: block
                & + a
                  font-weight: 500
              i
                font-size: 13px
                display: none

@media screen and (max-width: 720px)
  .documents_content
    .files_containter
      grid-template-columns: 1fr 250px

@media screen and (max-width: 500px)
  .documents_content
    .files_containter
      grid-template-columns: 1fr
      .slide_mobile
        &.tab_inline
          display: flex
          .tab
            flex: 1
            flex-basis: 0
            margin-left: 0
      .files_grid
        padding: 15px
        .file_item
          height: auto
          .file_detail 
            a
              flex-direction: row
              i
                font-size: 24px
                flex: inherit
                width: 50px
              .file_info
                border-top: none
                flex: 1
                padding: 15px 20px
                padding-left: 0px
        .add_file
          width: 50px
          height: 50px
          position: fixed
          bottom: 15px
          right: 15px
          border-radius: 3px
          overflow: hidden
          p
            display: none
          span
            width: 100%
            height: 100%
            border-radius: 0
            &:before
              display: none
      aside.checklist
        width: 100%
        position: fixed
        top: 95px
        z-index: 5
        right: -100%
        transition: all ease-in-out .3s
        height: calc(100vh - 95px)
        &.showing
          right: 0
</style>