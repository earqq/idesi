<template>
  <div class="documents_content">
    
    <div class="date-file" v-show="false">
      <div class="col-md-12 form-group">
        <label>Seleccione Formato</label>
        <select class="form-control" v-model="fileName">
          <option value="inscripcion_de_socio" v-if="!subidos.inscripcion_socio">Inscripcion de socio</option>
          <option value="solicitud_credito" v-if="!subidos.solicitud_credito" >Solicitud de credito</option>
          <option value="reporte_de_central" v-if="!subidos.reporte_de_central">Reporte de central de riesgo</option>
          <!-- <option value="evaluacion_cualitativa" v-if="!subidos.evaluacion_cualitativa" >Evaluacion cualitativa</option>
          <option value="evaluacion_cuantitativa" v-if="!subidos.evaluacion_cuantitativa">Evaluacion de cuantitativa</option> -->
          <option value="copia_dni"  v-if="!subidos.copia_dni" >Copias DNI</option>
          <option value="recibo_agua_casa" v-if="!subidos.recibo_agua_casa">Recibo de agua de casa</option>
          <option  value="recibo_luz_casa" v-if="!subidos.recibo_luz_casa">Recibo de luz de casa</option> 
          <option value="titulo_casa">Titulo de propiedad de casa</option>
          <option value="contrato_alquiler">Contrato de alquiler de casa</option>
          <option value="foto_casa">Fotos de casa</option>
          <option value="documento_negocio">Documentos del negocio</option>
          <option value="recibo_agua_negocio">Recibo de agua del negocio</option>
          <option value="recibo_luz_negocio">Recibo de luz del negocio</option>
          <option value="contrato_alquiler">Contrato de alquiler del negocio</option>
          <option value="boleta_compras">Boleta de compras del negocio</option>
          <option value="boleta_ventas">Boleta de ventas del negocio</option>
          <option value="factura_compras">Factura de compras del negocio</option>
          <option value="factura_ventas">Factura de ventas del negocio</option>
          <option value="foto_negocio">Fotos del negocio</option>
        </select>
      </div>
      <div class="col-md-12 form-group">
        <label>Archivo</label>
        <input
          type="file"
          id="file"
          ref="file"
          v-on:change="handleFileUpload()"
          class="form-control"
        />
      </div>
      <div class="col-md-12" style="    padding-top: 30px;">
        <button type="button" @click="submit" class="btn btn-crecer w-100">Nuevo Archivo</button>
      </div>

      <div class="col-md-12" style="    padding-top: 30px;">
        <button type="button" @click="cargarPdf()" class="btn btn-crecer w-100">Adjuntar Archivos</button>
      </div>

      <div class="col-md-3"></div>
    </div>

    <div class="files_containter">
      <div class="files_grid">
        <a class="add_file" >
          <span>
            <i class="material-icons-outlined">add</i>
          </span>
          <p> NUEVO ARCHIVO  </p>
        </a>
        <div class="file_item" v-for="(archivo, index) in archivos" :key="index">
          <div class="file_detail" v-if="archivo.tipo=='imagen'">
            <a :href="'../storage/'+person.documento+'_'+person.id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension"
              target="_blank">
              <i class="material-icons-outlined"> collections </i>
              <div class="file_info">
                <p v-text="archivo.nombre+'.'+archivo.extension"></p>
                <small> 27 de enero de 2020 </small>            
              </div>
            </a>
          </div>
          <div class="file_detail" v-if="archivo.tipo=='documento' && archivo.nombre!='evaluacion_cualitativa' && archivo.nombre!='evaluacion_cuantitativa' ">
            <a :href="'../storage/'+person.documento+'_'+person.id+'/prestamo_'+archivo.prestamos_id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension"
              target="_blank">
              <i class="material-icons-outlined"> picture_as_pdf </i>
              <div class="file_info">
                <p v-text="archivo.nombre+'.'+archivo.extension"></p>
                <small> 27 de enero de 2020 </small>            
              </div>
            </a>
          </div>
        </div>
        <a v-show="archivos.length || 0 < 5" class="spanner" v-for="i in 5" :key="i*1.5"  ></a>
      </div>
      <aside class="checklist">
        <div class="list-file scroll-style">
          <loader-file v-if="loaderFile"></loader-file>
          <ol class="tree-structure" v-else>
            <li  :class="{ subido: subidos.inscripcion_socio }">
              <span class="num">1</span>
              <a href="#">Inscripcion de socio</a>
              <i class="fas fa-check-circle" v-if="subidos.inscripcion_socio"></i>
            </li>
            <li :class="{ subido: subidos.solicitud_credito }">
              <span class="num">2</span>
              <a href="#">Solicitud de credito</a>
              <i class="fas fa-check-circle" v-if="subidos.solicitud_credito"></i>
            </li>
            <li :class="{ subido: subidos.reporte_de_central }" >
              <span class="num">3</span>
              <a href="#">Reporte de central de riesgo</a>
              <i class="fas fa-check-circle" v-if="subidos.reporte_de_central"></i>
            </li>
            <li :class="{ subido: subidos.evaluacion_cualitativa }" >
              <span class="num">4</span>
              <a href="#">Evaluacion cualitativa</a>
              <i class="fas fa-check-circle" v-if="subidos.evaluacion_cualitativa"></i> 
            </li>
            <li :class="{ subido: subidos.evaluacion_cuantitativa }">
              <span class="num">5</span>
              <a href="#">Evaluacion de cuantitativa</a>
              <i class="fas fa-check-circle" v-if="subidos.evaluacion_cuantitativa"></i>
            </li>
            <li :class="{ subido: subidos.copia_dni}">
              <span class="num">6</span>
              <a href="#">Copia DNI</a>
              <i class="fas fa-check-circle" v-if="subidos.copia_dni"></i>
            </li>

            <li>
              <span class="num num-tree">7</span>
              <a href="#">Documentos de casa</a>
              <ol>
                <li :class="{ subido: subidos.recibo_agua_casa}">
                  <span class="num">7.1</span>
                  <a href="#">Recibo de agua </a>
                <i class="fas fa-check-circle" v-if="subidos.recibo_agua_casa"></i>
                </li>
                <li :class="{ subido: subidos.recibo_luz_casa}">
                  <span class="num">7.1</span>
                  <a href="#">Recibo de luz</a>
                <i class="fas fa-check-circle" v-if="subidos.recibo_luz_casa"></i>
                </li>
                <li>
                  <span class="num">7.2</span>
                  <a href="#">Ubicacion</a>
                </li>
                <li>
                  <span class="num">7.3</span>
                  <a href="#">Titulo de propiedad</a>
                </li>
                <li>
                  <span class="num">7.4</span>
                  <a href="#">Contrato de alquiler</a>
                </li>
                <li>
                  <span class="num">7.5</span>
                  <a href="#">Fotos de casa</a>
                </li>
              </ol>
            </li>

            <li>
              <span class="num num-tree">8</span>
              <a href="#">Documentos del negocio</a>
              <ol>
                <li>
                  <span class="num">8.1</span>
                  <a href="#">Recibo de agua y/o luz</a>
                </li>
                <li>
                  <span class="num">8.2</span>
                  <a href="#">Ubicacion</a>
                </li>
                <li>
                  <span class="num">8.3</span>
                  <a href="#">Contrato de alquiler</a>
                </li>
                <li>
                  <span class="num">8.4</span>
                  <a href="#">Fotos de negocio</a>
                </li>
                <li>
                  <span class="num">8.5</span>
                  <a href="#">Boletas/Facturas de compras</a>
                </li>
                <li>
                  <span class="num">8.6</span>
                  <a href="#">Boletas/Facturas de ventas</a>
                </li>
              </ol>
            </li>

            <li>
              <span class="num num-tree">8</span>
              <a href="#">Colateral</a>
              <ol>
                <li>
                  <span class="num">8.1</span>
                  <a href="#"></a>
                </li>
                <li>
                  <span class="num">8.2</span>
                  <a href="#">Ubicacion</a>
                </li>
                <li>
                  <span class="num">8.3</span>
                  <a href="#">Contrato de alquiler</a>
                </li>
                <li>
                  <span class="num">8.4</span>
                  <a href="#">Fotos de negocio</a>
                </li>
              </ol>
            </li>
          </ol>
        </div>
      </aside>
    </div>
    
    <div class="gm-grid-container-file" v-show="false" >

      <div class="new-file">

        <div class="return" @click="retornar()">
          <i class="fas fa-chevron-left back"></i>
          <p>Clientes</p>
          <i class="fas fa-users icon-users"></i>
        </div>

      </div>
      <div class="container-fluid file-loan p-0 scroll-style">
        <!-- <div class="col-md-12 header-file">

        </div> -->
        <div class="row col-md-12 files">

          <div class="file-type " @click="cargarPdf()">
            <div class="type file-document" >          
              <p>solicitud_credito.pdf</p> 
                <div class="mask">
                   <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M17.656 4c-1.336 0-2.59.52-3.535 1.465L5.465 14.12A4.964 4.964 0 0 0 4 17.656V57c0 1.652 1.348 3 3 3h40c1.652 0 3-1.348 3-3V46h8c1.102 0 2-.898 2-2V24c0-1.102-.898-2-2-2h-8V7c0-1.652-1.348-3-3-3zM18 6h29c.55 0 1 .45 1 1v15H16c-1.102 0-2 .898-2 2v20c0 1.102.898 2 2 2h32v11c0 .55-.45 1-1 1H7c-.55 0-1-.45-1-1V18h9c1.652 0 3-1.348 3-3zm-2 .5V15c0 .55-.45 1-1 1H6.5c.11-.164.234-.32.379-.465l8.656-8.656c.145-.145.3-.27.465-.379zM16 24h42v20H16zm9 4a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3c1.652 0 3-1.348 3-3v-2c0-1.652-1.348-3-3-3zm10 0a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3c2.207 0 4-1.793 4-4v-4c0-2.207-1.793-4-4-4zm10 0a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3a1 1 0 1 0 0-2h-3v-4h4a1 1 0 1 0 0-2zm-19 2h3c.55 0 1 .45 1 1v2c0 .55-.45 1-1 1h-3zm10 0h2c1.102 0 2 .898 2 2v4c0 1.102-.898 2-2 2h-2zM9 52a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1z"></path></svg>
                </div>
            </div>
          </div>
           <div class="file-type " @click="cualitativaPdf()" v-if="person.cualitativa=='1'">
            <div class="type file-document" >          
              <p>evaluacion_cualitativa.pdf</p> 
                <div class="mask">
                   <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M17.656 4c-1.336 0-2.59.52-3.535 1.465L5.465 14.12A4.964 4.964 0 0 0 4 17.656V57c0 1.652 1.348 3 3 3h40c1.652 0 3-1.348 3-3V46h8c1.102 0 2-.898 2-2V24c0-1.102-.898-2-2-2h-8V7c0-1.652-1.348-3-3-3zM18 6h29c.55 0 1 .45 1 1v15H16c-1.102 0-2 .898-2 2v20c0 1.102.898 2 2 2h32v11c0 .55-.45 1-1 1H7c-.55 0-1-.45-1-1V18h9c1.652 0 3-1.348 3-3zm-2 .5V15c0 .55-.45 1-1 1H6.5c.11-.164.234-.32.379-.465l8.656-8.656c.145-.145.3-.27.465-.379zM16 24h42v20H16zm9 4a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3c1.652 0 3-1.348 3-3v-2c0-1.652-1.348-3-3-3zm10 0a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3c2.207 0 4-1.793 4-4v-4c0-2.207-1.793-4-4-4zm10 0a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3a1 1 0 1 0 0-2h-3v-4h4a1 1 0 1 0 0-2zm-19 2h3c.55 0 1 .45 1 1v2c0 .55-.45 1-1 1h-3zm10 0h2c1.102 0 2 .898 2 2v4c0 1.102-.898 2-2 2h-2zM9 52a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1z"></path></svg>
                </div>
            </div>
          </div>
           <div class="file-type " @click="cuantitativaPdf()" v-if="person.cuantitativa=='1'">
            <div class="type file-document" >          
              <p>evaluacion_cuantitativa.pdf</p> 
                <div class="mask">
                   <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false"><path d="M17.656 4c-1.336 0-2.59.52-3.535 1.465L5.465 14.12A4.964 4.964 0 0 0 4 17.656V57c0 1.652 1.348 3 3 3h40c1.652 0 3-1.348 3-3V46h8c1.102 0 2-.898 2-2V24c0-1.102-.898-2-2-2h-8V7c0-1.652-1.348-3-3-3zM18 6h29c.55 0 1 .45 1 1v15H16c-1.102 0-2 .898-2 2v20c0 1.102.898 2 2 2h32v11c0 .55-.45 1-1 1H7c-.55 0-1-.45-1-1V18h9c1.652 0 3-1.348 3-3zm-2 .5V15c0 .55-.45 1-1 1H6.5c.11-.164.234-.32.379-.465l8.656-8.656c.145-.145.3-.27.465-.379zM16 24h42v20H16zm9 4a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3c1.652 0 3-1.348 3-3v-2c0-1.652-1.348-3-3-3zm10 0a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h3c2.207 0 4-1.793 4-4v-4c0-2.207-1.793-4-4-4zm10 0a1 1 0 0 0-1 1v10a1 1 0 1 0 2 0v-3h3a1 1 0 1 0 0-2h-3v-4h4a1 1 0 1 0 0-2zm-19 2h3c.55 0 1 .45 1 1v2c0 .55-.45 1-1 1h-3zm10 0h2c1.102 0 2 .898 2 2v4c0 1.102-.898 2-2 2h-2zM9 52a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1zm5 0a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1z"></path></svg>
                </div>
            </div>
          </div>


         

          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Eliminar Archivo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                    @click="cancelDeleting()"
                  >Cerrar</button>
                  <button
                    type="button"
                    class="btn btn-primary w-auto"
                    data-dismiss="modal"
                    @click="deleteFile()"
                  >Eliminar</button>
                </div>
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
import LoaderFile from "./componentes/loader/listado-file.vue";
export default {
  mixins: [serviceNumber],
  components: {  LoaderFile},
  data() {
    return {
      resource: "clientes",
      clientes: [],
      page: 0,
      tipo: true,
      last_page: 1,
      form: {},
      check: 0,
      loaderFile:1,
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

      /***
       * OTROS
       */

      files: {},
      file: {},
      loading: false,

      formData: {},
      fileName: "0",
      attachment: "",
      deletingFile: {},
      subidos:[],
      notification: false,
      message: "",
      errors: {},

      person: {},
      archivos: [],
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
  created() {
    this.listFile();
  },

  methods: {
    retornar() {
      this.backMixin_handleBack('/perfil/'+this.person.documento);
    },
    listFile() {
      this.$http.get(`/files/${this.$route.params.prestamo}`).then(response => {
        this.person = response.data["datos"];
        this.archivos = response.data["files"];
        this.subidos = response.data["subidos"];
        this.loaderFile=0
        console.log(this.person.cuantitativa)
      });
    },

    handleFileUpload() {
      this.attachment = document.getElementById("file").files[0];
      console.log(this.attachment);
    },

    prepareToDelete(file) {
      this.deletingFile = file;
    },

    cancelDeleting() {
      this.deletingFile = {};
    },

    deleteFile() {
      this.$http
        .get(
          `/files/delete/${this.deletingFile.id}/${this.deletingFile.prestamos_id}`
        )
        .then(response => {
          this.resetForm();
          this.listFile();
          this.$toast.error(
            ".",
            "El archivo fue eliminado",
            this.notificationSystem.options.error
          );
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.showNotification(error.response.data.message, false);
        });
    },

    resetForm() {
      this.formData = {};
      this.fileName = "";
      this.attachment = "";
      this.f
    },

    anyError() {
      return Object.keys(this.errors).length > 0;
    },

    clearErrors() {
      this.errors = {};
    },
    submit() {
      this.formData = new FormData();
      this.formData.append("name", this.fileName);
      this.formData.append("prestamo_id", this.$route.params.prestamo);
      this.formData.append("file", this.attachment);

      this.$http
        .post(`/files/add`, this.formData, {
          headers: { "Content-Type": "multipart/form-data" }
        })
        .then(response => {
          this.resetForm();
          this.listFile();
          $('#file').val('')
          this.$toast.success(
            ".",
            "Archivo Registrado",
            this.notificationSystem.options.success
          );
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.showNotification(error.response.data.message, false);
        });
    },

    cargarPdf(){
                window.open('/clientes/solicitudPdf/'+this.$route.params.prestamo,'_blank'); 
      },
      cualitativaPdf(){
                window.open('/evaluacion/cualitativaPdf/'+this.$route.params.prestamo,'_blank'); 
      },
      cuantitativaPdf(){
               window.open('/evaluacion/cuantitativaPdf/'+this.$route.params.prestamo,'_blank'); 
      }
  }
};
</script>
<style lang="sass" scoped>
@import "../../sass/variables"
@import "../../sass/buttons"
.documents_content
  .files_containter
    display: grid
    grid-template-columns: 1fr 300px
    .files_grid
      display: grid
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr) )
      grid-gap: 15px
      box-sizing: border-box
      padding: 20px
      box-sizing: border-box
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
        .file_detail
          width: 100%
          height: 100%
          .file_info
            p
              font-size: 13px
              font-weight: 600
              margin: 0
              color: $text_color
            small
              font-size: 11pxv
              color: $text_color
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
</style>