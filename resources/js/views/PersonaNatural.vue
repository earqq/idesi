<template>
  <div class="create_client_content">
    <section class="tabs_section">
      <div class="tabs_wrapper">
        <div class="tab " @click="tab = 1" :class="[{complete : validateStep1 }, {selected: tab == 1}]">
          <span>1</span>
          <p>PERSONALES</p>
        </div>
        <div class="tab" @click="tab = 2" :class="{selected: tab == 2}">
          <span>2</span>
          <p>LABORALES</p>
        </div>
        <div class="tab" @click="tab = 3" :class="{selected: tab == 3}">
          <span>3</span>
          <p>FAMILIARES</p>
        </div>
        <div class="tab" @click="tab = 4" :class="{selected: tab == 4}">
          <span>4</span>
          <p>ADICIONALES</p>
        </div>
        <div class="tab" @click="tab = 5" :class="{selected: tab == 5}">
          <span>5</span>
          <p>OBLIGACIONES</p>
        </div>
        <div class="tab" @click="tab = 6" :class="{selected: tab == 6}">
          <span>6</span>
          <p>DECLARACIÓN</p>
        </div>
      </div>
    </section>

    <section class="client_forms">
        <div class="client_forms_wrapper">
        
          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 1" class="form_step"  >
              
              <div class="form_step_wrapper">
                <h3 class="title">
                  Datos Personales
                </h3>
                <div class="form_content">

                  <div class="group_form">

                    <div class="input_wrapper"  >
                      <label>Tipo de Documento</label>
                      <select v-model="form.cliente.tipo_documento" >
                        <option value="DNI">DNI</option>
                        <option value="CE">CE</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                      </select>
                    </div>
      
                    <div class="input_wrapper" :class="{require: !validateDoc}">
                      <label for="documento">Número</label>
                      <input type="text"  v-if="form.cliente.tipo_documento=='DNI'" v-model="form.cliente.documento"  @change="datosCliente()"  v-mask="'########'" />
                      <input type="text"  v-else-if="form.cliente.tipo_documento=='CE'" v-model="form.cliente.documento"  />
                      <input type="text"  v-else  disabled/>
                      <div class="message">número de documento inválido</div>
                    </div>

                    <div class="input_wrapper">
                      <label for="nacimiento">Fecha de Nacimiento</label>
                      <input type="date" v-model="form.natural.nacimiento" > 
                    </div>

                    <div class="input_wrapper" :class="{require: !validateName}">
                      <label for="nombres">Nombres</label>
                      <input type="text" v-model="form.natural.nombres" placeholder />
                      <div class="message">nombres muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateLastname}">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" v-model="form.natural.apellidos" placeholder />
                      <div class="message">apellidos muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateNacionalidad}">
                      <label for="apellidos">Nacionalidad</label>
                      <input type="text"  :maxlength="15"  v-model="form.cliente.pais"/>
                      <div class="message">nacionalidad invalida</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateDepartamento}">
                      <label for="apellidos">Departamento de Nacimiento</label>
                      <input type="text" v-model="form.cliente.departamento" :maxlength="45"  />
                      <div class="message">nombre de departamento muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateProvincia}">
                      <label for="apellidos">Provincia de Nacimiento</label>
                      <input type="text" v-model="form.cliente.provincia" :maxlength="45"  />
                      <div class="message">nombre de provincia muy corto</div>
                    </div>

                    <div class="input_wrapper" :class="{require: !validateDistrito}">
                      <label for="apellidos">Distrito de Nacimiento</label>
                      <input type="text" v-model="form.cliente.distrito" :maxlength="45"  />
                      <div class="message">nombre de distrito muy corto</div>
                    </div>

                  </div>

                  <span class="separator"></span>

                  <div class="group_form">

                    <div class="input_wrapper">
                      <label>Estado Civil</label>
                      <select v-model="form.natural.estado_civil" :maxlength="25" >
                        <option value="SOLTERO">SOLTERO</option>
                        <option value="CASADO">CASADO</option>
                        <option value="CONVIVIENTE">CONVIVIENTE</option>
                        <option value="DIVORCIADO">DIVORCIADO</option>
                        <option value="VIUDO">VIUDO</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                      <label>Genero</label>
                      <select v-model="form.natural.genero" :maxlength="10" >
                        <option value="FEMENINO">FEMENINO</option>
                        <option value="MASCULINO">MASCULINO</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                      <label>Grado de Instrucción</label>
                      <select v-model="form.natural.grado_instruccion" :maxlength="10" class="form-control">
                        <option value="PRIMARIA">PRIMARIA</option>
                        <option value="TECNICO">TECNICO</option>
                        <option value="SUPERIOR">SUPERIOR</option>
                        <option value="OTRO">OTRO</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                        <label>Ocupación</label>
                        <input type="text" v-model="form.natural.ocupacion" :maxlength="50" />
                    </div>

                  </div>

                  <span class="separator"></span>

                  <div class="group_form">

                    <div class="input_wrapper">
                        <label>Domicilio Declarado</label>
                        <input type="text" v-model="form.natural.direccion" :maxlength="70" />
                    </div>

                    <div class="input_wrapper">
                        <label>Domicilio Reniec</label>
                        <input type="text" v-model="form.natural.direccion_registros" :maxlength="70" disabled/>
                    </div>

                    <div class="input_wrapper">
                        <label>Distrito</label>
                        <input type="text" v-model="form.natural.domicilio_distrito" :maxlength="45" />
                    </div>

                    <div class="input_wrapper">
                        <label>Provincia</label>
                        <input type="text" v-model="form.natural.domicilio_provincia" :maxlength="45" />
                    </div>

                    <div class="input_wrapper">
                        <label>Departamento</label>
                        <input type="text" v-model="form.natural.domicilio_departamento" :maxlength="45" />
                    </div>

                  </div>

                  <span class="separator"></span>

                  <div class="group_form">

                    <div class="input_wrapper">
                        <label>Número</label>
                        <input type="text" v-model="form.natural.numero" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Manzana</label>
                        <input type="text" v-model="form.natural.manzana" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Lote</label>
                        <input type="text" v-model="form.natural.lote" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Departamento</label>
                        <input type="text" v-model="form.natural.dpto" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Interior</label>
                        <input type="text" v-model="form.natural.int" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Piso</label>
                        <input type="text" v-model="form.natural.piso" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Referencia</label>
                        <input type="text" v-model="form.natural.referencia" :maxlength="50" />
                    </div>

                    <div class="input_wrapper">
                        <label>Teléfono</label>
                        <input type="text" v-model="form.natural.telefono" :maxlength="10" />
                    </div>

                    <div class="input_wrapper">
                        <label>Celular</label>
                        <input
                          type="text"
                          v-mask="'### ### ###'"
                          v-model="form.natural.celular"
                        />
                    </div>

                    <div class="input_wrapper">
                        <label>Email</label>
                        <input type="text" v-model="form.natural.correo" :maxlength="45" />
                    </div>

                  </div>

                </div>
              </div>

              <div class="form_buttons">
                <a class="button_primary medium next" @click="next(1)">
                  <span> SIGUIENTE </span>
                  <i class="material-icons-outlined"> navigate_next </i>
                </a>
              </div>

            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 2" class="form_step">

              <div class="form_step_wrapper">

                <h3 class="title">
                  Datos Laborales
                </h3>

                <div class="form_content">

                  <div class="group_form">

                    <div class="input_wrapper">
                      <label>Estado de Trabajador</label>
                      <select v-model="form.laboral.estado_laboral" :maxlength="15">
                        <option value="TRABAJA">TRABAJA</option>
                        <option value="NO TRABAJA">NO TRABAJA</option>
                        <option value="JUBILADO">JUBILADO</option>
                        <option value="AMA DE CASA">AMA DE CASA</option>
                        <option value="ESTUDIANTE">ESTUDIANTE</option>
                        <option value="OTROS">OTROS</option>
                      </select>
                    </div>

                    <div class="input_wrapper" v-if="form.laboral.estado_laboral=='OTROS'">
                      <label>Especifique</label>
                      <input type="text"  :maxlength="45" v-model="form.laboral.especificacion">
                    </div>

                  </div>

                  <span v-if="form.laboral.estado_laboral=='TRABAJA'" class="separator"></span>
                  
                  <div class="group_form"  v-if="form.laboral.estado_laboral=='TRABAJA'">

                    <div class="input_wrapper"> 
                      <label>Tipo de Trabajador</label>
                      <select v-model="form.laboral.tipo_trabajador" :maxlength="15">
                        <option value="INDEPENDIENTE">INDEPENDIENTE</option>
                        <option value="DEPENDIENTE">DEPENDIENTE</option>
                        <option value="AGRICULTOR">AGRICULTOR</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                      <label>Razon Social</label>
                      <input type="text" :maxlength="45" v-model="form.laboral.razon_social">
                    </div>

                    <div class="input_wrapper">
                      <label>Ingreso Mensual</label>
                      <select v-model="form.laboral.ingreso_mensual" :maxlength="25">
                        <option value="HASTA S/. 1000">HASTA S/. 1000</option>
                        <option value="S/. 1.001 a S/ 2.500">S/. 1000 a S/ 2.500</option>
                        <option value="S/. 2.500 a S/ 5.000">S/. 2.500 a S/ 5.000</option>
                        <option value="S/. 5.001 a S/ 10.000">S/. 5.001 a S/ 10.000</option>
                        <option value="S/ 10.001 A MÀS">S/ 10.001 A MÀS</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                      <label>Cargo/ Ocupaciòn</label>
                      <input type="text" :maxlength="20" v-model="form.laboral.cargo_ocupacion">
                    </div>

                    <div class="input_wrapper">
                      <label for="nacimiento">Fecha de Ingreso</label>
                      <date-pick v-model="form.laboral.fecha_ingreso" :months="mesEs" :weekdays="diaEs"></date-pick>
                    </div>

                  </div>

                  <span v-if="form.laboral.estado_laboral=='TRABAJA'" class="separator"></span>

                  <div class="group_form"  v-if="form.laboral.estado_laboral=='TRABAJA'">

                    <div class="input_wrapper">
                      <label>Giro de Negocio</label>
                      <v-select
                        label="giro_negocio"
                        :options="giros"
                        :reduce="giros => giros.giro_negocio"
                        v-model="form.laboral.giro_negocio">
                        <span slot="no-options">
                          No se encontro giro de negocio
                        </span>
                      </v-select>
                    </div>

                    <div class="input_wrapper">
                      <label for="nacimiento">Direcciòn</label>
                      <input type="text" :maxlength="45" v-model="form.laboral.direccion">
                    </div>

                    
                    
                    <div class="input_wrapper">
                        <label>Pais</label>
                        <input type="text" v-model="form.laboral.pais" :maxlength="20" />
                    </div>

                    <div class="input_wrapper">
                        <label>Departamento</label>
                        <select
                          v-model="form.laboral.departamento"
                          filterable
                          @change="filterProvince"
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

                    <div class="input_wrapper">
                        <label>Provincia</label>
                        <select
                        v-model="form.laboral.provincia"
                        filterable
                        @change="filterDistrict"
                        dusk="provincias_id">
                        <option value="0">SELECCIONE</option>
                        <option
                          v-for="option in provinces"
                          :key="option.id"
                          :value="option.id"
                          :label="option.descripcion"
                        >></option>
                      </select>

                    </div>

                    <div class="input_wrapper">
                        <label>Distrito</label>
                        <select
                          v-model="form.laboral.distrito"
                          filterable
                          dusk="distritos_id">
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

                  <span v-if="form.laboral.estado_laboral=='TRABAJA'" class="separator"></span>

                  <div class="group_form"  v-if="form.laboral.estado_laboral=='TRABAJA'">

                    <div class="input_wrapper">
                      <label>Número</label>
                      <input type="text" v-model="form.laboral.numero" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Manzana</label>
                        <input type="text" v-model="form.laboral.manzana" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Lote</label>
                        <input type="text" v-model="form.laboral.lote" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Departamento</label>
                        <input type="text" v-model="form.laboral.dpto" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Interior</label>
                        <input type="text" v-model="form.laboral.int" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Piso</label>
                        <input type="text" v-model="form.laboral.piso" :maxlength="5" />
                    </div>

                    <div class="input_wrapper">
                        <label>Referencia</label>
                        <input type="text" v-model="form.laboral.referencia" :maxlength="45" />
                    </div>

                    <div class="input_wrapper">
                        <label>Teléfono</label>
                        <input type="text" v-model="form.laboral.telefono" :maxlength="10" />
                    </div>
      
                    <div class="input_wrapper">
                        <label>Celular</label>
                        <input
                          type="text"
                          v-mask="'### ### ###'"
                          v-model="form.laboral.celular"
                        />
                    </div>

                    <div class="input_wrapper">
                        <label>Email</label>
                        <input type="text" v-model="form.laboral.email" :maxlength="45" />
                    </div>

                  </div>

                </div>

              </div>

              <div class="form_buttons">
                <a class="button_inline_primary medium prev" @click="prev(2)">
                  <i class="material-icons-outlined"> navigate_before </i>
                  <span> ATRAS </span>
                </a>
                <a class="button_primary medium next" @click="next(2)">
                  <span> SIGUIENTE </span>
                  <i class="material-icons-outlined"> navigate_next </i>
                </a>
              </div>
              
            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 3" class="form_step">

              <div class="form_step_wrapper" :class="{part_bottom: form.detalles.length > 0}">

                <h3 class="title">
                  Datos Familiares
                </h3>

                <div class="form_content">

                  <div class="group_form">

                    <div class="input_wrapper">
                      <label>¿Tiene Hijos?</label>
                      <select v-model="form.familia.hijos">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div> 

                    <div class="input_wrapper" v-if="form.familia.hijos=='SI'">
                      <label>Nro de hijos</label>
                      <input type="text" :maxlength="2" v-model="form.familia.numero">
                    </div>

                    <div class="input_wrapper">
                      <label>¿Tiene cónyuge ó conviviente?</label>
                      <select v-model="form.familia.conyugue" @change="conyugeAsignacion()">
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div> 

                    <div class="input_wrapper" v-if="form.familia.conyugue=='SI'">
                      <label>Ocupación del cónyuge ó conviviente?</label>
                      <select v-model="form.familia.ocupacion" :maxlength="15">
                        <option value="AMA DE CASA">AMA DE CASA</option>
                        <option value="DEPENDIENTE">DEPENDIENTE</option>
                        <option value="INDEPENDIENTE">INDEPENDIENTE</option>
                      </select>
                    </div> 

                  </div>

                </div>
          
              </div>

              <div class="form_list" v-if="form.detalles.length>0">

                <div class="form_step_wrapper" v-for="(row, index) in form.detalles" :key="index" >
                  <h3 class="title">
                    Familiar {{index + 1}}
                  </h3>

                  <div class="form_content" >

                    <div class="group_form small">
                      
                      <div class="input_wrapper">
                        <label> Parentesco </label>
                        <select v-model="row.parentesco" class="form-control" disabled>
                          <option value="CONYUGE">CONYUGE</option>
                          <option value="CONVIVIENTE">CONVIVIENTE</option>
                          <option value="HIJOS">HIJOS</option>
                        </select>
                      </div>


                      <div class="input_wrapper"> 
                        <label> Documento </label>
                        <input type="text" v-model="row.documento" @change="datosFamiliar(index)" />
                      </div>

                      <div class="input_wrapper">
                        <label> Nombres </label>
                        <input type="text" v-model="row.nombres" :maxlength="45" class="form-control" />
                      </div>

                      <div class="input_wrapper">
                        <label> Fecha de Nacimiento </label>
                        <input type="date" v-model="row.nacimiento">
                      </div>

                      <div class="input_wrapper">
                        <label> ¿Socio? </label>
                        <select v-model="row.socio" class="form-control">
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                          </select>
                      </div>

                    </div>

                  </div>
                </div>

              </div>

              <div class="form_buttons">
                <a class="button_inline_primary medium prev" @click="prev(3)">
                  <i class="material-icons-outlined"> navigate_before </i>
                  <span> ATRAS </span>
                </a>
                <a class="button_primary medium next" @click="next(3)">
                  <span> SIGUIENTE </span>
                  <i class="material-icons-outlined"> navigate_next </i>
                </a>
              </div>

            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 4" class="form_step">
              <div class="form_step_wrapper">
                <h3 class="title">
                  Datos Adicionales
                </h3>
                <div class="form_content">
                  <blockquote class="message_form"> 
                    Completar esta sección solo si el/la solicitante menor de edad se haya inscrito a través de un(a) representate. </blockquote>
                  <div class="group_form">

                    <div class="input_wrapper">
                      <label>Apellidos y Nombres (Representate)  </label>
                      <input type="text" :maxlength="45" v-model="form.adicional.representante" >
                    </div>

                    <div class="input_wrapper">
                      <label>Tipo de Documento</label>
                      <select v-model="form.adicional.documento" >
                        <option value="DNI">DNI</option>
                        <option value="CE">CE</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                      </select>
                    </div>

                    <div class="input_wrapper">
                      <label for="documento">Número</label>
                      <input type="text" :maxlength="15" v-model="form.adicional.numero" />
                    </div>

                    <div class="input_wrapper">
                        <label>Relación con el solicitante</label>
                        <select v-model="form.adicional.relacion" >
                          <option value="PADRE">PADRE</option>
                          <option value="MADRE">MADRE</option>
                          <option value="OTRO">OTRO</option>
                        </select>
                    </div>

                  </div>
                </div>
                
              </div>

              <div class="form_buttons">
                <a class="button_inline_primary medium prev" @click="prev(4)">
                  <i class="material-icons-outlined"> navigate_before </i>
                  <span> ATRAS </span>
                </a>
                <a class="button_primary medium next" @click="next(4)">
                  <span> SIGUIENTE </span>
                  <i class="material-icons-outlined"> navigate_next </i>
                </a>
              </div>
            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 5" class="form_step"  >
              
              <div class="form_step_wrapper">
                <h3 class="title">
                  Obligaciones Asociativas
                </h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                        <label>Inscripción </label>
                        <vue-numeric currency="S/. " separator="," v-model="form.asociativa.inscripcion"  v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                        <label>Aporte </label>
                        <vue-numeric currency="S/. " separator="," v-model="form.asociativa.aporte"  v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                        <label>Fondo de prevencion social </label>
                        <vue-numeric currency="S/. " separator="," v-model="form.asociativa.fondo"  v-bind:precision="2"></vue-numeric>
                    </div>
                    <div class="input_wrapper">
                        <label>Fondo de prevencion social opcional </label>
                        <vue-numeric currency="S/. " separator="," v-model="form.asociativa.fondo_opcional" v-bind:precision="2"></vue-numeric>
                    </div>
                  </div>
                </div>

              </div>
                <div class="form_buttons">
                  <a class="button_inline_primary medium prev" @click="prev(5)">
                    <i class="material-icons-outlined"> navigate_before </i>
                    <span> ATRAS </span>
                  </a>
                  <a class="button_primary medium next" @click="next(5)">
                    <span> SIGUIENTE </span>
                    <i class="material-icons-outlined"> navigate_next </i>
                  </a>
                </div>
            </div>
          </transition>

          <transition name="slide-fade" mode="in-out">
            <div v-show="tab == 6" class="form_step" >
              <div class="form_step_wrapper">
                <h3 class="title">
                  Declaración
                </h3>
                <div class="form_content">
                  <div class="group_form">
                    <div class="input_wrapper">
                        <label>¿Es sujeto a informar a la UIF Perú?</label>
                        <select v-model="form.declaracion.uif">
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    <div class="input_wrapper">
                        <label>¿Es PEP? (persona expuesta politicamente)</label>
                        <select v-model="form.declaracion.pep">
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                      </div>
                    <div class="input_wrapper">
                        <label>Estado</label>
                        <select v-model="form.declaracion.estado">
                          <option value="ADMITIDO">ADMITIDO</option>
                          <option value="RECHAZADO">RECHAZADO</option>
                        </select>
                      </div>
                    <div class="input_wrapper all">
                        <label>OBSERVACIONES</label>
                        <textarea v-model="form.declaracion.obervaciones" cols="auto" rows="5"></textarea>
                      </div>
                  </div>
                </div>
              </div>

              <div class="form_buttons">
                <a class="button_inline_primary medium prev" @click="prev(6)">
                  <i class="material-icons-outlined"> navigate_before </i>
                  <span> ATRAS </span>
                </a>
                <a class="button_primary medium next" @click="submit()" >
                  <span> FINALIZAR </span>
                  <i class="material-icons-outlined"> check </i>
                </a>
              </div>
            </div>
          </transition>
            
        </div>
    </section>
  </div>
