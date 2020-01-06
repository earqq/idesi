<template >
    <div class="container-general">
        <h2>Datos principales</h2>
        <label>Fuente de ingreso</label>
        <input v-model='principal.fuente_ingreso' type='text'>
        <label>Destino del credito</label>
        <select v-model='principal.destino_credito'>
            <option value='1'>Capital de trabajo</option>
            <option value='2'>Activo Fijo</option>
            <option value='3'>Consumo</option>
            <option value='4'>Vehiculo</option>
            <option value='5'>Hipotecario</option>
            <option value='6'>Mejoramiento de vivienda</option>
            <option value='7'>Compra de deuda</option>
        </select>
        <label>Descripcion destino</label>
        <input type="text" v-model='principal.destino_credito_descripcion'>

        <h2>Datos del negocio</h2>
        <label>Ubicacion del negocio</label>
        <input type="text" v-model='negocio.ubicacion'>
        <label>Antiguedad</label>
        <select v-model="negocio.antiguedad">
            <option value='0'>Menos de 1 año</option>
            <option value='1'>1 año</option>
            <option value='2'>2 años</option>
            <option value='3'>3 años</option>
            <option value='4'>4 años</option>
            <option value='5'>5 años</option>
            <option value='6'>Más de 5 años</option>
        </select>
        <label>Local</label>
        <select v-model='negocio.local'>
            <option value='1'>Propio</option>
            <option value='2'>Alquilado</option>
            <option value='3'>Módulo V. pública</option>
            <option value='4'>Familiar</option>
            <option value='5'>Hipotec/anticresis</option>
        </select>
        <label>Licencia de Funcionamiento</label>
        <select v-model='negocio.licencia_funcionamiento'>
            <option value='1'>Si cuenta</option>
            <option value='0'>No cuenta</option>
        </select>
        <label>Realizo mejoras en el local</label>
        <select v-model='negocio.mejoras_local'>
            <option value='1'>Si realizo</option>
            <option value='0'>No realizo</option>
        </select>   
        <h2>Datos del vehiculo</h2>
        <label>Marca</label>
        <input type="text" v-model='vehiculo.marca'>
        <label>Modelo</label>
        <input type="text" v-model='vehiculo.modelo'>
        <label>Año fabricación</label>
        <select v-model='vehiculo.año'>
            <option value='1995'>1995</option>
            <option value='1996'>1996</option>
            <option value='1997'>1997</option>
            <option value='1998'>1998</option>
            <option value='1999'>1999</option>
            <option value='2001'>2001</option>
            <option value='2002'>2002</option>
            <option value='2003'>2003</option>
            <option value='2004'>2004</option>
            <option value='2005'>2005</option>
            <option value='2006'>2006</option>
            <option value='2007'>2007</option>
            <option value='2008'>2008</option>
            <option value='2009'>2009</option>
            <option value='2010'>2010</option>
            <option value='2011'>2011</option>
            <option value='2012'>2012</option>
            <option value='2013'>2013</option>
            <option value='2014'>2014</option>
            <option value='2015'>2015</option>
            <option value='2016'>2016</option>
            <option value='2017'>2017</option>
            <option value='2018'>2018</option>
            <option value='2018'>2018</option>
            <option value='2019'>2019</option>
        </select>
        <label>Tipo servicio que brinda</label>
        <input type='text' v-model='vehiculo.tipo_servicio_brinda'>
        <label>Antiguedad realizando el servicio</label>
        <input type='text' v-model='vehiculo.antiguedad_servicio'>
        <label> Permiso para brindar servicio</label>
        <select v-model='vehiculo.permiso_servicio'>
            <option value="1">Si cuenta</option>
            <option value="0">No cuenta</option>
        </select>
        <label>Horario trabajo</label>
        <input type='text' v-model='vehiculo.horario_servicio'>
        <h2>Informacion familiar</h2>
        <label>Tipo de vivienda</label>
        <select v-model='familiar.tipo_vivienda'>
            <option value='1'>Propia Cancelada</option>
            <option value='2'>Propia (hipoteca)</option>
            <option value='3'>De los padres</option>
            <option value='4'>De familiares</option>
            <option value='5'>Alquilada</option>
        </select>
        <label>Situacion familiar</label>
        <select v-model='familiar.situacion_familiar'>
            <option value='1'>Soltero</option>
            <option value='2'>Casado</option>
            <option value='3'>Conviviente</option>
        </select>
        <label>Miembros de familia</label>
        <input type='number' v-model='familiar.miembros_familia'> 
        <br>
        <label>Hijos</label>
        <table>
            <tr>
                <td>Edad</td>
                <td>Colegio</td>
                <td>Grado</td>
                <td>Costo</td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='familiar.hijos[1].edad'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[1].colegio'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[1].grado'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[1].costo'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='familiar.hijos[2].edad'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[2].colegio'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[2].grado'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[2].costo'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='familiar.hijos[3].edad'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[3].colegio'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[3].grado'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[3].costo'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='familiar.hijos[4].edad'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[4].colegio'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[4].grado'>
                </td>
                <td>
                    <input type='text' v-model='familiar.hijos[4].costo'>
                </td>
            </tr>
        </table>    
        <h2>COMENTARIOS (CENTRAL DE RIESGO)</h2>
        <table>
            <tr>
                <td>Entidad Financiera</td>
                <td>Capital</td>
                <td>Activo F</td>
                <td>Consumo</td>
                <td>Vehicular</td>
                <td>Hipoteca</td>
                <td>Terceros</td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='central_riesgo[1].entidad_financiera'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[1].capital'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[1].activo_f'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[1].consumo'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[1].vehicular'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[1].hipoteca'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[1].terceros'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='central_riesgo[2].entidad_financiera'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[2].capital'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[2].activo_f'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[2].consumo'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[2].vehicular'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[2].hipoteca'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[2].terceros'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='central_riesgo[3].entidad_financiera'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[3].capital'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[3].activo_f'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[3].consumo'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[3].vehicular'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[3].hipoteca'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[3].terceros'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='text' v-model='central_riesgo[4].entidad_financiera'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[4].capital'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[4].activo_f'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[4].consumo'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[4].vehicular'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[4].hipoteca'>
                </td>
                <td>
                    <input type='checkbox' v-model='central_riesgo[4].terceros'>
                </td>
            </tr>
        </table>  
        <h2>REFERENCIAS PERSONALES(Familiares, compañeros de trabajo, vecinos)</h2>
        <table>
            <tr>
                <td>Tipo de relación</td>
                <td>Nombre</td>
                <td>Telefono</td>
            </tr>
            <tr>
                <td>
                    <input v-model='referencias[1].tipo_relacion' type='text'>
                </td>
                <td>
                    <input v-model='referencias[1].nombre' type='text'>
                </td>
                <td>
                    <input v-model='referencias[1].telefono' type='text'>
                </td>
            </tr>
            <tr>
                <td>
                    <input v-model='referencias[2].tipo_relacion' type='text'>
                </td>
                <td>
                    <input v-model='referencias[2].nombre' type='text'>
                </td>
                <td>
                    <input v-model='referencias[2].telefono' type='text'>
                </td>
            </tr>
            <tr>
                <td>
                    <input v-model='referencias[3].tipo_relacion' type='text'>
                </td>
                <td>
                    <input v-model='referencias[3].nombre' type='text'>
                </td>
                <td>
                    <input v-model='referencias[3].telefono' type='text'>
                </td>
            </tr>
        </table>
        <h2>COLATERAL</h2>
        <label>Aval con casa propia</label>
        <select v-model='colateral'> 
            <option value='1'>Aval con casa propia</option>
            <option value='2'>Aval con casa alquilada</option>
            <option value='3'>Garantia liquida liquida</option>
            <option value='4'>Garantia vehicular</option>
            <option value='5'>Hipoteca inmobiliara</option>
            <option value='0'>Sin colateral</option>
        </select>
    </div>
