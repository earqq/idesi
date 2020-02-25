<template lang="pug">
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
                     <div :class="{require: !row.validate_documento, other: validateDocumentosSocios}" class="input_wrapper">
                      <label>Documento de Identidad</label>
                      <input
                        type="text"
                        v-model="row.documento"
                        v-mask="'#########'"
                        @change="datosAval(index)"
                      />
                    </div>
                     <div :class="{require: !row.validate_nombres, other: validateNombresSocios}" class="input_wrapper">
                      <label>Nombres</label>
                      <input type="text" maxlength="50" v-model="row.nombres" />
                    </div>
                     <div :class="{require: !row.validate_apellidos, other: validateApellidosSocios}" class="input_wrapper">
                      <label>Apellidos</label>
                      <input type="text" maxlength="50" v-model="row.apellidos" />
                    </div>
                    <div :class="{require: !row.validate_fecha_nacimiento, other: validateFechasNacimientoSocios}" class="input_wrapper">
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
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </select>
                    </div>                    
                    <div  v-if="row.socio=='1'" :class="{require: !row.validate_codigo_socio, other: validateCodigosSociosAval}" class="input_wrapper">
                      <label>Codigo</label>
                      <input type="text" v-model="row.codigo_socio"  maxlength='10' />
                    </div>
                    <div  v-if="row.socio=='1'" :class="{require: !row.validate_aporte_socio , other: validateCodigosSociosAval}" class="input_wrapper">
                      <label>Aporte</label>
                      <input
                        type='text'
                        v-mask='"######"'
                        v-model="row.aporte_socio"
                        
                      >
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
</template>