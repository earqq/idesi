<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EVALUACION CUALITATIVA</title>
    <style>
        body{
            font-family: sans-serif;
        } 
        td{ border: 1px solid #d5d5d5;
            font-size: 12px;
        }
        .title{
            font-weight: bold;
            font-size: 11px;
        }
    </style>
</head>
<body>


    
            <table style="border: none;" width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
                <tr style="border: none;">
                    <th style="border: none;"></th>
                    <th style="border: none;"></th>
                    <th style="border: none;"></th>
                </tr>
                <tr >
                    <td  colspan="2" valign="middle" align="left"  style="width: 80%;border: none;"><span>EVALUACIÓN CUALITATIVA DEL PRESTAMO</span></td>
                
                    <td rowspan="2" style="padding: 10px 0;"><span class="title"> <img src="{{env('RUTA')}}/public/img/logo.png" alt="" srcset=""></span> </td>
                </tr>
                    
                <tr>
                <td colspan="2" style="padding: 10px 0;border: none;"><span class="title"></span>   <span class="title"></span>  </td>
                </tr>
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS PRINCIPALES</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td> <span class="title">FUENTE DE INGRESO </span> {{$cualitativa->fuente_ingresos}} <span > </span> </td>
                            <td > <span class="title">DESTINO DE CREDITO</span> {{$cualitativa->destino_credito}} <span > </span> </td>
                            <td > <span class="title">DESCRIPCIÓN DE DESTINO</span> {{$cualitativa->destino_credito_descripcion}} <span > </span> </td>
                        </tr>
                </tbody>
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead> 
                    <tr>
                        @if ($cualitativa->fuente_ingresos == 'TRANSPORTE BAJAJ' || $cualitativa->fuente_ingresos == 'TRANSPORTES')
                            <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">DATOS VEHICULO</th>
                        @else
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS NEGOCIO</th>
                        @endif
                        
                    </tr>
                </thead>
                @if ($cualitativa->fuente_ingresos == 'TRANSPORTE BAJAJ' || $cualitativa->fuente_ingresos == 'TRANSPORTES')
                    <tbody>
                        <tr>
                            <td> <span class="title">MARCA: </span> {{$cualitativa->vehiculo_marca}} <span > </span> </td>
                            <td > <span class="title">MODELO: </span> {{$cualitativa->vehiculo_modelo}} <span > </span> </td> 
                            <td > <span class="title">AÑO: </span> {{$cualitativa->vehiculo_anio}} <span > </span> </td> 
                        </tr>
                        <tr>
                            <td > <span class="title">TIPO DE SERVICIO: </span> {{$cualitativa->vehiculo_tipo_servicio_brinda}} <span > </span> </td>
                            <td > <span class="title">ANTIGUEDAD DE SERVICIO: </span> {{$cualitativa->vehiculo_antiguedad_servicio}} <span > </span> </td> 
                            <td > <span class="title">PERMISO SERVICIO: </span> 
                            {{ $cualitativa->vehiculo_permiso_servicio ? 'SI' : 'NO' }} 
                            <span > </span> </td> 
                        </tr>
                        <tr>
                            <td > <span class="title">HR. SERVICIO INICIO</span> {{$cualitativa->horario_atencion_entrada}} <span > </span> </td>
                            <td > <span class="title">HR. SERVICIO FIN</span> {{$cualitativa->horario_atencion_salida}} <span > </span> </td> 
                            <td ></td> 
                        </tr>
                    
                    </tbody>        
                @else
                 <tbody>
                    <tr>
                        <td> <span class="title">UBICACIÓN DE INGRESO </span> {{$cualitativa->negocio_ubicacion}} <span > </span> </td>
                        <td > <span class="title">ANTIGUEDAD</span> {{$cualitativa->negocio_antiguedad}} <span > </span> </td> 
                        <td > <span class="title">LOCAL</span> {{$cualitativa->negocio_local}} <span > </span> </td> 
                    </tr>
                    <tr>
                        <td > <span class="title">LICENCIA FUNCIONAMIENTO</span>
                        {{$cualitativa->negocio_licencia_funcionamiento ?  'SI' : 'NO' }}
                        <span > </span> </td>
                        <td > <span class="title">REALIZO MEJORAS</span>
                        {{$cualitativa->negocio_mejoras_local ? 'SI' :  'NO'}}
                        <span > </span> </td> 
                        <td ></td> 
                    </tr>
                    <tr>
                        <td > <span class="title">HR. ATENCION ENTRADA</span> {{$cualitativa->horario_atencion_entrada}} <span > </span> </td> 
                        <td > <span class="title">HR. ATENCION SALIDA</span> {{$cualitativa->horario_atencion_salida}} <span > </span> </td> 
                    </tr>
                 </tbody> 
                @endif
                
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS FAMILIARES</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td> <span class="title">TIPO DE VIVIENDA </span> {{$cualitativa->familiar['tipo_vivienda']}}  <span > </span> </td>
                            <td > <span class="title">SITUACIÓN FAMILIAR</span>  {{$cualitativa->familiar['situacion_familiar']}} <span > </span> </td> 
                            <td > <span class="title">MIEMBROS DE FAMILIA</span>  {{count($cualitativa->prestamo->cliente->persona->hijos)}} <span > </span> </td> 
                        </tr>

                        @if (!$cualitativa->prestamo->cliente->persona->hijos)
                            <tr>
                                <td colspan="3" style="text-align: center">  NO REGISTRA HIJOS</td>
                            </tr>
                        @else

                            <tr>
                                <td colspan="3">
                                    <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Documento</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Nombres</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Fecha nacimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody> 

                                        @if($cualitativa->prestamo->cliente->persona->hijos)
                                            @foreach ($cualitativa->prestamo->cliente->persona->hijos as $hijos)
                                                    <tr>
                                                        <td>{{$hijos['documento']}}</td>
                                                        <td>{{$hijos['nombres']}}</td>
                                                        <td>{{$hijos['fecha_nacimiento']}}</td>
                                                    </tr>  
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                </td>
                            </tr>
                        @endif
                </tbody>
            </table>
            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 12px">CENTRAL DE RIESGO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <span class="title">COMENTARIOS: </span>
                            <span>
                                {{$cualitativa->comentario_central_riesgo}} 
                            </span>
                        </td>
                    </tr> 
                    <tr colspan="3" >
                        <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                <thead>             
                                    <tr>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Entidad Financiera</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cap. Trabajo</th> 
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Activo Fijo</th> 
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Consumo Fijo</th> 
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Vehicular</th> 
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Hipoteca</th> 
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Terceros</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cualitativa->central_riesgo)
                                        @foreach ($cualitativa->central_riesgo as $cual)
                                        @if ($cual['entidad'])
                                            <tr>
                                                <td>{{$cual['entidad']}}</td>
                                                <td>{{ $cual['capital_trabajo'] ? 'SI' : 'NO'}}</td>
                                                <td> {{ $cual['activo_fijo'] ? 'SI' : 'NO'}}</td>
                                                <td>{{ $cual['consumo'] ? 'SI' : 'NO'}}</td>
                                                <td>{{ $cual['vehicular'] ? 'SI' : 'NO'}}</td>
                                                <td>{{ $cual['hipoteca'] ? 'SI' : 'NO'}}</td>
                                                <td>{{ $cual['terceros'] ? 'SI' : 'NO'}}</td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">REFERENCIAS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr colspan="3" >
                        <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Tipo de relación</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Nombre</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Telefono</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @if (is_array($cualitativa->referencias) || is_object($cualitativa->referencias))      
                                        @foreach ($cualitativa->referencias as $ref)
                                            @if ($ref['tipo_relacion'])
                                                <tr>
                                                    <td>{{ $ref['tipo_relacion']}}</td>
                                                    <td>{{ $ref['nombres']}}</td>
                                                    <td>{{ $ref['telefonos']}}</td> 
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                    </tr>  
                </tbody>
            </table>

           
            
            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">COLATERAL</th>
                    </tr>
                </thead>
                <tbody>

                    <tr colspan="3" >
                        <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                <thead>

                                    
                                    <tr>
                                        <th style="text-align: inherit; font-weight: 100;border: none; font-size: 10px">Colateral</th>
                                        <th style="text-align: inherit ;font-weight: 100;border: none;font-size: 10px">Comentarios</th> 
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$cualitativa->colateral}}</td>
                                        <td>{{$cualitativa->comentario_colateral}}</td> 
                                    </tr>       
                                </tbody>
                            </table>
                    </tr>  
                </tbody>
            </table>

</body>
</html> 