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
          <p>CLIENTE</p>
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

        <div v-if='prestamo.cliente.tipo_cliente==1' v-show="tab == 2" class="form_step">
          <div class="form_step_wrapper">
            <h3 class="title">Datos del Titular</h3>
            <div class="form_content">
              <div class="group_form">
                <div class="input_wrapper" :class="{require: !validateNombre}">
                  <label>Nombres</label>
                  <input type="text" v-model="prestamo.cliente.persona.nombres" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateApellidos}">
                  <label>Apellidos</label>
                  <input type="text" v-model="prestamo.cliente.persona.apellidos" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDocumento}">
                  <label>Documento</label>
                  <input type="text" v-model="prestamo.cliente.documento" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateNacimiento}">
                  <label>Fecha de nacimiento</label>
                  <input type="date" v-model="prestamo.cliente.persona.fecha_nacimiento" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateCivil}">
                  <label>Estado Civil</label>
                  <select v-model="prestamo.cliente.persona.estado_civil">
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
                  <input type="text" v-model="prestamo.cliente.persona.ocupacion" maxlength='100' />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" >
                  <label>Teléfono</label>
                  <input type="text" v-model="prestamo.cliente.telefono" />
                </div>
                <div class="input_wrapper" :class="{require: !validateCelular}">
                  <label>Celular</label>
                  <input type="text" v-mask="'### ### ###'" v-model="prestamo.cliente.persona.celular" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDireccion}">
                  <label>Dirección Declarada</label>
                  <input type="text" v-model="prestamo.cliente.ubicacion_direccion_declarada" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper">
                  <label>Dirección Reniec</label>
                  <input type="text" v-model='prestamo.cliente.ubicacion_direccion_sistema' disabled />
                </div>
              </div>

              <span class="separator"></span>

              <div class="group_form">
                <div class="input_wrapper" :class="{require: !validateDepartamento}">
                  <label>Departamento</label>
                   <select
                        v-model="prestamo.cliente.ubicacion_departamento"
                        
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
                </div>
                <div class="input_wrapper" :class="{require: !validateProvincia}">
                  <label>Provincia</label> 
                  <select
                      v-model="prestamo.cliente.ubicacion_provincia"
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
                        v-model="prestamo.cliente.ubicacion_distrito"
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
                  <input type="text" v-model="prestamo.cliente.ubicacion_referencia" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDomicilio}">
                  <label>Tipo Domicilio</label>
                  <select v-model="prestamo.cliente.persona.tipo_domicilio">
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
                  <input type="text" v-model="prestamo.cliente.persona.trabajo.empresa_razon_social" />
                  <div class="message">Se requiere esta información</div>
                </div>
                <div class="input_wrapper" :class="{require: !validateDireccionLaboral}">
                  <label>Dirección centro laboral </label>
                  <input type="text" v-model="prestamo.cliente.persona.trabajo.empresa_direccion" />
                  <div class="message">Se requiere esta información</div>
                </div>
              </div>
            </div>
          </div>
          <button
            type="button"
            @click="clickAddconyuge"
            class="add_section in_bottom"
            v-if="tools.tiene_conyuge==false">
            <span>AGREGAR CÓNYUGE O CONVIVIENTE</span>
            <i class="material-icons-outlined">add</i> 
          </button>

          <div class="form_list " v-if="tools.tiene_conyuge==true">
            <div class="form_step_wrapper in_bottom" >
              <h3 class="title">
                CÓNYUGE o Conviviente 
                <button  class="delete_section" type="button"  @click="clickRemoveconyuge()">
                  <i class="material-icons-outlined"> delete </i>
                </button>
              </h3>
              <div class="form_content" >
                <div class="group_form" >
                  <div class="input_wrapper"  :class="{require: !validateDocumentoConyuge}">
                    <label>Documento de Identidad</label>
                    <input
                      type="text"
                      v-model="prestamo.cliente.persona.conyuge.documento"
                      @keyup="datosCliente()"
                      maxlength='15'
                    />
                    <div class="message">número de documento inválido</div>
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateNombreConyuge}">
                    <label>Nombres y Apellidos</label>
                    <input type="text" v-model="prestamo.cliente.persona.conyuge.nombres" />
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateNacimientoConyuge}">
                    <label>Fecha de Nacimiento</label>
                    <input type="date" v-model="prestamo.cliente.persona.conyuge.fecha_nacimiento" />
                  </div>
                  <div class="input_wrapper">
                    <label>Estado Civil</label>
                    <select v-model="prestamo.cliente.persona.conyuge.estado_civil">
                      <option value="SOLTERO">SOLTERO</option>
                      <option value="CASADO">CASADO</option>
                      <option value="CONVIVIENTE">CONVIVIENTE</option>
                      <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                      <option value="VIUDO">VIUDO</option>
                    </select>
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateOcupacionConyuge}">
                    <label>Ocupación</label>
                    <input type="text" v-model="prestamo.cliente.persona.conyuge.ocupacion" />
                  </div>
                  <div class="input_wrapper">
                    <label>Socio</label>
                    <select v-model="prestamo.cliente.persona.conyuge.socio">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                  </div> 
                  <div class="input_wrapper" :class="{require: !validateCodigoConyuge}" v-if="prestamo.cliente.persona.conyuge.socio==1" >
                    <label>Código</label>
                    <input  type="text"  v-model="prestamo.cliente.persona.conyuge.codigo_socio" maxlength='10'/>
                  </div>
                  
                  <div class="input_wrapper" :class="{require: !validateAporteConyuge}" v-if="prestamo.cliente.persona.conyuge.socio==1">
                    <label>Aporte </label>
                    <vue-numeric currency="S/. " separator="," v-model="prestamo.cliente.persona.conyuge.aporte_socio" v-bind:precision="2"></vue-numeric>
                  </div>                 
                  <div class="input_wrapper">
                    <label>Teléfono</label>
                    <input type="text" v-model="prestamo.cliente.persona.conyuge.telefono" maxlength='11' />
                  </div>
                  <div class="input_wrapper"  :class="{require: !validateCelularConyuge}">
                    <label>Celular</label>
                    <input  type="text"  v-mask="'### ### ###'"  v-model="prestamo.cliente.persona.conyuge.celular" />
                  </div>
                  <div class="input_wrapper" >
                    <label>¿Trabaja?</label>
                    <select v-model="prestamo.cliente.persona.conyuge.trabaja">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                  </div>

                  <div class="input_wrapper"  :class="{require: !validateCentroConyuge}" v-if="prestamo.cliente.persona.conyuge.trabaja==1">
                    <label>Centro Laboral</label>
                    <input type="text" v-model="prestamo.cliente.persona.conyuge.centro_laboral" />
                  </div>

                  <div class="input_wrapper"  :class="{require: !validateDireccionConyuge}" v-if="prestamo.cliente.persona.conyuge.trabaja==1">
                    <label>Dirección centro laboral</label>
                    <input type="text" v-model="prestamo.cliente.persona.conyuge.direccion_centro_laboral" />
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
            <a class="button_primary medium next" @click=" (validateStep2 && validateStep1) ? next(2) : tabError()" >
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>    
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
        id: this.$route.params.prestamoID, 
        garantias: [],
        avales: [],
        cliente: {
          ubicacion_departamento: "",
          ubicacion_provincia: "",
          ubicacion_distrito: "",
          ubicacion_direccion_declarada: "",
          ubicacion_referencia: "",
          documento:'',
          telefono: "",
          celular: "",
          persona: {
            nombres: "",
            apellidos: "",
            fecha_nacimiento: "",
            estado_civil: "SOLTERO",
            ocupacion: "",
            tipo_domicilio: "PROPIA",
            trabajo:{
              empresa_ruc:"",
              empresa_direccion: "",
              empresa_razon_social: "",
            },   
            conyuge: {
              documento: "",
              nombres: "",
              fecha_nacimiento: "",
              estado_civil: "SOLTERO",
              ocupacion: "",
              telefono: "",
              celular: "",
              trabaja: 1,
              centro_laboral: "",
              direccion_centro_laboral: "",
              socio: false,
              codigo_socio: "",
              aporte_socio: "",
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
    validateNombre(){
      return this.prestamo.cliente.persona.nombres.length>4;
    }
    ,
    validateApellidos(){
      return this.prestamo.cliente.persona.apellidos.length>5;
    }
    ,
    validateDocumento(){
      return this.prestamo.cliente.documento.length>=8
    }
    ,
    validateNacimiento(){
      return this.prestamo.cliente.persona.fecha_nacimiento.length>4
    }
    ,
    validateCivil(){
      return this.prestamo.cliente.persona.estado_civil.length>5
    }
    ,
    validateOcupacion(){
      return this.prestamo.cliente.persona.ocupacion.length>4
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
    validateDomicilio(){
      return this.prestamo.cliente.persona.tipo_domicilio.length>5
    }
    ,
    validateCentro(){
      if(this.prestamo.cliente.persona.trabajo)
      return this.prestamo.cliente.persona.trabajo.empresa_razon_social.length>5
      else return true
    }
    ,
    validateDireccionLaboral(){
      if(this.prestamo.cliente.persona.trabajo)
      return this.prestamo.cliente.persona.trabajo.empresa_direccion.length>6
      else return true
    },


     validateDocumentoConyuge(){
       if(this.prestamo.cliente.persona.conyuge){
          return String(this.prestamo.cliente.persona.conyuge.documento).length > 6
       }else{
         return true
       }
    },

     validateNombreConyuge(){
       if(this.prestamo.cliente.persona.conyuge){
         return this.prestamo.cliente.persona.conyuge.nombres.length>6
       }else{
         return true
       }   
    },

     validateNacimientoConyuge(){
      return this.prestamo.cliente.persona.conyuge.fecha_nacimiento.length>6
    },

     validateOcupacionConyuge(){
      if(this.prestamo.cliente.persona.conyuge && this.prestamo.cliente.persona.conyuge.ocupacion)
        return this.prestamo.cliente.persona.conyuge.ocupacion.length>6
      else true
    },

    validateCelularConyuge(){
      if(this.prestamo.cliente.persona.conyuge && this.prestamo.cliente.persona.conyuge.celular)
      return this.prestamo.cliente.persona.conyuge.celular.length>6
      else true
    },
    validateCodigoConyuge(){
      if(this.prestamo.cliente.persona.conyuge.socio && this.prestamo.cliente.persona.conyuge.codigo_socio){
        return this.prestamo.cliente.persona.conyuge.codigo_socio.length>=3
      }
      else return true
    },
    validateAporteConyuge(){
      if(this.prestamo.cliente.persona.conyuge.socio){
        return String(this.prestamo.cliente.persona.conyuge.aporte_socio)>=1
      }
      else return true
    },
    validateCentroConyuge(){
      return this.prestamo.cliente.persona.conyuge.centro_laboral.length>6
    },

    validateDireccionConyuge(){
      return this.prestamo.cliente.persona.conyuge.direccion_centro_laboral.length>6
    },

    validateStep2(){
      if(this.prestamo.cliente.persona.conyuge.conyuge_tiene=='SI'){

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
              this.validateCodigoConyuge &&
              this.validateAporteConyuge &&
              this.validateCelularConyuge &&
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
  async created() { 
    await this.obtenerDatosCliente()
          this.obtenerDatosPrestamo()
    // this.clickAddAval()
    // this.clickAddGarantia()

  
  },

  methods: {
    obtenerDatosCliente(){ 
      this.$http
      .get(`/clientes/` + this.$route.params.clienteID)
      .then(response => {  
        this.prestamo.cliente=response.data
        if(this.prestamo.cliente.persona.conyuge){
          this.tools.tiene_conyuge=true
          this.prestamo.cliente.persona.conyuge={
              documento: this.prestamo.cliente.persona.conyuge.documento,
              nombres: this.prestamo.cliente.persona.conyuge.nombres,
              fecha_nacimiento: this.prestamo.cliente.persona.conyuge.fecha_nacimiento,
              estado_civil: this.prestamo.cliente.persona.conyuge.estado_civil,
              ocupacion: this.prestamo.cliente.persona.conyuge.ocupacion,
              telefono: "",
              celular: "",
              trabaja: this.prestamo.cliente.persona.conyuge.trabaja,
              centro_laboral: "",
              direccion_centro_laboral: "",
              socio: this.prestamo.cliente.persona.conyuge.socio,
              codigo_socio: "",
              aporte_socio: "",
          }
        }else{
          this.tools.tiene_conyuge=false
        }    
      });
    },
    obtenerDatosPrestamo(){
            this.$http
      .get(`clientes/datos/prestamo/` + this.$route.params.prestamoID)
      .then(response => {  
        console.log(response.data)

              this.prestamo.monto_inicial= response.data.monto_inicial
              this.prestamo.cuotas_inicial= response.data.cuotas_inicial 
              this.prestamo.disponibilidad_pago_inicial= response.data.disponibilidad_pago_inicial 
              this.prestamo.destino_inicial= response.data.destino_inicial  
              this.prestamo.forma_inicial= response.data.forma_inicial 
              this.prestamo.producto =  response.data.producto 
              this.prestamo.forma= response.data.forma  
              this.prestamo.importe= response.data.importe 
              this.prestamo.meses= response.data.meses 
              this.prestamo.aporte= response.data.aporte 
              this.prestamo.cuota_sistema= response.data.cuota_sistema 
              this.prestamo.cuotas= response.data.cuotas 
              this.prestamo.tasa= response.data.tasa  
              this.prestamo.comentarios= response.data.comentarios  
              this.prestamo.producto_final= response.data.producto_final 
              this.prestamo.forma_final= response.data.forma_final 
              this.prestamo.aporte_final= response.data.aporte_final 
              this.prestamo.importe_final= response.data.importe_final  
              this.prestamo.plazo_final= response.data.plazo_final  
              this.prestamo.cuota_final= response.data.cuota_final  
              this.prestamo.tasa_final= response.data.tasa_final
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
          // this.prestamo.cliente.persona.domicilio_provincia= '0'
          // this.prestamo.cliente.persona.domicilio_distrito= '0'
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
    clickAddconyuge() {
      this.prestamo.cliente.persona.conyuge={
              documento: "",
              nombres: "",
              fecha_nacimiento: "",
              estado_civil: "SOLTERO",
              ocupacion: "",
              telefono: "",
              celular: "",
              trabaja: 1,
              centro_laboral: "",
              direccion_centro_laboral: "",
              socio: false,
              codigo_socio: "",
              aporte_socio: "",
      }
      this.tools.tiene_conyuge=true
    },
    clickRemoveconyuge() {      
      this.tools.tiene_conyuge=false
      this.prestamo.cliente.persona.documento=''  
    },
    clickAddAval() { 
      this.prestamo.avales.push({
        documento: "",
        nombres: "",
        apellidos: "",
        fecha_nacimiento: "",
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
      if(this.prestamo.cliente.persona.conyuge.documento.length>7){
        axios
        .post("/consulta/doc", {
          documento: this.prestamo.cliente.persona.conyuge.documento
        })
        .then(function(response) { 
          if(response.data)
          me.prestamo.cliente.persona.conyuge.nombres =
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
              this.$router.push({ name: 'cliente', params: { clienteID: this.$route.params.clienteID, persona: this.$route.params.prestamoID }})
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
