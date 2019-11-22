<template>
  <div class="container-general">
    <div class="row col-md-12 m-0 loan">
      <div class="loans-tab-general">
        <tabs
          :tabs="tabsAll"
          :currentTab="currentTabAll"
          :wrapper-class="'default-tabs'"
          :tab-class="'default-tabs__item'"
          :tab-active-class="'default-tabs__item_active'"
          :line-class="'default-tabs__active-line'"
          @onClick="handleClickAll"
        />
      </div>
      <div class="content">
        <div class="loans-all" v-if="currentTabAll === 'prestamo'">
          <tabs
            :tabs="tabs"
            :currentTab="currentTab"
            :wrapper-class="'default-tabs'"
            :tab-class="'default-tabs__item'"
            :tab-active-class="'default-tabs__item_active'"
            :line-class="'default-tabs__active-line'"
            @onClick="handleClick"
          />
          <div class="loan-cliente" v-if="currentTab === 'cliente'">
            <div class="row">
              <div class="col-md-12 d-flex titulo-prestamo-menu">
                <p>Titular</p>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Estado Civil</label>
                  <select v-model="cliente.estado_civil" class="form-control">
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
                  <input type="text" v-model="cliente.ocupacion" class="form-control" />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Teléfono</label>
                  <input type="text" v-model="cliente.telefono" class="form-control" />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-model="cliente.celular"
                    class="form-control input-mask"
                    v-mask="{mask: '+51 999999999', greedy: true}"
                  />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Dirección</label>
                  <input type="text" v-model="cliente.direccion" class="form-control" />
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Departamento</label>
                  <select
                    class="form-control"
                    v-model="cliente.departamentos_id"
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
                    v-model="cliente.provincias_id"
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
                    v-model="cliente.distritos_id"
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
                  <input type="text" v-model="cliente.referencia" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tipo Domicilio</label>
                  <input type="text" v-model="cliente.tipo_domicilio" class="form-control" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Centro Laboral</label>
                  <input type="text" v-model="cliente.centro_laboral" class="form-control" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Dirección</label>
                  <input type="text" v-model="cliente.direccion_laboral" class="form-control" />
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
                    v-model="cliente.documento_conyugue"
                    class="form-control input-mask"
                    v-mask="{mask: '99999999', greedy: true}"
                    @change="datosCliente()"
                  />
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Nombres</label>
                  <input type="text" v-model="cliente.nombres_conyugue" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" v-model="cliente.apellidos_conyugue" class="form-control" />
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha de Nacimiento</label>
                  <input type="text" v-model="cliente.nacimiento_conyugue" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Estado Civil</label>
                  <select v-model="cliente.estado_civil_conyugue" class="form-control">
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
                  <input type="text" v-model="cliente.ocupacion_conyugue" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Telefono</label>
                  <input type="text" v-model="cliente.telefono_conyugue" class="form-control" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-model="cliente.celular_conyugue"
                    class="form-control input-mask"
                    v-mask="{mask: '+51 999999999', greedy: true}"
                  />
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Centro Laboral</label>
                  <input type="text" v-model="cliente.centro_laboral_conyugue" class="form-control" />
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Dirección</label>
                  <input type="text" v-model="cliente.direccion_laboral_conyugue" class="form-control" />
                </div>
              </div>

              <div class="col-md-12 d-flex justify-content-end mt-3 mb-4">
                <button
                  class="btn btn-success btn-sm"
                  @click.prevent="handleClick('aval')"
                >Continuar</button>
              </div>
            </div>
          </div>
          <div class="loan-aval" v-if="currentTab === 'aval'">
            <div v-for="(row, index) in avals" :key="index" class="row">
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
                  <input type="text" v-model="row.nacimiento" class="form-control" />
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
                <button
                  class="btn btn-success btn-sm"
                  @click.prevent="handleClick('garantia')"
                >Continuar</button>
              </div>
            </div>
          </div>

          <div class="loan-garantia" v-if="currentTab === 'garantia'">
            <div v-for="(row, index) in garantias" :key="index" class="row">
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
                <button
                  class="btn btn-success btn-sm"
                  @click.prevent="handleClick('propuesta')"
                >Continuar</button>
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
        <div class="loans-views" v-if="currentTabAll === 'visita'">
          <div class="row m-0">
            <div class="col-md-12 d-flex justify-content-between">
              <p>Lista de Visitas</p>
              <button>Crear Visita</button>
            </div>
            <div class="col-md-12 views p-0">
              <table style="width:100%">
                <tr>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
                <tr>
                  <td>Gian Marco Albornoz Rimas</td>
                  <td>Pendiente</td>
                  <td>
                    <button class="btn btn-success" style="width:50%">Ver Prestamo</button>
                  </td>
                </tr>
                <tr>
                  <td>Gian Marco Albornoz Rimas</td>
                  <td>Rechazado</td>
                  <td>
                    <button class="btn btn-success" style="width:50%">Ver Prestamo</button>
                  </td>
                </tr>
                <tr>
                  <td>Gian Marco Albornoz Rimas</td>
                  <td>Observado</td>
                  <td>
                    <button class="btn btn-success" style="width:50%">Ver Prestamo</button>
                  </td>
                </tr>
                <tr>
                  <td>Gian Marco Albornoz Rimas</td>
                  <td>Pendiente</td>
                  <td>
                    <button class="btn btn-success" style="width:50%">Ver Prestamo</button>
                  </td>
                </tr>
              </table>
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
const TABSALL = [
  {
    title: "PRESTAMO",
    value: "prestamo"
  },
  {
    title: "VISITA",
    value: "visita"
  }
];
export default {
  mixins: [serviceNumber],
  components: { Tabs },
  data() {
    return {
      resource: "clientes",
      tabs: TABS,
      tabsAll: TABSALL,
      currentTab: "cliente",
      currentTabAll: "prestamo",
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      districts: [],
      errors: {},
      form: {},
      cliente: [],
      avals: [],
      garantias: [],
      prestamo: []

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

    /**
     *  DATOS DE PRESTAMOS
     */
     await this.$http
      .get(`/${this.resource}/prestamo/ver/` + this.$route.params.prestamo)
      .then(response => {
        console.log(response.data);
        this.cliente=response.data.cliente
        this.avals=response.data.avals
        this.garantias=response.data.garantias
        this.prestamo=response.data.prestamo
      });

    
  },
  methods: {
    handleClick(newTab) {
      this.currentTab = newTab;
    },
    handleClickAll(newTab) {
      this.currentTabAll = newTab;
    }
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
.loans-tab-general {
  width: 100%;
  button {
    width: 48%;
  }
}
</style>