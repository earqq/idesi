<template>
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
        <div class="tab" @click="validate.propuesta_cliente ? tab = 2 : tabError()" :class="{selected: tab == 2}"  >
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
          <propuesta-cliente v-on:update='updatePropuestaCliente'> </propuesta-cliente>
          <div class="form_buttons all">
            <a class="button_primary medium next" @click=" validate.propuesta_cliente ? next(1) : tabError()">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>
        <div v-if='prestamo.cliente.tipo_cliente==1' v-show="tab == 2" class="form_step">
          <cliente-persona v-on:update='updateClientePersona'> </cliente-persona>
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
          

          <div class="form_buttons">
            <a class="button_inline_primary medium prev" @click="prev(3)">
              <i class="material-icons-outlined">navigate_before</i>
              <span>ATRAS</span>
            </a>
            <a class="button_primary medium next" @click=" (validateStep2 && validateStep1 && validateStep3) ? next(3) : tabError()">
              <span>SIGUIENTE</span>
              <i class="material-icons-outlined">navigate_next</i>
            </a>
          </div>
        </div>

        <div v-show="tab == 4" class="form_step">
        

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
                  <input
                    type='text'
                    v-model="prestamo.importe"
                    v-mask='"#####"'
                  >
                </div>
                <div class="input_wrapper">
                  <label>Cuotas</label>
                  <input
                    type="text"
                    v-model="prestamo.cuotas"
                    v-mask='"#####"'
                    @keyup="meses_numero"
                  />
                </div>
                <div class="input_wrapper">
                  <label>Meses</label>
                  <input type="text" v-model="prestamo.meses" disabled />
                </div>
                <div class="input_wrapper">
                  <label>Cuota del sistema</label>
                  <input  type='number' v-model="prestamo.cuota_sistema"    >
                </div>
                <div class="input_wrapper">
                  <label>Aporte a la fecha</label>
                  <input
                    type='text'                    
                    v-mask='"#####"'
                    v-model="prestamo.aporte"
                  >
                </div>
                <div class="input_wrapper">
                  <label>Prob. Infocorp</label>
                  <input type='number' v-model="prestamo.probabilidad_infocorp"  >
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
import { toastOptions } from '../../constants.js'
import { OBTENER_PRESTAMOS , OBTENER_CLIENTES  } from './prestamos.js'
import PropuestaCliente  from './registrarElementos/PropuestaCliente'
import ClientePersona  from './registrarElementos/ClientePersona'