</template>
<script>
export default {
    data(){
        return{
            principal:{
                destino_credito_descripcion:"",
                destino_credito:1,
                fuente_ingreso:""
            },
            negocio:{
                ubicacion:"",
                antiguedad:'1',
                local:1,
                licencia_funcionamiento:1,
                horario_atencion:"",
                mejoras_local:0
            },
            vehiculo:{
                marca:"",
                modelo:"",
                año:"",
                tipo_servicio_brinda:"",
                antiguedad_servicio:"",
                permiso_servicio:1,
                horario_trabajo:""
            },
            familiar:{
                tipo_vivienda:1,
                situacion_familiar:1,
                miembros_familia:1,
                hijos:{
                    1:{},
                    2:{},
                    3:{},
                    4:{}
                }
            },       
            central_riesgo:{
                1:{
                    entidad_financiera:"",
                    capital:false,
                    activo_f:false,
                    consumo:false,
                    vehicular:false,
                    hipoteca:false,
                    terceros:false
                },
                2:{
                    entidad_financiera:"",
                    capital:false,
                    activo_f:false,
                    consumo:false,
                    vehicular:false,
                    hipoteca:false,
                    terceros:false
                },
                3:{
                    entidad_financiera:"",
                    capital:false,
                    activo_f:false,
                    consumo:false,
                    vehicular:false,
                    hipoteca:false,
                    terceros:false
                },
                4:{
                    entidad_financiera:"",
                    capital:false,
                    activo_f:false,
                    consumo:false,
                    vehicular:false,
                    hipoteca:false,
                    terceros:false
                }
            },
            referencias:{
                1:{
                    tipo_relacion:"",
                    nombre:"",
                    telefono:""
                },
                2:{
                    tipo_relacion:"",
                    nombre:"",
                    telefono:""
                },
                3:{
                    tipo_relacion:"",
                    nombre:"",
                    telefono:""
                }
            },
            colateral:0
        }
    }
}
</script>