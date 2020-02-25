<template >
  <div class="form_step_wrapper">
        <h3 class="title">Datos del Titular</h3>
        <div class="form_content">
          <div class="group_form">
            <div class="input_wrapper" :class="{require: !validateNombre}">
              <label>Nombres</label>
              <input type="text" v-model="cliente.persona.nombres" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" :class="{require: !validateApellidos}">
              <label>Apellidos</label>
              <input type="text" v-model="cliente.persona.apellidos" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" :class="{require: !validateDocumento}">
              <label>Documento</label>
              <input type="text" v-model="cliente.documento" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" :class="{require: !validateNacimiento}">
              <label>Fecha de nacimiento</label>
              <input type="date" v-model="cliente.persona.fecha_nacimiento" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" :class="{require: !validateCivil}">
              <label>Estado Civil</label>
              <select v-model="cliente.persona.estado_civil">
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
              <input type="text" v-model="cliente.persona.ocupacion" maxlength='100' />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" >
              <label>Teléfono</label>
              <input type="text" v-model="cliente.telefono" />
            </div>
            <div class="input_wrapper" :class="{require: !validateCelular}">
              <label>Celular</label>
              <input type="text" v-mask="'### ### ###'" v-model="cliente.persona.celular" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" :class="{require: !validateDireccion}">
              <label>Dirección Declarada</label>
              <input type="text" v-model="cliente.ubicacion_direccion_declarada" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper">
              <label>Dirección Reniec</label>
              <input type="text" v-model='cliente.ubicacion_direccion_sistema' disabled />
            </div>
          </div>

          <span class="separator"></span>

          <div class="group_form">
            <div class="input_wrapper" :class="{require: !validateDepartamento}">
              <label>Departamento</label>
                <select
                    v-model="cliente.ubicacion_departamento"
                    
                    @change="filterProvincesTitularMe"
                    dusk="departamentos_id">                  
                  <option
                    v-for="option in departamentos"
                    :key="option.id"
                    :value="option.id"
                    :label="option.descripcion"
                  >></option>
              </select>
            </div>
            <div class="input_wrapper" :class="{require: !validateProvincia}">
              <label>Provincia</label> 
              <select
                  v-model="cliente.ubicacion_provincia"
                  filterable
                  @change="filterDistrictTitularMe"
                  dusk="provincias_id">
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
                    v-model="cliente.ubicacion_distrito"
                    filterable
                    dusk="distritos_id">
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
              <input type="text" v-model="cliente.ubicacion_referencia" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" :class="{require: !validateDomicilio}">
              <label>Tipo Domicilio</label>
              <select v-model="cliente.persona.tipo_domicilio">
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
              <input type="text" v-model="cliente.persona.trabajo.empresa_razon_social" />
              <div class="message">Se requiere esta información</div>
            </div>
            <div class="input_wrapper" :class="{require: !validateDireccionLaboral}">
              <label>Dirección centro laboral </label>
              <input type="text" v-model="cliente.persona.trabajo.empresa_direccion" />
              <div class="message">Se requiere esta información</div>
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
                  v-model="cliente.persona.conyuge.documento"
                  @keyup="datosCliente()"
                  maxlength='15'
                />
                <div class="message">número de documento inválido</div>
              </div>
              <div class="input_wrapper"  :class="{require: !validateNombreConyuge}">
                <label>Nombres y Apellidos</label>
                <input type="text" v-model="cliente.persona.conyuge.nombres" />
              </div>
              <div class="input_wrapper"  :class="{require: !validateNacimientoConyuge}">
                <label>Fecha de Nacimiento</label>
                <input type="date" v-model="cliente.persona.conyuge.fecha_nacimiento" />
              </div>
              <div class="input_wrapper">
                <label>Estado Civil</label>
                <select v-model="cliente.persona.conyuge.estado_civil">
                  <option value="SOLTERO">SOLTERO</option>
                  <option value="CASADO">CASADO</option>
                  <option value="CONVIVIENTE">CONVIVIENTE</option>
                  <option value="DIVORCIADO - SEPARADO">DIVORCIADO - SEPARADO</option>
                  <option value="VIUDO">VIUDO</option>
                </select>
              </div>
              <div class="input_wrapper"  :class="{require: !validateOcupacionConyuge}">
                <label>Ocupación</label>
                <input type="text" v-model="cliente.persona.conyuge.ocupacion" />
              </div>
              <div class="input_wrapper">
                <label>Socio </label>
                <select v-model="cliente.persona.conyuge.socio">
                  <option value=true>SI</option>
                  <option value=false>NO</option>
                </select>
              </div> 
              <div class="input_wrapper" :class="{require: !validateCodigoConyuge}" v-if="cliente.persona.conyuge.socio" >
                <label>Código</label>
                <input  type="text"  v-model="cliente.persona.conyuge.codigo_socio" maxlength='10'/>
              </div>
              
              <div class="input_wrapper" :class="{require: !validateAporteConyuge}" v-if="cliente.persona.conyuge.socio">
                <label>Aporte </label>
                <input type='text' v-mask='"######"' v-model="cliente.persona.conyuge.aporte_socio" >
              </div>                 
              <div class="input_wrapper">
                <label>Teléfono</label>
                <input type="text" v-model="cliente.persona.conyuge.telefono" maxlength='11' />
              </div>
              <div class="input_wrapper"  :class="{require: !validateCelularConyuge}">
                <label>Celular</label>
                <input  type="text"  v-mask="'### ### ###'"  v-model="cliente.persona.conyuge.celular" />
              </div>
              <div class="input_wrapper" >
                <label>¿Trabaja?</label>
                <select v-model="cliente.persona.conyuge.trabaja">
                  <option value=true>SI</option>
                  <option value=false>NO</option>
                </select>
              </div>

              <div class="input_wrapper"  :class="{require: !validateCentroConyuge}" v-if="cliente.persona.conyuge.trabaja">
                <label>Centro Laboral</label>
                <input type="text" v-model="cliente.persona.conyuge.centro_laboral" />
              </div>

              <div class="input_wrapper"  :class="{require: !validateDireccionConyuge}" v-if="cliente.persona.conyuge.trabaja">
                <label>Dirección centro laboral</label>
                <input type="text" v-model="cliente.persona.conyuge.direccion_centro_laboral" />
              </div>
            </div>
          </div>
        </div>
          </div>
          </div>
          
