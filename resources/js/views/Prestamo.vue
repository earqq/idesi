<template>
  <div class="container-general">
     <header>
        <span @click="retornar()">
          <i class="fas fa-angle-left"></i>
        </span>
        <h1>Nuevo prestamo</h1>
      </header>
    <div class="row col-md-12 m-0 loan">
      <tabs
        :tabs="tabs"
        :currentTab="currentTab"
        :wrapper-class="'default-tabs'"
        :tab-class="'default-tabs__item'"
        :tab-active-class="'default-tabs__item_active'"
        :line-class="'default-tabs__active-line'"
        @onClick="handleClick"
      />
      <div class="content">
        <div class="loan-cliente" v-if="currentTab === 'cliente'">
          <div class="row">
            <div class="col-md-12 d-flex titulo-prestamo-menu">
              <p>Titular</p>
            </div>
            <div class="col-md-3">
              <div class="form-group">
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
                  class="form-control input-mask"
                  v-mask="{mask: '+51 999999999', greedy: true}"
                />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" v-model="form.direccion" class="form-control" />
              </div>
            </div>

            <div class="col-md-2">
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
            <div class="col-md-2">
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
            <div class="col-md-2">
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
                <label>Referencia</label>
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
                <label>Dirección</label>
                <input type="text" v-model="form.direccion_laboral" class="form-control" />
              </div>
            </div>

            <div class="col-md-12 d-flex titulo-prestamo-menu">
              <p>Conyugue o Conviviente</p>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Documento de Identidad</label>
                <input
                  type="text"
                  v-model="form.documento_conyugue"
                  class="form-control input-mask"
                  v-mask="{mask: '99999999', greedy: true}"
                  @change="datosCliente()"
                />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Nombres</label>
                <input type="text" v-model="form.nombres_conyugue" class="form-control" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Apellidos</label>
                <input type="text" v-model="form.apellidos_conyugue" class="form-control" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <date-pick
                                 v-model="form.nacimiento_conyugue" 
                                 :months="mesEs"
                                 :weekdays="diaEs"
                                ></date-pick>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Estado Civil</label>
                <select v-model="form.estado_civil_conyugue" class="form-control">
                  <option value="0">SELECCIONE ...</option>
                  <option value="SOLTERO">SOLTERO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="CONVIVIENTE">CONVIVIENTE</option>
                  <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                  <option value="VIUDO">VIUDO</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Ocupación</label>
                <input type="text" v-model="form.ocupacion_conyugue" class="form-control" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Telefono</label>
                <input type="text" v-model="form.telefono_conyugue" class="form-control" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Celular</label>
                <input
                  type="text"
                  v-model="form.celular_conyugue"
                  class="form-control input-mask"
                  v-mask="{mask: '+51 999999999', greedy: true}"
                />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Centro Laboral</label>
                <input type="text" v-model="form.centro_laboral_conyugue" class="form-control" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" v-model="form.direccion_laboral_conyugue" class="form-control" />
              </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end mt-3 mb-4">
              <button class="btn btn-success btn-sm" @click.prevent="handleClick('aval')">Continuar</button>
            </div>
          </div>
        </div>
        <div class="loan-aval" v-if="currentTab === 'aval'">
          <div v-for="(row, index) in form.avals" :key="index" class="row">
            <div class="col-md-12 d-flex titulo-prestamo-menu">
              <p>Aval</p>
              <i class="fas fa-trash" @click.prevent="clickRemoveAval(index)" v-if="index!=0"></i>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Documento de Identidad</label>
                <input
                  type="text"
                  v-model="row.documento"
                  class="form-control input-mask"
                  v-mask="{mask: '99999999', greedy: true}"
                  @change="datosAval(index)"
                />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nombres</label>
                <input type="text" v-model="row.nombres" class="form-control" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Apellidos</label>
                <input type="text" v-model="row.apellidos" class="form-control" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Fecha de Nacimiento</label>
                  <date-pick
                                 v-model="row.nacimiento" 
                                 :months="mesEs"
                                 :weekdays="diaEs"
                                ></date-pick>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Estado Civil</label>
                <select  v-model="row.estado_civil"  class="form-control">
                  <option value="0">SELECCIONE ...</option>
                  <option value="SOLTERO">SOLTERO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="CONVIVIENTE">CONVIVIENTE</option>
                  <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                  <option value="VIUDO">VIUDO</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Ocupación</label>
                <input type="text" v-model="row.ocupacion" class="form-control" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Teléfono</label>
                <input type="text" v-model="row.telefono" class="form-control" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Celular</label>
                <input type="text" v-model="row.celular" class="form-control" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" v-model="row.direccion" class="form-control" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Distrito</label>
                <input type="text" v-model="row.distrito" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Centro Laboral</label>
                <input type="text" v-model="row.centro_laboral" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" v-model="row.direccion_laboral" class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <button
                type="button"
                @click.prevent="clickAddAval"
                class="btn btn-outline-dark more-option"
              >
                <i class="fas fa-plus"></i> Agregar Aval
              </button>
            </div>
            <div class="col-md-12 d-flex justify-content-end mb-4">
              <button class="btn btn-success btn-sm" @click.prevent="handleClick('garantia')">Continuar</button>
            </div>
          </div>
        </div>

        <div class="loan-garantia" v-if="currentTab === 'garantia'">
          <div v-for="(row, index) in form.garantias" :key="index" class="row">
            <div class="col-md-12 d-flex titulo-prestamo-menu">
              <p>Garantía</p>
              <i class="fas fa-trash" @click.prevent="clickRemoveGarantia(index)" v-if="index!=0"></i>
            </div>

            <div class="col-md-12">
              <label>Bien en Garantía</label>
              <input type="text" v-model="row.bien_garantia" class="form-control" />
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Inscripción</label>
                <input type="text" v-model="row.inscripcion" class="form-control" />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Declaración Jurada</label>
                <input type="text" v-model="row.declaracion_jurada" class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <button
                type="button"
                @click.prevent="clickAddGarantia"
                class="btn btn-outline-dark more-option"
              >
                <i class="fas fa-plus"></i> Agregar Garantia
              </button>
            </div>
            <div class="col-md-12 d-flex justify-content-end mb-4">
              <button class="btn btn-success btn-sm" @click.prevent="handleClick('propuesta')">Continuar</button>
            </div>
          </div>
        </div>
        <div class="loan-propuesta" v-if="currentTab === 'propuesta'">
          <div class="row">
            <div class="col-md-12 d-flex titulo-prestamo-menu">
              <p>Propuesta</p>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Producto</label>
                <input type="text" v-model="form.producto" class="form-control" />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Forma</label>
                <select v-model="form.forma" class="form-control">
                  <option value="0">SELECCIONE</option>
                  <option value="DIARIO">DIARIO</option>
                  <option value="SEMANAL">SEMANAL</option>
                  <option value="MENSUAL">MENSUAL</option>
                </select>
              </div>
            </div>


            <div class="col-md-3">
              <div class="form-group">
                <label>Importe</label>
                <input type="text" v-model="form.importe" class="form-control" />
              </div>
            </div>

             <div class="col-md-3">
              <div class="form-group">
                <label>Plazo</label>
                <select v-model="form.plazo"   class="form-control">
                  <option value="0">SELECCIONE</option>
                  <option v-for="(index) in 36" :key="index" :value="index" >{{index}} </option>
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Cuotas</label>
                <input type="text" v-model="form.cuotas" class="form-control" />
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Aporte</label>
                <input type="text" v-model="form.aporte" class="form-control" />
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Comentarios</label>
                <textarea type="text" v-model="form.comentarios" class="form-control"></textarea>
              </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end mt-3 mb-4">
              <button class="btn btn-success btn-sm " @click.prevent="submit">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Tabs from "vue-tabs-with-active-line";
