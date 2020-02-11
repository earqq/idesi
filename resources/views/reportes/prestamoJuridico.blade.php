<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: sans-serif;
        }
        /* span{
            border: 1px solid #cbcbcb;
            padding: 2px 19px;
            border-radius: 2px;
            width: 100%;
        } */
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
                    <td  rowspan="2" valign="middle" align="left"  style="width: 70%">
                        <img src="{{env('RUTA')}}/public/img/logo.png" alt="" srcset="">
                    </td>
                
                <td colspan="2" style="padding: 10px 0;"><span class="title">Fecha</span> {{$prestamo->created_at}}</td>
                </tr>
                    
                <tr>
                <td colspan="2" style="padding: 10px 0;"><span class="title">Codigo de socio</span> {{$cliente->codigo}}</td>
                </tr>
            </table>


            <table style="width: 100%;    margin: 30px 0 5px 0;"   cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px">SOLICITUD DE CREDITO PERSONA JURIDICA</th>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px;text-align: end;">Nº <span> 15 </span></th>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px;text-align: end;">APORTE A LA FECHA <span> S/. 2500</span></th>
                    </tr>
                </thead>
            </table>

            <table style="width: 100%;"   border="1" cellpadding="5" cellspacing="0">
                <tbody>
                        <tr>
                            <td> <span class="title">MONTO</span> <span > S/. {{$prestamo->monto_inicial}}</span> </td>
                            <td> <span class="title">PLAZO</span> <span > {{$prestamo->cuotas_inicial}}</span> </td>
                            <td> <span class="title">DISPONIBILIDAD DE PAGO</span> <span > {{$prestamo->disponibilidad_pago_inicial}}</span> </td>
                        </tr>
                        <tr>
                            <td colspan="2" ><span class="title">DESTINO</span> <span > {{$prestamo->destino_inicial}}</span> </td>
                            <td> <span class="title">FORMA</span> <span > {{$prestamo->forma_inicial}}</span> </td>
                        </tr>

                </tbody>
            </table>


            <table style="width: 100%;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">TITULAR</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="2">
                            <span class="title">RAZON SOCIAL</span>  <span > {{$juridico->razon_social}}</span>
                            </td>
                            <td> <span class="title">RUC</span> <span >{{$cliente->documento}}</span> </td>
                        </tr>

                        <tr>
                            <td> <span class="title">NOMBRE COMERCIAL</span> <span >{{$cliente->nombre_comercial}}</span> </td>
                            <td> <span class="title">ACTIVIDAD</span> <span > {{$juridico->actividad_principal}}</span> </td>
                            <td> <span class="title">NUMERO DE PARTIDA</span> <span > {{$juridico->partida_registral}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">DIRECCIÓN</span> <span >{{$juridico->direccion}}</span> </td>
                        </tr>
                        <tr>
                            
                        <td> <span class="title">FECHA DE CONSTITUCIÓN</span> <span > {{$juridico->telefono}}</span> </td>
                            <td colspan="2"> <span class="title">EMAIL</span> <span > {{$juridico->email}} </span> </td>
                        </tr>
                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">REPRESENTANTE LEGAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                        <span class="title"> APELLIDOS Y NOMBRES</span>  <span > {{$juridico->nombres_representante}}</span>
                        </td>
                    </tr>

                    <tr>
                        <td> <span class="title">DNI</span> <span > {{$juridico->nombres_representante}}</span> </td>
                        <td> <span class="title">F. NACIMIENTO</span> <span > {{$juridico->nacimiento_representante}}</span> </td>
                        <td> <span class="title">ESTADO CIVIL</span> <span > {{$juridico->estado_civil_representante}} </span> </td>
                    </tr>
                    <tr>
                        <td> <span class="title">OCUPACIÓN</span> <span > {{$juridico->ocupacion_representante}}</span> </td>
                        <td> <span class="title">TELÉFONO</span> <span > {{$juridico->telefono_representante}}</span> </td>
                        <td> <span class="title">CELULAR</span> <span > {{$juridico->celular_representante}} </span> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <span class="title">DIRECCION</span> <span > {{$juridico->direccion_representante}}</span> </td>
                        <td> <span class="title">DISTRITO</span> <span > {{$juridico->distrito_representante}}</span> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <span class="title">PROVINCIA</span> <span > {{$juridico->provincia_representante}}</span> </td>
                        <td> <span class="title">DEPARTAMENTO</span> <span > {{$juridico->departamento_representante}}</span> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <span class="title">REFERENCIA</span> <span > {{$juridico->referencia_representante}}</span> </td>
                        <td> <span class="title">TIPO DOMICILIO</span> <span > {{$juridico->tipo_domicilio_representante}}</span> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <span class="title">PODERES (ASIENTOA)</span> <span > {{$juridico->poderes_representante}}</span> </td>
                        <td> <span class="title">FECHA INICIO (CARGO)</span> <span > {{$juridico->fecha_inicio_representante}}</span> </td>
                    </tr>
            </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;;">AVAL</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($avals as $aval)
                           <tr>
                                <td colspan="2">
                                    <span class="title">Apellidos y Nombres</span> <span > {{$aval->apellidos}} {{$aval->nombres}}</span>
                                </td>
                                @if ($aval->tipo_persona == 'pn')
                                   <td>
                                        <span class="title">P. Natural</span> <span > [ X ]</span>
                                    </td>    
                                @else
                                <td>
                                        <span class="title">P. Juridico</span> <span > [ X ]</span>
                                    </td>
                                @endif
                            </tr>
    
                            <tr>
                                <td> <span class="title">Dni</span> <span > {{$aval->documento}}</span> </td>
                                <td> <span class="title">F. de Nacimiento</span><span > {{$aval->nacimiento}}</span> </td>
                                <td> <span class="title">Estado civil</span> <span > {{$aval->estado_civil}}</span> </td>
                            </tr>
                            <tr>
                                <td> <span class="title">Ocupación</span> <span > {{$aval->ocupacion}}</span> </td>
                                <td> <span class="title">Teléfono</span> <span > {{$aval->telefono}}</span> </td>
                                <td> <span class="title">Celular</span> <span > {{$aval->celular}} </span> </td>
                            </tr>
                            <tr>
                                    @if ($aval->socio == 'si')
                                    <td> <span class="title">¿Es socio?</span> SI <span > [ X ] </span>  NO <span > [  ] </span> </td>
                                    <td> <span class="title">Codigo de socio </span><span > {{$aval->codigo_socio}}</span> </td>
                                    <td> <span class="title">Aporte</span> <span > S/. {{$aval->aporte_socio}}</span> </td>
                                    @else
                                    <td> <span class="title">¿Es socio?</span> SI <span > [  ] </span>  NO <span > [ X ] </span> </td>
                                    <td> <span class="title">Codigo de socio </span><span > -- --</span> </td>
                                    <td> <span class="title">Aporte</span> <span > -- -- </span> </td>
                                    @endif

                            </tr>
    
                            <tr>
                                <td colspan="2" > <span class="title">Dirección</span>  <span > {{$aval->direccion}}</span> </td>
                                <td  > <span class="title">Distrito</span> <span > {{$aval->distrito}} </span> </td>
                            </tr>
                            <tr>
                                <td > <span class="title">Centro laboral</span>  <span > {{$aval->centro_laboral}}</span> </td>
                                <td colspan="2" > <span class="title">Dirección</span> <span > {{$aval->direccion_laboral}} </span> </td>
                            </tr>
                        @endforeach
                        

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">GARANTIA</th>
                    </tr>
                </thead>
                <tbody>
                        
                    @foreach ($garantias as $garantia)
                        <tr>
                        <td colspan="2"> <span class="title">Bien de garantia </span> <span > {{$garantia->bien_garantia}}</span> </td>
                            <td><span class="title">INS.</span><span > [ {{$garantia->inscripcion}} ] </span>  <span class="title">D.J</span> <span>[ {{$garantia->declaracion_jurada}} ]</span></td>
                        </tr> 

                    @endforeach
                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">PROPUESTA DEL ANALISTA</th>
                        <th style="background: #fff;border: 1px solid #e4e4e4;"> <span > </span> </th>
                    </tr>
                </thead>
                <tbody>
                        

                        <tr>
                            <td colspan="4"> <span class="title">PRODUCTO</span><span > {{$prestamo->producto}}</span> </td>
                            {{-- <td> <span class="title">FORMA</span> <span > {{$prestamo->forma}}</span> </td> --}}
                        </tr>
                        <tr>
                            <td> <span class="title">IMPORTE</span> <span > {{$prestamo->importe}}</span> </td>
                            <td> <span class="title">PLAZO</span> <span > {{$prestamo->plazo}}</span> </td>
                            <td> <span class="title">CUOTAS</span> <span > {{$prestamo->cuotas}} </span> </td>
                            <td> <span class="title">APORTE</span> <span > {{$prestamo->aporte}} </span> </td>
                        </tr>
                        @foreach ($avals as $aval)
                        <tr>
                                <td colspan="3"> <span class="title">Aval</span> <span > {{$aval->apellidos}} {{$aval->nombres}} </span> </td>
                                <td> <span class="title">Dni</span> <span > {{$aval->documento}}</span> </td>
                            </tr>   
                        @endforeach
                        
                        @foreach ($garantias as $garantia)
                        <tr>
                                <td colspan="3"> <span class="title">Bien de garantia </span> <span > {{$garantia->bien_garantia}} </span> </td>
                                <td><span class="title">INS.</span><span > [ {{$garantia->inscripcion}} ] </span>  <span class="title">D.J</span> <span>[ {{$garantia->declaracion_jurada}} ]</span></td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <td colspan="4" > COMENTARIOS <span > {{$prestamo->comentarios}} </span></td>
                        </tr>


                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">COMITÉ DE CRÉDITO</th>
                        {{-- <th style="background: #fff;border: 1px solid #e4e4e4;"> <span > </span> </th> --}}
                    </tr>
                </thead>
                <tbody>
                        
                       @if ($evaluacion)
                            @foreach ($evaluacion as $eval)
                                    <tr>
                                        @if ($eval->estado=='OBSERVADO')
                                            <td> <span class="title">APROBADO</span><span > [    --     ]</span> </td>
                                            <td> <span class="title">DESAPROBADO</span> <span > [    --     ]</span> </td>
                                            <td> <span class="title">OBSERVADO</span> <span style="background: #009688;color:#fff"  > [     X    ]</span> </td>
                                        @elseif($eval->estado=='APROBADO')
                                            <td> <span class="title">APROBADO</span><span style="background: #009688;color:#fff" > [     X    ]</span> </td>
                                            <td> <span class="title">DESAPROBADO</span> <span > [   --      ]</span> </td>
                                            <td> <span class="title">OBSERVADO</span> <span > [    --     ]</span> </td>
                                        @elseif($eval->estado=='DESAPROBADO')
                                            <td> <span class="title">APROBADO</span><span > [     --    ]</span> </td>
                                            <td> <span class="title">DESAPROBADO</span> <span style="background: #009688;color:#fff"  > [    X     ]</span> </td>
                                            <td> <span class="title">OBSERVADO</span> <span > [   --      ]</span> </td>
                                        @endif
                                    </tr>
                                    <tr>
                                    <td colspan="3"> <span class="title">INDICACIONES</span> <span > {{$eval->detalle}}</span> </td>
                                    </tr> 
                                
                            @endforeach

                        @else
                            <tr>
                                <td colspan="3" style="text-align: center">
                                        NO REGISTRA EVALUACIONES
                                </td>
                            </tr>
                        @endif


                </tbody>
            </table>
            
            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">COMITÉ DE CRÉDITO FINAL</th>
                        {{-- <th style="background: #fff;border: 1px solid #e4e4e4;"> <span > </span> </th> --}}
                    </tr>
                </thead>
                <tbody>
                    
                        {{-- <tr style="background: #e4e4e4;">
                            <td colspan="2"> <span class="title">¿OBSERVACIONES LEVANTADAS?</span>SI <span > [ X ] </span>  NO <span > [  ] </span></td>
                            <td style="background: #fff"> <span > </span> </td>
                        </tr> --}}
                        @if ($prestamo->estado == 2)
                            <tr>
                                <td colspan="3" style="text-align: center"> LA SOLICITUD DE CREDITO ESTA EN EVALUACIÓN</td>
                            </tr>
                        @elseif($prestamo->estado == 'DESAPROBADO')
                            <tr>
                                <td colspan="3" style="text-align: center"> LA SOLICITUD DE CREDITO FUE RECHAZADA</td>
                            </tr>
                        @elseif($prestamo->estado == 'APROBADO')
                            <tr>
                                <td colspan="3" style="text-align: center"> LA SOLICITUD DE CREDITO FUE APROBADA</td>
                            </tr>
                            <tr>
                                    <td colspan="2"> <span class="title">PRODUCTO</span> <span> {{$prestamo->producto_final}} </span> </td>
                                    <td> <span class="title">APORTE</span> {{$prestamo->aporte_final}}  </td>
                            </tr>
                            <tr>
                                    <td> <span class="title">IMPORTE</span> <span > {{$prestamo->importe_final}}</span> </td>
                                    <td> <span class="title">PLAZO</span> <span > {{$prestamo->plazo_final}}</span> </td>
                                    <td> <span class="title">CUOTAS</span> <span > {{$prestamo->cuota_final}} </span> </td>
                                </tr>
                            <tr>
                                    <td colspan="3"> <span class="title">TAZA</span> <span > {{$prestamo->taza_final}} </span> </td>
                            </tr>
                        @endif


                </tbody>
            </table>

            
</body>
</html>