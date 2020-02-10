<template>
  <div class="create_client_content">
    <section class="tabs_section">
      <div class="tabs_wrapper">
        <div class="tab " @click="tab = 1" :class="{selected: tab == 1}" >
          <span>1</span>
          <p>PERSONALES</p>
        </div>
        <div class="tab" @click="tab = 2" :class="{selected: tab == 2}" v-if="validateStep1">
          <span>2</span>
          <p>LABORALES</p>
        </div>

        <div class="tab " @click="tabError()" v-else>
          <span>1</span>
          <p>LABORALES</p>
        </div>
        
        <div class="tab" @click="tab = 3" :class="{selected: tab == 3}" v-if="validateStep1 && validateStep2">
          <span>3</span>
          <p>FAMILIARES</p>
        </div>
        <div class="tab" @click="tabError()" v-else>
          <span>3</span>
          <p>FAMILIARES</p>
        </div>

        <div class="tab" @click="tab = 4" :class="{selected: tab == 4}"  v-if="validateStep1 && validateStep2 && validateStep3">
          <span>4</span>
          <p>ADICIONALES</p>
        </div>
        <div class="tab" @click="tabError" v-else>
          <span>4</span>
          <p>ADICIONALES</p>
        </div>

        <div class="tab" @click="tab = 5" :class="{selected: tab == 5}"  v-if="validateStep1 && validateStep2">
          <span>5</span>
          <p>OBLIGACIONES</p>
        </div>

        <div class="tab" @click="tabError" v-else >
          <span>5</span>
          <p>OBLIGACIONES</p>
        </div>

        <div class="tab" @click="tab = 6" :class="{selected: tab == 6}"  v-if="validateStep1 && validateStep2">
          <span>6</span>
          <p>DECLARACIÓN</p>
        </div>
        <div class="tab" @click="tabError" v-else>
          <span>6</span>
          <p>DECLARACIÓN</p>
        </div>
      </div>
    </section>

    <section class="client_forms">
        <div class="client_forms_wrapper">
          <div v-show="tab == 1" class="form_step"  >
            
            <div class="form_step_wrapper">
              <h3 class="title">
                Datos Personales
              </h3>
              <div class="form_content">

                <div class="group_form">

                  <div class="input_wrapper" >
                    <label>Tipo de Documento</label>
                    <select v-model="cliente.tipo_documento" >
                      <option value="DNI">DNI</option>
                      <option value="CE">CE</option>
                      <option value="PASAPORTE">PASAPORTE</option>
                    </select>
                    
                  </div>
    
                  <div class="input_wrapper" :class="{require: !validateNumero}">
                    <label for="documento">Número</label>
                    <input type="text"  v-if="cliente.tipo_documento=='DNI'" v-model="cliente.documento"   v-mask="'########'" />
                    <input type="text"  v-else v-model="cliente.documento" v-mask="'#########'"   />
                    <div class="message">N° de documento invalido</div>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateNacimiento}">
                    <label for="nacimiento">Fecha de Nacimiento</label>
                    <input type="date" v-model="cliente.persona.fecha_nacimiento" > 
                    <div class="message">Fecha invalida</div>
                  </div>

                  <div class="input_wrapper"  :class="{require: !validateNombres}" >
                    <label for="nombres">Nombres</label>
                    <input type="text" maxlength="100" v-model="cliente.persona.nombres" placeholder />
                    <div class="message">Se requeire nombres</div>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateApellidos}">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" maxlength="100" v-model="cliente.persona.apellidos" placeholder />
                    <div class="message">Se requiere apellidos</div>
                  </div>

                  <div class="input_wrapper"  :class="{require: !validateNacionalidad}">
                    <label for="apellidos">Nacionalidad</label>
                    <input type="text"  maxlength="20"  v-model="cliente.pais"/>
                    <div class="message">Nombre de nacionalidad invalida</div>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateDepartamento}">
                    <label for="apellidos">Departamento de Nacimiento</label>
                    <input type="text" v-model="cliente.persona.nacimiento_departamento" maxlength="100"  />
                    <div class="message">Nombre de departamento invalido</div>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateProvincia}" >
                    <label for="apellidos">Provincia de Nacimiento</label>
                    <input type="text" v-model="cliente.persona.nacimiento_provincia" maxlength="100"  />
                    <div class="message">Nombre de provincia invalido</div>
                  </div>

                  <div class="input_wrapper"  :class="{require: !validateDistrito}">
                    <label for="apellidos">Distrito de Nacimiento</label>
                    <input type="text" v-model="cliente.persona.nacimiento_distrito" maxlength="100"  />
                    <div class="message">Nombre de distrito invalido</div>
                  </div>

                </div>

                <span class="separator"></span>

                <div class="group_form">

                  <div class="input_wrapper">
                    <label>Estado Civil</label>
                    <select v-model="cliente.persona.estado_civil" maxlength="25" >
                      <option value="SOLTERO">SOLTERO</option>
                      <option value="CASADO">CASADO</option>
                      <option value="CONVIVIENTE">CONVIVIENTE</option>
                      <option value="DIVORCIADO">DIVORCIADO</option>
                      <option value="VIUDO">VIUDO</option>
                    </select>
                  </div>

                  <div class="input_wrapper">
                    <label>Genero</label>
                    <select v-model="cliente.persona.genero" maxlength="10" >
                      <option value="FEMENINO">FEMENINO</option>
                      <option value="MASCULINO">MASCULINO</option>
                    </select>
                  </div>

                  <div class="input_wrapper">
                    <label>Grado de Instrucción</label>
                    <select v-model="cliente.persona.grado_instruccion" maxlength="10" class="cliente-control">
                      <option value="PRIMARIA">PRIMARIA</option>
                      <option value="TECNICO">TECNICO</option>
                      <option value="SUPERIOR">SUPERIOR</option>
                      <option value="OTRO">OTRO</option>
                    </select>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateOcupacion}">
                      <label>Ocupación</label>
                      <input type="text" v-model="cliente.persona.ocupacion" maxlength="50" />
                      <div class="message">Información muy corta</div>
                  </div>

                </div>

                <span class="separator"></span>

                <div class="group_form">

                  <div class="input_wrapper" :class="{require: !validateDomicilio}">
                      <label>Domicilio Declarado</label>
                      <input type="text" v-model="cliente.ubicacion_direccion_declarada" maxlength="100" />
                      <div class="message">Información muy corta</div>
                  </div>

                  <div class="input_wrapper">
                      <label>Domicilio Reniec</label>
                      <input type="text" v-model="cliente.ubicacion_direccion_reniec" maxlength="100" disabled/>
                  </div>

                  <div class="input_wrapper">
                      <label>Departamento</label>
                      <select
                        v-model="cliente.ubicacion_departamento"
                        filterable
                        @change="filterProvinceTitular"
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

                  <div class="input_wrapper" :class="{require: !validateProvinciaDomicilio}">
                      <label>Provincia</label>
                      <select
                      v-model="cliente.ubicacion_provincia"
                      filterable
                      @change="filterDistrictTitular"
                      dusk="provincias_id">
                      <option value="0">SELECCIONE</option>
                      <option
                        v-for="option in provincesTitular"
                        :key="option.id"
                        :value="option.id"
                        :label="option.descripcion"
                      >></option>
                    </select>
                    <div class="message">Seleccione provincia</div>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateDistritoDomicilio}">
                      <label>Distrito</label>
                      <select
                        v-model="cliente.ubicacion_distrito"
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
                    <div class="message">Seleccione distrito</div>
                  </div>

                </div>

                <span class="separator"></span>

                <div class="group_form">

                  <div class="input_wrapper">
                      <label>Número</label>
                      <input type="number" v-model="cliente.ubicacion_numero" maxlength="3" />
                  </div>

                  <div class="input_wrapper">
                      <label>Manzana</label>
                      <input type="text" v-model="cliente.ubicacion_manzana" maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>Lote</label>
                      <input type="number" v-model="cliente.ubicacion_lote" maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>N° departamento</label>
                      <input type="number" v-model="cliente.ubicacion_nro_departamento" maxlength="3" />
                  </div>

                  <div class="input_wrapper">
                      <label>Interior</label>
                      <input type="number" v-model="cliente.ubicacion_interior" maxlength="3" />
                  </div>

                  <div class="input_wrapper">
                      <label>Piso</label>
                      <input type="number" v-model="cliente.ubicacion_piso" maxlength="3" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateReferencia}">
                      <label>Referencia</label>
                      <input type="text" v-model="cliente.ubicacion_referencia" maxlength="50" />
                      <div class="message">Información muy corta</div>
                  </div>

                  <div class="input_wrapper">
                      <label>Teléfono</label>
                      <input type="text" v-model="cliente.telefono" maxlength="10" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateCelular}">
                      <label>Celular</label>
                      <input
                        type="text"
                        v-mask="'### ### ###'"
                        v-model="cliente.celular"
                      />
                      <div class="message">Información muy corta</div>
                  </div>

                  <div class="input_wrapper">
                      <label>Email</label>
                      <input type="text" v-model="cliente.email" maxlength="45" />
                  </div>

                </div>

              </div>
            </div>

            <div class="form_buttons all">
              <a class="button_primary medium next" @click="next(1)" v-if="validateStep1">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
              <a class="button_primary medium next" @click="tabError()" v-else>
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div>

          </div>

          <div v-show="tab == 2" class="form_step">

            <div class="form_step_wrapper">

              <h3 class="title">
                Datos Laborales
              </h3>

              <div class="form_content">

                <div class="group_form">

                  <div class="input_wrapper">
                    <label>Estado de Trabajador</label>
                    <select v-model="cliente.persona.estado_trabajo" maxlength="15">
                      <option value="TRABAJA">TRABAJA</option>
                      <option value="NO TRABAJA">NO TRABAJA</option>
                      <option value="JUBILADO">JUBILADO</option>
                      <option value="AMA DE CASA">AMA DE CASA</option>
                      <option value="ESTUDIANTE">ESTUDIANTE</option>
                      <option value="MENOR DE EDAD">MENOR DE EDAD</option>
                      <option value="OTROS">OTROS</option>
                    </select>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateEspecifique}" v-if="cliente.persona.estado_trabajo=='OTROS'">
                    <label>Especifique</label>
                    <input type="text"  maxlength="45" v-model="cliente.persona.trabajo_especificacion">
                    <div class="message">Especifique su trabajo</div>
                  </div>

                </div>

                <span v-if="cliente.persona.estado_trabajo=='TRABAJA'" class="separator"></span>
                
                <div class="group_form"  v-if="cliente.persona.estado_trabajo=='TRABAJA'">

                  <div class="input_wrapper"> 
                    <label>Tipo de Trabajador</label>
                    <select v-model="cliente.trabajo.tipo_trabajador" maxlength="15">
                      <option value="INDEPENDIENTE">INDEPENDIENTE</option>
                      <option value="DEPENDIENTE">DEPENDIENTE</option>
                      <option value="AGRICULTOR">AGRICULTOR</option>
                    </select>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateRazon}">
                    <label>Razon Social</label>
                    <input type="text" maxlength="200" v-model="cliente.trabajo.empresa_razon_social">
                    <div class="message">Se requiere la razón social</div>
                  </div>

                  <div class="input_wrapper">
                    <label>Ingreso Mensual</label>
                    <select v-model="cliente.trabajo.ingreso_mensual" maxlength="25">
                      <option value="HASTA S/. 1000">HASTA S/. 1000</option>
                      <option value="S/. 1.001 a S/ 2.500">S/. 1000 a S/ 2.500</option>
                      <option value="S/. 2.500 a S/ 5.000">S/. 2.500 a S/ 5.000</option>
                      <option value="S/. 5.001 a S/ 10.000">S/. 5.001 a S/ 10.000</option>
                      <option value="S/ 10.001 A MÀS">S/ 10.001 A MÀS</option>
                    </select>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateCargo}">
                    <label>Cargo/ Ocupación</label>
                    <input type="text" maxlength="20" v-model="cliente.trabajo.cargo_ocupacion">
                    <div class="message">Se requiere su ocupación</div>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateFechaIngreso}">
                    <label for="nacimiento">Fecha de Ingreso</label>
                    <input type="date" v-model="cliente.trabajo.fecha_ingreso">
                    <div class="message">Fecha de ingreso a la empresa</div>
                  </div>

                </div>

                <span v-if="cliente.persona.estado_trabajo=='TRABAJA'" class="separator"></span>

                <div class="group_form"  v-if="cliente.persona.estado_trabajo=='TRABAJA'">

                  <div class="input_wrapper" :class="{require: !validateGiro}">
                    <label>Giro de Negocio</label>
                    <v-select
                      label="giro_negocio"
                      :options="giros"
                      :reduce="giros => giros.giro_negocio"
                      v-model="cliente.trabajo.empresa_giro_negocio">
                      <span slot="no-options">
                        No se encontro giro de negocio
                      </span>
                    </v-select>
                    <div class="message">Se requiere giro de negocio</div>
                  </div>

                  <div class="input_wrapper" :class="{require: !validateDireccion}">
                    <label for="nacimiento">Dirección</label>
                    <input type="text" maxlength="100" v-model="cliente.trabajo.empresa_direccion">
                    <div class="message">Dirección de la empresa</div>
                  </div>

                  <div class="input_wrapper">
                      <label>Pais</label>
                      <input type="text" disabled v-model="cliente.trabajo.empresa_pais" maxlength="20" />
                  </div>

                  <div class="input_wrapper">
                      <label>Departamento</label>
                      <select
                        v-model="cliente.trabajo.empresa_departamento"
                        filterable
                        @change="filterProvincesLaboralMe"
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

                  <div class="input_wrapper"  :class="{require: !validateProvinciaDomicilioLaboral}">
                      <label>Provincia</label>
                      <select
                      v-model="cliente.trabajo.empresa_provincia"
                      filterable
                      @change="filterDistrictLaboralMe"
                      dusk="provincias_id">
                      <option value="0">SELECCIONE</option>
                      <option
                        v-for="option in provincesLaboral"
                        :key="option.id"
                        :value="option.id"
                        :label="option.descripcion"
                      >></option>
                    </select>
                    <div class="message">Seleccione provincia</div>
                  </div>

                  <div class="input_wrapper"  :class="{require: !validateDistritoDomicilioLaboral}">
                      <label>Distrito</label>
                      <select
                        v-model="cliente.trabajo.empresa_distrito"
                        filterable
                        dusk="distritos_id">
                      <option value="0">SELECCIONE</option>
                      <option
                        v-for="option in districtsLaboral"
                        :key="option.id"
                        :value="option.id"
                        :label="option.descripcion"
                      >></option>
                    </select>
                    <div class="message">Seleccione Distrito</div>
                  </div> 

                </div> 

                <span v-if="cliente.persona.estado_trabajo=='TRABAJA'" class="separator"></span>

                <div class="group_form"  v-if="cliente.persona.estado_trabajo=='TRABAJA'">

                  <div class="input_wrapper">
                    <label>Número</label>
                    <input type="number" v-model="cliente.trabajo.empresa_numero" maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>Manzana</label>
                      <input type="text" v-model="cliente.trabajo.empresa_manzana" maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>Lote</label>
                      <input type="number" v-model="cliente.trabajo.empresa_lote" maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>N° departamento</label>
                      <input type="number" v-model="cliente.trabajo.empresa_dpto" maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>Interior</label>
                      <input type="number" v-model="cliente.trabajo.empresa_int" maxlength="5" />
                  </div>

                  <div class="input_wrapper">
                      <label>Piso</label>
                      <input type="number" v-model="cliente.trabajo.empresa_piso" maxlength="5" />
                  </div>

                  <div class="input_wrapper" :class="{require: !validateReferenciaLaboral}">
                      <label>Referencia</label>
                      <input type="text" v-model="cliente.trabajo.empresa_referencia" maxlength="50" />
                      <div class="message">Referencia de la dirección</div>
                  </div>

                  <div class="input_wrapper">
                      <label>Teléfono</label>
                      <input type="text" v-model="cliente.trabajo.empresa_telefono" maxlength="10" />
                  </div>
    
                  <div class="input_wrapper" :class="{require: !validateCelularLaboral}">
                      <label>Celular</label>
                      <input
                        type="text"
                        v-mask="'### ### ###'"
                        v-model="cliente.trabajo.empresa_celular"
                      />
                      <div class="message">Celular de la empresa</div>
                  </div>

                  <div class="input_wrapper">
                      <label>Email</label>
                      <input type="text" v-model="cliente.trabajo.empresa_email" maxlength="45" />
                  </div>

                </div>

              </div>

            </div>

            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(2)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" @click="next(2)"  v-if="validateStep1 && validateStep2">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
              <a class="button_primary medium next" @click="tabError" v-else>
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div>
            
          </div>

          <div v-show="tab == 3" class="form_step">

            <div class="form_step_wrapper" >

              <h3 class="title">
                Datos Familiares
              </h3>

              <div class="form_content">

                <div class="group_form">

                  <div class="input_wrapper">
                    <label>¿Tiene Hijos?</label>
                    <select v-model="cliente.tools.hijos">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div> 
 
                  <div class="input_wrapper" v-if="cliente.tools.hijos=='SI'">
                    <label>Nro de hijos</label>
                    <input type="text" maxlength="2" v-mask="'##'" v-model="cliente.tools.numero_hijos" >
                  </div>

                  <div class="input_wrapper">
                    <label>¿Tiene cónyuge ó conviviente?</label>
                    <select v-model="cliente.tools.conyuge">
                      <option value="true">SI</option>
                      <option value="false">NO</option>
                    </select>
                  </div> 
                 

                </div>

              </div>
        
              <div class="form_list" >
                <div v-if="cliente.tools.conyuge" class="sub_step_wrapper"  >
                  <h3 class="title">
                    Conyuge
                  </h3>

                  <div class="form_content" >

                    <div class="group_form small">
                      
                      <div class="input_wrapper">
                        <label> Parentesco </label>
                        <select v-model="cliente.persona.conyuge.parentesco" class="cliente-control" disabled>
                          <option value="CONYUGE">CÓNYUGE</option>
                          <option value="CONVIVIENTE">CONVIVIENTE</option>
                          <option value="HIJOS">HIJOS</option>
                        </select>
                      </div>

                      <div class="input_wrapper" v-if="cliente.tools.conyuge">
                        <label>Ocupación del cónyuge ó conviviente?</label>
                        <select v-model="cliente.persona.conyuge.ocupacion" maxlength="15">
                          <option value="AMA DE CASA">AMA DE CASA</option>
                          <option value="DEPENDIENTE">DEPENDIENTE</option>
                          <option value="INDEPENDIENTE">INDEPENDIENTE</option>
                        </select>
                      </div> 
                      <div class="input_wrapper" :class="{require: !validarDocumentoConyuge}">
                        <label> Documento </label>
                        <input type="text" v-model="cliente.persona.conyuge.documento" maxlength="9" @keyup="datosConyuge(cliente.persona.conyuge.documento)" />
                      </div>

                      <div class="input_wrapper" :class="{require: !validarNombresConyuge}">
                        <label> Nombres </label>
                        <input type="text" v-model="cliente.persona.conyuge.nombres" maxlength="100" class="cliente-control" />
                      </div>
                      <div class="input_wrapper" :class="{require: !validarNacimientoConyuge}">
                        <label for="nacimiento">Fecha de Nacimiento</label>
                        <input type="date" v-model="cliente.persona.conyuge.fecha_nacimiento"> 
                        <div class="message">N° de fecha invalido</div>
                      </div>
                      <div class="input_wrapper">
                        <label> ¿Socio? </label>
                        <select v-model="cliente.persona.conyuge.socio" class="cliente-control">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                          </select>
                      </div>

                    </div>

                  </div>
                </div>
                <div class="sub_step_wrapper" v-for="(row, index) in cliente.persona.hijos" :key="index" >
                  <h3 class="title">
                    Hijo {{index + 1}}
                  </h3>

                  <div class="form_content" >

                    <div class="group_form small">


                      <div class="input_wrapper" :class="{require: !row.validar_documentos}">
                        <label> Documento </label>
                        <input type="text" maxlength="9" v-model="row.documento" @keyup="datosFamiliar(index,row.documento)" />
                      </div>

                      <div class="input_wrapper" :class="{require: !row.validar_nombres}">
                        <label> Nombres  </label>
                        <input type="text" v-model="row.nombres" maxlength="100" class="cliente-control" />
                      </div>
                     
                      <div class="input_wrapper" :class="{require: !row.validar_fecha_nacimiento}">
                        <label for="nacimiento">Fecha de Nacimiento</label>
                        <input type="date" v-model="row.fecha_nacimiento"> 
                        <div class="message">N° de fecha invalido</div>
                      </div>
                      <div class="input_wrapper">
                        <label> ¿Socio? </label>
                        <select v-model="row.socio" class="cliente-control">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                          </select>
                      </div>

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
              <a class="button_primary medium next" @click="next(3)"  v-if="validateStep3">
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
              <a class="button_primary medium next" @click="tabError" v-else>
                <span> SIGUIENTE </span>
                <i class="material-icons-outlined"> navigate_next </i>
              </a>
            </div>

          </div>

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
                    <label>Tipo de Documento</label>
                    <select v-model="cliente.persona.representante.tipo_documento" >
                      <option value="DNI">DNI</option>
                      <option value="CE">CE</option>
                      <option value="PASAPORTE">PASAPORTE</option>
                    </select>
                  </div>

                  <div class="input_wrapper">
                    <label for="documento">Número</label>
                    <input type="text" maxlength="9" v-model="cliente.persona.representante.documento" @keyup="datosRepresentante" />
                  </div>
                  
                  <div class="input_wrapper">
                    <label>Apellidos y Nombres (Representate)  </label>
                    <input type="text" maxlength="100" v-model="cliente.persona.representante.nombres" >
                  </div> 

                  <div class="input_wrapper">
                      <label>Relación con el solicitante</label>
                      <select v-model="cliente.persona.representante.tipo_relacion" >
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

          <div v-show="tab == 5" class="form_step"  >
            
            <div class="form_step_wrapper">
              <h3 class="title">
                Obligaciones Asociativas
              </h3>
              <div class="form_content">
                <div class="group_form">
                  <div class="input_wrapper">
                      <label>Inscripción </label>
                      <vue-numeric currency="S/ " :readonly="true" maxlength='10' separator="," v-model="cliente.obligacion.inscripcion"  v-bind:precision="2"></vue-numeric>
                  </div>
                  <div class="input_wrapper">
                      <label>Aporte </label>
                      <vue-numeric currency="S/ " separator="," maxlength='10' v-model="cliente.obligacion.aporte"  v-bind:precision="2"></vue-numeric>
                  </div>
                  <div class="input_wrapper">
                      <label>Fondo de prevencion social </label>
                      <vue-numeric currency="S/ " separator="," maxlength='10' v-model="cliente.obligacion.fondo"  v-bind:precision="2"></vue-numeric>
                  </div>
                  <div class="input_wrapper">
                      <label>Fondo de prevencion social opcional </label>
                      <vue-numeric currency="S/ " separator="," maxlength='10' v-model="cliente.obligacion.fondo_opcional" v-bind:precision="2"></vue-numeric>
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

          <div v-show="tab == 6" class="form_step" >
            <div class="form_step_wrapper">
              <h3 class="title">
                Declaración
              </h3>
              <div class="form_content">
                <div class="group_form">
                  <div class="input_wrapper">
                    <label>¿Es sujeto a informar a la UIF Perú?</label>
                    <select v-model="cliente.declaracion.uif">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                  </div>
                  <div class="input_wrapper">
                    <label>¿Es PEP? (persona expuesta politicamente)</label>
                    <select v-model="cliente.declaracion.pep">
                      <option value="1">SI</option>
                      <option value="0">NO</option>
                    </select>
                  </div>
                </div>
                <div class="group_form all">
                  <div class="input_wrapper">
                    <label>Observaciones</label>
                    <textarea v-model="cliente.declaracion.obervaciones" cols="auto" rows="5"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="form_buttons">
              <a class="button_inline_primary medium prev" @click="prev(6)">
                <i class="material-icons-outlined"> navigate_before </i>
                <span> ATRAS </span>
              </a>
              <a class="button_primary medium next" :class="{loading: loading}" @click="registrar()" >
                <div class="load_spinner"></div>
                <span> FINALIZAR </span>
                <i class="material-icons-outlined"> check </i>
              </a>
            </div>
          </div>
        </div>
    </section>
  </div>
