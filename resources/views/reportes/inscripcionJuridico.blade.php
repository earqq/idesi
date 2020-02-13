<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscripcion de Socio</title>
    <style>
        body{
            font-family: sans-serif;
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
                    <td  colspan="2" valign="middle" align="left"  style="width: 70%;border: none;"><span>SOLICITUD DE ADMISIÓN - PERSONA JURIDICA</span></td>
                
                    <td rowspan="2" style="padding: 10px 0;"><span class="title"> <img src="{{env('RUTA')}}/public/img/logo.png" alt="" srcset=""></span>  </td>
                </tr> 
                    
                <tr>
                <td colspan="2" style="padding: 10px 0;border: none;"><span class="title">Nro de Registro</span> 45222  <span class="title">Agencia</span> Huánuco </td>
                </tr>
            </table>


            <table style="width: 100%; margin: 4px 0 27px 0px;"   cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;border: none;font-size:12px;text-align: center">Sr. Presidente del Consejo de Administración de la Cooperativa de Ahorro
                         y Crédito Sembrar, solicito ser aceptado(a) como socio(a), asimismo me comprometo a cumplir con las disposiciones del Estatuto y Leyes vigentes.</th>
                    </tr>
                </thead>
            </table>



            <table style="width: 100%;    border: none;"   border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DATOS PERSONALES</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="2">
                            <span class="title">RAZON SOCIAL</span> {{$empresa->razon_social}} <span > </span>
                            </td>
                            <td >
                            <span class="title">RUC</span> {{$cliente->documento}} <span > </span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"> <span class="title">NOMBRE COMERCIAL </span>  <span>{{$empresa->nombre_comercial}} </span> </td>
                            <td> <span class="title">ACTIVIDAD PRINCIPAL</span> <span > {{$empresa->actividad_principal}} </span> </td>
                        </tr>
                        <tr>
                            <td colspan="2"> <span class="title">NRO. FR PARTIDA REGISTRAL</span> <span > {{$empresa->partida_registral}} </span> </td>
                            <td> <span class="title">OFICINA REGISTRAL</span> <span> {{$empresa->oficina_principal}}</span> </td>
                        </tr>
                        <tr>
                            <td> <span class="title">P.N CON NEGOCIO </span> <span >{{$empresa->tipo_negocio}}</span> </td>
                            <td colspan="2"> <span class="title">DIRECCIÓN</span> {{$cliente->ubicacion_direccion_declarada}} <span > </span> </td>
                        </tr>
                        <tr>
                            <td> <span class="title">NÚMERO</span> {{$cliente->ubicacion_numero}}</td>
                            <td> <span class="title">MZ</span>  {{$cliente->ubicacion_manzana}} </td>
                            <td> <span class="title">LOTE </span> {{$cliente->ubicacion_lote}}  </td>
                        </tr>
                        <tr>
                            <td> <span class="title">DPTO</span> {{$cliente->ubicacion_nro_departamento}}</td>
                            <td> <span class="title">INT</span> {{$cliente->ubicacion_interior}}</td>
                            <td> <span class="title">PISO </span>{{$cliente->ubicacion_piso}}</td>
                        </tr>
                        <tr>
                            <td> <span class="title">DISTRITO</span> <span >{{$cliente->ubicacion_distrito}}</span> </td>
                            <td> <span class="title">PROVINCIA</span> {{$cliente->ubicacion_provincia}} <span > </span> </td>
                            <td> <span class="title">DEPARTAMENTO</span> {{$cliente->ubicacion_departamento}} <span >  </span> </td>
                        </tr>


                        <tr>
                            <td colspan="3"> <span class="title">REFERENCIA</span> <span > {{$cliente->ubicacion_referencia}} </span> </td>
                        </tr>
                        
                        <tr>
                            <td> <span class="title">TELÉFONO</span> <span >{{$cliente->telefono}} </span> </td>
                            <td> <span class="title">CELULAR</span> {{$cliente->celular}}  <span > </span> </td>
                            <td> <span class="title">EMAIL</span> {{$cliente->email}} <span >  </span> </td>
                        </tr>

                </tbody>
            </table>
            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">REPRESENTANTES LEGALES</th>
                    </tr>
                </thead>
                <tbody>
                          <tr colspan="3" >
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                        <thead>

                                            
                                            <tr>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Apellidos y nombre</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Doc. Identidad</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cargo</th>
                                            </tr>
                                           
                                        </thead>

                                        @if (isset($representante))
                                            <tbody>
                                                @foreach ($representante as  $rep)
                                                        <tr>
                                                            <td>{{$rep->nombres}}</td>
                                                            <td>{{$rep->documento}}</td>
                                                            <td>{{$rep->cargo}}</td>
                                                        </tr>
                                                @endforeach           
                                            </tbody>
                                        @else
                                            <tbody>
                                                <td colspan="3">
                                                    <span>*****************************************  NO REGISTRA REPRESENTANTES  ******************************</span>
                                                </td>         
                                            </tbody>   
                                        @endif
                                       
                                    </table>
                            </tr>
                        

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">PRINCIPALES DIRECTORES</th>
                    </tr>
                </thead>
                <tbody>
                          <tr colspan="3" >
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                        <thead>

                                            
                                            <tr>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Apellidos y nombre</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Doc. Identidad</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Cargo</th>
                                            </tr>
                                           
                                        </thead>
                                        @if (isset($directores))
                                            <tbody>
                                                @foreach ($directores as  $dir)
                                                        <tr>
                                                            <td>{{$dir->nombres}}</td>
                                                            <td>{{$dir->documento}}</td>
                                                            <td>{{$dir->cargo}}</td>
                                                        </tr>
                                                @endforeach           
                                            </tbody>
                                        @else
                                        <tbody>
                                            <td colspan="3">
                                                <span>*****************************************  NO REGISTRA DIRECTORES  *********************************</span>
                                            </td>         
                                        </tbody>
                                        @endif
                                        
                                    </table>
                            </tr>
                        

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">PRINCIPALES ACCIONISTAS (más del 25%) O PARTICIPACIONISTAS Y/O ASOCIADOS</th>
                    </tr>
                </thead>
                <tbody>
                          <tr colspan="3" >
                                <table style="width: 100%;margin-bottom: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                                        <thead>

                                            
                                            <tr>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none; font-size: 10px">Apellidos y nombre</th>
                                                <th style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 10px">Doc. Identidad</th>
                                            </tr>
                                           
                                        </thead>
                                        @if (isset($accionistas))
                                            <tbody>
                                                @foreach ($accionistas as  $acci)
                                                        <tr>
                                                            <td>{{$acci->nombres}}</td>
                                                            <td>{{$acci->documento}}</td>
                                                        </tr>
                                                @endforeach           
                                            </tbody>
                                        @else
                                        <tbody>
                                            <td colspan="3">
                                                <span>*****************************************  NO REGISTRA ACCIONITAS  *********************************</span>
                                            </td>         
                                        </tbody>
                                        @endif
                                        
                                        
                                    </table>
                            </tr>
                        

                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">OBLIGACIONES ASOCIATIVAS</th>
                    </tr>
                </thead>
                <tbody>
                          
                    <tr>
                            <td colspan="3"><span class="title">Inscripción</span> S/. {{$obligacion->inscripcion}} <span class="title">Aporte</span> S/. {{$obligacion->aporte}}</td> 
                    </tr>
                </tbody>
            </table>

            <table style="width: 100%;margin-top: 20px;    border: none;" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="3" style="text-align: inherit;background: #e4e4e4;font-weight: 100;border: none;font-size: 12px">DECLARACIONES</th>
                    </tr>
                </thead>
                <tbody>
                          
                    <tr>
                        <td colspan="3"> <span class="title">Es sujeto obligado a informar a la UIF Perú</span> [ {{$declaracion->uif}}] </td>
                    </tr>
                    <tr>
                        <td><span class="title">Firma</span>____________________</td>
                        <td colspan="2" style="height: 70px;"> <div style="border: 1px solid; width: 100px; height: 70px;margin: 0 auto;"></div> </td>
                    </tr>
                    <tr>
                        <td><span class="title">Estado</span> 
                            @if ($cliente->estado=='1')
                                CREADO - PENDIENTE 
                            @endif 
                        </td>
                        <td colspan="2"><span class="title">Fecha</span> {{$declaracion->created_at}}</td>
                    </tr>

                    <tr>
                        <td colspan="3"> <span class="title">observaciones</span>
                            <span> {{$declaracion->observaciones}}
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
</body>
</html>