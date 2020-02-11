/<template>
  <div class="create_client_content">
    <section class="tabs_section">
      <div class="tabs_wrapper">
        <div
          class="tab"
          @click="tab = 1"
          :class="[{selected: tab == 1}]"
        >
          <span>1</span>
          <p>SOLICITUD</p>
        </div>
        <div class="tab" @click="validateStep1 ? tab = 2 : tabError()" :class="{selected: tab == 2}"  >
          <span>2</span>
          <p>EMPRESA</p>
        </div>

        <div class="tab" @click=" (validateStep1 && validateStep2) ? tab = 3: tabError()" :class="{selected: tab == 3}" >
          <span>3</span>
          <p>AVAL</p>
        </div>

        <div class="tab" @click="(validateStep1 && validateStep2) ? tab = 4 : tabError()" :class="{selected: tab == 4}">
          <span>4</span>
          <p>GARANTIA</p>
        </div>


        <div class="tab" @click="(validateStep1 && validateStep2) ? tab = 5: tabError()" :class="{selected: tab ==5}" >
          <span>5</span>
          <p>PROPUESTA</p>
        </div>

      </div>
    </section>

    <section class="client_forms">
      <div class="client_forms_wrapper">
        <div v-show="tab == 1" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Solicitud de Crédito</h3>
            <div class="form_content">
              <div class="group_form">
                <div class="input_wrapper" :class="{require: !validateMonto}">
                  <label>Monto</label> 
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="prestamo.monto_inicial"
                    v-bind:precision="2"
                    maxlength='11'
                  ></vue-numeric>
                  <div class="message">Monto de solicitud invalido</div>
                </div>
                <div class="input_wrapper">
                  <label>Forma</label>
                  <select v-model="prestamo.forma_inicial">
                    <option value="DIARIO">DIARIO</option>
                    <option value="SEMANAL">SEMANAL</option>
                    <option value="QUINCENAL">QUINCENAL</option>
                    <option value="MENSUAL">MENSUAL</option>
                  </select>
                </div>
                <div class="input_wrapper">
                  <label>Cuotas</label>
                  <input type="number" v-model="prestamo.cuotas_inicial" maxlength=11  />
                </div>
                <div class="input_wrapper" :class="{require: !validateDiponibilidad}">
                  <label>Disponibilidad de pago</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="prestamo.disponibilidad_pago_inicial"
                    v-bind:precision="2"  
                    maxlength='11'
                  ></vue-numeric> 
                  <div class="message">La disponibilidad es invalida</div>
                </div>
              </div>
              <div class="group_form all">
                <div class="input_wrapper" :class="{require: !validateDestino}">
                  <label>Destino de crédito (propuesta cliente)</label>
                  <textarea  v-model="prestamo.destino_inicial"  />
                  <div class="message">Información de destino es corta</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons all">
            <a class="button_primary medium next" @click=" validateStep1 ? next(1) : tabError()">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>
       
        <!-- Para empresas -->
        <div  v-show="tab == 2" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Datos de la Empresa</h3>
            <div class="form_content">

              <div class="group_form">

                <div class="input_wrapper">
                  <label>Razón Social</label>
                  <input type="text" maxlength='200'  v-model="prestamo.cliente.empresa.razon_social"  disabled/>
                </div>

                <div class="input_wrapper">
                  <label>Ruc</label>
                  <input type="text" maxlength='11'  v-model="prestamo.cliente.documento" disabled/>
                </div>

                <div class="input_wrapper">
                  <label>Nombre comercial</label>
                  <input type="text" maxlength="50" v-model="prestamo.cliente.empresa.nombre_comercial"  />
                </div>

                <div class="input_wrapper" :class="{require: !validateActividad}">
                  <label>Actividad</label>
                  <input type="text" maxlength='200'  v-model="prestamo.cliente.empresa.actividad_principal" />
                  <div class="message">Actividad de la empresa</div>
                </div>

                <div class="input_wrapper" :class="{require: !validatePartida}">
                  <label>Número de partida</label>
                  <input type="text" maxlength='8' v-model="prestamo.cliente.empresa.partida_registral"  />
                  <div class="message">N° de partida la empresa</div>
                </div>
                <div class="input_wrapper">
                  <label>Teléfono</label>
                  <input type="text" maxlength='15' v-model="prestamo.cliente.telefono"  />
                </div>
                <div class="input_wrapper" :class="{require: !validateDireccionEmpresa}">
                  <label>Dirección</label>
                  <input type="text" maxlength='200' v-model="prestamo.cliente.empresa.ubicacion_direccion_declarada"  />
                  <div class="message">Dirección de la emrpesa</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateFechaConstitucion}">
                  <label>Fecha de constitución</label>
                  <input type="date" v-model="prestamo.cliente.empresa.fecha_constitucion"  />
                  <div class="message">Fecha de inicio de la empresa</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateEmail}">
                  <label>Email</label>
                  <input maxlength='50' type="text" v-model="prestamo.cliente.email"  />
                  <div class="message">Ingrese correo de la empresa</div>
                </div>
              </div>

              <span class="separator"></span>

              <div class="group_form">

                <div class="input_wrapper" :class="{require: !validateDocumentoRepresentante}">
                  <label>Documento de Identidad</label>
                  <input
                    type="text"
                    v-model="prestamo.cliente.empresa.representante.documento"
                    @keyup="datosCliente()"
                    v-mask="'########'"
                  /> 
                  <div class="message">Numero de documento del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateNombres}">
                  <label>Nombres y Apellidos</label>
                  <input type="text" maxlength='100' v-model="prestamo.cliente.empresa.representante.nombres" />
                  <div class="message">Nombre del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateNacimiento}">
                  <label>Fecha de Nacimiento</label>
                  <input type="date" v-model="prestamo.cliente.empresa.representante.fecha_nacimiento" />
                  <div class="message">Fecha de nacimiento del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateCivil}">
                  <label>Estado Civil</label>
                  <select v-model="prestamo.cliente.empresa.representante.estado_civil">
                    <option value="SOLTERO">SOLTERO</option>
                    <option value="CASADO">CASADO</option>
                    <option value="CONVIVIENTE">CONVIVIENTE</option>
                    <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                    <option value="VIUDO">VIUDO</option>
                  </select>
                  <div class="message">Estado civil del representante</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateOcupacion}">
                  <label>Ocupación</label>
                  <input type="text" maxlength='50' v-model="prestamo.cliente.empresa.representante.ocupacion" />
                  <div class="message">Ingrese ocupacion del representante</div>
                </div>


                <div class="input_wrapper" >
                  <label>Teléfono</label>
                  <input type="text" maxlength='10' v-model="prestamo.cliente.empresa.representante.telefono" />
                </div>

                <div class="input_wrapper" :class="{require: !validateCelular}">
                  <label>Celular</label>
                  <input
                    type="text"
                    v-mask="'### ### ###'"
                    v-model="prestamo.cliente.empresa.representante.celular_representante"
                  />
                  <div class="message">Ingrese número de celular</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateDireccionRepresentante}">
                  <label>Dirección</label>
                  <input type="text" maxlength='100' v-model="prestamo.cliente.empresa.representante.ubicacion_direccion" />
                  <div class="message">Ingrese su dirección</div>
                </div>
              </div>
              <div class="separator"></div>

              <div class="group_form">


                <div class="input_wrapper" :class="{require: !validateDepartamento}">
                  <label>Departamento</label>
                  <input type="text" v-model="prestamo.cliente.empresa.representante.ubicacion_departamento" />
                  <div class="message">Seleccione departamento</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateProvincia}">
                  <label>Provincia</label>
                  <input type="text" v-model="prestamo.cliente.empresa.representante.ubicacion_provincia" />
                  <div class="message">Seleccione provincia</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateDistrito}">
                  <label>Distrito</label>
                  <input type="text" v-model="prestamo.cliente.empresa.representante.ubicacion_distrito" />
                  <div class="message">Seleccione distrito</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateReferencia}">
                  <label>Referencia</label>
                    <input type="text" maxlength='100' v-model="prestamo.cliente.empresa.representante.ubicacion_referencia" />
                    <div class="message">La referencia es invalido</div>
                </div>


                <div class="input_wrapper" :class="{require: !validateTipoDomicilio}">
                  <label>Tipo Domicilio</label>
                  <select v-model="prestamo.cliente.empresa.representante.tipo_domicilio">
                    <option value="PROPIA">PROPIA</option>
                    <option value="PROPIA HIPOTECA">PROPIA HIPOTECA</option>
                    <option value="DE LOS PADRES">DE LOS PADRES</option>
                    <option value="DE LOS FAMILIARES">DE LOS FAMILIARES</option>
                    <option value="ALQUILADA">ALQUILADA</option>
                  </select>
                  <div class="message">Tipo de vivienda invalido</div>
                </div>

                <div class="input_wrapper" :class="{require: !validatePoderes}">
                  <label>Poderes (Asiento)</label>
                    <input type="text" v-model="prestamo.cliente.empresa.representante.poderes" v-mask="'####'" />
                    <div class="message">Ingrese poderes</div>
                </div>

                <div class="input_wrapper" :class="{require: !validateFechaCargo}">
                  <label>Fecha inicio (Cargo) </label>
                  <input type="date" v-model="prestamo.cliente.empresa.representante.fecha_inicio"/>
                  <div class="message">Fecha incorrecta</div>
                </div>
              </div>
          
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(2)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(2)"  v-if="validateStep1 && validateStep2">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
            <a class="button_primary medium next"  v-else>
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>
        <!-- Fin empresas -->
        <div v-show="tab == 3" class="form_step">
          <div class="form_step_wrapper">
            <div class="form_list no_border" >
              <div class="sub_step_wrapper " v-for="(row, index) in prestamo.avales" :key="index">
                <h3 class="title">
                  Aval {{index + 1}}
                  <button  
                    class="delete_section"
                    type="button"
                    @click.prevent="clickRemoveAval(index)">
                    <i class="material-icons-outlined">delete</i>
                  </button>
                </h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Tipo</label>
                      <select v-model="row.tipo_persona">
                        <option value="pn">Persona Natural</option>
                        <option value="pj">Persona Juridica</option>
                      </select>
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Ruc</label>
                      
                      <input
                        type="text"
                        v-model="row.empresa_ruc"
                        v-mask="'###########'"
                        @keyup='ObtenerDatosAvalEmpresa(row.empresa_ruc,index)'
                      />
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Razon Social</label>
                      <input
                        type="text"
                        maxlength='200'
                        v-model="row.empresa_razon_social"
                      />
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Dirección</label>
                      <input
                        type="text"
                        maxlength='200'
                        v-model="row.empresa_direccion" 
                      />
                    </div>

                  </div>
                  
                  <span class="separator" ></span>

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Documento de Identidad</label>
                      <input
                        type="text"
                        v-model="row.documento"
                        v-mask="'#########'"
                        @change="datosAval(index)"
                      />
                    </div>
                    <div class="input_wrapper">
                      <label>Nombres</label>
                      <input type="text" maxlength="50" v-model="row.nombres" />
                    </div>
                    <div class="input_wrapper">
                      <label>Apellidos</label>
                      <input type="text" maxlength="50" v-model="row.apellidos" />
                    </div>
                    <div class="input_wrapper">
                      <label>Fecha de Nacimiento</label>
                      <input type="date" v-model="row.fecha_nacimiento" />
                    </div>
                    <div class="input_wrapper">
                      <label>Estado Civil</label>
                      <select v-model="row.estado_civil">
                        <option value="SOLTERO">SOLTERO</option>
                        <option value="CASADO">CASADO</option>
                        <option value="CONVIVIENTE">CONVIVIENTE</option>
                        <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                        <option value="VIUDO">VIUDO</option>
                      </select>
                    </div>
                    <div class="input_wrapper">
                      <label>Ocupación</label>
                      <input type="text" maxlength="40" v-model="row.ocupacion" />
                    </div>
                    <div class="input_wrapper">
                      <label>Centro Laboral</label>
                      <input type="text" maxlength="50" v-model="row.centro_laboral" />
                    </div>
                    <div class="input_wrapper">
                      <label>Dirección centro laboral</label>
                      <input type="text" maxlength="100" v-model="row.direccion_centro_laboral" />
                    </div>
                  </div>

                  <span class="separator"></span>

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Socio</label>
                      <select v-model="row.socio">
                        <option value="true">SI</option>
                        <option value="false">NO</option>
                      </select>
                    </div>
                    <div  v-if="row.socio" class="input_wrapper">
                      <label>Codigo</label>
                      <input type="text" v-model="row.codigo_socio"  maxlength='10' />
                    </div>
                    <div  v-if="row.socio" class="input_wrapper">
                      <label>Aporte</label>
                      <vue-numeric
                        currency="S/. "
                        separator=","
                        v-model="row.aporte_socio"
                        v-bind:precision="2"
                      ></vue-numeric>
                    </div>
              
                    <div class="input_wrapper">
                      <label>Teléfono</label>
                      <input type="text" maxlength="10" v-model="row.telefono" />
                    </div>
                    <div class="input_wrapper">
                      <label>Celular</label>
                      <input type="text" v-model="row.celular" v-mask="'### ### ###'" />
                    </div>
                    <div class="input_wrapper">
                      <label>Dirección</label>
                      <input type="text" v-model="row.direccion" maxlength="100" />
                    </div>
                    <div class="input_wrapper">
                      <label>Distrito</label>
                      <input type="text" v-model="row.distrito" maxlength="30" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" @click="clickAddAval" class="add_section" v-if="prestamo.avales.length<=1">
              <span>AGREGAR AVAL</span>
              <i class="material-icons-outlined">add</i> 
            </button>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(3)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click=" (validateStep2 && validateStep1) ? next(3) : tabError()">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 4" class="form_step">
          <div class="form_step_wrapper">
            <div class="form_list no_border">
              <div class="sub_step_wrapper " v-for="(row, index) in prestamo.garantias" :key="index">
                <h3 class="title">
                  Garantia {{index + 1}}
                  <button 
                    class="delete_section"
                    type="button"
                    @click.prevent="clickRemoveGarantia(index)">
                    <i class="material-icons-outlined">delete</i>
                  </button>
                </h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Bien en Garantía</label>
                      <input type="text" maxlength="50" v-model="row.bien_garantia" />
                    </div>
                  </div>
                  <div class="group_form">
                    <div class="input_box no_label">
                      <div class="input_box_wrapper">
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio'+index" :name="'garantiaType'+index" v-model="row.inscripcion" value="1" />
                          <label class="box_content" :for="'radio'+index">
                            <div class="box">
                            </div>
                            <span>Inscripción</span>
                          </label>
                        </div>
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio2'+index" :name="'garantiaType'+index" v-model="row.declaracion_jurada" value="1" />
                          <label class="box_content" :for="'radio2'+index">
                            <div class="box">
                            </div>
                            <span>Declaración Jurada</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" @click="clickAddGarantia" class="add_section" v-if="prestamo.garantias.length<=1">
              <span>AGREGAR GARANTIA</span>
              <i class="material-icons-outlined">add</i> 
            </button>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(4)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click=" (validateStep2 && validateStep1) ? next(4) : tabError()">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 5" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Propuesta de Analista</h3>
            <div class="form_content">
              <div class="group_form">
                <div class="input_wrapper">
                  <label>Producto</label>
                  <select v-model="prestamo.producto" @change="meses_numero">
                    <option value="CREDIDIARIO">CREDIDIARIO</option>
                    <option value="CREDISEMANA">CREDISEMANA</option>
                    <option value="PYME">PYME</option>
                    <option value="PYME ESPECIAL">PYME ESPECIAL</option>
                    <option value="CONSUMO">CONSUMO</option>
                    <option value="CONSUMO ESPECIAL">CONSUMO ESPECIAL</option>
                  </select>
                </div>
                <div class="input_wrapper">
                  <label>Importe</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="prestamo.importe"
                    v-bind:precision="2"
                  ></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Cuotas</label>
                  <input
                    type="number"
                    v-model="prestamo.cuotas"
                    :min="1"
                    :max="48"
                    @keyup="meses_numero"
                  />
                </div>
                <div class="input_wrapper">
                  <label>Meses</label>
                  <input type="text" v-model="prestamo.meses" disabled />
                </div>
                <div class="input_wrapper">
                  <label>Cuota del sistema</label>
                  <vue-numeric v-model="prestamo.cuota_sistema" v-bind:precision="1"></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Aporte a la fecha</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="prestamo.aporte"
                    v-bind:precision="2"
                  ></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Prob. Infocorp</label>
                  <vue-numeric v-model="prestamo.probabilidad_infocorp" v-bind:precision="1"></vue-numeric>
                </div>
              </div>

              <div class="group_form all">
                <div class="input_wrapper">
                  <label>Comentarios</label>
                  <textarea type="text" v-model="prestamo.comentarios"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(5)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click.prevent=" (validateStep2 && validateStep1) ? registrar() : tabError()" :class="{loading: loading}">
              <div class="load_spinner"></div>
              <span>FINALIZAR</span>
              <i class="material-icons-outlined">check</i>
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
import VueNumeric from "vue-numeric";
 import { toastOptions } from '../constants.js'