</template>
<script>
import { OBTENER_DEPARTAMENTOS, OBTENER_PROVINCIAS, OBTENER_DISTRITOS } from '../prestamos.js'
export default {
    data(){
      return{
        departamentos:[],
        provincias:[],
        distritos:[],
        provincesTitular: [],
        districtsTitular: [],
        tools:{
          tiene_conyuge:false
        },
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
            trabajo:{
              empresa_direccion: "",
              empresa_razon_social: "",
            },   

          },
        },
      }
    },
    apollo:{
      departamentosBD:{
        query:OBTENER_DEPARTAMENTOS,              
        update(res){
          this.departamentos=res.departamentos
          this.filterProvincesTitularMe()
        }
      },
      provinciasBD:{
        query:OBTENER_PROVINCIAS,   
        update(res){
          this.provincias=res.provincias
          this.filterProvincesTitularMe()
        }           
      },
      distritosBD:{
        query:OBTENER_DISTRITOS,    
        update(res){
          this.distritos=res.distritos
          this.filterProvincesTitularMe()
        }          
      }
    },    
    methods:{
      filterProvincesTitularMe() {
          this.provincesTitular = this.provincias.filter(f => {
              return f.departamento_id == this.cliente.ubicacion_departamento
          })
          for (let index = 0; index < this.provincesTitular.length; index++) {
            if(this.cliente.ubicacion_provincia==this.provincesTitular[index].id){
              this.cliente.ubicacion_provincia=this.provincesTitular[index].id
            }
          }
          this.filterDistrictTitularMe()
      },
      
      filterDistrictTitularMe() {
          // this.cliente.domicilio_distrito= '0'
          this.districtsTitular = this.distritos.filter(f => {
              return f.provincia_id == this.cliente.ubicacion_provincia
          })        

          for (let index = 0; index < this.districtsTitular.length; index++) {
              if(this.cliente.ubicacion_distrito==this.districtsTitular[index].id){
                this.cliente.ubicacion_distrito=this.districtsTitular[index].id
              }
            }
          // this.prestamo.cliente.ubicacion_distrito=this.districtsTitular[0].id

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
    },
    computed:{
      validateNombre(){
        return this.cliente.persona.nombres.length>2;
      }
      ,
      validateApellidos(){
        return this.cliente.persona.apellidos.length>5;
      }
      ,
      validateDocumento(){
        return this.cliente.documento.length>=8
      }
      ,
      validateNacimiento(){
        return this.cliente.persona.fecha_nacimiento.length>4
      }
      ,
      validateCivil(){
        return this.cliente.persona.estado_civil.length>3
      }
      ,
      validateOcupacion(){
        return this.cliente.persona.ocupacion.length>4
      }
      ,
      validateCelular(){
        return  this.cliente.celular.length>9
      }
      ,
      validateDireccion(){
        return  this.cliente.ubicacion_direccion_declarada.length>5
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
        return this.cliente.ubicacion_referencia.length>5
      }
      ,
      validateDomicilio(){
        return this.cliente.persona.tipo_domicilio.length>5
      }
      ,
      validateCentro(){
        
        if(this.cliente.persona.trabajo)
        {
          return this.cliente.persona.trabajo.empresa_razon_social.length>5
        }
        else{
          return true
        }
      }
      ,
      validateDireccionLaboral(){
        if(this.cliente.persona.trabajo)
        return this.cliente.persona.trabajo.empresa_direccion.length>6
        else return true
      },


      validateDocumentoConyuge(){
        if(this.cliente.persona.conyuge){
            return String(this.cliente.persona.conyuge.documento).length > 6
        }else{
          return true
        }
      },

      validateNombreConyuge(){
        if(this.cliente.persona.conyuge){
          return this.cliente.persona.conyuge.nombres.length>6
        }else{
          return true
        }   
      },

      validateNacimientoConyuge(){
        return this.cliente.persona.conyuge.fecha_nacimiento.length>6
      },

      validateOcupacionConyuge(){
        if(this.cliente.persona.conyuge && this.cliente.persona.conyuge.ocupacion)
          return this.cliente.persona.conyuge.ocupacion.length>6
        else true
      },

      validateCelularConyuge(){
        if(this.cliente.persona.conyuge && this.cliente.persona.conyuge.celular)
        return this.cliente.persona.conyuge.celular.length>6
        else true
      },
      validateCodigoConyuge(){
        if(this.cliente.persona.conyuge.socio=='1'){
          return this.cliente.persona.conyuge.codigo_socio.length>=3
        }
        else{
          return true
        }
      },
      validateAporteConyuge(){
        if(this.cliente.persona.conyuge.socio=='1'){
          return String(this.cliente.persona.conyuge.aporte_socio)>=1
        }
        else{
          return true
        }
      },      
    }
}
</script>