</template>

<script>
import DatePick from "vue-date-pick";
import "vue-date-pick/dist/vueDatePick.css";
import { serviceNumber } from "../mixins/functions";
import vSelect from "vue-select";
import VueNumeric from 'vue-numeric'

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
  name: 'natural',
  mixins: [serviceNumber],
  components: { DatePick , vSelect,VueNumeric}, 
  data() {
    return {
      giros: [],
      resource: "clientes",
      clientes: [],
      tipo_persona: 'PN',
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provinces: [],
      loading_submit:'0',
      districts: [],
      form: {
        familia: {
          numero: 1
        }
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
      },
      mesEs: mesConf,
      diaEs: diaConf,
      tab: 1
    };
  },
  async created() {

    this.$http.get(`/${this.resource}/datos/`).then(response => {
      this.all_departments = response.data.departments;
      this.all_provinces = response.data.provinces;
      this.all_districts = response.data.districts;
    });


    await this.initForm();
    
    this.$http.get(`/evaluaciones/giro`).then(response => {
      this.giros = response.data;
    });
  },
  methods: {
    next(index) {
      this.tab = index + 1
    },
    prev(index) {
      this.tab = index - 1
    },
    initForm() {
      this.form = {
        cliente:{
          tipo_documento: "DNI",
          documento: "",
          codigo: "",
          tipo_cliente: this.tipo_persona,
          pais: "",
          departamento: "",
          provincia: "",
          distrito: "",
          numero_registro: "",
          agencia: ""
        },
        natural:{
          nombres: "",
          apellidos: "",
          nacimiento: "",
          estado_civil: "SOLTERO",
          ocupacion: "",
          telefono: "",
          celular: "",
          direccion: "",
          direccion_registros: "",
          referencia: "",
          tipo_domicilio: 0,
          centro_laboral: "",
          direccion_laboral: "",
          genero: "MASCULINO",
          grado_instruccion:"PRIMARIA",
          numero: "",
          manzana: "",
          lote: "",
          dpto: "",
          int: "",
          piso:"",
          domicilio_distrito:"",
          domicilio_provincia:"",
          domicilio_departamento:"",
          correo:"",
        },
        laboral:{
          estado_laboral:"TRABAJA",
          tipo_trabajador:"INDEPENDIENTE",
          razon_social:"",
          ingreso_mensual: "HASTA S/. 1000",
          cargo_ocupacion:"",
          fecha_ingreso:"",
          giro_negocio: "",
          direccion: "",
          numero: "",
          manzana: "",
          dpto: "",
          int: "",
          piso:"",
          lote:"",
          distrito:"",
          provincia:"",
          departamento:"",
          pais:"PERÚ",
          referencia:"",
          telefono:"",
          celular:"",
          email:"",
          especificacion:""
        
        },
         familia:{
          hijos: "NO",
          numero:0,
          conyugue:"NO",
          ocupacion:"AMA DE CASA",
        },

        detalles: [],

        adicional:{
          representante: "",
          documento: 'DNI',
          numero:"",
          relacion: 'PADRE'
        },
        asociativa:{
          inscripcion:"",
          aporte:"",
          fondo:"",
          fondo_opcional:"",

        },

        declaracion:{
          uif: "NO",
          pep:"NO",
          obervaciones:"",
          estado: "ADMITIDO",
          fecha: ""
        }

        
      };
    },
    conyugeAsignacion(){

      if(this.form.familia.conyugue=='SI'){
            this.form.detalles.push({
                nombres: "",
                documento:"",
                parentesco:"CONYUGE",
                nacimiento:"",
                socio:"NO",
            });
      }else{
        for (var i = 0; i < this.form.detalles.length; i++) {  
            if(this.form.detalles[i].parentesco!='HIJOS'){ 
              this.form.detalles.splice(i,1)
            } 
        }
      }
    },
    
    hijosAsignacion(new_value,old_value){
       old_value = old_value || 0
       new_value = new_value || 0 
      var conyuge=null

      for (var i = 0; i < this.form.detalles.length; i++) {  
            if(this.form.detalles[i].parentesco!='HIJOS'){ 
              conyuge= this.form.detalles[i] 
            } 
      }

      this.form.detalles=[]

      for (var i = 0; i < new_value; i++) { 
              this.form.detalles.push({
                  nombres: "",
                  documento:"",
                  parentesco:"HIJOS",
                  nacimiento:"",
                  socio:"0",
              })

        } 
        if (conyuge) this.form.detalles.push(conyuge)

    },
    resetForm() {
      this.initForm();
    },
    datosCliente() {
      let me = this;
      axios
        .post("/consulta/dni", {
          documento: this.form.cliente.documento
        })
        .then(function(response) {
          console.log(response.data);
          me.form.natural.nombres = response.data["nombres"];
          me.form.natural.apellidos = response.data["surnames"];
        })
        .catch(function(error) {
          console.log(error);
          me.initForm();
        });
    },
    datosFamiliar(index) {
      let me = this;
      axios
        .post("/consulta/dni", {
          documento: this.form.detalles[index].documento
        })
        .then(function(response) {
          console.log(response.data);
          me.form.detalles[index].nombres = response.data["nombres"]  + ' ' +  response.data["surnames"];
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
      this.loading_submit=1;
      this.$http
        .post(`/${this.resource}/nuevo/natural`, this.form)
        .then(response => {
          if (response.data.success) {
            this.resetForm();
            this.$toast.success(
              "La solicitud fue admitida",
              "Exitoso",
              this.notificationSystem.options.success
            );

            this.loading_submit=0;
            this.$parent.getRecords();
            this.$parent.tipo = true;

            
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
  computed: {

    validateName () {
      return this.form.natural.nombres.length > 2
    },
    validateNacionalidad () {
      return this.form.cliente.pais.length > 2
    },
    validateDepartamento () {
      return this.form.cliente.departamento.length > 2
    },
    validateProvincia () {
      return this.form.cliente.provincia.length > 2
    },
    validateDistrito () {
      return this.form.cliente.distrito.length > 2
    },
    validateLastname () {
      return this.form.natural.apellidos.length > 2
    },
    validateDoc () {
      let result = false
      if (this.form.cliente.tipo_documento == 'DNI') result = this.form.cliente.documento.length == 8
      else if (this.form.cliente.tipo_documento == 'CE') result = this.form.cliente.documento.length == 11
      return result
    },
    validateStep1 () {
      return this.validateDoc && this.validateName && this.validateLastname
    }
  },
  watch: {
    'form.familia.numero'(new_value,old_value){
      if (new_value < 1) this.form.familia.numero = 1
      this.hijosAsignacion(new_value,old_value)
    },
    'form.familia.hijos' (val) {
      if (val == 'NO') this.form.familia.numero = 0
    }
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
