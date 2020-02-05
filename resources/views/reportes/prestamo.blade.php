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
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px">Solicitud de Crèdito- Persona Natural</th>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px;text-align: end;">Nº <span> 15 </span></th>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px;text-align: end;">Aporte a la fecha <span> S/. 2500</span></th>
                    </tr>
                </thead>
            </table>

            <table style="width: 100%;"   border="1" cellpadding="5" cellspacing="0">
                <tbody>
                        <tr>
                            <td> <span class="title">MONTO</span> <span > S/. {{$prestamo->monto_inicial}}</span> </td>
                            <td> <span class="title">PLAZO</span> <span > {{$prestamo->plazo_inicial}}</span> </td>
                            <td> <span class="title">DISPONIBILIDAD DE PAGO</span> <span >S/. {{$prestamo->disponibilidad_pago_inicial}}</span> </td>
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
                            <td colspan="3">
                            <span class="title">Apellidos y Nombres</span>  <span > {{$natural->apellidos}} {{$natural->nombres}}</span>
                            </td>
                        </tr>

                        <tr>
                            <td> <span class="title">Dni</span> <span >{{$cliente->documento}}</span> </td>
                        <td> <span class="title">F. Nacimiento</span> <span > {{$natural->nacimiento}}</span> </td>
                            <td> <span class="title">Estado civil</span> <span > {{$natural->estado_civil}} </span> </td>
                        </tr>
                        <tr>
                            <td> <span class="title">Departamento</span> <span >HUANUCO</span> </td>
                            <td> <span class="title">Provincia</span> <span > HUANUCO</span> </td>
                            <td> <span class="title">Distrito</span> <span > HUANUCO </span> </td>
                        </tr>
                        <tr>
                            
                            <td> <span class="title">Telefono</span> <span > {{$natural->telefono}}</span> </td>
                            <td colspan="2"> <span class="title">Celular</span> <span > {{$natural->celular}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">Ocupación</span> <span > {{$natural->ocupacion}}</span> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <span class="title">Dirección</span> <span > {{$natural->direccion_cliente}}</span> </td>
                        </tr>

                        <tr>
                            <td colspan="2"> <span class="title">Referencia</span> <span > {{$natural->referencia}}</span> </td>
                            <td> <span class="title">Tipo de domicilio</span> <span > {{$natural->tipo_domicilio}}</span> </td>
                        </tr>

                        <tr>
                        <td > <span class="title">Centro laboral</span>  <span > {{$natural->centro_laboral}}</span> </td>
                            <td colspan="2"> <span class="title">Dirección</span> <span > {{$natural->direccion_laboral}} </span> </td>
                        </tr>

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">CONYUGE O CONVIVIENTE</th>
                    </tr>
                </thead>
                @if ($tiene_conyuge=='SI')
                <tbody>
                    <tr>
                        <td colspan="3">
                        <span class="title"> Apellidos y Nombres</span>  <span > {{$conyugue->nombres}}</span>
                        </td>
                    </tr>

                    <tr>
                        <td> <span class="title">Dni</span> <span > {{$conyugue->documento}}</span> </td>
                        <td> <span class="title">F. Nacimiento</span> <span > {{$conyugue->nacimiento}}</span> </td>
                        <td> <span class="title">Estado civil</span> <span > {{$conyugue->estado_civil}} </span> </td>
                    </tr>
                    <tr>
                        <td> <span class="title">Ocupación</span> <span > {{$conyugue->ocupacion}}</span> </td>
                        <td> <span class="title">Teléfono</span> <span > {{$conyugue->telefono}}</span> </td>
                        <td> <span class="title">Celular</span> <span > {{$conyugue->celular}} </span> </td>
                    </tr>
                    <tr>
                        @if ($conyugue->socio == 'si')
                        <td> <span class="title">¿Es socio?</span> SI <span > [ X ] </span>  NO <span > [  ] </span> </td>
                        <td> <span class="title">Codigo de socio </span><span > {{$conyugue->codigo_socio}}</span> </td>
                        <td> <span class="title">Aporte</span> <span > S/. {{$conyugue->aporte_socio}}</span> </td>
                        @else
                        <td> <span class="title">¿Es socio?</span> SI <span > [  ] </span>  NO <span > [ X ] </span> </td>
                        <td> <span class="title">Codigo de socio </span><span > -- --</span> </td>
                        <td> <span class="title">Aporte</span> <span > -- -- </span> </td>
                        @endif
                        
                        
                    </tr>

                    <tr>
                        <td > <span class="title">Centro laboral</span>  <span > {{$conyugue->centro_laboral}}</span> </td>
                        <td colspan="2" > <span class="title">Dirección</span> <span > {{$conyugue->direccion}} </span> </td>
                    </tr>

            </tbody>
            @else
            <tbody>
                <tr>
                    <td colspan="3">
                        <span>*****************************************  NO REGISTRA CONYUGE  **********************************</span>
                    </td>
                </tr>

            </tbody>
            @endif
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
                            <td> <span class="title">IMPORTE</span> <span >S/. {{$prestamo->importe}}</span> </td>
                            <td> <span class="title">PLAZO</span> <span > {{$prestamo->plazo}}</span> </td>
                            <td> <span class="title">CUOTAS</span> <span > {{$prestamo->cuotas}} </span> </td>
                            <td> <span class="title">APORTE</span> <span >S/. {{$prestamo->aporte}} </span> </td>
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
                                <td><span class="title">INS.</span><span > [ {{$garantia->inscripcion}} ] </span>  <span class="title">D.J</span> <span>[ {{$garantia->declaracion_jurada}}]</span></td>
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
                            <th colspan="2" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">COMITÉ DE CRÉDITO</th>
                            <th style="background: #fff;border: 1px solid #e4e4e4;"> <span > </span> </th>
                        </tr>
                    </thead>
                    <tbody>
                            
                        @if ($evaluacion != '')
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
                                <td colspan="3" style="text-align: center">NO EXISTE EVALUACIÓN</td>
                            </tr>
                            
                        @endif

    
                    </tbody>
                </table>

                <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">COMITÉ DE CRÉDITO FINAL</th>
                            <th style="background: #fff;border: 1px solid #e4e4e4;"> <span > </span> </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            {{-- <tr style="background: #e4e4e4;">
                                <td colspan="2"> <span class="title">¿OBSERVACIONES LEVANTADAS?</span>SI <span > [ X ] </span>  NO <span > [  ] </span></td>
                                <td style="background: #fff"> <span > </span> </td>
                            </tr> --}}
                            @if ($prestamo->estado == 'PENDIENTE')
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