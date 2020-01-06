<template >
    <div class="container-general">
        <div class="row m-0">
            <div class="col-md-12">
                        <h1>Evaluacion cuantitativa</h1>
            </div>
            <div class="col-md-12">
                        <h2>Ingresos del titular</h2>  
            </div>
            <div class="col-md-12">
                        <h2>Ingresos del negocio</h2>
            </div>
            <div class="col-md-12">
                        <table>
            <tr>
                <td>Concepto</td>
                <td>Lunes</td>
                <td>Martes</td>
                <td>Miercoles</td>
                <td>Jueves</td>
                <td>Viernes</td>
                <td>Sabado</td>
                <td>Domingo</td>
                <td>Subtotal</td>
            </tr>
            <tr v-for='(val,index) in evaluacion.titular.ingresos_negocio' v-bind:key='index'>
                <td>
                    <input type='text' v-model='val.concepto'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)'  v-model='evaluacion.titular.ingresos_negocio[index].lunes'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)' v-model='evaluacion.titular.ingresos_negocio[index].martes'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)'  v-model='evaluacion.titular.ingresos_negocio[index].miercoles'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)'  v-model='evaluacion.titular.ingresos_negocio[index].jueves'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)'  v-model='evaluacion.titular.ingresos_negocio[index].viernes'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)'  v-model='evaluacion.titular.ingresos_negocio[index].sabado'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)'  v-model='evaluacion.titular.ingresos_negocio[index].domingo'>
                </td>
                <td>
                    <input type='number' :change='negocioIngresosSubtotal(index)'   v-model='evaluacion.titular.ingresos_negocio[index].subtotal'>
                </td>
            </tr>            
        </table>    
            </div>

            <div class="col-md-12">
                
        <h2>Ingresos por 4tao 5ta Categoria</h2>
            </div>

            <div class="col-md-12">
                
        <table>
            <tr>
                <td>CONCEPTO</td>
                <td>MES</td>
            </tr>
            <tr v-for='(ingreso,index) in evaluacion.titular.ingresos_por_categoria' v-bind:key='index'>
                <td><input type='text' v-model='evaluacion.titular.ingresos_por_categoria[index].concepto'></td>
                <td><input type='text' v-model='evaluacion.titular.ingresos_por_categoria[index].mes'></td>
            </tr>           
        </table>
            </div>

            <div class="col-md-12">
                        <h2>GIRO DEL NEGOCIO</h2>
            </div>

                  <div class="form-group col-md-4">
        <label>Aval con casa propia</label>
                      <input type='text' v-model='evaluacion.titular.giro_negocio' class="form-control">
      </div>

            <div class="form-group col-md-4">
        <label>Aval con casa propia</label>
                      <input type='text' v-model='evaluacion.titular.giro_negocio' class="form-control">
      </div>
      
                  <div class="form-group col-md-4">
        <label>MARGEN COSTO</label>
                <input type='text' v-model='evaluacion.titular.margen_costo' class="form-control">
      </div>

                        <div class="form-group col-md-4">
        <label>VALOR INVENTARIO</label>
        
        <input type='text' v-model='evaluacion.titular.valor_inventario' class="form-control">
      </div>
      
                              <div class="form-group col-md-12">
        <label>GASTO FINANCIERO TITULAR</label>
            
        <table>
            <tr>
                <td>Entidad</td>
                <td>Saldo capital</td>
                <td>Cuota</td>
            </tr>
            <tr v-for='(gasto,index) in evaluacion.titular.gasto_financiero' v-bind:key='index'>
                <td><input type='text' v-model='evaluacion.titular.gasto_financiero[index].entidad'></td>
                <td><input type='text' v-model='evaluacion.titular.gasto_financiero[index].saldo_capital'></td>
                <td><input type='text' v-model='evaluacion.titular.gasto_financiero[index].cuota'></td>
            </tr>

        </table>
      </div>

                                    <div class="form-group col-md-12">
                    <label>GASTO DEL NEGOCIO</label>
                                <table>
                            <tr>
                                <td>Entidad</td>
                                <td>Cuota</td>
                            </tr>
                            <tr v-for='(gasto, index) in evaluacion.titular.gasto_negocio' v-bind:key='index'>
                                <td><input type='text' v-model='evaluacion.titular.gasto_negocio[index].entidad'></td>
                                <td><input type='text' v-model='evaluacion.titular.gasto_negocio[index].pago'></td>
                            </tr>         
                        </table>
                </div>

                
            <div class="form-group col-md-12">
                    <label>INGRESOS DEL CONYUGE O CONVIVIENTE (Si tuviese)</label>
                    <label>Ingresos del negocio (LLenar solo si el negocio es distinto al titular)</label>

                        <table>
            <tr>
                <td>Concepto</td>
                <td>Lunes</td>
                <td>Martes</td>
                <td>Miercoles</td>
                <td>Jueves</td>
                <td>Viernes</td>
                <td>Sabado</td>
                <td>Domingo</td>
                <td>Subtotal</td>
            </tr>
            <tr v-for='(ingreso,index) in evaluacion.conyuge.ingresos_negocio' v-bind:key='index'>
                <td>
                    <input type='text' v-model='evaluacion.conyuge.ingresos_negocio[index].concepto'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)'  v-model='evaluacion.conyuge.ingresos_negocio[index].lunes'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)' v-model='evaluacion.conyuge.ingresos_negocio[index].martes'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)'  v-model='evaluacion.conyuge.ingresos_negocio[index].miercoles'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)'  v-model='evaluacion.conyuge.ingresos_negocio[index].jueves'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)'  v-model='evaluacion.conyuge.ingresos_negocio[index].viernes'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)'  v-model='evaluacion.conyuge.ingresos_negocio[index].sabado'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)'  v-model='evaluacion.conyuge.ingresos_negocio[index].domingo'>
                </td>
                <td>
                    <input type='number' :change='conyugeIngresosSubtotal(index)'   v-model='evaluacion.conyuge.ingresos_negocio[index].subtotal'>
                </td>
            </tr>
            
        </table>  
                </div>


     <div class="form-group col-md-12">
                    <label>Ingresos por 4tao 5ta Categoria</label>
        

        <table>
            <tr>
                <td>CONCEPTO</td>
                <td>MES</td>
            </tr>
            <tr v-for='(ingresos,index) in evaluacion.conyuge.ingresos_por_categoria' v-bind:key='index'>
                <td><input type='text' v-model='evaluacion.conyuge.ingresos_por_categoria[index].concepto'></td>
                <td><input type='text' v-model='evaluacion.conyuge.ingresos_por_categoria[index].mes'></td>
            </tr>            
        </table>
                </div>

             <div class="form-group col-md-12">
                    <label>GIRO DEL NEGOCIO</label>
        <model-select :options="giros"
                        :text="giros.giro_negocio"
                                v-model="evaluacion.conyuge.giro_negocio_conyuge"
                                placeholder="selecciona giro ">
         </model-select>
                </div>

             <div class="form-group col-md-12">
                    <label>MARGEN COSTO</label>
                    
        <input type='text' v-model='evaluacion.conyuge.margen_costo_conyuge' class="form-control">
                </div>

                
             <div class="form-group col-md-12">
                    <label>VALOR INVENTARIO</label>
                    
        <input type='text' v-model='evaluacion.conyuge.valor_inventario_conyuge' class="form-control">
                </div>

                       
             <div class="form-group col-md-12">
                    <label>GASTO FINANCIERO TITULAR</label>
                            <table>
            <tr>
                <td>Entidad</td>
                <td>Saldo capital</td>
                <td>Cuota</td>
            </tr>
            <tr v-for='(gasto,index) in evaluacion.conyuge.gasto_financiero' v-bind:key='index'>
                <td><input type='text' v-model='evaluacion.conyuge.gasto_financiero[index].entidad'></td>
                <td><input type='text' v-model='evaluacion.conyuge.gasto_financiero[index].saldo_capital'></td>
                <td><input type='text' v-model='evaluacion.conyuge.gasto_financiero[index].cuota'></td>
            </tr>            
        </table>
                </div>

                     <div class="form-group col-md-12">
                    <label>GASTO DEL NEGOCIO</label>
                            <table>
            <tr>
                <td>Entidad</td>
                <td>Cuota</td>
            </tr>
            <tr v-for='(gasto,index) in evaluacion.conyuge.gasto_negocio' v-bind:key='index'>
                <td><input type='text' v-model='evaluacion.conyuge.gasto_negocio[index].entidad'></td>
                <td><input type='text' v-model='evaluacion.conyuge.gasto_negocio[index].pago'></td>
            </tr>
            
        </table>
                </div>
                                     <div class="form-group col-md-12">
                    <label>GASTOS SERVICIO DEL HOGAR</label>
                    
        <table>
            <tr>
                <td>Concepto</td>
                <td>Pago</td>
            </tr>
            <tr v-for='(gasto,index) in evaluacion.gastos_hogar' v-bind:key='index'>
                <td><input type='text' v-model='evaluacion.gastos_hogar[index].concepto'> </td>
                <td><input type='text' v-model='evaluacion.gastos_hogar[index].pago'> </td>
            </tr>            
        </table>
                   
                </div>

                                     <div class="form-group col-md-12">
                    <label>PROPIEDADES</label>
                    
            <table>
            <tr>
                <td>Concepto</td>
                <td>Pago</td>
            </tr>
            <tr v-for='(propiedades,index) in evaluacion.propiedades' v-bind:key='index'>
                <td><input type='text' v-model='evaluacion.propiedades[index].concepto'> </td>
                <td><input type='text' v-model='evaluacion.propiedades[index].valor_estimado'> </td>
            </tr>
            
        </table>
                   
                </div>


                                     <div class="form-group col-md-12">
                    <label>PROPUESTA</label>
                   
                </div>

                               <div class="form-group col-md-12">
                    <label>PRODUCTO</label>
                   
        <input type='text' v-model='evaluacion.propuesta.producto' class="form-control">
                </div>

                            <div class="form-group col-md-12">
                    <label>MONTO</label>
                   
        <input type='text' v-model='evaluacion.propuesta.monto' class="form-control">
                </div>

                           <div class="form-group col-md-12">
                    <label>PLAZO</label>
                   
        <input type='text' v-model='evaluacion.propuesta.plazo' class="form-control">
                </div>

                         <div class="form-group col-md-12">
                    <label>NUMERO CUOTAS</label>
                   
        <input type='text' v-model='evaluacion.propuesta.numero_cuotas' class="form-control">
                </div>
                         <div class="form-group col-md-12">
                    <label>CUOTAS</label>
                   
        <input type='text' v-model='evaluacion.propuesta.cuotas' class="form-control">
                </div>
                       <div class="form-group col-md-12">
                    <label>PROB INFOCORP</label>
                   
        <input type='text' v-model='evaluacion.probabilidad_infocorp' class="form-control">
                </div>

                   <div class="form-group col-md-12">
                       <button @click='guardar()' class="btn btn-crecer">Guardar</button>
                </div>


        </div>
    </div>
