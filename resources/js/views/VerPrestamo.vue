<template>
  <div class="container-general loan">
    <header class="m-0">
      <span @click="retornar()">
        <i class="fas fa-angle-left"></i>
      </span>
      <h1>Perfil</h1>
    </header>

    <ul style="list-style: outside none none;" class="nav nav-tabs row nav-loan" role="tablist">
      <li class="nav-item col-md-3">
        <a class="nav-link active" data-toggle="tab" href="#cliente" role="tab" aria-expanded="true" >Cliente</a>
      </li>
      <li class="nav-item col-md-3">
        <a class="nav-link" data-toggle="tab" href="#aval" role="tab" aria-expanded="false">Aval</a>
      </li>
      <li class="nav-item col-md-3">
        <a class="nav-link" data-toggle="tab" href="#garantia" role="tab" aria-expanded="false">Garantia</a>
      </li>
      <li class="nav-item col-md-3">
        <a class="nav-link" data-toggle="tab" href="#propuesta"  role="tab" aria-expanded="false" >Propuesta analista</a>
      </li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active loan-cliente" id="cliente" role="tabpanel" aria-expanded="true">
        <div class="row p-0 contenedor-titular">
          <div class="col-md-12 d-flex titulo-prestamo-menu">
            <p>Titular</p>
          </div>

          <div class="col-md-3">
            <div class="form-group">
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
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Ocupación</label>
              <input type="text" v-model="form.natural.ocupacion" class="form-control" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Teléfono</label>
              <input type="text" v-model="form.natural.telefono" class="form-control" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Celular</label>
              <input
                type="text"
                v-model="form.natural.celular"
                class="form-control input-mask"
                v-mask="{mask: '+51 999999999', greedy: true}"
              />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" v-model="form.natural.direccion" class="form-control" />
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label>Departamento</label>
              <select
                class="form-control"
                v-model="form.natural.departamentos_id"
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
                v-model="form.natural.provincias_id"
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
                v-model="form.natural.distritos_id"
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
              <input type="text" v-model="form.natural.referencia" class="form-control" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tipo Domicilio</label>
              <input type="text" v-model="form.natural.tipo_domicilio" class="form-control" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Centro Laboral</label>
              <input type="text" v-model="form.natural.centro_laboral" class="form-control" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" v-model="form.natural.direccion_laboral" class="form-control" />
            </div>
          </div>

          <div class="col-md-12 d-flex titulo-prestamo-menu">
            <p>Conyugue o Conviviente</p>
          </div>

          <div class="col-md-4">
            <div class="form-group search-fa-animation">
              <label>Documento de Identidad</label>
              <input
                type="text"
                v-model="form.conyugue.documento_conyugue"
                class="form-control input-mask"
                v-mask="{mask: '99999999', greedy: true}"
                @change="datosCliente()"
              />
              <i class="fas fa-search"></i>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Nombres</label>
              <input type="text" v-model="form.conyugue.nombres_conyugue" class="form-control" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Apellidos</label>
              <input type="text" v-model="form.conyugue.apellidos_conyugue" class="form-control" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Fecha de Nacimiento</label>
              <!-- <input type="text" v-model="form.conyugue.nacimiento_conyugue" class="form-control" /> -->
              <date-pick v-model="form.conyugue.nacimiento_conyugue" :months="mesEs" :weekdays="diaEs"></date-pick>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
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
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Ocupación</label>
              <input type="text" v-model="form.conyugue.ocupacion_conyugue" class="form-control" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Telefono</label>
              <input type="text" v-model="form.conyugue.telefono_conyugue" class="form-control" />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Celular</label>
              <input
                type="text"
                v-model="form.conyugue.celular_conyugue"
                class="form-control input-mask"
                v-mask="{mask: '+51 999999999', greedy: true}"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Centro Laboral</label>
              <input type="text" v-model="form.conyugue.centro_laboral_conyugue" class="form-control" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" v-model="form.conyugue.direccion_laboral_conyugue" class="form-control" />
            </div>
          </div>

          <div class="col-md-12 d-flex justify-content-end mt-3 mb-4">
            <a class="nav-link" data-toggle="tab" href="#garantia" role="tab" aria-expanded="false" >CONUTNIAR</a>
          </div>
        </div>
      </div>
      <div class="tab-pane loan-aval" id="aval" role="tabpanel" aria-expanded="false">
        <div v-for="(row, index) in form.avals" :key="index" class="row p-0 contenedor-aval">
          <div class="col-md-12 d-flex titulo-prestamo-menu">
            <p>Aval</p>
            <i class="fas fa-trash" @click.prevent="clickRemoveAval(index)"></i>
          </div>
          <div class="col-md-3">
            <div class="form-group search-fa-animation">
              <label>Documento de Identidad</label>
              <input
                type="text"
                v-model="row.documento"
                class="form-control input-mask"
                v-mask="{mask: '99999999', greedy: true}"
                @change="datosAval(index)"
              />
              <i class="fas fa-search"></i>
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
              <!-- <input type="text" v-model="row.nacimiento" class="form-control" /> -->
              <date-pick v-model="row.nacimiento" :months="mesEs" :weekdays="diaEs"></date-pick>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Estado Civil</label>
              <input type="text" v-model="row.estado_civil" class="form-control" />
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
          <div class="col-md-4 p-0">
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
          <div class="col-md-6 pr-0">
            <div class="form-group">
              <label>Dirección</label>
              <input type="text" v-model="row.direccion_laboral" class="form-control" />
            </div>
          </div>
        </div>

        <div class="row p-0 m-0">
          <div class="col-md-12 mt-3 mb-3">
            <button type="button" @click.prevent="clickAddAval" class="btn btn-crecer more-option w-100">
              <i class="fas fa-plus"></i> Agregar Aval
            </button>
          </div>
          <div class="col-md-12 d-flex justify-content-end mb-4">
            <button
              class="btn btn-success btn-sm "
              @click.prevent="handleClick('garantia')"
            >Continuar</button>
          </div>
        </div>
      </div>
      <div class="tab-pane loan-garantia" id="garantia"  role="tabpanel" aria-expanded="false" > 
            <div v-for="(row, index) in form.garantias" :key="index" class="row contenedor-garantia">
              <div class="col-md-12 d-flex titulo-prestamo-menu">
                <p>Garantía</p>
                <i class="fas fa-trash" @click.prevent="clickRemoveGarantia(index)"></i>
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

            <div class="row p-0 m-0">
              <div class="col-md-12 p-0 mt-3 mb-3">
                <button
                  type="button"
                  @click.prevent="clickAddGarantia"
                  class="btn btn-crecer more-option w-100"
                >
                  <i class="fas fa-plus"></i> Agregar Garantia
                </button>
              </div>
              <div class="col-md-12 d-flex justify-content-end mb-4">
                <button
                  class="btn btn-success btn-sm"
                  @click.prevent="handleClick('propuesta')"
                >Continuar</button>
              </div>
            </div>
      </div>

      <div class="tab-pane loan-propuesta" id="propuesta" role="tabpanel" aria-expanded="false" >
            <div class="row contenedor-propuesta">
              <div class="col-md-12 d-flex titulo-prestamo-menu">
                <p>Propuesta</p>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Producto</label>
                  <input type="text" v-model="prestamo.producto" class="form-control" />
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Forma</label>
                  <input type="text" v-model="prestamo.forma" class="form-control" />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Importe</label>
                  <input type="text" v-model="prestamo.importe" class="form-control" />
                </div>
              </div>

              <div class="col-md-3">
                <label>Plazo</label>
                <input type="text" v-model="prestamo.plazo" class="form-control" />
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Cuotas</label>
                  <input type="text" v-model="prestamo.cuotas" class="form-control" />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Aporte</label>
                  <input type="text" v-model="prestamo.aporte" class="form-control" />
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Comentarios</label>
                  <textarea type="text" v-model="prestamo.comentarios" class="form-control"></textarea>
                </div>
              </div>

              <div class="col-md-12 d-flex justify-content-end mt-3 mb-4">
                <button class="btn btn-success btn-sm" @click.prevent="submit">Guardar</button>
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