export default {
  components:{  PropuestaCliente,
                ClientePersona },
  data() {
    return {
      resource: "clientes",
      tab: 1,    
      errors: {},
      tools:{
        tiene_conyuge:false,      
      },
      cualitativa: {
        prestamo_id: this.$route.params.prestamo,
        destino_credito_descripcion: "",
        destino_credito: "Capital de trabajo",
        fuente_ingreso: "",
        negocio: {
          ubicacion: "",
          antiguedad: "1 AÑO",
          local: "PROPIO",
          licencia_funcionamiento: "SI CUENTA",
          horario_atencion_inicio: "00:00",
          horario_atencion_salida: "00:00",
          mejoras_local: "SI REALIZO"
        },
        vehiculo: {
          marca: "",
          modelo: "",
          año: "2010",
          tipo_servicio_brinda: "",
          antiguedad_servicio: "",
          permiso_servicio: "SI CUENTA",
          horario_servicio_inicio: "00:00",
          horario_servicio_fin: "00:00"
        },
        familiar: {
          numero_hijos: 0,
          tipo_vivienda: "PROPIA CANCELADA",
          situacion_familiar: "SOLTERO",
          miembros_familia: 0,
          hijos: []
        },
        comentario_central_riesgo:'',
        central_riesgo: [
          {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          },
          {
            entidad_financiera: "",
            capital: false,
            activo_f: false,
            consumo: false,
            vehicular: false,
            hipoteca: false,
            terceros: false
          }
        ],
        referencias: [
          {
            tipo_relacion: "",
            nombre: "",
            telefono: ""
          },
          {
            tipo_relacion: "",
            nombre: "",
            telefono: ""
          }
        ],
        colateral: "SIN COLATERAL",
        comentario_colateral: ""
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
        monto_cliente: "",
        cuotas_cliente: "5",
        disponibilidad_pago: "",
        destino_credito: "",
        forma: "DIARIO",
        producto_analista: "CREDIDIARIO",
        meses_analista: 0,
        importe_analista: 0,
        aporte_analista: 0,
        cuotas_analista: 0,
        cuota_sistema:0,
        tasa: 0.0,
        comentarios: "",
        estado: 1
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
      },
      validate:{
        propuesta_cliente : false
      }
    };
  },
  apollo:{
      obtenerPrestamo:{
        query: OBTENER_PRESTAMOS,
        variables(){
          return {
            id:this.$route.params.prestamoID
          } 
        },
        update(res){
          if(res.prestamos[0])
            console.log("updating")
        }
      },
      obtenercliente:{
        query: OBTENER_CLIENTES,
        variables(){
          return{
            id:this.$route.params.clienteID
          }
        },
        update(res){
          this.prestamo.cliente=res.clientes[0]
          if(!this.prestamo.cliente.persona.trabajo){
            this.prestamo.cliente.persona.trabajo={
                empresa_ruc:"",
                empresa_direccion: "",
                empresa_razon_social: "",
              }
          }

          if(this.prestamo.cliente.persona.conyuge){
            this.tools.tiene_conyuge=true
            this.prestamo.cliente.persona.conyuge={
                documento: this.prestamo.cliente.persona.conyuge.documento || "",
                nombres: this.prestamo.cliente.persona.conyuge.nombres || "",
                fecha_nacimiento: this.prestamo.cliente.persona.conyuge.fecha_nacimiento || "",
                estado_civil: this.prestamo.cliente.persona.conyuge.estado_civil || "",
                ocupacion: this.prestamo.cliente.persona.conyuge.ocupacion || "",
                telefono: this.prestamo.cliente.persona.conyuge.telefono || "",
                celular: this.prestamo.cliente.persona.conyuge.celular || "",
                trabaja: this.prestamo.cliente.persona.conyuge.trabaja,
                centro_laboral: this.prestamo.cliente.persona.conyuge.centro_laboral || "",
                direccion_centro_laboral: this.prestamo.cliente.persona.conyuge.direccion_centro_laboral || "",
                socio: this.prestamo.cliente.persona.conyuge.socio,
                codigo_socio: this.prestamo.cliente.persona.conyuge.codigo_socio || "",
                aporte_socio: this.prestamo.cliente.persona.conyuge.aporte_socio || "",
            }
          }else{
            this.tools.tiene_conyuge=false
          }    
        }
      }
  },
  computed: {       
   
    validateCodigosSociosAval(){
      let response=true
      this.prestamo.avales.map(item=>{
        if(item.socio=='1'){
          item.validate_codigo_socio=false
          item.validate_aporte_socio=false
          if(item.codigo_socio && item.codigo_socio.length>2)
            item.validate_codigo_socio=true
          else response=false
          if(item.aporte_socio>0)
            item.validate_aporte_socio=true  
          else response=false
        }
      })     
      return response
    },
    validateFechasNacimientoSocios(){
      let response=true
      this.prestamo.avales.map(item=>{
        item.validate_fecha_nacimiento=false
        if(item.fecha_nacimiento && item.fecha_nacimiento.length>2)
          item.validate_fecha_nacimiento=true
        else response=false
      })     
      return response
    },
    validateDocumentosSocios(){
      let response=true
      this.prestamo.avales.map(item=>{
        item.validate_documento=false
        if(item.documento && item.documento.length>2)
          item.validate_documento=true
        else response=false
      })     
      return response
    },
    validateNombresSocios(){
      let response=true
      this.prestamo.avales.map(item=>{
        item.validate_nombres=false
        if(item.nombres && item.nombres.length>2)
          item.validate_nombres=true
        else response=false
      })     
      return response
    },
    validateApellidosSocios(){
      let response=true
      this.prestamo.avales.map(item=>{
        item.validate_apellidos=false
        if(item.apellidos && item.apellidos.length>2)
          item.validate_apellidos=true
        else response=false
      })     
      return response
    },
    validateCentroConyuge(){
      if(this.prestamo.cliente.persona.conyuge.trabaja=='1'){
        return this.prestamo.cliente.persona.conyuge.centro_laboral.length>5
      }
      else{
        return true
      }
      
    },

    validateDireccionConyuge(){
       if(this.prestamo.cliente.persona.conyuge.trabaja=='1'){
        return this.prestamo.cliente.persona.conyuge.direccion_centro_laboral.length>5
      }
      else{
        return true
      }
      
    },

    validateStep3(){
      return this.validateCodigosSociosAval &&
            this.validateFechasNacimientoSocios &&
            this.validateDocumentosSocios &&
            this.validateNombresSocios &&
            this.validateApellidosSocios
    },
    validateStep2(){
    
      if(this.tools.tiene_conyuge){

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
      if(this.$route.params.prestamoID!='0')
          this.obtenerDatosPrestamo()
  },

  methods: {    
    updatePropuestaCliente(data){
      this.prestamo.monto_cliente=data.monto_cliente
      this.prestamo.forma=data.forma
      this.prestamo.cuotas_cliente=data.cuotas_cliente
      this.prestamo.disponibilidad_pago=data.disponibilidad_pago
      this.cualitativa.fuente_ingreso=data.fuente_ingreso
      this.cualitativa.destino_credito=data.destino_credito
      this.cualitativa.destino_credito_descripcion=data.destino_credito_descripcion
      this.validate.propuesta_cliente = data.validate
    },
    updateClientePersona(data){
      // this.prestamo.monto_cliente=data.monto_cliente
      // this.prestamo.forma=data.forma
      // this.prestamo.cuotas_cliente=data.cuotas_cliente
      // this.prestamo.disponibilidad_pago=data.disponibilidad_pago
      // this.cualitativa.fuente_ingreso=data.fuente_ingreso
      // this.cualitativa.destino_credito=data.destino_credito
      // this.cualitativa.destino_credito_descripcion=data.destino_credito_descripcion
      // this.validate.propuesta_cliente = data.validate
    },
    obtenerDatosPrestamo(){
      this.$http
      .get(`clientes/datos/prestamo/` + this.$route.params.prestamoID)
      .then(response => {  
              this.prestamo.monto_inicial= response.data.monto_inicial || ""
              this.prestamo.cuotas_inicial= response.data.cuotas_inicial  || "5"
              this.prestamo.disponibilidad_pago_inicial= response.data.disponibilidad_pago_inicial  || ""
              this.prestamo.destino_inicial= response.data.destino_inicial  || "" 
              this.prestamo.forma_inicial= response.data.forma_inicial  || "DIARIO"
              this.prestamo.producto =  response.data.producto  || ""
              this.prestamo.forma= response.data.forma   || ""
              this.prestamo.importe= response.data.importe  || ""
              this.prestamo.meses= response.data.meses  || ""
              this.prestamo.aporte= response.data.aporte  || ""
              this.prestamo.cuota_sistema= response.data.cuota_sistema  || ""
              this.prestamo.cuotas= response.data.cuotas  || ""
              this.prestamo.tasa= response.data.tasa   || ""
              this.prestamo.comentarios= response.data.comentarios  || "" 
              this.prestamo.producto_final= response.data.producto_final  || ""
              this.prestamo.forma_final= response.data.forma_final || "" 
              this.prestamo.aporte_final= response.data.aporte_final  || ""
              this.prestamo.importe_final= response.data.importe_final || ""  
              this.prestamo.plazo_final= response.data.plazo_final  || "" 
              this.prestamo.cuota_final= response.data.cuota_final  || "" 
              this.prestamo.tasa_final= response.data.tasa_final || ""            
              if(response.data.avales){
                response.data.avales.map(item=>{
                  item.validate_codigo_socio=true
                  item.validate_aporte_socio=true
                  item.validate_fecha_nacimiento=true
                  item.validate_documento=true
                  item.validate_nombres=true
                  item.validate_apellidos=true
                  if(item.socio)
                    item.socio='1'
                  else 
                    item.socio='0'
                  this.prestamo.avales.push(item)                  
                })
              }

              if(response.data.garantias){
                this.prestamo.garantias = response.data.garantias
              }
              
              
      });
    },
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
        socio: 0,
        codigo_socio: "",
        aporte_socio: "",
        validate_codigo_socio:false,
        validate_aporte_socio:false,
        validate_fecha_nacimiento:false,
        validate_documento:false,
        validate_nombres:false,
        validate_apellidos:false,
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
        inscripcion: "",
        declaracion_jurada:"",
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
              this.$router.push({ name: 'perfil', params: { id: this.$route.params.clienteID}})
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
