<template>
  <div class="container-general loan" style="background: rgb(220, 234, 240);">
    <header>
      <span @click="retornar()">
        <i class="fas fa-angle-left"></i>
      </span>
      <h1>Solicitd de Credito</h1>
    </header>
    <div class="col-md-12 p-0">
      <div class="nav-tabs style-tab-menu">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item col-md-2">
            <a
              class="nav-link active text-center"
              id="solicitud-tab"
              data-toggle="tab"
              href="#solicitud"
              role="tab"
              aria-controls="solicitud"
              aria-selected="true"
            >Solicitud</a>
          </li>

          <li class="nav-item col-md-2">
            <a
              class="nav-link text-center"
              id="cliente-tab"
              data-toggle="tab"
              href="#cliente"
              role="tab"
              aria-controls="cliente"
              aria-selected="false"
            >Cliente</a>
          </li>
          <li class="nav-item col-md-2">
            <a
              class="nav-link text-center"
              id="aval-tab"
              data-toggle="tab"
              href="#aval"
              role="tab"
              aria-controls="aval"
              aria-selected="false"
            >Aval</a>
          </li>
          <li class="nav-item col-md-3">
            <a
              class="nav-link text-center"
              id="garantia-tab"
              data-toggle="tab"
              href="#garantia"
              role="tab"
              aria-controls="garantia"
              aria-selected="false"
            >Garantia</a>
          </li>
          <li class="nav-item col-md-3">
            <a
              class="nav-link text-center"
              id="propuesta-tab"
              data-toggle="tab"
              href="#propuesta"
              role="tab"
              aria-controls="propuesta"
              aria-selected="false"
            >Propuesta de analista</a>
          </li>
        </ul>
      </div>

      <div class="col-md-12 body-tabs">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active"  id="solicitud"  role="tabpanel" aria-labelledby="solicitud-tab" >
            <div class="row contenedor-solicitud">
              <div class="col-md-12 d-flex titulo-prestamo-menu">
                <p>Solicitud de credito</p>
              </div>

              <div class="col-md-4 form-group">
                <label>Monto</label>
                <!-- <input type="text" v-model="form.monto_inicial" class="form-control" /> -->
                <money   v-model="form.monto_inicial" v-bind="money" class="form-control"  ></money>
              </div>
              <div class="col-md-4 form-group">
                <label>Forma</label>
                <select v-model="form.forma_inicial" class="form-control" >
                  <option value="DIARIO">DIARIO</option>
                  <option value="SEMANAL">SEMANAL</option>
                  <option value="QUINCENAL">QUINCENAL</option>
                  <option value="MENSUAL">MENSUAL</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label>Plazo</label>
                <select v-model="form.plazo_inicial" class="form-control" >
                  <option v-for="(index) in 36" :key="index" :value="index">{{index}}</option>
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label>Disponibilidad de pago</label>
                <input type="text" v-model="form.disponibilidad_pago_inicial" class="form-control" />
              </div>
              <div class="col-md-6 form-group">
                <label>Destino de credito en propuesta cliente</label>
                <input type="text" v-model="form.destino_inicial" class="form-control" />
              </div> 
            </div>

            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>

          <div class="tab-pane fade" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
            <div class="row p-0 contenedor-titular">
              <div class="col-md-12 d-flex titulo-prestamo-menu">
                <p>Titular</p>
              </div>
              <div class="col-md-3 form-group">
                <label for>Nombres</label>
                <input type="text" class="form-control" v-model="form.natural.nombres" />
              </div>
              <div class="col-md-3 form-group">
                <label for>Apellidos</label>
                <input type="text" class="form-control" v-model="form.natural.apellidos" />
              </div>
              <div class="col-md-3 form-group">
                <label for>Documento</label>
                <input type="text" class="form-control" v-model="form.cliente.documento" />
              </div>
              <div class="col-md-3 form-group">
                <label for>Fecha de nacimiento</label>
                <input type="text" class="form-control" v-model="form.natural.nacimiento" />
              </div>

              <div class="col-md-3 form-group">
                <label>Estado Civil</label>
                <select v-model="form.natural.estado_civil" class="form-control"> 
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

              <div class="col-md-3 form-group">
                <label>Dirección Consignado</label>
                <input type="text" v-model="form.natural.direccion" class="form-control" />
              </div>
              <div class="col-md-3 form-group">
                <label>Dirección Reniec</label>
                <input type="text"  class="form-control"  disabled/>
              </div>

              <div class="col-md-2 form-group">
                <label>Departamento</label>
                <input
                  type="text"
                  v-model="form.natural.domicilio_departamento"
                  class="form-control"
                />
              </div>
              <div class="col-md-2 form-group">
                <label>Provincia</label>
                <input type="text" v-model="form.natural.domicilio_provincia" class="form-control" />
              </div>
              <div class="col-md-2 form-group">
                <label>Distrito</label>
                <input type="text" v-model="form.natural.domicilio_distrito" class="form-control" />
              </div>

              <div class="col-md-6 form-group">
                <label>Referencia</label>
                <input type="text" v-model="form.natural.referencia" class="form-control" />
              </div>
              <div class="col-md-6 form-group">
                <label>Tipo Domicilio</label>
                <select v-model="form.natural.tipo_domicilio" class="form-control">
                  <option value="PROPIA">PROPIA</option>
                  <option value="PROPIA HIPOTECA">PROPIA HIPOTECA</option>
                  <option value="DE LOS PADRES">DE LOS PADRES</option>
                  <option value="DE LOS FAMILIARES">DE LOS FAMILIARES</option>
                  <option value="ALQUILADA">ALQUILADA</option>
                </select>
              </div>
 
              <div class="col-md-6 form-group">
                <label>Centro Laboral</label>
                <input type="text" v-model="form.natural.centro_laboral" class="form-control" />
              </div>
              <div class="col-md-6 form-group">
                <label>Dirección centro laboral</label>
                <input type="text" v-model="form.natural.direccion_laboral" class="form-control" />
              </div>

              <div class="col-md-12 d-flex titulo-prestamo-menu">
                <p>Conyuge o Conviviente</p>
              </div>
              

              <div class="col-md-12 row" v-if="form.conyugue.conyuge_tiene=='SI'">
                <div class="col-md-4 form-group">
                <label>Documento de Identidad</label>
                <input
                  type="text"
                  v-model="form.conyugue.documento_conyugue"
                  class="form-control letter-5"
                  v-mask="{mask: '99999999', greedy: true}"
                  @change="datosCliente()"
                />
              </div>

              <div class="col-md-8 form-group">
                <label>Nombres y Apellidos</label>
                <input type="text" v-model="form.conyugue.nombres_conyugue" class="form-control" />
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
                <label>Socio</label>
                <select v-model="form.conyugue.socio_conyugue" class="form-control">
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>

              <div class="col-md-4 form-group">
                <label>Codigo</label>
                <input type="text" v-model="form.conyugue.codigo_socio_conyugue" class="form-control"  v-if="form.conyugue.socio_conyugue=='SI'"/>
                <input type="text"  class="form-control" disabled v-else>
              </div>

              <div class="col-md-4 form-group">
                <label>Aporte</label>
                <money   v-model="form.conyugue.aporte_socio_conyugue" v-bind="money" class="form-control" v-if="form.conyugue.socio_conyugue=='SI'" ></money>
                <input type="text"  class="form-control" disabled v-else>
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
                  class="form-control letter-5"
                  v-mask="{mask: '+51 999999999', greedy: true}"
                />
              </div>

              <div class="col-md-4 form-group">
                <label>Centro Laboral</label>
                <input
                  type="text"
                  v-model="form.conyugue.centro_laboral_conyugue"
                  class="form-control"
                />
              </div>
              <div class="col-md-12 form-group">
                <label>Dirección centro laboral</label>
                <input
                  type="text"
                  v-model="form.conyugue.direccion_laboral_conyugue"
                  class="form-control"
                />
              </div>
              </div>
                <div class="col-md-12 mt-2">
                  <button
                    type="button"
                    @click.prevent="clickAddConyuge"
                    class="btn btn-outline-dark more-option w-100"
                    v-if="form.conyugue.conyuge_tiene=='NO'"
                  >
                    <i class="fas fa-plus"></i> Agregar Conyuge ó Conviviente
                  </button>
                  <button
                    type="button"
                    @click.prevent="clickRemoveConyuge"
                    class="btn btn-outline-dark more-option w-100"
                    v-else
                  >
                    <i class="fas fa-plus"></i> Remover Conyuge
                  </button>
              </div>
            </div>
            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>

          <div class="tab-pane fade" id="aval" role="tabpanel" aria-labelledby="aval-tab">

              <div v-for="(row, index) in form.avals" :key="index" class="row p-0 contenedor-aval">
                <div class="col-md-12 d-flex titulo-prestamo-menu">
                  <p>Aval</p>
                  <i class="fas fa-trash" @click.prevent="clickRemoveAval(index)"></i>
                </div>
                <div class="col-md-2 form-group"> 
                    <label>Tipo Persona</label>
                    <select  v-model="row.tipo_persona"  class="form-control"> 
                      <option value="pn">Persona Natural</option>
                      <option value="pj">Persona Juridica</option>
                    </select> 
                </div>
                <div class="col-md-2 form-group"> 
                    <label>Documento de Identidad</label>
                    <input
                      type="text"
                      v-model="row.documento"
                      class="form-control letter-5"
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

                <div class="col-md-2 form-group"> 
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
                    <label>Socio</label>
                    <select v-model="row.socio" class="form-control">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select> 
                </div>
                
                <div class="col-md-4 form-group"> 
                    <label>Codigo</label>
                    <input type="text" v-model="row.codigo_socio" class="form-control" v-if="row.socio=='SI'"/> 
                    <input type="text" class="form-control" v-else disabled/> 
                </div>

                <div class="col-md-4 form-group"> 
                    <label>Aporte</label>
                    <money   v-model="row.aporte_socio" v-bind="money" class="form-control" v-if="row.socio=='SI'" ></money>
                    <input type="text" class="form-control" v-else disabled/> 
                </div>


                <div class="col-md-4 form-group">
                    <label>Celular</label>
                    <input type="text" v-model="row.celular" class="form-control letter-5" v-mask="{mask: '+51 999999999', greedy: true}" />
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
                    <label>Dirección centro laboral</label>
                    <input type="text" v-model="row.direccion_laboral" class="form-control" />
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-12">
                  <button
                    type="button"
                    @click.prevent="clickAddAval"
                    class="btn btn-outline-dark more-option w-100"
                  >
                    <i class="fas fa-plus"></i> Agregar Aval
                  </button>
                </div>
              </div>

            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>

          <div class="tab-pane fade" id="garantia" role="tabpanel" aria-labelledby="garantia-tab">
              <div v-for="(row, index) in form.garantias" :key="index" class="row contenedor-garantia">
                  <div class="col-md-12 d-flex titulo-prestamo-menu">
                    <p>Garantía</p>
                    <i class="fas fa-trash" @click.prevent="clickRemoveGarantia(index)"></i>
                  </div>

                  <div class="col-md-10 form-group">
                    <label>Bien en Garantía</label>
                    <input type="text" v-model="row.bien_garantia" class="form-control" />
                  </div>

                  <div class="col-md-1 form-group">
                      <label>Ins</label>
                        <label class="form-check-label">
                          <input type="radio" v-model="row.tipo"  class="form-check-input" value="INS">
                        </label>
                  </div>

                  <div class="col-md-1 form-group">
                      <label>D. J</label>
                      <label class="form-check-label">
                        <input type="radio" v-model="row.tipo"  class="form-check-input" value="DJ">
                      </label>
                  </div>
                  
              </div>
                <div class="row mt-3" v-if="form.garantias.length<=1">
                  <div class="col-md-12">
                    <button 
                      type="button"
                      @click.prevent="clickAddGarantia"
                      class="btn btn-outline-dark more-option w-100"
                    >
                      <i class="fas fa-plus"></i> Agregar Garantia
                    </button>
                  </div> 
                </div>
            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="next()">Siguiente</a>
            </div>
          </div>

          <div class="tab-pane fade" id="propuesta" role="tabpanel" aria-labelledby="propuesta-tab">
            <div class="row contenedor-propuesta">
                <div class="col-md-12 d-flex titulo-prestamo-menu">
                  <p>Propuesta</p>
                </div>
                <div class="col-md-2 form-group">
                    <label>Producto</label>
                    <select v-model="form.producto" class="form-control" @change="meses_numero">
                      <option value="CREDIDIARIO">CREDIDIARIO</option>
                      <option value="CREDISEMANA">CREDISEMANA</option>
                      <option value="CREDIQUINCENA">CREDIQUINCENA</option>
                      <option value="PYME">PYME</option>
                      <option value="PYME ESPECIAL">PYME ESPECIAL</option>
                      <option value="CONSUMO">CONSUMO</option>
                      <option value="CONSUMO ESPECIAL">CONSUMO ESPECIAL</option>
                    </select>

                </div>

          
                <div class="col-md-2 form-group">
                    <label>Importe</label>
                    <money   v-model="form.importe" v-bind="money" class="form-control"></money>
                </div>
 
                <div class="col-md-2 form-group">
                    <label>Plazo</label>
                    <input type="number" class="form-control" v-model="form.plazo" :min="1" :max='48' @keyup="meses_numero">

                </div>

              <div class="col-md-2 form-group">
                <label>Meses</label>
                <input type="text" v-model="form.meses" class="form-control" disabled />
              </div>

                <div class="col-md-2 form-group">
                    <label>Cuota del sistema</label>
                    <input type="number" v-model="form.cuotas" class="form-control" />
                </div>

                <div class="col-md-2 form-group">
                    <label>Aporte</label>
                    <money  v-model="form.aporte" v-bind="money" class="form-control"></money>
                </div>
                <div class="col-md-2 form-group">
                    <label>Prob. Infocorp</label>
                    <input type='number' v-model='form.probabilidad_infocorp' class='form-control'>
                </div>
 
                <div class="col-md-12 form-group">
                    <label>Comentarios</label>
                    <textarea type="text" v-model="form.comentarios" class="form-control"></textarea>
                </div>
            </div>
            <div class="input-group mb-3 group-end d-flex justify-content-end mt-2">
              <a class="btn btn-dark btnPrevious" @click.prevent="previous()">Atras</a>
              <a class="btn btn-orange btnNext" @click.prevent="submit()" v-if="loading_submit=='0'">Registrar</a>
              <div class="container-load-register" v-else ><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="spinner" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-spinner fa-w-16 fa-spin fa-lg"><path fill="currentColor" d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z" class=""></path></svg> <span class="fw6 f4 ml3">Registrando</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";

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
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      districts: [],
      errors: {},
      loading_submit: 0,
      form: {},
      contador_aval: 0,
      contador_garantia: 0,
      mesEs: mesConf,
      diaEs: diaConf,
      money: {
          decimal: ',', 
          thousands: '.',
          prefix: 'S/. ',
          suffix: '',
          precision: 2,
          masked: false
      },
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

        this.form.cliente.departamento =
          response.data["cliente"]["departamento"];
        // console.log(this.filterProvinces())

        this.form.cliente.provincia = response.data["cliente"]["provincia"];
        // this.filterDistricts()
        this.form.cliente.distrito = response.data["cliente"]["distrito"];
        this.form.natural.estado_civil =
          response.data["natural"]["estado_civil"];
        this.form.natural.ocupacion = response.data["natural"]["ocupacion"];
        this.form.natural.domicilio_distrito =
          response.data["natural"]["domicilio_distrito"];
        this.form.natural.domicilio_provincia =
          response.data["natural"]["domicilio_provincia"];
        this.form.natural.domicilio_departamento =
          response.data["natural"]["domicilio_departamento"];
        this.form.natural.telefono = response.data["natural"]["telefono"];
        this.form.natural.celular = response.data["natural"]["celular"];
        this.form.natural.nombres = response.data["natural"]["nombres"];
        this.form.natural.apellidos = response.data["natural"]["apellidos"];
        this.form.natural.nacimiento = response.data["natural"]["nacimiento"];
        this.form.natural.direccion =
          response.data["natural"]["direccion_cliente"];
        this.form.natural.referencia = response.data["natural"]["referencia"];
        this.form.natural.tipo_domicilio =
          response.data["natural"]["tipo_domicilio"];
        this.form.natural.centro_laboral =
          response.data["natural"]["centro_laboral"];
        this.form.natural.direccion_laboral =
          response.data["natural"]["direccion_laboral"];

        if (response.data["tiene_conyuge"]=='SI') {
          console.log(response.data["conyugue"])
          this.form.conyugue.documento_conyugue =
            response.data["conyugue"]["documento"];
          this.form.conyugue.nombres_conyugue =
            response.data["conyugue"]["nombres"];
          this.form.conyugue.nacimiento_conyugue =
            response.data["conyugue"]["nacimiento"];
          this.form.conyugue.estado_civil_conyugue =
            response.data["conyugue"]["estado_civil"];
          this.form.conyugue.ocupacion_conyugue =
            response.data["conyugue"]["ocupacion"];
          this.form.conyugue.telefono_conyugue =
            response.data["conyugue"]["telefono"];
          this.form.conyugue.celular_conyugue =
            response.data["conyugue"]["celular"];
          this.form.conyugue.centro_laboral_conyugue =
            response.data["conyugue"]["centro_laboral"];
          this.form.conyugue.direccion_laboral_conyugue =
            response.data["conyugue"]["direccion"];
          this.form.conyugue.socio_conyugue =
            response.data["conyugue"]["socio"];
          this.form.conyugue.codigo_socio_conyugue =
            response.data["conyugue"]["codigo_socio"];
          this.form.conyugue.aporte_socio_conyugue =
            response.data["conyugue"]["aporte_socio"];
            this.form.conyugue.conyuge_tiene='SI';
        }else{
            
          this.form.conyugue.conyuge_tiene='NO';
          console.log(this.form.conyugue.conyuge_tiene)
        }
      });
  },

  methods: {
    next() {
      $(".nav-tabs .active")
        .parent()
        .next("li")
        .find("a")
        .trigger("click");
    },
    previous() {
      $(".nav-tabs .active")
        .parent()
        .prev("li")
        .find("a")
        .trigger("click");
    },
    clickAddConyuge(){
      this.form.conyugue.conyuge_tiene='SI'
    },
    clickRemoveConyuge(){
      this.form.conyugue.conyuge_tiene='NO'
    },
    clickAddAval() {
      // this.contador_aval++;
      this.form.avals.push({
        documento: "",
        nombres: "",
        apellidos: "",
        nacimiento: "",
        estado_civil: "SOLTERO",
        ocupacion: "",
        telefono: "",
        celular: "",
        direccion: "",
        distrito: "",
        centro_laboral: "",
        direccion_laboral: "",
        socio: 'NO',
        codigo_socio: "",
        aporte_socio: "",
        tipo_persona: "pn"
      });
    },
    clickRemoveAval(index) {
      this.form.avals.splice(index, 1);
    },
    clickAddGarantia() {
      // this.contador_garantia++;
      this.form.garantias.push({
        bien_garantia: "",
        tipo: ""
      });
    },
    clickRemoveGarantia(index) {
      this.form.garantias.splice(index, 1);
    },
    clearForm() {
      this.initForm();
    },
    initForm() {
      this.errors = {};
      this.form = {
        idprestamo: -1,
        garantias: [],
        avals: [],
        cliente: {
          departamento: "",
          provincia: "",
          distrito: "",
          documento: this.$route.params.dni
        },
        natural: {
          nombres: "",
          apellidos: "",
          nacimiento: "",
          estado_civil: "SOLTERO",
          ocupacion: "",
          telefono: "",
          celular: "",
          direccion: "",
          referencia: "",
          tipo_domicilio: "",
          centro_laboral: "",
          direccion_laboral: "",
          domicilio_departamento: "",
          domicilio_provincia: "",
          domicilio_distrito: ""
        },
        conyugue: {
          documento_conyugue: "",
          nombres_conyugue: "",
          nacimiento_conyugue: "",
          estado_civil_conyugue: "SOLTERO",
          ocupacion_conyugue: "",
          telefono_conyugue: "",
          celular_conyugue: "",
          centro_laboral_conyugue: "",
          direccion_laboral_conyugue: "",
          socio_conyugue: 'NO',
          codigo_socio_conyugue: "",
          aporte_socio_conyugue: "",
          conyuge_tiene: 0,
        },
        monto_inicial: "",
        plazo_inicial: "5",
        disponibilidad_pago_inicial: "",
        destino_inicial: "",
        forma_inicial: "DIARIO",
        producto: "CREDIDIARIO",
        forma: "DIARIO",
        meses: 0,
        importe: 0,
        aporte: 0,
        plazo: 0,
        coutas: 0,
        tasa: 0.0,
        comentarios: "",
        estado: "PENDIENTE"
      };
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
          me.form.conyugue.nombres_conyugue = response.data["nombres"] +' '+ response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
    },
    meses_numero(){

        if(this.form.producto=='CREDIDIARIO'){
          console.log('diario')
          this.form.meses = (Number(this.form.plazo)/30).toFixed(2)
        }
        else if(this.form.producto=='CREDISEMANA'){
          this.form.meses = (Number(this.form.plazo)/4).toFixed(2)
        }
        else{
          this.form.meses = (Number(this.form.plazo)/1).toFixed(2)
        }

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
          // me.initForm();
        });
    },
    submit() {
      // if() {
      //       return this.$message.error('Los montos ingresados superan al monto a pagar o son incorrectos');
      //  }
      this.loading_submit=1;

      this.$http
        .post(`/${this.resource}/prestamo`, this.form)
        .then(response => {
          this.$toast.success(
            "El prestamo fue creado",
            "Exitoso",
            this.notificationSystem.options.success
          );
        this.loading_submit=0;
        this.retornar();
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
    retornar() {
      this.backMixin_handleBack();
    }
  },
  mounted() {


    if(this.form.producto=='CREDIDIARIO'){

      this.form.meses = (Number(this.form.plazo)/30).toFixed(2)
    }
    else if(this.form.producto=='CREDISEMANA'){
      this.form.meses = (Number(this.form.plazo)/4).toFixed(2)
    }
    else if(this.form.producto=='MENSUAL'){
      this.form.meses = Number(this.form.plazo)/1 
    }
    
  }
};
</script>
<style lang="scss">
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
