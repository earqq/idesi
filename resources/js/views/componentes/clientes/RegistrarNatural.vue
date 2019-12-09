<template>
  <div class="row d-flex justify-content-center">
          <div class="col-md-2 image">
            <img src alt />
          </div>

          <div class="col-md-10">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="documento">Documento de Identidad</label>
                <input
                  type="text"
                  class="form-control letter-5"
                  v-model="form.documento"
                  @change="datosCliente()"
                  v-mask="{mask: '99999999', greedy: true}"
                />
              </div>

              <div class="form-group col-md-3">
                <label for="nombres">Nombres</label>
                <input type="text" class="form-control" v-model="form.nombres" placeholder />
              </div>

              <div class="form-group col-md-3">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" v-model="form.apellidos" placeholder />
              </div>

              <div class="form-group col-md-3">
                <label for="nacimiento">Fecha de Nacimiento</label>
                <date-pick v-model="form.nacimiento" :months="mesEs" :weekdays="diaEs"></date-pick>
              </div>
                <div class="form-group col-md-3">
                <label for="nacimiento">Codigo Cliente</label>
                <input type="text" class="form-control" v-model="form.codigo" placeholder />
              </div>
              <div class="form-group col-md-3">
                <label>Estado Civil</label>
                <select v-model="form.estado_civil" class="form-control">
                  <option value="0">SELECCIONE ...</option>
                  <option value="SOLTERO">SOLTERO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="CONVIVIENTE">CONVIVIENTE</option>
                  <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                  <option value="VIUDO">VIUDO</option>
                </select>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Ocupación</label>
                  <input type="text" v-model="form.ocupacion" class="form-control" />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Teléfono</label>
                  <input type="text" v-model="form.telefono" class="form-control" />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-model="form.celular"
                    class="form-control letter-5"
                    v-mask="{mask: '+51 999999999', greedy: true}"
                  />
                </div>
              </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Departamento</label>
                <select
                  class="form-control"
                  v-model="form.departamentos_id"
                  filterable
                  @change="filterProvince"
                  dusk="departamentos_id"
                >
                  <option value="0">SELECCIONE</option>
                  <option
                    v-for="option in all_departments"
                    :key="option.id"
                    :value="option.id"
                    :label="option.descripcion"
                  >></option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Provincia</label>
                <select
                  class="form-control text-uppercase"
                  v-model="form.provincias_id"
                  filterable
                  @change="filterDistrict"
                  dusk="provincias_id"
                >
                  <option value="0">SELECCIONE</option>
                  <option
                    v-for="option in provinces"
                    :key="option.id"
                    :value="option.id"
                    :label="option.descripcion"
                  >></option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Distrito</label>
                <select
                  class="form-control text-uppercase"
                  v-model="form.distritos_id"
                  filterable
                  dusk="distritos_id"
                >
                  <option value="0">SELECCIONE</option>
                  <option
                    v-for="option in districts"
                    :key="option.id"
                    :value="option.id"
                    :label="option.descripcion"
                  >></option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Dirección Declarado</label>
                <input type="text" v-model="form.direccion" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Dirección Reniec</label>
                <input type="text" v-model="form.direccion_registros" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Referencia de domicilio declarado</label>
                <input type="text" v-model="form.referencia" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tipo Domicilio</label>
                <input type="text" v-model="form.tipo_domicilio" class="form-control" />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Centro Laboral</label>
                <input type="text" v-model="form.centro_laboral" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group"> 
                <label>Dirección Centro Laboral</label>
                <input type="text" v-model="form.direccion_laboral" class="form-control" />
              </div>
            </div>

            </div>
          </div>

          <div class="col-md-2 offset-md-8 d-flex justify-content-end">
            <button class="btn btn-success w-100" @click.prevent="submit">Registrar Cliente</button>
          </div>
        </div>
</template>

<script>
import DatePick from 'vue-date-pick';
import "vue-date-pick/dist/vueDatePick.css";
import { serviceNumber } from "../../../mixins/functions";

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
mixins: [serviceNumber],
  components: { DatePick},
   props: ['tipo_persona'],
        
  data() {
    return {
      resource: "clientes",
      clientes: [],
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      districts: [],
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
      mesEs: mesConf,
      diaEs: diaConf
    };
  },
  async created() {
    
     await   this.$http.get(`/${this.resource}/datos/`).then(response => {
      this.all_departments = response.data.departments;
      this.all_provinces = response.data.provinces;
      this.all_districts = response.data.districts;
    });

    await this.initForm();
  },
  methods: {

    initForm() {
      this.form = {
        documento: "",
        nombres: "",
        apellidos: "",
        nacimiento: "",
        departamentos_id: "0",
        provincias_id: "0",
        distritos_id: "0",
        estado_civil: "0",
        ocupacion: "",
        telefono: "",
        celular: "",
        codigo: "",
        direccion: "",
        referencia: "",
        tipo_domicilio: "",
        centro_laboral: "",
        direccion_laboral: "",
        tipo_persona: this.tipo_persona,
        direccion_registros: "0",
      };
    },
    resetForm() {
      this.initForm();
    },
    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.documento
        })
        .then(function(response) {
          console.log(response.data);
          me.form.nombres = response.data["nombres"];
          me.form.apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          me.initForm();
        });
    },

    submit() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }

      this.$http
        .post(`/${this.resource}/nuevo/natural`, this.form)
        .then(response => {
          if (response.data.success) {
            this.resetForm();
            this.$toast.success(
              "El cliente fue creado",
              "Exitoso",
              this.notificationSystem.options.success
            );
          } else {
            // this.resetForm();
            this.$toast.error(
              "El cliente ya existe!",
              "Error",
              this.notificationSystem.options.error
            );
          }
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
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>

<style lang="scss" scoped>
.vdpWithInput {
  width: 100%;
}
.vdpWithInput > input {
  font-size: 16px;
  display: block;
  width: 100%;
  box-sizing: border-box;
  -webkit-appearance: none;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0.1em 0.3em;
  padding: 5px 40px 6px 15px;
  border-radius: 4px;
  background: white;
  border-width: 1px;
  border-style: solid;
  border-color: rgb(224, 224, 224);
  border-image: initial;
  outline: 0px;
}
</style>
