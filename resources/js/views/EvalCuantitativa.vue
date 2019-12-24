<template >
    <div class="container-general">
        <h1>Evaluacion cuantitativa</h1>
        <h2>Ingresos del titular</h2>        
        <h2>Ingresos del negocio</h2>
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
        <h2>Ingresos por 4tao 5ta Categoria</h2>
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
        <h2>GIRO DEL NEGOCIO</h2>
        <input type='text' v-model='evaluacion.titular.giro_negocio'>
        <h2>MARGEN COSTO</h2>
        <input type='text' v-model='evaluacion.titular.margen_costo'>
        <h2>VALOR INVENTARIO</h2>
        <input type='text' v-model='evaluacion.titular.valor_inventario'>
        <h2>GASTO FINANCIERO TITULAR</h2>
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
        <h2>GASTO DEL NEGOCIO</h2>
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
        <h2>INGRESOS DEL CONYUGE O CONVIVIENTE (Si tuviese) </h2>
        <h2>Ingresos del negocio (LLenar solo si el negocio es distinto al titular)</h2>
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
            <tr v-for='(ingreso,index) in evaluacion.conyuge.ingresos_negocios' v-bind:key='index'>
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
        <h2>Ingresos por 4tao 5ta Categoria</h2>
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
        <h2>GIRO DEL NEGOCIO</h2>
        <input type='text' v-model='evaluacion.conyuge.giro_negocio_conyuge'>
        <h2>MARGEN COSTO</h2>
        <input type='text' v-model='evaluacion.conyuge.margen_costo_conyuge'>
        <h2>VALOR INVENTARIO</h2>
        <input type='text' v-model='evaluacion.conyuge.valor_inventario_conyuge'>
        <h2>GASTO FINANCIERO TITULAR</h2>
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
        <h2>GASTO DEL NEGOCIO</h2>
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
        <h2>GASTOS SERVICIO DEL HOGAR</h2>
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
        <h2>PROPIEDADES</h2>
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
        <h2>PROPUESTA</h2>
        <label>PRODUCTO</label>
        <input type='text' v-model='evaluacion.propuesta.producto'>
        <label>MONTO</label>
        <input type='text' v-model='evaluacion.propuesta.monto'>
        <label>PLAZO</label>
        <input type='text' v-model='evaluacion.propuesta.plazo'>
        <label>NUMERO CUOTAS</label>
        <input type='text' v-model='evaluacion.propuesta.numero_cuotas'>
        <label>CUOTAS</label>
        <input type='text' v-model='evaluacion.propuesta.cuotas'>
        <label>PROB INFOCORP</label>
        <input type='text' v-model='evaluacion.probabilidad_infocorp'>
        <br>
        <button @click='guardar()'>Guardar</button>
    </div>
</template>
<script>
export default {
    data(){
        return{
            evaluacion:{
                prestamo_id:this.$params.prestamo,
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
                console.log('volvio')
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