</template>
<script>
import { ModelSelect } from 'vue-search-select'

export default {
        components: {
      ModelSelect
    },
    data(){
        return{
            giros: [],
            evaluacion:{
                prestamo_id:this.$route.params.prestamo,
                propuesta:{
                    producto:"",
                    monto:1,
                    numero_cuotas:0,
                    cuotas:0,
                },
                probabilidad_infocorp:0,
                gastos_hogar:[
                    {
                        concepto:"",
                        pago:0
                    },
                    {
                        concepto:"",
                        pago:0
                    },
                    {
                        concepto:"",
                        pago:0
                    },
                    {
                        concepto:"",
                        pago:0
                    },
                    {
                        concepto:"",
                        pago:0
                    },
                    {
                        concepto:"",
                        pago:0
                    },
                ],
                propiedades:[
                    {
                        concepto:"",
                        valor_estimado:0
                    },
                    {
                        concepto:"",
                        valor_estimado:0
                    },
                    {
                        concepto:"",
                        valor_estimado:0
                    },
                    {
                        concepto:"",
                        valor_estimado:0
                    },
                    {
                        concepto:"",
                        valor_estimado:0
                    },
                    {
                        concepto:"",
                        valor_estimado:0
                    },
                ],
                titular:{
                    ingresos_negocio:[
                        {
                            concepto:'',
                            lunes:0,
                            martes:0,
                            miercoles:0,
                            jueves:0,
                            viernes:0,
                            sabado:0,
                            domingo:0,
                        },
                        {
                            concepto:'',
                            lunes:0,
                            martes:0,
                            miercoles:0,
                            jueves:0,
                            viernes:0,
                            sabado:0,
                            domingo:0,
                        },
                        {
                            concepto:'',
                            lunes:0,
                            martes:0,
                            miercoles:0,
                            jueves:0,
                            viernes:0,
                            sabado:0,
                            domingo:0,
                        }
                    ],
                    ingresos_por_categoria:[
                        {
                            concepto:"",
                            mes:""
                        },
                        {
                            concepto:"",
                            mes:""
                        }
                    ],
                    gasto_financiero:[
                        {
                            entidad:"",
                            saldo_capital:0,
                            cuota:0,
                        },
                        {
                            entidad:"",
                            saldo_capital:0,
                            cuota:0,
                        },
                        {
                            entidad:"",
                            saldo_capital:0,
                            cuota:0,
                        }
                    ],
                    gasto_negocio:[
                        {
                            entidad:"ALQUILER",
                            pago:0
                        },
                        {
                            entidad:"EMPLEADOS",
                            pago:0
                        },
                        {
                            entidad:"IMPUESTOS",
                            pago:0
                        },                      
                        {
                            entidad:"SERVICIOS LAT",
                            pago:0
                        }
                    ],
                    giro_negocio:"",
                    margen_costo:0,
                    valor_inventario:0,
                },
                conyuge:{
                    ingresos_negocio:[
                        {
                            concepto:'',
                            lunes:0,
                            martes:0,
                            miercoles:0,
                            jueves:0,
                            viernes:0,
                            sabado:0,
                            domingo:0,
                        },
                        {
                            concepto:'',
                            lunes:0,
                            martes:0,
                            miercoles:0,
                            jueves:0,
                            viernes:0,
                            sabado:0,
                            domingo:0,
                        },
                        {
                            concepto:'',
                            lunes:0,
                            martes:0,
                            miercoles:0,
                            jueves:0,
                            viernes:0,
                            sabado:0,
                            domingo:0,
                        }
                    ],

                    ingresos_por_categoria:[
                        {
                            concepto:"",
                            mes:""
                        },
                        {
                            concepto:"",
                            mes:""
                        }
                    ],
                    giro_negocio:"",
                    margen_costo:"",
                    valor_inventario:0,
                    gasto_financiero:[
                        {
                            entidad:"",
                            saldo_capital:0,
                            cuota:0,
                        },
                        {
                            entidad:"",
                            saldo_capital:0,
                            cuota:0,
                        },
                        {
                            entidad:"",
                            saldo_capital:0,
                            cuota:0,
                        }
                    ],
                    gasto_negocio:[
                        {
                            entidad:"ALQUILER",
                            pago:0
                        },
                        {
                            entidad:"EMPLEADOS",
                            pago:0
                        },
                        {
                            entidad:"IMPUESTOS",
                            pago:0
                        },                       
                        {
                            entidad:"SERVICIOS LAT",
                            pago:0
                        }
                    ],
                }
            }
        }
    },

     async mounted() { 
                     this.$http.get(`/evaluaciones/propuestaAnalista/` + this.$route.params.prestamo)
                            .then(response => { 
                            console.log(response.data);
                                    this.evaluacion.propuesta.producto=response.data.producto
                                    this.evaluacion.propuesta.monto=response.data.importe
                                    this.evaluacion.propuesta.cuotas=response.data.cuotas
                                    this.evaluacion.propuesta.plazo=response.data.plazo
                            });

                   this.$http.get(`/evaluaciones/giro/`)
                            .then(response => { 
                            console.log(response.data);
                            this.giros = response.data;
                            });
        },
    methods:{
        negocioIngresosSubtotal(index){
            this.evaluacion.titular.ingresos_negocio[index].subtotal=parseFloat(this.evaluacion.titular.ingresos_negocio[index].lunes,2)+
                                            parseFloat(this.evaluacion.titular.ingresos_negocio[index].martes,2)+
                                            parseFloat(this.evaluacion.titular.ingresos_negocio[index].miercoles,2)+
                                            parseFloat(this.evaluacion.titular.ingresos_negocio[index].jueves,2)+
                                            parseFloat(this.evaluacion.titular.ingresos_negocio[index].viernes,2)+
                                            parseFloat(this.evaluacion.titular.ingresos_negocio[index].sabado,2)+
                                            parseFloat(this.evaluacion.titular.ingresos_negocio[index].domingo,2)            
        },
        guardar(){
            axios.post('/evaluaciones/cuantitativa',this.evaluacion)
            .then(res=>{
                alert('guardado correctamente');
            })
        },  
        conyugeIngresosSubtotal(index){
            this.evaluacion.conyuge.ingresos_negocio[index].subtotal=parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].lunes,2)+
                                            parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].martes,2)+
                                            parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].miercoles,2)+
                                            parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].jueves,2)+
                                            parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].viernes,2)+
                                            parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].sabado,2)+
                                            parseFloat(this.evaluacion.conyuge.ingresos_negocio[index].domingo,2)
        }
    }
}
</script>