import { serviceNumber } from "../mixins/functions";
import DatePick from 'vue-date-pick';
import 'vue-date-pick/dist/vueDatePick.css';

// import BackMixin from `vue-router-back-mixin`;


const TABS = [
  {
    title: "01 DATOS CLIENTE",
    value: "cliente"
  },
  {
    title: "02 AVAL",
    value: "aval"
  },
  {
    title: "03 GARANTIA",
    value: "garantia"
  },
  {
    title: "04 PROPUESTA ANALISTA",
    value: "propuesta"
  }
];
const mesConf=[
        'Enero', 'Febrero', 'Marzo', 'Abril',
        'Mayo', 'Junio', 'Julio', 'Agosto',
        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];
const diaConf=[
       'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'
];
export default {
  mixins: [serviceNumber],
  components: { Tabs ,DatePick},
  data() {
    return {
      resource: "clientes",
      tabs: TABS,
      currentTab: "cliente",
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      districts: [],
      errors: {},
      form: {},
      contador_aval: 0,
      contador_garantia: 0,
      mesEs: mesConf,
      diaEs: diaConf,
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
    this.initForm();

    this.$http.get(`/${this.resource}/datos/`).then(response => {
      this.all_departments = response.data.departments;
      this.all_provinces = response.data.provinces;
      this.all_districts = response.data.districts;
    });

    this.$http
      .get(`/${this.resource}/datos/prestamo/` + this.$route.params.dni)
      .then(response => {
        console.log(response.data);
        this.form.departamentos_id = response.data["departamentos_id"];
        // console.log(this.filterProvinces())

        this.form.provincias_id = response.data["provincias_id"];
        // this.filterDistricts()
        this.form.distritos_id = response.data["distritos_id"];
        this.form.estado_civil = response.data["estado_civil"];
        this.form.ocupacion = response.data["ocupacion"];
        this.form.telefono = response.data["telefono"];
        this.form.celular = response.data["celular"];
        this.form.direccion = response.data["direccion"];
        this.form.referencia = response.data["referencia"];
        this.form.tipo_domicilio = response.data["tipo_domicilio"];
        this.form.centro_laboral = response.data["centro_laboral"];
        this.form.direccion_laboral = response.data["direccion_laboral"];
        this.form.documento_conyugue = response.data["documento_conyugue"];
        this.form.nombres_conyugue = response.data["nombres_conyugue"];
        this.form.apellidos_conyugue = response.data["apellidos_conyugue"];
        this.form.nacimiento_conyugue = response.data["nacimiento_conyugue"];
        this.form.estado_civil_conyugue =
          response.data["estado_civil_conyugue"];
        this.form.ocupacion_conyugue = response.data["ocupacion_conyugue"];
        this.form.telefono_conyugue = response.data["telefono_conyugue"];
        this.form.celular_conyugue = response.data["celular_conyugue"];
        this.form.centro_laboral_conyugue =
          response.data["centro_laboral_conyugue"];
        this.form.direccion_laboral_conyugue =
          response.data["direccion_laboral_conyugue"];
      });
  },

  methods: {
    handleClick(newTab) {
      this.currentTab = newTab;
    },
    clickAddAval() {
      // this.contador_aval++;
      this.form.avals.push({
        documento: "",
        nombres: "",
        apellidos: "",
        nacimiento: "",
        estado_civil: "",
        ocupacion: "",
        telefono: "",
        celular: "",
        direccion: "",
        distrito: "",
        centro_laboral: "",
        direccion_laboral: ""
      });
    },
    clickRemoveAval(index) {
      this.form.avals.splice(index, 1);
    },
    clickAddGarantia() {
      // this.contador_garantia++;
      this.form.garantias.push({
        bien_garantia: "",
        inscripcion: "",
        declaracion_jurada: ""
      });
    },
    clickRemoveGarantia(index) {
      this.form.garantias.splice(index, 1);
    },
    clearForm(){
      this.initForm()
    },
    initForm() {
      this.errors = {};
      this.form = {
        departamentos_id: "0",
        provincias_id: "0",
        distritos_id: "0",
        estado_civil: "0",
        documento: this.$route.params.dni,
        ocupacion: "",
        telefono: "",
        celular: "",
        direccion: "",
        referencia: "",
        tipo_domicilio: "",
        centro_laboral: "",
        direccion_laboral: "",
        documento_conyugue: "",
        nombres_conyugue: "",
        apellidos_conyugue: "",
        nacimiento_conyugue: "",
        estado_civil_conyugue: "0",
        ocupacion_conyugue: "",
        telefono_conyugue: "",
        celular_conyugue: "",
        centro_laboral_conyugue: "",
        direccion_laboral_conyugue: "",
        garantias: [],
        avals: [],
        producto: "",
        forma: "0",
        importe: 0,
        aporte: 0,
        plazo: 0,
        coutas: 0,
        tasa: 0.0,
        comentarios: "",
        estado: "PENDIENTE"
      };

      this.clickAddAval();
      this.clickAddGarantia();
    },
    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.documento_conyugue
        })
        .then(function(response) {
          console.log(response.data);
          me.form.nombres_conyugue = response.data["nombres"];
          me.form.apellidos_conyugue = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          me.initForm();
        });
    },
    datosAval(index) {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/dni", {
          documento: this.form.avals[index].documento
        })
        .then(function(response) {
          console.log(response.data);
          me.form.avals[index].nombres = response.data["nombres"];
          me.form.avals[index].apellidos = response.data["surnames"];

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
        .post(`/${this.resource}/prestamo`, this.form)
        .then(response => {
          this.clearForm()
          this.$toast.success(
              "El prestamo fue creado",
              "Exitoso",
              this.notificationSystem.options.success
            ); 
          this.currentTab = 'cliente'
          this.backMixin_handleBack()
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
        retornar(){
      this.backMixin_handleBack()
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
<style lang="scss">
.default-tabs {
  position: relative;
  margin: 0 auto;
  &__item {
    display: inline-block;
    margin: 0 5px;
    padding: 10px;
    padding-bottom: 8px;
    font-size: 16px;
    letter-spacing: 0.8px;
    color: gray;
    text-decoration: none;
    border: none;
    background-color: transparent;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: all 0.25s;
    &_active {
      color: black;
    }
    &:hover {
      border-bottom: 2px solid gray;
      color: black;
    }
    &:focus {
      outline: none;
      border-bottom: 2px solid gray;
      color: black;
    }
    &:first-child {
      margin-left: 0;
    }
    &:last-child {
      margin-right: 0;
    }
  }
  &__active-line {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px;
    background-color: black;
    transition: transform 0.4s ease, width 0.4s ease;
  }
}
.content {
  margin-top: 30px;
  font-size: 20px;
}
.default-tabs {
  width: 100%;
}
button {
  width: 24%;
}
.vdpWithInput{
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
