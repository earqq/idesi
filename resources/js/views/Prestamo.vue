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
            <div class="col-md-3 form-group ">
                  <label for=""> Nombres</label>
                <input type="text" class="form-control" v-model="form.natural.nombres">
                
              </div>
              <div class="col-md-3 form-group">
                <label for=""> Apellidos</label>
                <input type="text" class="form-control" v-model="form.natural.apellidos">
              </div>
              <div class="col-md-3 form-group">
                <label for=""> Documento</label>
                <input type="text" class="form-control" v-model="form.cliente.documento">
              </div>
              <div class="col-md-3 form-group">
                <label for=""> Fecha de nacimiento</label>
                <input type="text" class="form-control" v-model="form.natural.nacimiento">
              </div>

            <div class="col-md-3 form-group">
                <label>Estado Civil</label>
                <select v-model="form.natural.estado_civil" class="form-control">
                  <option value="0">SELECCIONE ...</option>
                  <option value="SOLTERO">SOLTERO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="CONVIVIENTE">CONVIVIENTE</option>
                  <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                  <option value="VIUDO">VIUDO</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Ocupación</label>
                <input type="text" v-model="form.natural.ocupacion" class="form-control" />
            </div>
            <div class="col-md-3 form-group">
                <label>Teléfono</label>
                <input type="text" v-model="form.natural.telefono" class="form-control" />
            </div>
            <div class="col-md-3 form-group">
                <label>Celular</label>
                <input
                  type="text"
                  v-model="form.natural.celular"
                  class="form-control input-mask"
                  v-mask="{mask: '+51 999999999', greedy: true}"
                />
            </div>

            <div class="col-md-6 form-group">
                <label>Dirección</label>
                <input type="text" v-model="form.natural.direccion" class="form-control" />
            </div>

            <div class="col-md-2 form-group">
                <label>Departamento</label>
                <select
                  class="form-control"
                  v-model="form.cliente.departamentos_id"
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
            <div class="col-md-2 form-group">
                <label>Provincia</label>
                <select
                  class="form-control text-uppercase"
                  v-model="form.cliente.provincias_id"
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
            <div class="col-md-2 form-group">
                <label>Distrito</label>
                <select
                  class="form-control text-uppercase"
                  v-model="form.cliente.distritos_id"
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
            <div class="col-md-6 form-group">
                <label>Referencia</label>
                <input type="text" v-model="form.natural.referencia" class="form-control" />
            </div>
            <div class="col-md-6 form-group">
                <label>Tipo Domicilio</label>
                <input type="text" v-model="form.natural.tipo_domicilio" class="form-control" />
            </div>

            <div class="col-md-6 form-group"> 
                <label>Centro Laboral</label>
                <input type="text" v-model="form.natural.centro_laboral" class="form-control" /> 
            </div>
            <div class="col-md-6 form-group"> 
                <label>Dirección</label>
                <input type="text" v-model="form.natural.direccion_laboral" class="form-control" /> 
            </div>

            <div class="col-md-12 d-flex titulo-prestamo-menu">
              <p>Conyugue o Conviviente</p>
            </div>

            <div class="col-md-4 form-group"> 
                <label>Documento de Identidad</label>
                <input
                  type="text"
                  v-model="form.conyugue.documento_conyugue"
                  class="form-control input-mask"
                  v-mask="{mask: '99999999', greedy: true}"
                  @change="datosCliente()"
                /> 
            </div>

            <div class="col-md-4 form-group"> 
                <label>Nombres</label>
                <input type="text" v-model="form.conyugue.nombres_conyugue" class="form-control" /> 
            </div>
            <div class="col-md-4 form-group"> 
                <label>Apellidos</label>
                <input type="text" v-model="form.conyugue.apellidos_conyugue" class="form-control" /> 
            </div>

            <div class="col-md-4 form-group"> 
                <label>Fecha de Nacimiento</label>
                <date-pick
                                 v-model="form.conyugue.nacimiento_conyugue" 
                                 :months="mesEs"
                                 :weekdays="diaEs"
                                ></date-pick> 
            </div>
            <div class="col-md-4 form-group"> 
                <label>Estado Civil</label>
                <select v-model="form.conyugue.estado_civil_conyugue" class="form-control">
                  <option value="0">SELECCIONE ...</option>
                  <option value="SOLTERO">SOLTERO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="CONVIVIENTE">CONVIVIENTE</option>
                  <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                  <option value="VIUDO">VIUDO</option>
                </select> 
            </div>

            <div class="col-md-4 form-group"> 
                <label>Ocupación</label>
                <input type="text" v-model="form.conyugue.ocupacion_conyugue" class="form-control" /> 
            </div>
            <div class="col-md-4 form-group"> 
                <label>Telefono</label>
                <input type="text" v-model="form.conyugue.telefono_conyugue" class="form-control" /> 
            </div>
            <div class="col-md-4 form-group"> 
                <label>Celular</label>
                <input
                  type="text"
                  v-model="form.conyugue.celular_conyugue"
                  class="form-control input-mask"
                  v-mask="{mask: '+51 999999999', greedy: true}"
                /> 
            </div>

            <div class="col-md-4 form-group"> 
                <label>Centro Laboral</label>
                <input type="text" v-model="form.conyugue.centro_laboral_conyugue" class="form-control" /> 
            </div>
            <div class="col-md-12 form-group"> 
                <label>Dirección</label>
                <input type="text" v-model="form.conyugue.direccion_laboral_conyugue" class="form-control" /> 
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
            <div class="col-md-3 form-group"> 
                <label>Documento de Identidad</label>
                <input
                  type="text"
                  v-model="row.documento"
                  class="form-control input-mask"
                  v-mask="{mask: '99999999', greedy: true}"
                  @change="datosAval(index)"
                /> 
            </div>
            <div class="col-md-3 form-group"> 
                <label>Nombres</label>
                <input type="text" v-model="row.nombres" class="form-control" /> 
            </div>

            <div class="col-md-3 form-group"> 
                <label>Apellidos</label>
                <input type="text" v-model="row.apellidos" class="form-control" /> 
            </div>

            <div class="col-md-3 form-group"> 
                <label>Fecha de Nacimiento</label>
                  <date-pick
                                 v-model="row.nacimiento" 
                                 :months="mesEs"
                                 :weekdays="diaEs"
                                ></date-pick> 
            </div>

            <div class="col-md-4 form-group"> 
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

            <div class="col-md-4 form-group"> 
                <label>Ocupación</label>
                <input type="text" v-model="row.ocupacion" class="form-control" /> 
            </div>

            <div class="col-md-4 form-group"> 
                <label>Teléfono</label>
                <input type="text" v-model="row.telefono" class="form-control" /> 
            </div>

            <div class="col-md-4 form-group">
                <label>Celular</label>
                <input type="text" v-model="row.celular" class="form-control" />
            </div>

            <div class="col-md-4 form-group">
                <label>Dirección</label>
                <input type="text" v-model="row.direccion" class="form-control" />
            </div>
            <div class="col-md-4 form-group">
                <label>Distrito</label>
                <input type="text" v-model="row.distrito" class="form-control" />
            </div>
            <div class="col-md-6 form-group">
                <label>Centro Laboral</label>
                <input type="text" v-model="row.centro_laboral" class="form-control" />
            </div>
            <div class="col-md-6 form-group">
                <label>Dirección</label>
                <input type="text" v-model="row.direccion_laboral" class="form-control" />
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

            <div class="col-md-6 form-group">
                <label>Inscripción</label>
                <input type="text" v-model="row.inscripcion" class="form-control" />
            </div>

            <div class="col-md-6 form-group">
                <label>Declaración Jurada</label>
                <input type="text" v-model="row.declaracion_jurada" class="form-control" />
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
            <div class="col-md-8 form-group">
                <label>Producto</label>
                <input type="text" v-model="form.producto" class="form-control" />
            </div>

            <div class="col-md-4 form-group">
                <label>Forma</label>
                <select v-model="form.forma" class="form-control">
                  <option value="0">SELECCIONE</option>
                  <option value="DIARIO">DIARIO</option>
                  <option value="SEMANAL">SEMANAL</option>
                  <option value="MENSUAL">MENSUAL</option>
                </select>
            </div>


            <div class="col-md-3 form-group">
                <label>Importe</label>
                <input type="text" v-model="form.importe" class="form-control" />
            </div>

             <div class="col-md-3 form-group">
                <label>Plazo</label>
                <select v-model="form.plazo"   class="form-control">
                  <option value="0">SELECCIONE</option>
                  <option v-for="(index) in 36" :key="index" :value="index" >{{index}} </option>
                </select>
            </div>

            <div class="col-md-3 form-group">
                <label>Cuotas</label>
                <input type="text" v-model="form.cuotas" class="form-control" />
            </div>

            <div class="col-md-3 form-group">
                <label>Aporte</label>
                <input type="text" v-model="form.aporte" class="form-control" />
            </div>

            <div class="col-md-12 form-group">
                <label>Comentarios</label>
                <textarea type="text" v-model="form.comentarios" class="form-control"></textarea>
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


        this.form.cliente.departamentos_id = response.data['cliente']["departamentos_id"];
        // console.log(this.filterProvinces())

        this.form.cliente.provincias_id = response.data['cliente']["provincias_id"];
        // this.filterDistricts()
        this.form.cliente.distritos_id = response.data['cliente']["distritos_id"];
        this.form.natural.estado_civil = response.data['natural']["estado_civil"]; 
        this.form.natural.ocupacion = response.data['natural']["ocupacion"];
        this.form.natural.telefono = response.data['natural']["telefono"];
        this.form.natural.celular = response.data['natural']["celular"];
        this.form.natural.nombres = response.data['natural']["nombres"];
        this.form.natural.apellidos = response.data['natural']["apellidos"];
        this.form.natural.nacimiento = response.data['natural']["nacimiento"];
        this.form.natural.direccion = response.data['natural']["direccion_cliente"];
        this.form.natural.referencia = response.data['natural']["referencia"];
        this.form.natural.tipo_domicilio = response.data['natural']["tipo_domicilio"];
        this.form.natural.centro_laboral = response.data['natural']["centro_laboral"];
        this.form.natural.direccion_laboral = response.data['natural']["direccion_laboral"];
          if(response.data['conyugue']){
              this.form.conyugue.documento_conyugue = response.data['conyugue']["documento"];
              this.form.conyugue.nombres_conyugue = response.data['conyugue']["nombres"];
              this.form.conyugue.apellidos_conyugue = response.data['conyugue']["apellidos"];
              this.form.conyugue.nacimiento_conyugue = response.data['conyugue']["nacimiento"];
              this.form.conyugue.estado_civil_conyugue = response.data['conyugue']["estado_civil"];
              this.form.conyugue.ocupacion_conyugue = response.data['conyugue']["ocupacion"];
              this.form.conyugue.telefono_conyugue = response.data['conyugue']["telefono"];
              this.form.conyugue.celular_conyugue = response.data['conyugue']["celular"];
              this.form.conyugue.centro_laboral_conyugue = response.data['conyugue']["centro_laboral"];
              this.form.conyugue.direccion_laboral_conyugue =response.data['conyugue']["direccion"];
          }
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
        garantias: [],
        avals: [],
        cliente:{
                departamentos_id: "0",
                provincias_id: "0",
                distritos_id: "0",
                documento: this.$route.params.dni,
        },
        natural:{
          nombres: "",
          apellidos: "",
          nacimiento: "",
          estado_civil: "0",
          ocupacion: "",
          telefono: "",
          celular: "",
          direccion: "",
          referencia: "",
          tipo_domicilio: "", 
          centro_laboral: "",
          direccion_laboral: "",
        },
        conyugue:{
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
        },
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
          documento: this.form.conyugue.documento_conyugue
        })
        .then(function(response) {
          console.log(response.data);
          me.form.conyugue.nombres_conyugue = response.data["nombres"];
          me.form.conyugue.apellidos_conyugue = response.data["surnames"];

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