</template>

<script>
import { serviceNumber } from "../mixins/functions";
import vSelect from "vue-select";
import VueNumeric from 'vue-numeric'
 import { toastOptions } from '../constants.js'
export default {
  name: 'persona',
  mixins: [serviceNumber],
  components: { vSelect,VueNumeric}, 
  data() {
    return {
      giros: [],
      resource: "clientes",
      clientes: [],
      tipo_persona: 'PN',
      all_departments: [],
      all_provinces: [],
      all_districts: [],
      provincesLaboral: [],
      districtsLaboral: [],
      provincesTitular: [],
      districtsTitular: [],
      loading: false,
      cliente : {
        tipo_documento: "DNI",
        documento: "",
        tipo_cliente: 1,
        pais: "PERU",
        ubicacion_referencia: "",
        ubicacion_numero: "",
        ubicacion_manzana: "",
        ubicacion_lote: "",
        ubicacion_nro_departamento: "",
        ubicacion_interior: "",
        ubicacion_piso:"",
        ubicacion_distrito:"100101",
        ubicacion_provincia:"1001",
        ubicacion_departamento:"10",
        ubicacion_direccion_declarada: "",
        ubicacion_direccion_sistema: "",
        email:"",
        telefono: "",
        celular: "",
        persona:{
          nombres: "",
          apellidos: "",
          nacimiento_departamento: "",
          nacimiento_provincia: "",
          nacimiento_distrito: "",
          fecha_nacimiento: "",
          estado_civil: "SOLTERO",
          ocupacion: "",
          tipo_domicilio: "PROPIA",
          centro_laboral: "",
          direccion_laboral: "",
          genero: "MASCULINO",
          grado_instruccion:"PRIMARIA",
          estado_trabajo:"TRABAJA",
          trabajo_especificacion:"",
          hijos: [],
          conyuge:{
            parentesco:"CONYUGE",
            nombres: "",
            documento: "",
            fecha_nacimiento: "",
            socio: 0,
            ocupacion:"AMA DE CASA",
          },
          representante:{
            nombres: "",
            tipo_documento: 'DNI',
            documento:"",
            tipo_relacion: 'PADRE'
          },
        },
        trabajo:{
          tipo_trabajador:"INDEPENDIENTE",
          empresa_razon_social:"",
          ingreso_mensual: "HASTA S/. 1000",
          cargo_ocupacion:"",
          fecha_ingreso:"",
          empresa_giro_negocio: "",
          empresa_direccion: "",
          empresa_numero: "",
          empresa_manzana: "",
          empresa_dpto: "",
          empresa_int: "",
          empresa_piso:"",
          empresa_lote:"",
          empresa_distrito:"100101",
          empresa_provincia:"1001",
          empresa_departamento:"10",
          empresa_pais:"PERÚ",
          empresa_referencia:"",
          empresa_telefono:"",
          empresa_celular:"",
          empresa_email:"",
        },
        tools:{
          hijos:"NO",
          conyuge:false,
          numero_hijos:0
        },
        obligacion:{
          inscripcion: 30,
          aporte:"",
          fondo:"",
          fondo_opcional:"",

        },
        declaracion:{
          uif: 0,
          pep: 0,
          obervaciones:"",
          fecha: ""
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
      tab: 1
    };
  },
   computed: {
    
    validateNumero() {
      return String(this.cliente.documento).length>7;
    },
    validateNacimiento() {
      return this.cliente.persona.fecha_nacimiento.length>4;
    },
    validarNacimientoConyuge(){
      if(this.cliente.tools.conyuge)
      return this.cliente.persona.conyuge.fecha_nacimiento.length>7
      else return true
    },
    validarDocumentoConyuge(){
      if(this.cliente.tools.conyuge)
      return this.cliente.persona.conyuge.documento.length>7
      else return true
    },
    validarNombresConyuge(){
      if(this.cliente.tools.conyuge)
      return this.cliente.persona.conyuge.nombres.length>7
      else return true
    },
    validarNacimientoHijos() {
      let response=true
      this.cliente.persona.hijos.map(detail=>{
        if(detail.fecha_nacimiento==''){
          detail.validar_fecha_nacimiento=false
          response=false
        }else{
          detail.validar_fecha_nacimiento=true
        }
      })
      return response
    },
    validarDocumentosHijos() {
      let response=true
      this.cliente.persona.hijos.map(detail=>{
        if(detail.documento==''){
          detail.validar_documentos=false
          response=false
        }else{
          detail.validar_documentos=true
        }
      })
      return response
    },
    validarNombresHijos() {
      let response=true
      this.cliente.persona.hijos.map(detail=>{
        console.log(detail.nombres.length)
        if(detail.nombres.length<3){
          detail.validar_nombres=false
          response=false
        }else{
          detail.validar_nombres=true
        }
      })
      return response
    },
    validateNombres() {
      return this.cliente.persona.nombres.length>3;
    },
    validateApellidos() {
      return this.cliente.persona.apellidos.length>4;
    },
    validateNacionalidad() {
      return this.cliente.pais.length>3;
    },
    validateDepartamento() {
      return this.cliente.persona.nacimiento_departamento.length>3;
    },
    validateProvincia() {
      return this.cliente.persona.nacimiento_provincia.length>3
    },
    validateDistrito() {
      return this.cliente.persona.nacimiento_distrito.length>3;
    },
    validateOcupacion() {
      return this.cliente.persona.ocupacion.length>3;
    },
    validateDomicilio() {
      return this.cliente.ubicacion_direccion_declarada.length>3;
    },
    validateReferencia() {
      return this.cliente.ubicacion_referencia.length>3;
    },
    validateCelular() {
      return this.cliente.celular.length>8;
    },
    validateProvinciaDomicilio() {
      return this.cliente.ubicacion_provincia!='0';
    },
    validateDistritoDomicilio() {
      return this.cliente.ubicacion_distrito!='0';
    },
    validateStep1(){
      return  this.validateNumero  &&
              this.validateNacimiento &&
              this.validateNombres &&
              this.validateApellidos &&
              this.validateNacionalidad &&
              this.validateDepartamento &&
              this.validateProvincia &&
              this.validateDistrito &&
              this.validateOcupacion &&
              this.validateDomicilio &&
              this.validateReferencia &&
              this.validateProvinciaDomicilio &&
              this.validateDistritoDomicilio &&
              this.validateCelular 
    },

     validateRazon() {
      return this.cliente.trabajo.empresa_razon_social.length>3;
    },
     validateCargo() {
      return this.cliente.trabajo.cargo_ocupacion.length>3;
    },
     validateFechaIngreso() {
      return this.cliente.trabajo.fecha_ingreso.length>4;
    },
     validateGiro() {
      return this.cliente.trabajo.empresa_giro_negocio.length>3;
    },
     validateDireccion() {
      return this.cliente.trabajo.empresa_direccion.length>3;
    },
     validateReferenciaLaboral() {
      return this.cliente.trabajo.empresa_referencia.length>3;
    },
     validateCelularLaboral() {
      return this.cliente.trabajo.empresa_celular.length>8;
    },
     validateEspecifique() {
      return this.cliente.persona.trabajo_especificacion.length>3;
    },
     validateProvinciaDomicilioLaboral() {
      return this.cliente.trabajo.empresa_provincia!='0';
    },
    validateDistritoDomicilioLaboral() {
      return this.cliente.trabajo.empresa_distrito!='0';
    },
    validateStep2(){

      if(this.cliente.persona.estado_trabajo=='TRABAJA'){
              return this.validateRazon &&
                    this.validateCargo &&
                    this.validateFechaIngreso &&
                    this.validateGiro &&
                    this.validateDireccion &&
                    this.validateReferenciaLaboral &&
                    this.validateCelularLaboral &&
                    this.validateDistritoDomicilioLaboral &&
                    this.validateProvinciaDomicilioLaboral
      }
      else if(this.cliente.persona.estado_trabajo=='OTROS'){
                return  this.validateEspecifique
      }
      else{
        return true
      }

    },
    validateStep3(){
      this.validarNacimientoHijos
      this.validarNombresHijos
      this.validarDocumentosHijos
      if(this.validarDocumentosHijos &&
        this.validarNombresHijos &&
        this.validarNacimientoHijos && 
        this.validarNacimientoConyuge &&
        this.validarDocumentoConyuge &&
        this.validarNombresConyuge )
        return true
      else return false
    }

  },
  methods: {
    tabError(){
       this.$toast.error(
          "Rellene los datos necesarios",
          "Error",
          toastOptions.error
        )
    },
    next(index) {
      window.scrollTo(0,0)
      this.tab = index + 1
    },
    prev(index) {
      window.scrollTo(0,0)
      this.tab = index - 1
    },
    hijosAsignacion(new_value,old_value){
       old_value = old_value || 0
       new_value = new_value || 0 
      this.cliente.persona.hijos=[]
      for (var i = 0; i < new_value; i++) { 
              this.cliente.persona.hijos.push({
                  nombres: "",
                  documento:"",
                  fecha_nacimiento:"",
                  socio:0,
                  validar_fecha_nacimiento:false,
                  validar_documentos:false,
                  validar_nombres:false
              })

        } 

    },
    resetForm() {
    },
    datosCliente() {
      let me = this;
      axios
        .post("/consulta/doc", {
          documento: this.cliente.documento
        })
        .then(function(response) {          
          if(response.data){
            me.cliente.persona.nombres = response.data["nombres"];
            me.cliente.persona.apellidos = response.data["surnames"];

            // this.submit()
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    datosRepresentante() {
      if(this.cliente.persona.representante.documento.length==8){
        let me = this;
        axios
          .post("/consulta/doc", {
            documento: this.cliente.persona.representante.documento
          })
          .then(function(response) {          
            if(response.data){
              me.cliente.persona.representante.nombres= response.data["nombres"] +' '+ response.data["surnames"];

              // this.submit()
            }
          })
          .catch(function(error) {
            console.log(error);
          });
      }
    },
    datosFamiliar(index,document) {
      if(document.length==8){
        let me = this;
        axios
        .post("/consulta/doc", {
          documento: this.cliente.persona.hijos[index].documento
        })
        .then(function(response) {
          if(response.data){
            me.cliente.persona.hijos[index].nombres = response.data["nombres"]  + ' ' +  response.data["surnames"];
          }
        })
        .catch(function(error) {
          console.log(error);
        });
      }
    },
    datosConyuge(document) {
      if(document.length==8){
        let me = this;
        axios
        .post("/consulta/doc", {
          documento: me.cliente.persona.conyuge.documento
        })
        .then(function(response) {
          if(response.data){
            me.cliente.persona.conyuge.nombres = response.data["nombres"]  + ' ' +  response.data["surnames"];
          }
        })
        .catch(function(error) {
          console.log(error);
        });
      }
    },
    registrar() {

      this.loading=true
      this.$http
        .post(`/personas`, this.cliente)
        .then(response => {
              this.loading=false
            if(response.data.success){ 

                this.$toast.success(
                    "La solicitud fue registrada",
                    "Exitoso",
                    toastOptions.success
                  )

              this.$router.push({ name: 'clientes'})

              // this.resetForm();
              // this.$router.push({ name: 'clientes'})
            }else{
                this.loading=false
                this.$toast.error(
                  "Error cliente",
                  "Error",
                  toastOptions.error
                )
            }  
        })
        .catch(res=>{
            this.loading=false
            this.$toast.error(
              "Error al registrar",
              "Error",
              toastOptions.error
            )
        })
    },

    filterProvincesTitularMe() {
          this.provincesTitular = this.all_provinces.filter(f => {
              return f.departamento_id == this.cliente.ubicacion_departamento
          })
      },
    filterDistrictTitularMe() {
        this.districtsTitular = this.all_districts.filter(f => {
            return f.provincia_id == this.cliente.ubicacion_provincia
        })
    },
    filterProvincesLaboralMe() {
      this.cliente.trabajo.provincia = '0'
      this.cliente.trabajo.distrito = '0'
          this.provincesLaboral = this.all_provinces.filter(f => {
              return f.departamento_id == this.cliente.trabajo.empresa_departamento
          })
      },
    filterDistrictLaboralMe() {
      this.cliente.trabajo.distrito = '0'
        this.districtsLaboral = this.all_districts.filter(f => {
            return f.provincia_id == this.cliente.trabajo.empresa_provincia
        })
    },
  },
  watch: {
    'cliente.tools.numero_hijos'(new_value,old_value){
      if (new_value == 0 && new_value != '') this.cliente.tools.hijos = 'NO'    
      this.hijosAsignacion(new_value,old_value)
    },
    'cliente.tools.hijos' (val) {
      if (val == 'NO') this.cliente.tools.numero_hijos = 0
      else if (val == 'SI') this.cliente.tools.numero_hijos = 1
    },
    'cliente.documento'(val){
      if(val.length==8){
          this.datosCliente()
      }
    },
  },
  async mounted() {

    this.$http.get(`/evaluaciones/giro`).then(response => {
      this.giros = response.data;
    });

    await this.$http.get(`/ubigeo`).then(response => {
        this.all_departments = response.data.departments;
        this.all_provinces = response.data.provinces;
        this.all_districts = response.data.districts; 
      });

    await this.filterProvincesTitularMe()
    await this.filterDistrictTitularMe()

    await this.filterProvincesLaboralMe()
    await this.filterDistrictLaboralMe()

      
 
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