import { serviceNumber } from "../mixins/functions";


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
  components: { DatePick },
  data() {
    return {
      resource: "clientes",
      currentTab: "cliente",
      currentTabAll: "prestamo",
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      districts: [],
      errors: {},
      form: {},
      formViews: {},
      cliente: [],
      avals: [],
      garantias: [],
      prestamo: [],
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
      diaEs: diaConf,
      video: {},
      canvas: {},
      captures: []
    };
  },
  async created() {
    /**
     * LISTAR CIUDADES
     */
    await this.$http.get(`/${this.resource}/datos/`).then(response => {
      this.all_departments = response.data.departments;
      this.all_provinces = response.data.provinces;
      this.all_districts = response.data.districts;
    });

    await this.initFormPrestamo();

    /**
     *  DATOS DE PRESTAMOS
     */
    await this.$http
      .get(`/${this.resource}/prestamo/ver/` + this.$route.params.prestamo)
      .then(response => {
        console.log(response.data);

        this.form.cliente.departamentos_id = response.data['cliente']["departamentos_id"];
        this.form.cliente.provincias_id = response.data['cliente']["provincias_id"];
        this.form.cliente.distritos_id = response.data['cliente']["distritos_id"];
        this.form.cliente.documento = response.data['cliente']["documento"];

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
        this.form.avals = response.data.avals;
        this.form.garantias = response.data.garantias;
        this.prestamo = response.data.prestamo;
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

    await this.views();
    /**
     * DATOS VIES
     */
    await this.initForm();
  },
  methods: {
    stringDate(date) {
      var string = moment(date)
        .locale("es")
        .format("D [de] MMMM [del] YYYY");
      return string;
    },

    crearVisita() {
      this.tipo = false;
    },
    cancelarVisita() {
      this.tipo = true;
    },
    handleClick(newTab) {
      this.currentTab = newTab;
    },
    handleClickAll(newTab) {
      this.currentTabAll = newTab;
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
    initForm() {
      this.formViews = {
        fecha: "",
        hora: "",
        motivo: "",
        latitud: "",
        altitud: "",
        prestamos_id: this.$route.params.prestamo,
        estado: 1
      };
    },
    initFormPrestamo() {
      this.errors = {};
      this.form = {    
        idprestamo : this.$route.params.prestamo,
        garantias: [],
        avals: [],
        cliente:{
                departamentos_id: "0",
                provincias_id: "0",
                distritos_id: "0",
                documento: '',
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
    views() {
      this.$http
        .get(`/${this.resource}/visitas/` + this.$route.params.prestamo)
        .then(response => {
          this.list_vistas = response.data;
        });
    },
    resetForm() {
      this.initForm(); 
    },

  submit() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }
      this.$http
        .post(`/${this.resource}/prestamo`, this.form)
        .then(response => {
          // this.clearForm()
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
  }
};
</script>
<style lang="scss" scoped>

</style>