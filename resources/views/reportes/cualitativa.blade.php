<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EVALUACION CUALITATIVA</title>
    <style>
        body{
            font-family: monospace;
        } 
        td{
            border: 1px solid #d5d5d5;
            font-size: 12px;
        }
        .title{
            font-weight: bold
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
                
                    <td rowspan="2" style="padding: 10px 0;"><span class="title"> ***  Logo ****</span> </td>
                </tr>
                    
                <tr>
                <td colspan="2" style="padding: 10px 0;border: none;"><span class="title"></span>   <span class="title"></span>  </td>
                </tr>
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">DATOS PRINCIPALES</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td> <span class="title">FUENTE DE INGRESO </span> {{$cualitativa->principal['destino_credito_descripcion']}} <span > </span> </td>
                            <td > <span class="title">DESTINO DE CREDITO</span> {{$cualitativa->principal['destino_credito']}} <span > </span> </td>
                            <td > <span class="title">DESCRIPCIÓN DE DESTINO</span> {{$cualitativa->principal['fuente_ingreso']}} <span > </span> </td>
                        </tr>
                </tbody>
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead> 
                    <tr>
                        @if ($cualitativa->principal['fuente_ingreso'] == 'TRANSPORTE BAJAJ' || $cualitativa->principal['fuente_ingreso'] == 'TRANSPORTES')
                            <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">DATOS VEHICULO</th>
                        @else
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">DATOS NEGOCIO</th>
                        @endif
                        
                    </tr>
                </thead>
                @if ($cualitativa->principal['fuente_ingreso'] == 'TRANSPORTE BAJAJ' || $cualitativa->principal['fuente_ingreso'] == 'TRANSPORTES')
                    <tbody>
                        <tr>
                            <td> <span class="title">MARCA</span> {{$cualitativa->vehiculo['marca']}} <span > </span> </td>
                            <td > <span class="title">MODELO</span> {{$cualitativa->vehiculo['modelo']}} <span > </span> </td> 
                            <td > <span class="title">AÑO</span> {{$cualitativa->vehiculo['año']}} <span > </span> </td> 
                        </tr>
                        <tr>
                            <td > <span class="title">TIPO DE SERVICIO</span> {{$cualitativa->vehiculo['tipo_servicio_brinda']}} <span > </span> </td>
                            <td > <span class="title">ANTIGUEDAD DE SERVICIO</span> {{$cualitativa->vehiculo['antiguedad_servicio']}} <span > </span> </td> 
                            <td > <span class="title">PERMISO SERVICIO</span> {{$cualitativa->vehiculo['permiso_servicio']}} <span > </span> </td> 
                        </tr>
                        <tr>
                            <td > <span class="title">HR. SERVICIO INICIO</span> {{$cualitativa->vehiculo['horario_servicio_inicio']}} <span > </span> </td>
                            <td > <span class="title">HR. SERVICIO FIN</span> {{$cualitativa->vehiculo['horario_servicio_fin']}} <span > </span> </td> 
                            <td ></td> 
                        </tr>
                    
                    </tbody>        
                @else
                 <tbody>
                    <tr>
                        <td> <span class="title">UBICACIÓN DE INGRESO </span> {{$cualitativa->negocio['ubicacion']}} <span > </span> </td>
                        <td > <span class="title">ANITGUEDAD</span> {{$cualitativa->negocio['antiguedad']}} <span > </span> </td> 
                        <td > <span class="title">LOCAL</span> {{$cualitativa->negocio['local']}} <span > </span> </td> 
                    </tr>
                    <tr>
                        <td > <span class="title">LICENCIA FUNCIONAMIENTO</span> {{$cualitativa->negocio['licencia_funcionamiento']}} <span > </span> </td>
                        <td > <span class="title">REALIZO MEJORAS</span> {{$cualitativa->negocio['mejoras_local']}} <span > </span> </td> 
                        <td ></td> 
                    </tr>
                    <tr>
                        <td> <span class="title">HR. ATENCION INICIO </span> {{$cualitativa->negocio['horario_atencion_inicio']}} <span > </span> </td>
                        <td > <span class="title">HR. ATENCION ENTRADA</span> {{$cualitativa->negocio['horario_atencion_entrada']}} <span > </span> </td> 
                        <td > <span class="title">HR. ATENCION SALIDA</span> {{$cualitativa->negocio['horario_atencion_salida']}} <span > </span> </td> 
                    </tr>
                 </tbody> 
                @endif
                
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">DATOS FAMILIARES</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td> <span class="title">TIPO DE VIVIENDA </span> {{$cualitativa->familiar['tipo_vivienda']}}  <span > </span> </td>
                            <td > <span class="title">SITUACIÓN FAMILIAR</span>  {{$cualitativa->familiar['situacion_familiar']}} <span > </span> </td> 
                            <td > <span class="title">MIEMBROS DE FAMILIA</span>  {{$cualitativa->familiar['miembros_familia']}} <span > </span> </td> 
                        </tr>

                        @if ($cualitativa->familiar['numero_hijos']==0)
                            <tr>
                                <td colspan="3">*****************************************   NO REGISTRA HIJOS  ***********************************</td>
                            </tr>
                        @else

                            <tr>
                                <td colspan="3">
                                    <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
    
                                        
                                        <tr>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Edad</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Colegio</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Grado</th>
                                            <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Costo</th>
                                          </tr>
                                       
                                    </thead>
                                    <tbody>
                                            @foreach ($cualitativa->familiar['hijos'] as $hijos)
                                                <tr>
                                                    <td>{{$hijos['edad']}}</td>
                                                    <td>{{$hijos['colegio']}}</td>
                                                    <td>{{$hijos['grado']}}</td>
                                                    <td>S/. {{$hijos['costo']}}</td>
                                                </tr>      
                                            @endforeach
                                                  
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
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">CENTRAL DE RIESGO</th>
                    </tr>
                </thead>
                <tbody>

                    <tr  >
                        <td colspan="3">
                            <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                <thead>

                                    
                                    <tr>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Entidad Financiera</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cap. Trabajo</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Activo Fijo</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Consumo Fijo</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Vehicular</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Hipoteca</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Terceros</th>
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    
                                    
                                        
                                    
                                    @foreach ($cualitativa->central_riesgo as $cual)
                                    @if ($cual['capital'])
                                    <tr>
                                        <td>{{$cual['entidad_financiera']}}</td>
                                        
                                        @if ($cual['capital'])
                                            <td style="text-align: center;background: #009688;color: #fff">
                                                SI
                                            </td>
                                        @else
                                            <td style="text-align: center">
                                                NO
                                            </td>
                                         @endif
                                        
                                        
                                            @if ($cual['activo_f'])
                                            <td style="text-align: center;background: #009688;color: #fff">
                                                SI
                                            </td>
                                            @else
                                            <td style="text-align: center;">
                                                NO
                                            </td>
                                            @endif
                                         
                                            @if ($cual['consumo'])
                                            <td style="text-align: center;background: #009688;color: #fff">
                                                SI
                                            </td>
                                            @else
                                            <td style="text-align: center;">
                                                NO
                                            </td>
                                            @endif
                                          
                                            @if ($cual['vehicular'])
                                            <td style="text-align: center;background: #009688;color: #fff">
                                                SI
                                            </td>
                                            @else
                                            <td style="text-align: center;">
                                                NO
                                            </td>
                                            @endif
                                          
                                            @if ($cual['hipoteca'])
                                            <td style="text-align: center;background: #009688;color: #fff">
                                                SI
                                            </td>
                                            @else
                                            <td style="text-align: center;">
                                                NO
                                            </td>
                                            @endif
                                          
                                            @if ($cual['terceros'])
                                            <td style="text-align: center;background: #009688;color: #fff">
                                                SI
                                            </td>
                                            @else
                                            <td style="text-align: center;">
                                                NO
                                            </td>
                                            @endif
                                         
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr  >
                         <td colspan="3">
                            <span class="title">COMENTARIOS</span>
                            <span>
                                {{$cualitativa->comentario_central_riesgo}} 
                            </span>
                         </td>
                    </tr>

                </tbody>
            </table>

            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">REFERENCIAS</th>
                    </tr>
                </thead>
                <tbody>

                    <tr colspan="3" >
                        <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                <thead>

                                    
                                    <tr>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Tipo de relación</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Nombre</th>
                                        <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Telefono</th> 
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    @foreach ($cualitativa->referencias as $ref)
                                    @if ($ref['tipo_relacion'])
                                        
                                    
                                    <tr>
                                        <td>{{ $ref['tipo_relacion']}}</td>
                                        <td>{{ $ref['nombre']}}</td>
                                        <td>{{ $ref['telefono']}}</td> 
                                    </tr>
                                    @endif
                                    @endforeach   
                                </tbody>
                            </table>
                    </tr>  
                </tbody>
            </table>

           
            
            <table style="width: 100%; margin-top: 20px;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;">COLATERAL</th>
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