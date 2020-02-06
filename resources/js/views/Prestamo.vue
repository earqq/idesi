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
        <div class="tab" @click="tab = 2" :class="{selected: tab == 2}" v-if="validateStep1">
          <span>2</span>
          <p>CLIENTE</p>
        </div>

        <div class="tab" v-else>
          <span>2</span>
          <p>CLIENTE</p>
        </div>

        <div class="tab" @click="tab = 3" :class="{selected: tab == 3}" v-if="validateStep1 && validateStep2">
          <span>3</span>
          <p>AVAL</p>
        </div>

        <div class="tab"  v-else>
          <span>3</span>
          <p>AVAL</p>
        </div>

        <div class="tab" @click="tab = 4" :class="{selected: tab == 4}" v-if="validateStep1 && validateStep2">
          <span>4</span>
          <p>GARANTIA</p>
        </div>

        <div class="tab" v-else>
          <span>4</span>
          <p>GARANTIA</p>
        </div>


        <div class="tab" @click="tab = 5" :class="{selected: tab ==5}" v-if="validateStep1 && validateStep2">
          <span>5</span>
          <p>PROPUESTA</p>
        </div>
        <div class="tab" v-else>
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
                    v-model="form.monto_inicial"
                    v-bind:precision="2"
                  ></vue-numeric>
                  <div class="message">Monto de solicitud invalido</div>
                </div>
                <div class="input_wrapper">
                  <label>Forma</label>
                  <select v-model="form.forma_inicial">
                    <option value="DIARIO">DIARIO</option>
                    <option value="SEMANAL">SEMANAL</option>
                    <option value="QUINCENAL">QUINCENAL</option>
                    <option value="MENSUAL">MENSUAL</option>
                  </select>
                </div>
                <div class="input_wrapper">
                  <label>Cuotas</label>
                  <input type="number" v-model="form.plazo_inicial"  />
                </div>
                <div class="input_wrapper" :class="{require: !validateDiponibilidad}">
                  <label>Disponibilidad de pago</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="form.disponibilidad_pago_inicial"
                    v-bind:precision="2"
                  ></vue-numeric> 
                  <div class="message">La disponibilidad es invalida</div>
                </div>
              </div>
              <div class="group_form all">
                <div class="input_wrapper" :class="{require: !validateDestino}">
                  <label>Destino de crédito (propuesta cliente)</label>
                  <textarea  v-model="form.destino_inicial"  />
                  <div class="message">Información de destino es corta</div>
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons all">
            <a class="button_primary medium next" @click="next(1)" v-if="validateStep1">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
            <a class="button_primary medium next" v-else>
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 2" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Datos del Titular</h3>
            <div class="form_content">
              <div class="group_form">
                <div class="input_wrapper" :class="{require: !validateNombre}">
                  <label>Nombres</label>
                  <input type="text" v-model="form.natural.nombres" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateApellidos}">
                  <label>Apellidos</label>
                  <input type="text" v-model="form.natural.apellidos" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDocumento}">
                  <label>Documento</label>
                  <input type="text" v-model="form.cliente.documento" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateNacimiento}">
                  <label>Fecha de nacimiento</label>
                  <input type="date" v-model="form.natural.nacimiento" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateCivil}">
                  <label>Estado Civil</label>
                  <select v-model="form.natural.estado_civil">
                    <option value="SOLTERO">SOLTERO</option>
                    <option value="CASADO">CASADO</option>
                    <option value="CONVIVIENTE">CONVIVIENTE</option>
                    <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                    <option value="VIUDO">VIUDO</option>
                  </select>
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateOcupacion}">
                  <label>Ocupación</label>
                  <input type="text" v-model="form.natural.ocupacion" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" >
                  <label>Teléfono</label>
                  <input type="text" v-model="form.natural.telefono" />
                </div>
                <div class="input_wrapper" :class="{require: !validateCelular}">
                  <label>Celular</label>
                  <input type="text" v-mask="'### ### ###'" v-model="form.natural.celular" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDireccion}">
                  <label>Dirección Consignado</label>
                  <input type="text" v-model="form.natural.direccion" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper">
                  <label>Dirección Reniec</label>
                  <input type="text" disabled />
                </div>
              </div>

              <span class="separator"></span>

              <div class="group_form">
                <div class="input_wrapper" :class="{require: !validateDepartamento}">
                  <label>Departamento</label>
                   <select
                        v-model="form.natural.domicilio_departamento"
                        
                        @change="filterProvincesTitularMe"
                        dusk="departamentos_id">
                      <option value="0">SELECCIONE</option>
                      <option
                        v-for="option in all_departments"
                        :key="option.id"
                        :value="option.id"
                        :label="option.descripcion"
                      >></option>
                  </select>
                  <!-- <input type="text" v-model="form.natural.domicilio_departamento" /> -->
                </div>
                <div class="input_wrapper" :class="{require: !validateProvincia}">
                  <label>Provincia</label> 
                  <select
                      v-model="form.natural.domicilio_provincia"
                      filterable
                      @change="filterDistrictTitularMe"
                      dusk="provincias_id">
                      <option value="0">SELECCIONE</option>
                      <option
                        v-for="option in provincesTitular"
                        :key="option.id"
                        :value="option.id"
                        :label="option.descripcion"
                      >></option>
                  </select>
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDistrito}">
                  <label>Distrito</label>
                  <select
                        v-model="form.natural.domicilio_distrito"
                        filterable
                        dusk="distritos_id">
                        <option value="0">SELECCIONE</option>
                      <option
                        v-for="option in districtsTitular"
                        :key="option.id"
                        :value="option.id"
                        :label="option.descripcion"
                      >></option>
                    </select> 
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateReferencia}">
                  <label>Referencia</label>
                  <input type="text" v-model="form.natural.referencia" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDomicilio}">
                  <label>Tipo Domicilio</label>
                  <select v-model="form.natural.tipo_domicilio">
                    <option value="PROPIA">PROPIA</option>
                    <option value="PROPIA HIPOTECA">PROPIA HIPOTECA</option>
                    <option value="DE LOS PADRES">DE LOS PADRES</option>
                    <option value="DE LOS FAMILIARES">DE LOS FAMILIARES</option>
                    <option value="ALQUILADA">ALQUILADA</option>
                  </select>
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateCentro}">
                  <label>Centro Laboral</label>
                  <input type="text" v-model="form.natural.centro_laboral" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDireccionLaboral}">
                  <label>Dirección centro laboral</label>
                  <input type="text" v-model="form.natural.direccion_laboral" />
                  <div class="message">Se requiere esta información</div>
                </div>
              </div>
            </div>
          </div>
          <button
            type="button"
            @click.prevent="clickAddconyuge"
            class="add_section in_bottom"
            v-if="form.conyugue.conyuge_tiene=='NO'">
            <span>AGREGAR CÓNYUGE O CONVIVIENTE</span>
            <i class="material-icons-outlined">add</i> 
          </button>

          <div class="form_list " v-if="form.conyugue.conyuge_tiene=='SI'">
            <div class="form_step_wrapper in_bottom" >
              <h3 class="title">
                CÓNYUGE o Conviviente
                <button  class="delete_section" type="button"  @click.prevent="clickRemoveconyuge()">
                  <i class="material-icons-outlined"> delete </i>
                </button>
              </h3>
              <div class="form_content" >
                <div class="group_form" >
                  <div class="input_wrapper"  :class="{require: !validateDocumentoConyuge}">
                    <label>Documento de Identidad</label>
                    <input
                      type="text"
                      v-model="form.conyugue.documento_conyugue"
                      @change="datosCliente()"
                      v-mask="'########'"
                    />
                    <div class="message">número de documento inválido</div>
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateNombreConyuge}">
                    <label>Nombres y Apellidos</label>
                    <input type="text" v-model="form.conyugue.nombres_conyugue" />
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateNacimientoConyuge}">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" v-model="form.conyugue.nacimiento_conyugue" />
                  </div>
                  <div class="input_wrapper">
                    <label>Estado Civil</label>
                    <select v-model="form.conyugue.estado_civil_conyugue">
                      <option value="SOLTERO">SOLTERO</option>
                      <option value="CASADO">CASADO</option>
                      <option value="CONVIVIENTE">CONVIVIENTE</option>
                      <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                      <option value="VIUDO">VIUDO</option>
                    </select>
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateOcupacionConyuge}">
                    <label>Ocupación</label>
                    <input type="text" v-model="form.conyugue.ocupacion_conyugue" />
                  </div>
                  <div class="input_wrapper">
                    <label>Socio</label>
                    <select v-model="form.conyugue.socio_conyugue">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                  <div class="input_wrapper" :class="{require: !validateCodigoConyuge}" v-if="form.conyugue.socio_conyugue=='SI'" >
                    <label>Código</label>
                    <input  type="text"  v-model="form.conyugue.codigo_socio_conyugue"/>
                  </div>
                  <div class="input_wrapper" v-else>
                    <label>Código</label>
                    <input type="text" disabled />
                  </div>
                  <div class="input_wrapper" :class="{require: !validateAporteConyuge}" v-if="form.conyugue.socio_conyugue=='SI'">
                    <label>Aporte</label>
                    <vue-numeric currency="S/. " separator="," v-model="form.conyugue.aporte_socio_conyugue" v-bind:precision="2"></vue-numeric>
                  </div>
                  <div class="input_wrapper" v-else>
                    <label>Aporte</label>
                    <input type="text" disabled/>
                  </div>
                  <div class="input_wrapper">
                    <label>Teléfono</label>
                    <input type="text" v-model="form.conyugue.telefono_conyugue" />
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateCelularConyuge}">
                    <label>Celular</label>
                    <input  type="text"  v-mask="'### ### ###'"  v-model="form.conyugue.celular_conyugue" />
                  </div>
                  <div class="input_wrapper" >
                    <label>¿Trabaja?</label>
                    <select v-model="form.conyugue.trabaja_conyugue">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateCentroConyuge}" v-if="form.conyugue.trabaja_conyugue=='SI'">
                    <label>Centro Laboral</label>
                    <input type="text" v-model="form.conyugue.centro_laboral_conyugue" />
                  </div>
                  <div class="input_wrapper" v-else>
                    <label>Centro Laboral</label>
                    <input type="text" disabled />
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateDireccionConyuge}" v-if="form.conyugue.trabaja_conyugue=='SI'">
                    <label>Dirección centro laboral</label>
                    <input type="text" v-model="form.conyugue.direccion_laboral_conyugue" />
                  </div>
                  <div class="input_wrapper"  v-else>
                    <label>Dirección centro laboral</label>
                    <input type="text"/>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(2)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(2)" v-if="validateStep2 && validateStep1">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
            <a class="button_primary medium next" v-else>
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 3" class="form_step">
          <div class="form_step_wrapper">
            <div class="form_list no_border" >
              <div class="sub_step_wrapper " v-for="(row, index) in form.avals" :key="index">
                <h3 class="title">
                  Aval {{index + 1}}
                  <button v-if="index > 0"
                    class="delete_section"
                    type="button"
                    @click.prevent="clickRemoveAval(index)">
                    <i class="material-icons-outlined">delete</i>
                  </button>
                </h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Tipo Persona</label>
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
                      />
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Razon Social</label>
                      <input
                        type="text"
                        v-model="row.empresa_razon_social"
                      />
                    </div>

                    <div class="input_wrapper" v-if="row.tipo_persona=='pj'">
                      <label>Dirección</label>
                      <input
                        type="text"
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
                        v-mask="'########'"
                        @change="datosAval(index)"
                      />
                    </div>
                    <div class="input_wrapper">
                      <label>Nombres</label>
                      <input type="text" v-model="row.nombres" />
                    </div>
                    <div class="input_wrapper">
                      <label>Apellidos</label>
                      <input type="text" v-model="row.apellidos" />
                    </div>
                    <div class="input_wrapper">
                      <label>Fecha de Nacimiento</label>
                      <input type="date" v-model="row.nacimiento" />
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
                      <input type="text" v-model="row.ocupacion" />
                    </div>
                    <div class="input_wrapper">
                      <label>Centro Laboral</label>
                      <input type="text" v-model="row.centro_laboral" />
                    </div>
                    <div class="input_wrapper">
                      <label>Dirección centro laboral</label>
                      <input type="text" v-model="row.direccion_laboral" />
                    </div>
                  </div>

                  <span class="separator"></span>

                  <div class="group_form">
                    <div class="input_wrapper">
                      <label>Socio</label>
                      <select v-model="row.socio">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                    <div class="input_wrapper">
                      <label>Codigo</label>
                      <input type="text" v-model="row.codigo_socio" v-if="row.socio=='SI'" />
                      <input type="text" v-else disabled />
                    </div>
                    <div class="input_wrapper">
                      <label>Aporte</label>
                      <vue-numeric
                        currency="S/. "
                        separator=","
                        v-model="row.aporte_socio"
                        v-bind:precision="2"
                        v-if="row.socio=='SI'"
                      ></vue-numeric>
                      <input type="text" v-else disabled />
                    </div>
              
                    <div class="input_wrapper">
                      <label>Teléfono</label>
                      <input type="text" v-model="row.telefono" />
                    </div>
                    <div class="input_wrapper">
                      <label>Celular</label>
                      <input type="text" v-model="row.celular" v-mask="'### ### ###'" />
                    </div>
                    <div class="input_wrapper">
                      <label>Dirección</label>
                      <input type="text" v-model="row.direccion" />
                    </div>
                    <div class="input_wrapper">
                      <label>Distrito</label>
                      <input type="text" v-model="row.distrito" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="button" @click="clickAddAval" class="add_section">
              <span>AGREGAR AVAL</span>
              <i class="material-icons-outlined">add</i> 
            </button>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(3)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(3)">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 4" class="form_step">
          <div class="form_step_wrapper">
            <div class="form_list no_border">
              <div class="sub_step_wrapper " v-for="(row, index) in form.garantias" :key="index">
                <h3 class="title">
                  Garantia {{index + 1}}
                  <button
                    v-if="index > 0"
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
                      <input type="text" v-model="row.bien_garantia" />
                    </div>
                  </div>
                  <div class="group_form">
                    <div class="input_box no_label">
                      <div class="input_box_wrapper">
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio'+index" :name="'garantiaType'+index" v-model="row.tipo" :value="'INS'" />
                          <label class="box_content" :for="'radio'+index">
                            <div class="box">
                            </div>
                            <span>Inscripción</span>
                          </label>
                        </div>
                        <div class="input_checkbox_wrapper radio" >
                          <input type="radio" :id="'radio2'+index" :name="'garantiaType'+index" v-model="row.tipo" :value="'DJ'" />
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

            <button type="button" @click="clickAddGarantia" class="add_section">
              <span>AGREGAR GARANTIA</span>
              <i class="material-icons-outlined">add</i> 
            </button>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(4)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click="next(4)">
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
                  <select v-model="form.producto" @change="meses_numero">
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
                    v-model="form.importe"
                    v-bind:precision="2"
                  ></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Cuotas</label>
                  <input
                    type="number"
                    v-model="form.plazo"
                    :min="1"
                    :max="48"
                    @keyup="meses_numero"
                  />
                </div>
                <div class="input_wrapper">
                  <label>Meses</label>
                  <input type="text" v-model="form.meses" disabled />
                </div>
                <div class="input_wrapper">
                  <label>Cuota del sistema</label>
                  <vue-numeric v-model="form.cuotas" v-bind:precision="1"></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Aporte a la fecha</label>
                  <vue-numeric
                    currency="S/. "
                    separator=","
                    v-model="form.aporte"
                    v-bind:precision="2"
                  ></vue-numeric>
                </div>
                <div class="input_wrapper">
                  <label>Prob. Infocorp</label>
                  <vue-numeric v-model="form.probabilidad_infocorp" v-bind:precision="1"></vue-numeric>
                </div>
              </div>

              <div class="group_form all">
                <div class="input_wrapper">
                  <label>Comentarios</label>
                  <textarea type="text" v-model="form.comentarios"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(5)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click.prevent="submit()" :class="{loading: loading}">
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
      form: {
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
          tipo_domicilio: "PROPIA",
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
          trabaja_conyugue: "SI",
          celular_conyugue: "",
          centro_laboral_conyugue: "",
          direccion_laboral_conyugue: "",
          socio_conyugue: "SI",
          codigo_socio_conyugue: "",
          aporte_socio_conyugue: "",
          conyuge_tiene: 0
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
        estado: "PENDIENTE"},
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
      return String(this.form.monto_inicial).length > 1
    },
    validateDiponibilidad() {
      return String(this.form.disponibilidad_pago_inicial).length > 1
    },
    validateDestino() {
      return this.form.destino_inicial.length > 6
    },
    validateStep1() {
      return this.validateMonto && this.validateDiponibilidad && this.validateDestino;
    },
    validateNombre(){
      return this.form.natural.nombres.length>4;
    }
    ,
    validateApellidos(){
      return this.form.natural.apellidos.length>5;
    }
    ,
    validateDocumento(){
      return this.form.cliente.documento.length>=8
    }
    ,
    validateNacimiento(){
      return this.form.natural.nacimiento.length>4
    }
    ,
    validateCivil(){
      return this.form.natural.estado_civil.length>5
    }
    ,
    validateOcupacion(){
      return this.form.natural.ocupacion.length>4
    }
    ,
    validateCelular(){
      return  this.form.natural.celular.length>9
    }
    ,
    validateDireccion(){
      return  this.form.natural.direccion.length>5
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
      return this.form.natural.referencia.length>5
    }
    ,
    validateDomicilio(){
      return this.form.natural.tipo_domicilio.length>5
    }
    ,
    validateCentro(){
      return this.form.natural.centro_laboral.length>5
    }
    ,
    validateDireccionLaboral(){
      return this.form.natural.direccion_laboral.length>6
    },


     validateDocumentoConyuge(){
      return this.form.conyugue.documento_conyugue.length>=8
    },

     validateNombreConyuge(){
      return this.form.conyugue.nombres_conyugue.length>6
    },

     validateNacimientoConyuge(){
      return this.form.conyugue.nacimiento_conyugue.length>6
    },

     validateOcupacionConyuge(){
      return this.form.conyugue.ocupacion_conyugue.length>6
    },

     validateCelularConyuge(){
      return this.form.conyugue.celular_conyugue.length>6
    },
     validateCodigoConyuge(){
      return this.form.conyugue.codigo_socio_conyugue.length>=3
    },
     validateAporteConyuge(){
      return String(this.form.conyugue.aporte_socio_conyugue).length>=1
    },
     validateCentroConyuge(){
      return this.form.conyugue.centro_laboral_conyugue.length>6
    },

     validateDireccionConyuge(){
      return this.form.conyugue.direccion_laboral_conyugue.length>6
    },

    validateStep2(){
      if(this.form.conyugue.conyuge_tiene=='SI'){

          return this.validateNombre && this.validateApellidos && 
             this.validateDocumento && this.validateNacimiento &&
             this.validateCivil && this.validateOcupacion && 
             this.validateCelular && this.validateDireccion && 
             this.validateDepartamento && this.validateProvincia &&
             this.validateDistrito && this.validateReferencia && 
             this.validateDomicilio && this.validateCentro && 
             this.validateDireccionLaboral &&
              this.validateDocumentoConyuge &&
              this.validateNombreConyuge &&
              this.validateNacimientoConyuge &&
              this.validateOcupacionConyuge &&
              this.validateCelularConyuge &&
              this.validateCodigoConyuge &&
              this.validateAporteConyuge &&
              this.validateCentroConyuge &&
              this.validateDireccionConyuge

      }
      else{
        return this.validateNombre && this.validateApellidos && 
             this.validateDocumento && this.validateNacimiento &&
             this.validateCivil && this.validateOcupacion && 
             this.validateCelular && this.validateDireccion && 
             this.validateDepartamento && this.validateProvincia &&
             this.validateDistrito && this.validateReferencia && 
             this.validateDomicilio && this.validateCentro && 
             this.validateDireccionLaboral
      }

    }


  },
  created() { 
    this.clickAddAval()
    this.clickAddGarantia()

    this.$http
      .get(`/${this.resource}/datos/prestamo/` + this.$route.params.dni)
      .then(response => { 

        this.form.cliente.departamento =
          response.data["cliente"]["departamento"] || "";
        this.form.cliente.provincia = response.data["cliente"]["provincia"] || "" 
        this.form.cliente.distrito = response.data["cliente"]["distrito"] || ""
        this.form.natural.estado_civil = response.data["natural"]["estado_civil"] || ""
        this.form.natural.ocupacion = response.data["natural"]["ocupacion"] || ""
        this.form.natural.domicilio_distrito = response.data["natural"]["domicilio_distrito"] || ""
        this.form.natural.domicilio_provincia = response.data["natural"]["domicilio_provincia"] || ""
        this.form.natural.domicilio_departamento = response.data["natural"]["domicilio_departamento"] || ""
        this.form.natural.telefono = response.data["natural"]["telefono"] || ""
        this.form.natural.celular = response.data["natural"]["celular"] || ""
        this.form.natural.nombres = response.data["natural"]["nombres"] || ""
        this.form.natural.apellidos = response.data["natural"]["apellidos"] || ""
        this.form.natural.nacimiento = response.data["natural"]["nacimiento"] || ""
        this.form.natural.direccion = response.data["natural"]["direccion_cliente"] || ""
        this.form.natural.referencia = response.data["natural"]["referencia"] || ""
        this.form.natural.tipo_domicilio = response.data["natural"]["tipo_domicilio"] || ""
        this.form.natural.centro_laboral = response.data["natural"]["centro_laboral"] || ""
        this.form.natural.direccion_laboral = response.data["natural"]["direccion_laboral"] || ""

        if (response.data["tiene_conyuge"] == "SI") { 
          this.form.conyugue.documento_conyugue = response.data["conyugue"]["documento"] || "";
          this.form.conyugue.nombres_conyugue = response.data["conyugue"]["nombres"] || "";
          this.form.conyugue.nacimiento_conyugue = response.data["conyugue"]["nacimiento"] || "";
          this.form.conyugue.estado_civil_conyugue =  response.data["conyugue"]["estado_civil"] || "";
          this.form.conyugue.ocupacion_conyugue = response.data["conyugue"]["ocupacion"] || "";
          this.form.conyugue.telefono_conyugue = response.data["conyugue"]["telefono"] || "";
          this.form.conyugue.trabaja_conyugue = response.data["conyugue"]["trabaja"] || 'SI';
          this.form.conyugue.celular_conyugue = response.data["conyugue"]["celular"] || "";
          this.form.conyugue.centro_laboral_conyugue = response.data["conyugue"]["centro_laboral"] || "";
          this.form.conyugue.direccion_laboral_conyugue = response.data["conyugue"]["direccion"] || "";
          this.form.conyugue.socio_conyugue = response.data["conyugue"]["socio"] || "SI";
          this.form.conyugue.codigo_socio_conyugue = response.data["conyugue"]["codigo_socio"] || "";
          this.form.conyugue.aporte_socio_conyugue = response.data["conyugue"]["aporte_socio"] || "";
          this.form.conyugue.conyuge_tiene = "SI";
        } else {
          this.form.conyugue.conyuge_tiene = "NO"; 
        }
      });
  },

  methods: {
    filterProvincesTitularMe() {
          // this.form.natural.domicilio_provincia= '0'
          // this.form.natural.domicilio_distrito= '0'
          this.provincesTitular = this.all_provinces.filter(f => {
              return f.departamento_id == this.form.natural.domicilio_departamento
          })
      },
      filterDistrictTitularMe() {
          // this.form.natural.domicilio_distrito= '0'
          this.districtsTitular = this.all_districts.filter(f => {
              return f.provincia_id == this.form.natural.domicilio_provincia
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
    clickAddconyuge() {
      this.form.conyugue.conyuge_tiene = "SI";
    },
    clickRemoveconyuge() {
      this.form.conyugue.conyuge_tiene = "NO";
    },
    clickAddAval() { 
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
        socio: "NO",
        codigo_socio: "",
        aporte_socio: "",
        tipo_persona: "pn",
        empresa_ruc:'',
        empresa_razon_social:'',
        empresa_direccion:''
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
      // this.initForm();
    },
    // initForm() {
    //   this.errors = {};
    //   this.form = {
        
    //   }
    // },
    datosCliente() {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/doc", {
          documento: this.form.conyugue.documento_conyugue
        })
        .then(function(response) { 
          me.form.conyugue.nombres_conyugue =
            response.data["nombres"] + " " + response.data["surnames"];

          // me.loader = false;
        })
        .catch(function(error) {
          console.log(error);
          // me.initForm();
        });
    },
    meses_numero() {
      if (this.form.producto == "CREDIDIARIO") { 
        this.form.meses = (Number(this.form.plazo) / 30).toFixed(2);
      } else if (this.form.producto == "CREDISEMANA") {
        this.form.meses = (Number(this.form.plazo) / 4).toFixed(2);
      } else {
        this.form.meses = (Number(this.form.plazo) / 1).toFixed(2);
      }
    },
    datosAval(index) {
      let me = this;
      // me.loader = "true";
      axios
        .post("/consulta/doc", {
          documento: this.form.avals[index].documento
        })
        .then(function(response) { 
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
 
        this.loading= true
      this.$http
        .post(`/${this.resource}/prestamo`, this.form)
        .then(response => {

            this.loading = false
            if(response.data.success){
                this.$toast.success(
                    "El prestamo fue creado",
                    "Exitoso",
                    toastOptions.success
                  )
              this.$router.push({ name: 'perfil', params: { documento: this.$route.params.dni, persona: 'PN' }})
            }else{
                this.$toast.error(
                  "No se pudo crear prestamo",
                  "Error",
                  toastOptions.error
                )
            }

        })

        .then(() => {
        });
    },
    retornar() {
      this.backMixin_handleBack("/perfil/" + this.form.cliente.documento);
    }
  },
  async mounted() {

    await this.$http.get(`/${this.resource}/datos/`).then(response => {
        this.all_departments = response.data.departments;
        this.all_provinces = response.data.provinces;
        this.all_districts = response.data.districts; 
        
    });

    await this.filterProvincesTitularMe()
    await this.filterDistrictTitularMe()

    if (this.form.producto == "CREDIDIARIO") {
      this.form.meses = (Number(this.form.plazo) / 30).toFixed(2);
    } else if (this.form.producto == "CREDISEMANA") {
      this.form.meses = (Number(this.form.plazo) / 4).toFixed(2);
    } else if (this.form.producto == "MENSUAL") {
      this.form.meses = Number(this.form.plazo) / 1;
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
