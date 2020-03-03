<template lang='pug'>
  .create_client_content
    section.tabs_section
      .tabs_wrapper
        .tab(@click='tab = 1' :class='[{selected: tab == 1}]')
          span 1
          p SOLICITUD
        .tab(@click='validate.propuesta_cliente ? tab = 2 : tabError()' :class='{selected: tab == 2}')
          span 2
          p CLIENTE         
    section.client_forms
      .client_forms_wrapper
        .form_step(v-show='tab == 1')
          propuesta-cliente(v-on:update='updatePropuestaCliente')  
          .form_buttons.all
            a.button_primary.medium.next(@click=' validate.propuesta_cliente ? next(1) : tabError()')
              span SIGUIENTE
              i.material-icons-outlined navigate_next
        .form_step( v-show='tab == 2')
          cliente-persona( v-if='prestamo.cliente.tipo_cliente==1' v-on:update='updateClientePersona' :clienteID='prestamo.cliente.id' )  
          cliente-empresa(v-else v-on:update='updateClientePersona' :clienteID='prestamo.cliente.id' )
          .form_buttons
            a.button_inline_primary.medium.prev(@click='prev(5)')
              i.material-icons-outlined navigate_before
              span ATRAS
            a.button_primary.medium.next(@click.prevent=' validate.cliente_persona  ? registrar() : tabError()' :class='{loading: loading}')
              .load_spinner
              span FINALIZAR
              i.material-icons-outlined check

</template>

<script>
import { toastOptions } from '../../constants.js'
import { OBTENER_PRESTAMOS , OBTENER_CLIENTES, REGISTRAR_PRESTAMO  } from './prestamos.js'
import PropuestaCliente  from './registrarElementos/PropuestaCliente'
import ClientePersona  from './registrarElementos/ClientePersona'
import ClienteEmpresa  from './registrarElementos/ClienteEmpresa'

export default {
  components:{  PropuestaCliente,
                ClientePersona,
                ClienteEmpresa,
                },
  data() {
    return {
      tab: 1,    
      cualitativa:{

      } , 
      prestamo: {
        id: this.$route.params.prestamoID, 
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
        estado: 1,
        cliente:{
          id:this.$route.params.clienteID,
          tipo_cliente:this.$route.params.tipoCliente
        }
      },
      loading: false,
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
        propuesta_cliente : false,
        cliente_persona : false,
      }
    };
  },
  methods: {    
    updatePropuestaCliente(data){
      this.prestamo.monto_cliente=data.monto_cliente
      this.prestamo.forma=data.forma
      this.prestamo.cuotas_cliente=data.cuotas_cliente
      this.prestamo.disponibilidad_pago=data.disponibilidad_pago
      this.cualitativa.fuente_ingresos=data.fuente_ingresos
      this.cualitativa.destino_credito=data.destino_credito
      this.cualitativa.destino_credito_descripcion=data.destino_credito_descripcion
      this.validate.propuesta_cliente = data.validate
    },
    updateClientePersona(data){
      this.prestamo.cliente=data.cliente
      this.validate.cliente_persona=data.validate
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
    registrar() {
      this.loading= true
      let cualitativa={
        fuente_ingresos:this.cualitativa.fuente_ingresos,
        destino_credito:this.cualitativa.destino_credito,
        destino_credito_descripcion:this.cualitativa.destino_credito_descripcion,
      }
      this.$apollo.mutate({
        mutation: REGISTRAR_PRESTAMO,
        variables:{
          id: this.$route.params.prestamoID,
          userID: localStorage.getItem("userID"),
          monto_cliente: this.prestamo.monto_cliente,
          forma: this.prestamo.forma,
          cuotas_cliente: this.prestamo.cuotas_cliente,
          disponibilidad_pago: this.prestamo.disponibilidad_pago,
          cualitativa: cualitativa,
          cliente: this.prestamo.cliente,
          estado:this.prestamo.estado
        }
      }).then(res=>{
        console.log("si volvio")
        this.loading = false
        this.$toast.success(
            "El prestamo fue creado",
            "Exitoso",
            toastOptions.success
          )
      this.$router.push({ name: 'perfil', params: { id: this.$route.params.clienteID}})
      }).catch(err=>{
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