export default {
  mixins: [serviceNumber],
  components: { VueNumeric },
  data() {
    return {
      resource: "clientes",
      tab: 1,
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provincesTitular: [],
      districtsTitular: [],
      errors: {},
      tools:{
        tiene_conyuge:false,      
      },
      prestamo: {
        id: 0, 
        garantias: [],
        avales: [],
        cliente: {
          ubicacion_departamento: "",
          ubicacion_provincia: "",
          ubicacion_distrito: "",
          ubicacion_referencia: "",
          ubicacion_direccion_declarada: "",
          documento:'',
          telefono: "",
          celular: "",
          empresa: {
            razon_social: "",
            nombre_comercial: "",
            actividad_principal: "",
            partida_registral: "",
            fecha_constitucion: "",
            representante: {
              documento: "",
              nombres: "",
              fecha_nacimiento: "",
              estado_civil: "SOLTERO",
              ocupacion: "",
              telefono: "",
              celular: "",
              ubicacion_direccion:"",
              ubicacion_departamento: "",
              ubicacion_provincia: "",
              ubicacion_distrito: "",
              ubicacion_referencia: "",
              tipo_domicilio:'PROPIA',
              poderes:'',
              fecha_inicio:'',             
            },
          },
        },
        monto_inicial: "",
        cuotas_inicial: "5",
        disponibilidad_pago_inicial: "",
        destino_inicial: "",
        forma_inicial: "DIARIO",
        producto: "CREDIDIARIO",
        forma: "DIARIO",
        meses: 0,
        importe: 0,
        aporte: 0,
        cuotas: 0,
        cuota_sistema:0,
        tasa: 0.0,
        comentarios: "",
        estado: "PROCESO"
      },
      contador_aval: 0,
      loading: false,
      contador_garantia: 0, 
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
  computed: {
    
    validateMonto() {
      return String(this.prestamo.monto_inicial).length > 1
    },
    validateDiponibilidad() {
      return String(this.prestamo.disponibilidad_pago_inicial).length > 1
    },
    validateDestino() {
      return this.prestamo.destino_inicial.length > 6
    },
    validateStep1() {
      return this.validateMonto && this.validateDiponibilidad && this.validateDestino;
    },   
    validateActividad(){
      return true
    },
    validatePartida(){
      return true
    },
    validateNombres(){
      return true
    },  
    validateDireccionEmpresa(){
      return true
    },
    validateDireccionRepresentante(){
      return true
    },
    validateTipoDomicilio(){
      return true
    },
    validatePoderes(){
      return true
    },
    validateFechaConstitucion(){
      return true
    },
    validateFechaCargo(){
      return true
    },
    validateEmail(){
      return true
    },
    validateDocumentoRepresentante(){
      return true
    },
    validateDocumento(){
      return this.prestamo.cliente.documento.length>=8
    }
    ,
    validateNacimiento(){
      if(this.prestamo.cliente.empresa.representante.fecha_nacimiento)
      return this.prestamo.cliente.empresa.representante.fecha_nacimiento.length>4
      else return true
    }
    ,
    validateCivil(){
      
      if(this.prestamo.cliente.empresa.representante.estado_civil)
        return this.prestamo.cliente.empresa.representante.estado_civil.length>5
    }
    ,
    validateOcupacion(){
      if(this.prestamo.cliente.empresa.representante.ocupacion)
      return this.prestamo.cliente.empresa.representante.ocupacion.length>4
    }
    ,
    validateCelular(){
      return  this.prestamo.cliente.celular.length>9
    }
    ,
    validateDireccion(){
      return  this.prestamo.cliente.ubicacion_direccion_declarada.length>5
    }
    ,
    validateDepartamento(){
      return true
    }
    ,
    validateProvincia(){
      return true
    }
    ,
    validateDistrito(){
      return true
    }
    ,
    validateReferencia(){
      return this.prestamo.cliente.ubicacion_referencia.length>5
    }
    ,
    validateCentro(){
      if(this.prestamo.cliente.empresa.trabajo)
      return this.prestamo.cliente.empresa.trabajo.empresa_razon_social.length>5
      else return true
    }
    ,
    validateDireccionLaboral(){
      if(this.prestamo.cliente.empresa.trabajo)
      return this.prestamo.cliente.empresa.trabajo.empresa_direccion.length>6
      else return true
    },


     validateDocumentoConyuge(){
      return String(this.prestamo.cliente.empresa.conyuge.documento).length > 6
    },

     validateNombreConyuge(){
      return this.prestamo.cliente.empresa.conyuge.nombres.length>6
    },

     validateNacimientoConyuge(){
      return this.prestamo.cliente.empresa.conyuge.fecha_nacimiento.length>6
    },

     validateOcupacionConyuge(){
      if(this.prestamo.cliente.empresa.conyuge && this.prestamo.cliente.empresa.conyuge.ocupacion)
        return this.prestamo.cliente.empresa.conyuge.ocupacion.length>6
      else true
    },

    validateCelularConyuge(){
      if(this.prestamo.cliente.empresa.conyuge && this.prestamo.cliente.empresa.conyuge.celular)
      return this.prestamo.cliente.empresa.conyuge.celular.length>6
      else true
    },
    validateCodigoConyuge(){
      if(this.prestamo.cliente.empresa.conyuge.socio && this.prestamo.cliente.empresa.conyuge.codigo_socio){
        return this.prestamo.cliente.empresa.conyuge.codigo_socio.length>=3
      }
      else return true
    },
    validateAporteConyuge(){
      if(this.prestamo.cliente.empresa.conyuge.socio){
        return String(this.prestamo.cliente.empresa.conyuge.aporte_socio)>=1
      }
      else return true
    },
    validateCentroConyuge(){
      return this.prestamo.cliente.empresa.conyuge.centro_laboral.length>6
    },

    validateDireccionConyuge(){
      return this.prestamo.cliente.empresa.conyuge.direccion_centro_laboral.length>6
    },

    validateStep2(){

        return this.validateNombres && this.validateDocumento && this.validateNacimiento &&
             this.validateCivil && this.validateOcupacion && 
             this.validateCelular && this.validateDireccion && 
             this.validateDepartamento && this.validateProvincia &&
             this.validateDistrito && this.validateReferencia && 
             this.validateCentro && this.validateDireccionLaboral

    }


  },
  async created() { 
    await this.obtenerDatosCliente()
    // this.clickAddAval()
    // this.clickAddGarantia()

  
  },

  methods: {
    obtenerDatosCliente(){
      this.$http
      .get(`/clientes/` + this.$route.params.clienteID)
      .then(response => { 
        console.log("respose")  
        console.log(response)
        this.prestamo.cliente=response.data
        console.log(this.prestamo)
      });
    },
    tabError(){
       this.$toast.error(
          "Rellene los datos necesarios",
          "Error",
          toastOptions.error
        )
    },
    filterProvincesTitularMe() {
          // this.prestamo.cliente.empresa.domicilio_provincia= '0'
          // this.prestamo.cliente.empresa.domicilio_distrito= '0'
          this.provincesTitular = this.all_provinces.filter(f => {
              return f.departamento_id == this.prestamo.cliente.ubicacion_departamento
          })
      },
    filterDistrictTitularMe() {
        // this.prestamo.cliente.domicilio_distrito= '0'
        this.districtsTitular = this.all_districts.filter(f => {
            return f.provincia_id == this.prestamo.cliente.ubicacion_provincia
        })
    },
    next(index) {
      window.scrollTo(0,0)
      this.tab = index + 1
    },
    prev(index) {
      window.scrollTo(0,0)
      this.tab = index - 1
    },  
    clickAddAval() { 
      this.prestamo.avales.push({
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
        direccion_centro_laboral: "",
        socio: false,
        codigo_socio: "",
        aporte_socio: "",
        tipo_persona: "pn",
        empresa_ruc:'',
        empresa_razon_social:'',
        empresa_direccion:''
      });
    },
    clickRemoveAval(index) {
      this.prestamo.avales.splice(index, 1);
    },
    clickAddGarantia() {
      this.prestamo.garantias.push({
        bien_garantia: "",
        tipo: ""
      });
    },
    clickRemoveGarantia(index) {
      this.prestamo.garantias.splice(index, 1);
    },
  
    datosCliente() {
      let me = this;
      // me.loader = "true";
      if(this.prestamo.cliente.empresa.representante.documento.length>7){
        axios
        .post("/consulta/doc", {
          documento: this.prestamo.cliente.empresa.representante.documento
        })
        .then(function(response) { 
          if(response.data)
          me.prestamo.cliente.empresa.representante.nombres =
            response.data["nombres"] + " " + response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
      }
    },
    meses_numero() {
      console.log("si viene");
      if (this.prestamo.producto == "CREDIDIARIO") { 
        this.prestamo.meses = (Number(this.prestamo.cuotas) / 30).toFixed(2);
      } else if (this.prestamo.producto == "CREDISEMANA") {
        this.prestamo.meses = (Number(this.prestamo.cuotas) / 4).toFixed(2);
      } else {
        this.prestamo.meses = (Number(this.prestamo.cuotas) / 1).toFixed(2);
      }
    },
    ObtenerDatosAvalEmpresa(ruc,index){
      
      if(ruc.length==11){
          let me = this;
          axios
            .post("/consulta/doc", {
              documento: ruc
            })
            .then(function(response) {          
              if(response.data){
                  
                 me.prestamo.avales[index].empresa_razon_social=response.data.RAZON
                 me.prestamo.avales[index].empresa_direccion=response.data.DIRECCION
              }
            })
            .catch(function(error) {
              console.log(error);
        });
        console.log()
      }
    },
    datosAval(index) {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/doc", {
          documento: this.prestamo.avales[index].documento
        })
        .then(function(response) { 
          me.prestamo.avales[index].nombres = response.data["nombres"];
          me.prestamo.avales[index].apellidos = response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
    },
    registrar() {
      this.loading= true
      this.$http
        .post(`/prestamos`, this.prestamo)
        .then(response => {

            this.loading = false
            if(response.data.success){
                this.$toast.success(
                    "El prestamo fue creado",
                    "Exitoso",
                    toastOptions.success
                  )
              this.$router.push({ name: 'perfil', params: { documento: this.$route.params.dni, empresa: 'PN' }})
            }else{
                this.$toast.error(
                  "No se pudo crear prestamo",
                  "Error",
                  toastOptions.error
                )
            }

        })

        .catch(err=>{
          this.loading=false
          this.$toast.error(
            "Error en el registro",
            "Error",
            toastOptions.error
          )
        });
    },
    retornar() {
      this.backMixin_handleBack("/perfil/" + this.prestamo.cliente.documento);
    }
  },
  async mounted() {

    await this.$http.get(`/ubigeo`).then(response => {
        this.all_departments = response.data.departments;
        this.all_provinces = response.data.provinces;
        this.all_districts = response.data.districts; 
        
    });

    await this.filterProvincesTitularMe()
    await this.filterDistrictTitularMe()

    if (this.prestamo.producto == "CREDIDIARIO") {
      this.prestamo.meses = (Number(this.prestamo.cuotas) / 30).toFixed(2);
    } else if (this.prestamo.producto == "CREDISEMANA") {
      this.prestamo.meses = (Number(this.prestamo.cuotas) / 4).toFixed(2);
    } else if (this.prestamo.producto == "MENSUAL") {
      this.prestamo.meses = Number(this.prestamo.cuotas) / 1;
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
