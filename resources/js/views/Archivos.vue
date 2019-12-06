<template>
  <div class="container-fluid file-loan">
      <div class=" row m-0 col-md-12">
          <div class="col-md-4 form-group">
              <label >Nombre del archivo</label>
              <input class="form-control" type="text" placeholder="Nombre de archivo"  v-model="fileName" required  />
          </div>
          <div class="col-md-4 form-group">
              <label >Archivo</label>
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" class="form-control"/>
          </div>
          <div class="col-md-4" style="    padding-top: 30px;">
              <button type="button" @click="submit" class="btn btn-success w-auto">Nuevo Archivo</button>
          </div>
      </div>
        
    

    <div class="row col-md-12 files" >

        <div class="file-type"  v-for="(archivo, index) in archivos" :key="index">

            <div class="type" v-if="archivo.tipo=='imagen'">
                <button class="btn btn-file" title="Delete" @click="prepareToDelete(archivo)" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> ELIMINAR</button>
                <a :href="'../storage/'+person.nombres+'_'+person.apellidos+'_'+person.id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension" target="_blank">
                    
                        <img  :src="'../storage/'+person.nombres+'_'+person.apellidos+'_'+person.id+'/prestamo_'+archivo.prestamos_id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension" :alt="archivo.nombre">
                        <p v-text="archivo.nombre+'.'+archivo.extension"></p>
                        <div class="mask">
                            <i class="fas fa-file-download"></i>
                        </div>
                </a>
             </div>

             <div class="type file-document" v-if="archivo.tipo=='documento'">
                 <button class="btn btn-file" title="Delete" @click="prepareToDelete(archivo)" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> ELIMINAR</button>
                 <a :href="'../storage/'+person.nombres+'_'+person.apellidos+'_'+person.id+'/prestamo_'+archivo.prestamos_id+'/'+archivo.tipo+'/'+archivo.nombre+'.'+archivo.extension" target="_blank">
                    
                 <p v-text="archivo.nombre+'.'+archivo.extension"></p>
                 <div class="mask">
                    <i class="fas fa-file-download"></i>
                </div>

                 </a>

             </div>

        </div>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Archivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancelDeleting()">Cerrar</button>
                    <button type="button" class="btn btn-primary w-auto" data-dismiss="modal" @click="deleteFile()">Eliminar</button>
                </div>
                </div>
            </div>
            </div> 
    </div>


  </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
export default {
  components: { InfiniteLoading },
  data() {
    return {
      resource: "clientes",
      clientes: [],
      page: 0,
      tipo: true,
      last_page: 1,
      form: {},
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
      fileName: "",
      attachment: "",
      deletingFile: {},

      notification: false,
      message: "",
      errors: {},

      person:{},
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
      },
    };
  },
    created() {

        this.listFile()
  },

  methods: {


    listFile(){
            this.$http
      .get(`/files/${this.$route.params.prestamo}` )
      .then(response => {
          this.person = response.data['datos']
          this.archivos = response.data['files']

      });
    },

    handleFileUpload() {
                this.attachment = document.getElementById('file').files[0];
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
        .get(`/files/delete/${this.deletingFile.id}/${this.deletingFile.prestamos_id}`)
        .then(response => {
          this.resetForm();
          this.listFile()
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
          this.resetForm()
          this.listFile()
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
    }
  },

};
</script>
